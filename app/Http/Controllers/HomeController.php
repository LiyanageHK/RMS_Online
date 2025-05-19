<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $status = session('status');

        // Get counts from database
        $totalItems = DB::selectOne("SELECT COUNT(*) as count FROM items")->count;
        $totalProducts = DB::selectOne("SELECT COUNT(*) as count FROM products")->count;
        $activeProducts = DB::selectOne("SELECT COUNT(*) as count FROM products WHERE status = 1")->count;
        $totalCategories = DB::selectOne("SELECT COUNT(*) as count FROM item_categories")->count;

        // Get monthly sales data for chart
        $monthlySales = DB::select("
            SELECT 
                DATE_FORMAT(created_at, '%b') as month,
                COUNT(*) as count
            FROM products 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            GROUP BY DATE_FORMAT(created_at, '%b')
            ORDER BY created_at ASC
        ");

        // Get product status distribution
        $productStatus = DB::select("
            SELECT 
                status,
                COUNT(*) as count
            FROM products
            GROUP BY status
        ");

        return view('home', compact(
            'status',
            'totalItems',
            'totalProducts',
            'activeProducts',
            'totalCategories',
            'monthlySales',
            'productStatus'
        ));
    }

    public function getOldInventoryHistory()
    {
        $oldInventoryHistory = DB::select("
            SELECT 
                'inventory' as 'type',
                item_id as id,
                item_name,
                on_hand_quantity as qty,
                updated_at as datetime
            FROM live_inventory
            ORDER BY updated_at DESC
            LIMIT 100
        ");

        return response()->json([
            'data' => $oldInventoryHistory,
            'type' => 'old_inventory_history'
        ]);
    }

    public function getPredictions()
    {
        // Get historical data from the live_inventory view
        $history = DB::select("
            SELECT 
                item_name,
                DATE(updated_at) as date,
                on_hand_quantity as current_stock,
                total_incoming as incoming,
                total_outgoing as outgoing
            FROM live_inventory
            WHERE updated_at >= DATE_SUB(NOW(), INTERVAL 3 MONTH)
            ORDER BY date ASC
        ");

        // Prepare data for AI model
        $historicalData = [];
        foreach ($history as $record) {
            $historicalData[] = [
                'item' => $record->item_name,
                'date' => $record->date,
                'current_stock' => $record->current_stock,
                'incoming' => $record->incoming,
                'outgoing' => $record->outgoing
            ];
        }

        // Call AI model
        $predictions = $this->callAIModel($historicalData);

        return response()->json([
            'predictions' => $predictions,
            'historical_data' => $historicalData
        ]);
    }
protected function callAIModel($historicalData)
{
    try {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer  '
        ])->post('https://models.github.ai/inference/chat/completions', [
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an inventory prediction assistant. Analyze the historical inventory data and predict the top 5 items that will need restocking in the next week based on current stock levels and outgoing trends. Return a valid JSON array with items having: item_name (string), predicted_quantity (number), and urgency_level (string: high/medium/low). Example: [{"item_name":"Flour","predicted_quantity":50,"urgency_level":"high"}]'
                ],
                [
                    'role' => 'user',
                    'content' => json_encode([
                        'task' => 'predict_restock_needs',
                        'data' => $historicalData,
                        'requirements' => [
                            'return_format' => 'json',
                            'top_items' => 5,
                            'timeframe' => 'next_7_days',
                            'consider' => ['current_stock', 'outgoing_trend']
                        ]
                    ])
                ]
            ],
            'temperature' => 0.7, // Reduced for more consistent results
            'top_p' => 0.9,
            'model' => 'openai/gpt-4.1'
        ]);

        if ($response->successful()) {
            $content = $response->json();
            
            if (!isset($content['choices'][0]['message']['content'])) {
                throw new \Exception('Invalid response format from AI API');
            }

            $predictionText = trim($content['choices'][0]['message']['content']);
            
            // Attempt to extract JSON from markdown code blocks if present
            if (str_starts_with($predictionText, '```json')) {
                $predictionText = trim(str_replace(['```json', '```'], '', $predictionText));
            }
            
            $predictions = json_decode($predictionText, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON in AI response: ' . json_last_error_msg());
            }

            // Validate and format predictions
            $formattedPredictions = [];
            foreach ($predictions as $item) {
                if (!is_array($item)) {
                    continue;
                }
                
                $formattedPredictions[] = [
                    'name' => $item['item_name'] ?? $item['name'] ?? $item['item'] ?? 'Unknown',
                    'predicted_restock' => $item['predicted_quantity'] ?? $item['quantity'] ?? $item['predicted_restock'] ?? 0,
                    'urgency' => $item['urgency_level'] ?? $item['urgency'] ?? 'medium'
                ];
            }
            
            return $formattedPredictions;
        }

        Log::error('AI API request failed', [
            'status' => $response->status(),
            'body' => $response->body(),
            'headers' => $response->headers()
        ]);
        return [];
        
    } catch (\Exception $e) {
        Log::error('AI Prediction Error: ' . $e->getMessage(), [
            'exception' => $e,
            'historical_data' => $historicalData
        ]);
        return [];
    }
}
}
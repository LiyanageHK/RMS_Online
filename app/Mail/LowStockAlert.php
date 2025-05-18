<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LowStockAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $currentStock;
    public $admin;
    public $additionalMessage;

    public function __construct($item, $currentStock, $admin, $additionalMessage = null)
    {
        $this->item = $item;
        $this->currentStock = $currentStock;
        $this->admin = $admin;
        $this->additionalMessage = $additionalMessage;
    }

    public function build()
    {
        return $this->subject('Low Stock Alert: ' . $this->item->name)
                    ->markdown('emails.low_stock_alert');
    }
}
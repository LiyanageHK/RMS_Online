@extends('layouts.app')

@section('content')
    <!-- Top Row -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 30px;">
        <h2 style="font-size: 22px; margin: 0; font-weight: bold; color: #333;">Customer Feedback</h2>
        <form method="GET" action="{{ route('feedback.index') }}">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search feedback..."
                   oninput="if(this.value==='') this.form.submit();"
                   style="padding: 10px 15px; width: 280px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px; transition: all 0.3s ease;">
        </form>
    </div>

    <!-- Table Section -->
    <div style="border: 1px solid #ddd; border-radius: 12px; background-color: #ffffff; padding: 30px 35px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin: 0 30px 40px 30px;">
        <!-- Section Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3 style="margin: 0; font-size: 20px; color: #333;">Feedback Overview</h3>
        </div>

        <!-- Feedback Table -->
        <div style="max-height: 450px; overflow-y: auto; width: 100%;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px;">
                <thead style="background-color: #f9f9f9; position: sticky; top: 0; z-index: 1;">
                    <tr>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #333; background: #f9f9f9;">Name</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #333; background: #f9f9f9;">Feedback</th>
                        <th style="padding: 12px; text-align: center; font-weight: 600; color: #333; background: #f9f9f9;">Date</th>
                        <th style="padding: 12px; text-align: center; font-weight: 600; color: #333; background: #f9f9f9;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $feedback)
                        <tr style="background-color: #fff; border-radius: 8px; box-shadow: 0 1px 5px rgba(0,0,0,0.08);">
                            <td style="padding: 12px; font-size: 14px; color: #555;">{{ $feedback->name }}</td>
                            <td style="padding: 12px; font-size: 14px; color: #555; max-width: 350px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ Str::limit($feedback->feedback, 50) }}
                            </td>
                            <td style="padding: 12px; font-size: 14px; color: #555; text-align: center;">
                                {{ $feedback->created_at->format('M d, Y') }}
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <a href="{{ route('feedback.show', $feedback->id) }}" 
                                   style="background-color: #6c757d; color: white; padding: 6px 12px; border-radius: 5px; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center;">
                                    <span class="material-icons" style="font-size: 16px; margin-right: 5px;">visibility</span> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

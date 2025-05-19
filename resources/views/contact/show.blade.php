@extends('layouts.app')

@section('content')
<div style="padding: 30px; background-color: #f5f5f5; min-height: 100vh;">
    <div style="max-width: 950px; margin: auto;">
        <div style="background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 25px 30px; border-bottom: 1px solid #e0e0e0;">
                <h2 style="font-size: 24px; font-weight: 700; color: #333;">Contact Message from {{ $message->name }}</h2>
                <a href="{{ route('contact.index') }}"
                   style="display: inline-flex; align-items: center; padding: 10px 20px; background-color: #E7592B; color: white; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 16px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                    <span class="material-icons" style="font-size: 18px; margin-right: 8px;">arrow_back</span> Back to List
                </a>
            </div>

            <div style="padding: 30px 30px;">
                {{-- Message Details --}}
                <div style="margin-bottom: 30px;">
                    <h4 style="font-size: 18px; font-weight: 600; color: #E7592B; margin-bottom: 15px;">Message Details</h4>
                    <div style="margin-bottom: 10px;">
                        <strong>Status:</strong>
                        @if($message->status === 'Resolved')
                            <span style="color: #28a745; font-weight: bold;">Resolved</span>
                        @else
                            <span style="color: #fd7e14; font-weight: bold;">Pending</span> <!-- orange -->
                        @endif
                    </div>
                    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <p><strong style="color: #333;">Email:</strong> <span style="color: #555;">{{ $message->email }}</span></p>
                        <p><strong style="color: #333;">Message:</strong></p>
                        <p style="color: #555; line-height: 1.6;">{{ $message->message }}</p>
                    </div>
                </div>

                {{-- Reply Form --}}
                @if($message->status !== 'Resolved')
                <div style="margin-top: 30px;">
                    <h4 style="font-size: 18px; font-weight: 600; color: #E7592B; margin-bottom: 15px;">Reply to Message</h4>
                    <form id="replyForm" method="POST" action="{{ route('contact.reply', $message->id) }}" style="background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        @csrf
                        <label for="reply" style="font-weight: 600; font-size: 16px; color: #333;">Reply Message:</label>
                        <textarea name="reply" id="reply" class="w-full border rounded p-3" rows="6" style="font-size: 16px; color: #333; border: 1px solid #ddd; resize: vertical; width: 100%; max-width: 900px;" required></textarea>
                        <div style="text-align: right; margin-top: 20px;">
                            <button type="submit" id="sendReplyBtn" style="background-color: #E7592B; color: white; padding: 12px 24px; border-radius: 8px; font-weight: 500; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                Send Reply
                            </button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Email Confirmation Modal -->
<div id="sendReplyModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
    <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
        <div style="margin-bottom: 15px;">
            <span class="material-icons" style="font-size: 40px; color: #0070FF;">email</span>
        </div>
        <h4 style="margin-bottom: 10px; font-size: 18px; color: #333;">Send Reply as Email?</h4>
        <p style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to send this reply as an email to the contact?</p>
        <div style="display: flex; justify-content: center; gap: 15px;">
            <button id="cancelSendReplyBtn" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
            <button id="confirmSendReplyBtn" style="padding: 10px 20px; background-color: #0070FF; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Send</button>
        </div>
    </div>
</div>

<script>
    document.getElementById('replyForm').addEventListener('submit', function(e) {
        e.preventDefault();
        document.getElementById('sendReplyModal').style.display = 'flex';
    });
    document.getElementById('cancelSendReplyBtn').onclick = function() {
        document.getElementById('sendReplyModal').style.display = 'none';
    };
    document.getElementById('confirmSendReplyBtn').onclick = function() {
        document.getElementById('sendReplyModal').style.display = 'none';
        document.getElementById('replyForm').submit();
    };
</script>
@endsection

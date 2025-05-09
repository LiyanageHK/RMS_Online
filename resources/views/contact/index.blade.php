@extends('layouts.admin')

@section('content')
    <!-- Top Row -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 30px;">
        <h2 style="font-size: 20px; margin: 0; font-weight: bold;">Contact Messages</h2>
        <form method="GET" action="{{ route('contact.index') }}">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search Contact Messages..."
                   oninput="if(this.value==='') this.form.submit();"
                   style="padding: 10px 12px; width: 260px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
        </form>
    </div>

    <!-- Table Section -->
    <div style="border: 1px solid #ddd; border-radius: 10px; background-color: #ffffff; padding: 25px 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin: 0 30px 40px 30px;">
        

        <!-- Contact Messages Table -->
        <table style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
            <thead style="background-color: #f9f9f9;">
                <tr>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Name</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Email</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Message</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $contact)
                    <tr style="background-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                        <td style="padding: 12px;">{{ $contact->name }}</td>
                        <td style="padding: 12px;">{{ $contact->email }}</td>
                        <td style="padding: 12px; text-align: left; max-width: 300px; word-wrap: break-word;">{{ Str::limit($contact->message, 50) }}</td>
                        <td style="padding: 12px; text-align: right;">
                            <a href="{{ route('contact.show', $contact->id) }}" style="background-color: #6c757d; color: white; padding: 6px 10px; border-radius: 4px; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center;">
                                <span class="material-icons" style="font-size: 16px; margin-right: 4px;">visibility</span> View / Reply
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 12px; text-align: center;">No contact messages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Custom Confirmation Modal -->
    <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
        <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
            <div style="margin-bottom: 15px;">
                <span class="material-icons" style="font-size: 40px; color: #dc3545;">warning</span>
            </div>
            <h4 style="margin-bottom: 10px; font-size: 18px; color: #333;">Confirm Deletion</h4>
            <p id="modalMessage" style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to delete this contact message?</p>
            <div style="display: flex; justify-content: center; gap: 15px;">
                <button id="cancelBtn" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
                <button id="confirmDeleteBtn" style="padding: 10px 20px; background-color: #dc3545; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Delete</button>
            </div>
        </div>
    </div>

    <!-- Modal Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let formToSubmit = null;

            document.querySelectorAll('.delete-button').forEach(button => {
                button.style.cursor = 'pointer';
                button.addEventListener('mouseover', () => button.style.cursor = 'pointer');
                button.addEventListener('click', function () {
                    formToSubmit = this.closest('form');
                    const name = this.getAttribute('data-name');
                    document.getElementById('modalMessage').textContent = `Are you sure you want to delete "${name}"?`;
                    document.getElementById('confirmModal').style.display = 'flex';
                });
            });

            document.getElementById('cancelBtn').addEventListener('click', function () {
                document.getElementById('confirmModal').style.display = 'none';
                formToSubmit = null;
            });

            document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
                if (formToSubmit) formToSubmit.submit();
            });
        });
    </script>
@endsection

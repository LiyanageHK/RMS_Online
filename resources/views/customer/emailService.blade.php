@extends('layouts.app')

@section('content')
<div class="container-custom">
    <div class="content-wrapper">
        <h2 class="heading">Send Email to Customers</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        @if($customers->count())
            <form method="POST" action="{{ route('send.email') }}">
                @csrf

                <div class="flex-container">
                    {{-- Left Side: Email Form --}}
                    <div class="form-section">
                        <div class="form-group">
                            <label for="subject" class="label">Subject</label>
                            <input type="text" id="subject" name="subject" class="input" required>
                        </div>

                        <div class="form-group">
                            <label for="body" class="label">Message</label>
                            <textarea id="body" name="body" rows="6" class="textarea" required></textarea>
                        </div>

                        <div class="form-actions button-group">
                            <button type="submit" class="send-btn">Send Email</button>
                            <button type="button" class="prev-btn">Previous Email</button>
                        </div>
                    </div>

                    {{-- Right Side: Customer List --}}
                    <div class="table-section">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Customer Number</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td><input type="checkbox" name="user_ids[]" value="{{ $customer->user_id }}"></td>
                                        <td>{{ 'CUS#' . str_pad($customer->user_id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="pagination">
                            @if ($customers->onFirstPage())
                                <span>&laquo; Prev</span>
                            @else
                                <a href="{{ $customers->previousPageUrl() }}">&laquo; Prev</a>
                            @endif

                            <span>Page {{ $customers->currentPage() }} of {{ $customers->lastPage() }}</span>

                            @if ($customers->hasMorePages())
                                <a href="{{ $customers->nextPageUrl() }}">Next &raquo;</a>
                            @else
                                <span>Next &raquo;</span>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        @else
            <p class="no-customers">No customers found.</p>
        @endif
    </div>
</div>

@endsection



<style>

    /* Container */
.container-custom {
  max-width: 800px;
  height: 9200px;
  margin: 20px auto;
  padding: 20px 30px; /* Ensure left/right padding */
  background-color: #fff;
  box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1),
              0 4px 6px -4px rgba(0,0,0,0.1);
  border-radius: 16px;
  overflow: hidden; /* Prevent overflow */
}


/* Heading */
.heading {
  font-size: 2rem;
  font-weight: 700;
  color: #2d3748; /* dark gray */
  margin-bottom: 24px;
}

/* Flex container for form and table side by side */
.flex-container {
  display: flex;
  flex-direction: column;
  gap: 32px;
}

/* On wider screens, row layout */
@media (min-width: 1024px) {
  .flex-container {
    flex-direction: row;
  }
}

.content-wrapper {
  width: 100%;
}


/* Left form section */
.form-section {
  flex: 1;
  background: #f9fafb;
  padding: 16px; /* Reduced padding */
  border-radius: 10px; /* Slightly smaller radius */
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
}

/* Form group */
.form-group {
  margin-bottom: 24px;
}

/* Labels */
.label {
  display: block;
  font-weight: 600;
  margin-bottom: 8px;
  color: #4a5568; /* gray-700 */
  font-size: 0.9rem;
}

/* Inputs */
.input, .textarea {
  width: 100%;
  padding: 10px 14px;
  border: 1px solid #cbd5e0; /* gray-300 */
  border-radius: 8px;
  font-size: 1rem;
  color: #2d3748;
  resize: vertical;
  transition: border-color 0.3s;
}

.input:focus, .textarea:focus {
  outline: none;
  border-color: #3182ce; /* blue-600 */
  box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.6);
}

/* Submit button */
.send-btn {
  background-color: #2563eb;
  color: white;
  padding: 10px 24px;
  font-size: 1rem;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s;
}

.send-btn:hover {
  background-color: #1d4ed8;
}

/* Right table section */
.table-section {
  flex: 1;
  max-height: 400px; /* Lower max height */
  overflow-y: auto;
}

/* Table styles */
.custom-table {
  width: 80%;
  border-collapse: collapse;
  font-size: 0.9rem;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  overflow: hidden;
}

.custom-table thead {
  background-color: #edf2f7;
  text-transform: uppercase;
  color: #4a5568;
  font-size: 0.8rem;
}

.custom-table th,
.custom-table td {
  padding: 12px 16px;
  border-bottom: 1px solid #e2e8f0;
  text-align: left;
}

.custom-table tbody tr:hover {
  background-color: #f7fafc;
}

/* Checkbox */
input[type="checkbox"] {
  width: 16px;
  height: 16px;
  cursor: pointer;
  accent-color: #2563eb;
}

/* Pagination */
.pagination {
  margin-top: 16px;
  display: flex;
  justify-content: center;
  gap: 12px;
  font-size: 0.9rem;
  color: #2563eb;
}

.pagination a {
  text-decoration: none;
  cursor: pointer;
  color: #2563eb;
}

.pagination a:hover {
  text-decoration: underline;
}

.pagination span {
  color: #a0aec0;
}

/* No customers message */
.no-customers {
  text-align: center;
  color: #718096;
  font-size: 1rem;
}

.header-with-button {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

/* Add spacing between buttons in the form-actions group */
.button-group {
  display: flex;
  gap: 16px;
  margin-top: 16px;
}

.prev-btn {
  background-color: #2563eb;       /* Blue-600 */
  color: white;
  padding: 10px 20px;
  border-radius: 8px;
  font-weight: 600;
  border: none;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(37, 99, 235, 0.4);
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
  font-size: 1rem;
}

.prev-btn:hover {
  background-color: #1d4ed8;       /* Blue-700 */
  box-shadow: 0 6px 10px rgba(29, 78, 216, 0.6);
}

.prev-btn:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.6);
}





/* Flex container for form and table side by side */
.flex-container {
  display: flex;
  flex-direction: column;
  gap: 32px;
}

/* Force left-right layout on wider screens */
@media (min-width: 1024px) {
  .flex-container {
    flex-direction: row;
    align-items: flex-start;
  }

  .form-section {
    order: 1; /* form stays on left */
    flex: 1 1 50%;
  }

  .table-section {
    order: 2; /* table stays on right */
    flex: 1 1 50%;
  }
}





</style>

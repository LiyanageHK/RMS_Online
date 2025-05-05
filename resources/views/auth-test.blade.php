@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Authentication Data Test</h3>
                </div>
                <div class="card-body">
                    @auth
                        <div class="mb-4">
                            <h4>User Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <td>{{ Auth::id() }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ Auth::user()->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ Auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <th>Email Verified</th>
                                    <td>{{ Auth::user()->email_verified_at ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ Auth::user()->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ Auth::user()->updated_at }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="mb-4">
                            <h4>Auth Methods</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Auth::check()</th>
                                    <td>{{ Auth::check() ? 'true' : 'false' }}</td>
                                </tr>
                                <tr>
                                    <th>Auth::guest()</th>
                                    <td>{{ Auth::guest() ? 'true' : 'false' }}</td>
                                </tr>
                                <tr>
                                    <th>Auth::viaRemember()</th>
                                    <td>{{ Auth::viaRemember() ? 'true' : 'false' }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="mb-4">
                            <h4>Session Data</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Session ID</th>
                                    <td>{{ session()->getId() }}</td>
                                </tr>
                                <tr>
                                    <th>CSRF Token</th>
                                    <td>{{ csrf_token() }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="mb-4">
                            <h4>All User Attributes</h4>
                            <table class="table table-bordered">
                                @foreach(Auth::user()->getAttributes() as $key => $value)
                                    <tr>
                                        <th>{{ $key }}</th>
                                        <td>{{ is_array($value) ? json_encode($value) : $value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            You are not authenticated. Please log in to see authentication data.
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
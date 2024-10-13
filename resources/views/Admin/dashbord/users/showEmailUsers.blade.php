@extends('Admin.layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Users Management / Email verified Users</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-users me-1"></i>
                Users List Email verified
            </div>
            <div class="card-body">
                @if($users->isEmpty())
                <p>No Email users found.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection

@section('title')
Dashboard - Email verified Users
@endsection

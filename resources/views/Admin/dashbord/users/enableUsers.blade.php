@extends('Admin.layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Users Management / Active Users</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-users me-1"></i>
                Users List Active
            </div>
            <div class="card-body">
                @if($activeUsers->isEmpty())
                    <p>No Active users found.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activeUsers as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <form action="{{ route('admin.users.updateStatusenable', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') <!-- This is important to specify the PUT method -->
                                        <button type="submit"  class="btn btn-danger">Banned User</button>
                                    </form>
                                </td>
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
Dashboard - Active Users
@endsection

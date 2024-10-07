@extends('Admin.layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users Management</a></li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-edit me-1"></i>
                Edit User - {{ $user->first_name }} {{ $user->last_name }}
            </div>
            <div class="card-body">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->last_name }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $user->date_of_birth }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Update User</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('title')
Edit User - {{ $user->first_name }} {{ $user->last_name }}
@endsection

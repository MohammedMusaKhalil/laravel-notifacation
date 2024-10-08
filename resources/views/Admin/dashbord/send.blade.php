@extends('Admin.layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Users Management / Send - Notification</li>
        </ol>
        <div class="row">
            <div class="col-xl-14">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-bell me-1"></i>
                        Send Notification
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.notifications.send') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="message">Notification Message</label>
                                <textarea name="message" id="message" class="form-control" rows="4" placeholder="Enter your message here"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="user_id">Select User</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="all">All Users</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="notification_date">Notification Date</label>
                                <input type="date" name="notification_date" id="notification_date" class="form-control" placeholder="Select date">
                            </div>
                            <button type="submit" class="btn btn-primary">Send Notification</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('title')
Dashboard - Send Notification
@endsection

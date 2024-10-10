@extends('Admin.layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard / Messages Sent</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-envelope me-1"></i>
                Messages Sent to Users
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Message</th>
                            <th>Arabic</th>
                            <th>English</th>
                            <th>French</th>
                            <th>German</th>
                            <th>Notification Date</th>
                            <th>For All</th>
                            <th>User ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sentMessages as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td>{{ $message->message }}</td>
                                <td>{{ $message->message_ar }}</td>
                                <td>{{ $message->message_en }}</td>
                                <td>{{ $message->message_fr }}</td>
                                <td>{{ $message->message_de }}</td>
                                <td>{{ $message->notification_date }}</td>
                                <td>{{ $message->is_for_all ? 'Yes' : 'No' }}</td>
                                <td>{{ $message->user_id ?? 'All Users' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">No messages sent yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection

@section('title')
Sent Messages - Admin
@endsection

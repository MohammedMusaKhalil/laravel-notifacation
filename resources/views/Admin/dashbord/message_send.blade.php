@extends('Admin.layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard / Messages Sent</li>
        </ol>
        <div class="row">
            @foreach ($number_blocks as $block)
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <i class="fas fa-lightbulb fa-2x m-2"></i>
                        <span class="ml-3 display-6">{{ $block['number'] }}</span>
                        <div class="display-7">{{ $block['title'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-envelope me-1"></i>
                Messages Sent to Users
            </div>
            <div class="card-body">
                <!-- Form for selecting date -->
                <form method="GET" action="{{ route('admin.dashbord.Users_messages') }}">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="date">Select Date:</label>
                            <input type="date" id="date" name="date" class="form-control" value="{{ request('date') }}">
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>

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

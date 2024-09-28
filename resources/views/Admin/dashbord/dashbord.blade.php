@extends('Admin.layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-14">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Notification
                    </div>
                    <div class="card-body">
                        @forelse ($notifications as $n)
                            <div class="alert alert-success" role="alert">
                                [{{ $n->created_at }}] User {{ $n->data['name'] }}
                                {{ $n->data['email'] }} hase just register.
                                <a href="#" class="float-right mark-as-read"
                                    data-id={{ $n->id }}>Mark as Read</a>
                            </div>
                            @if ($loop->last)
                            <a href="#" id="mark-all"
                            data-id={{ $n->id }}>Mark all Read</a>
                            @endif
                        @empty
                        there are no new Notifications !
                        @endforelse
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%"
                            height="40"></canvas></div>
                </div>
            </div> --}}
        </div>

    </div>
</main>
@endsection

@section('title')
Dashboard - Admin
@endsection

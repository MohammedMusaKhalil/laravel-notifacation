@extends('Admin.layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <i class="fas fa-users fa-2x m-2"></i>
                        <span class="ml-3 display-6">{{ $totalUsers }}</span>
                           <div class="display-7"> All Users</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('admin.users.index') }}">
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <i class="fas fa-users fa-2x m-2"></i>
                        <span class="ml-3 display-6">{{ $activeUsers }}</span>
                        <div class="display-7"> Active Users <span class="fas fa-check-circle fa-1x ml-2" style="color: green;"></span></div>
                        <!-- أيقونة إضافية -->
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('admin.users.enable') }}">
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <i class="fas fa-envelope fa-2x m-2"></i>
                        <span class="ml-3 display-6">{{ $usersWithEmail }}</span>
                        <div class="display-7">
                            Email verified Users
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('admin.users.email') }}">
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <i class="fas fa-phone fa-2x m-2"></i>
                        <span class="ml-3 display-6">{{ $usersWithPhone }}</span>
                        <div class="display-7">
                            Phone verified Users
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('admin.users.phone') }}">
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-14">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Notification Users Registers
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

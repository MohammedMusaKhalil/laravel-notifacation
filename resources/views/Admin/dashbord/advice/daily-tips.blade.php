@extends('Admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / Daily Advice</li>
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
    <div class="mb-3">
        <a href="{{ route('admin.dashbord.tips.create') }}" class="btn btn-primary">Add New Advice</a>
    </div>

    @foreach ($list_blocks as $block)
    <div class="row">
        <div class="col-md-12">
            <h3>{{ $block['title'] }}</h3>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Advice</th>
                    <th>Day</th>
                    <th>Language</th>
                    <th>Zodiac Sign</th>
                    <th>Advice Type</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($block['entries'] as $entry)
                    <tr>
                        <td>{{ $entry->advices }}</td>
                        <td>{{ $entry->daily->date ?? 'N/A' }}</td>
                        <td>{{ $entry->language->language ?? 'N/A' }}</td>
                        <td>{{ $entry->zodiacSign->zodiacn ?? 'N/A' }}</td>
                        <td>{{ $entry->advicetype->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.dashbord.tips.edit', $entry->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.dashbord.tips.destroy', $entry->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">{{ __('No tips found') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('title')
Dashboard - Daily Advice
@endsection

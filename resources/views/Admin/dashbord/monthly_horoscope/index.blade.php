@extends('Admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Horoscope Management / Monthly Horoscope</li>
    </ol>

    <div class="row">
        @foreach ($number_blocks as $block)
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <i class="fas fa-star fa-2x m-2"></i>
                    <span class="ml-3 display-6">{{ $block['number'] }}</span>
                    <div class="display-7">{{ $block['title'] }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mb-3">
        <a href="{{ route('admin.monthly.horoscope.create') }}" class="btn btn-primary">Add New Monthly Horoscope</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Monthly Horoscopes</h3>
            @if ($horoscopes->isEmpty())
                <div class="alert alert-warning">
                    No data available at the moment.
                </div>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ZodiacSign</th>
                            <th>Monthly</th>
                            <th>Language</th>
                            <th>General </th>
                            <th>Love </th>
                            <th>Financial </th>
                            <th>Health </th>
                            <th>Financial </th>
                            <th>Health </th>
                            <th>Love </th>
                            <th>Occupation </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($horoscopes as $horoscope)
                            <tr>
                                <td>{{ optional($horoscope->zodiacsign)->zodiacn }}</td>
                                <td>{{ optional($horoscope->monthly)->monthly }}/{{ optional($horoscope->monthly)->year }}</td>
                                <td>{{ optional($horoscope->language)->language }}</td>
                                <td>{{ $horoscope->generalPrediction }}</td>
                                <td>{{ $horoscope->lovePrediction }}</td>
                                <td>{{ $horoscope->financialPrediction }}</td>
                                <td>{{ $horoscope->healthPrediction }}</td>
                                <td>{{ $horoscope->Finanzial_per }}%</td>
                                <td>{{ $horoscope->health }}%</td>
                                <td>{{ $horoscope->loveLife }}%</td>
                                <td>{{ $horoscope->occupat_per }}%</td>
                                <td>
                                    <a href="{{ route('admin.monthly.horoscope.edit', $horoscope->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.monthly.horoscope.destroy', $horoscope->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
@endsection

@section('title')
Dashboard - Monthly Horoscope
@endsection

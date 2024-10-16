@extends('Admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Monthly Horoscope</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Horoscope Management / Edit Monthly Horoscope</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.monthly.horoscope.update', $horoscope->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="zodiacsign_id" class="form-label">Zodiac Sign</label>
                    <select name="zodiacsign_id" id="zodiacsign_id" class="form-control" required>
                        <option value="">Select Zodiac Sign</option>
                        @foreach ($zodiacSigns as $zodiac)
                            <option value="{{ $zodiac->id }}" {{ $horoscope->zodiacsign_id == $zodiac->id ? 'selected' : '' }}>{{ $zodiac->zodiacn }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="monthly_id" class="form-label">Monthly Date</label>
                    <select name="monthly_id" id="monthly_id" class="form-control" required>
                        <option value="">Select Monthly Date</option>
                        @foreach ($monthlies as $monthly)
                            <option value="{{ $monthly->id }}" {{ $horoscope->monthly_id == $monthly->id ? 'selected' : '' }} >{{ $monthly->monthly }}/{{ $monthly->year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="language_id" class="form-label">Language</label>
                    <select name="language_id" id="language_id" class="form-control" required>
                        <option value="">Select Language</option>
                        @foreach ($languages as $language)
                            <option value="{{ $language->id }}" {{ $horoscope->language_id == $language->id ? 'selected' : '' }}>{{ $language->language }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="generalPrediction" class="form-label">General Prediction</label>
                    <textarea name="generalPrediction" id="generalPrediction" class="form-control" rows="3" required>{{ $horoscope->generalPrediction }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="lovePrediction" class="form-label">Love Prediction</label>
                    <textarea name="lovePrediction" id="lovePrediction" class="form-control" rows="3" required>{{ $horoscope->lovePrediction }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="financialPrediction" class="form-label">Financial Prediction</label>
                    <textarea name="financialPrediction" id="financialPrediction" class="form-control" rows="3" required>{{ $horoscope->financialPrediction }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="healthPrediction" class="form-label">Health Prediction</label>
                    <textarea name="healthPrediction" id="healthPrediction" class="form-control" rows="3" required>{{ $horoscope->healthPrediction }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="Finanzial_per" class="form-label">Financial Percentage</label>
                    <input type="number" name="Finanzial_per" id="Finanzial_per" class="form-control" value="{{ $horoscope->Finanzial_per }}" required>
                </div>
                <div class="mb-3">
                    <label for="health" class="form-label">Health Percentage</label>
                    <input type="number" name="health" id="health" class="form-control" value="{{ $horoscope->health }}" required>
                </div>
                <div class="mb-3">
                    <label for="loveLife" class="form-label">Love Percentage</label>
                    <input type="number" name="loveLife" id="loveLife" class="form-control" value="{{ $horoscope->loveLife }}" required>
                </div>
                <div class="mb-3">
                    <label for="occupat_per" class="form-label">Occupation Percentage</label>
                    <input type="number" name="occupat_per" id="occupat_per" class="form-control" value="{{ $horoscope->occupat_per }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Horoscope</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('title')
Edit Monthly Horoscope
@endsection

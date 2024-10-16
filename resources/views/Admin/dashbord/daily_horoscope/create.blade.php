@extends('Admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Add Daily Horoscope</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Horoscope Management / Add Daily Horoscope</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.daily.horoscope.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="zodiac_sign_id" class="form-label">Zodiac Sign</label>
                    <select name="zodiac_sign_id" id="zodiac_sign_id" class="form-control" required>
                        <option value="">Select Zodiac Sign</option>
                        @foreach ($zodiacSigns as $zodiac)
                            <option value="{{ $zodiac->id }}">{{ $zodiac->zodiacn }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="daily_id" class="form-label">Daily ID</label>
                    <select name="daily_id" id="daily_id" class="form-control" required>
                        <option value="">Select Daily</option>
                        @foreach ($dailies as $daily)
                            <option value="{{ $daily->id }}">{{ $daily->date }}</option> <!-- Adjust as necessary -->
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="language_id" class="form-label">Language</label>
                    <select name="language_id" id="language_id" class="form-control" required>
                        <option value="">Select Language</option>
                        @foreach ($languages as $language)
                            <option value="{{ $language->id }}">{{ $language->language }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="generalPrediction" class="form-label">General Prediction</label>
                    <textarea name="generalPrediction" id="generalPrediction" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="lovePrediction" class="form-label">Love Prediction</label>
                    <textarea name="lovePrediction" id="lovePrediction" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="financialPrediction" class="form-label">Financial Prediction</label>
                    <textarea name="financialPrediction" id="financialPrediction" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="healthPrediction" class="form-label">Health Prediction</label>
                    <textarea name="healthPrediction" id="healthPrediction" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="Finanzial_per" class="form-label">Financial Percentage</label>
                    <input type="number" name="Finanzial_per" id="Finanzial_per" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="health" class="form-label">Health Percentage</label>
                    <input type="number" name="health" id="health" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="loveLife" class="form-label">Love Percentage</label>
                    <input type="number" name="loveLife" id="loveLife" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="occupat_per" class="form-label">Occupation Percentage</label>
                    <input type="number" name="occupat_per" id="occupat_per" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Horoscope</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('title')
Add Daily Horoscope
@endsection

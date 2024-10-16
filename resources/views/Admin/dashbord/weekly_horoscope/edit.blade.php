@extends('Admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Weekly Horoscope</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Horoscope Management / Edit Weekly Horoscope</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.weekly.horoscope.update', $horoscope->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- استخدام PUT لتحديث السجل -->
                <div class="mb-3">
                    <label for="zodiacsign_id" class="form-label">Zodiac Sign</label>
                    <select name="zodiacsign_id" id="zodiacsign_id" class="form-control" required>
                        <option value="">Select Zodiac Sign</option>
                        @foreach ($zodiacSigns as $zodiac)
                            <option value="{{ $zodiac->id }}" {{ $zodiac->id == $horoscope->zodiacsign_id ? 'selected' : '' }}>
                                {{ $zodiac->zodiacn }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="weekly_id" class="form-label">Weekly ID</label>
                    <select name="weekly_id" id="weekly_id" class="form-control" required>
                        <option value="">Select Weekly</option>
                        @foreach ($weeklies as $weekly)
                            <option value="{{ $weekly->id }}" {{ $weekly->id == $horoscope->weekly_id ? 'selected' : '' }}>
                                Week {{ $weekly->weekly }} - {{ $weekly->year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="language_id" class="form-label">Language</label>
                    <select name="language_id" id="language_id" class="form-control" required>
                        <option value="">Select Language</option>
                        @foreach ($languages as $language)
                            <option value="{{ $language->id }}" {{ $language->id == $horoscope->language_id ? 'selected' : '' }}>
                                {{ $language->language }}
                            </option>
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
                    <label for="warnings" class="form-label">Warnings</label>
                    <textarea name="warnings" id="warnings" class="form-control" rows="3" required>{{ $horoscope->warnings }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Weekly Horoscope</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('title')
Edit Weekly Horoscope
@endsection

@extends('Admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Tip</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / Edit Tip</li>
    </ol>

    <form action="{{ route('admin.dashbord.tips.update', $advice->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="advices" class="form-label">Advice</label>
            <input type="text" class="form-control" id="advices" name="advices" value="{{ $advice->advices }}" required>
        </div>

        <div class="mb-3">
            <label for="id_daily" class="form-label">Daily</label>
            <select class="form-control" id="id_daily" name="id_daily">
                <option value="">Select Daily</option>
                @foreach ($dailies as $daily)
                    <option value="{{ $daily->id }}" {{ $advice->id_daily == $daily->id ? 'selected' : '' }}>
                        {{ $daily->date }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="language_id" class="form-label">Language</label>
            <select class="form-control" id="language_id" name="language_id">
                <option value="">Select Language</option>
                @foreach ($languages as $language)
                    <option value="{{ $language->id }}" {{ $advice->language_id == $language->id ? 'selected' : '' }}>
                        {{ $language->language }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="zodiac_sign_id" class="form-label">Zodiac Sign</label>
            <select class="form-control" id="zodiac_sign_id" name="zodiac_sign_id">
                <option value="">Select Zodiac Sign</option>
                @foreach ($zodiacSigns as $sign)
                    <option value="{{ $sign->id }}" {{ $advice->zodiac_sign_id == $sign->id ? 'selected' : '' }}>
                        {{ $sign->zodiacn }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="advicetype_id" class="form-label">Advice Type</label>
            <select class="form-control" id="advicetype_id" name="advicetype_id">
                <option value="">Select Advice Type</option>
                @foreach ($advicetypes as $type)
                    <option value="{{ $type->id }}" {{ $advice->advicetype_id == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

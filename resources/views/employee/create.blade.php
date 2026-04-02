@extends('layouts.index-layout')

@section('title')
    إضافة موظف
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('employee/create-styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('content')

<form action="{{ route('employee.store') }}" method="post">
    @csrf
    <div class="container">

        <h2 class="section-title">بيانات العمل</h2>

        <div class="form-grid">
            <div class="form-group">
                <label>الرقم الوظيفي</label>
                <input type="text" placeholder="أدخل 5 أو 6 أرقام..." name="job_number" class="form-control @error('job_number') is-invalid @enderror">
                @error('job_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                    <br>
                <label>الإدارة</label>
                <select name="management_id">
                    @foreach ($management as $management_names)
                    <option value="{{ $management_names->id }}">{{ $management_names->management_name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <h2 class="section-title">البيانات الشخصية</h2>

        <div class="form-grid">
            <div class="form-group">
                <label>الاسم</label>
                <input type="text" placeholder="مثل: محمد خالد العتيبي" name="name" class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>الجنسية</label>
                <select name="nationality_id">
                    @foreach ($nationalities as $nationality)
                        <option value="{{ $nationality->id }}">{{ $nationality->nationality_name }}</option>
                    @endforeach
                </select>                
            </div>

            <div class="form-group">
                <label>رقم جواز السفر</label>
                <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror">
                @error('passport_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>رقم الهوية</label>
                <input type="text" name="id_number" class="form-control @error('id_number') is-invalid @enderror">
                @error('id_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>رقم الجوال</label>
                <input type="text" placeholder="05xxxxxxxx" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror">
                @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>تاريخ انتهاء الهوية</label>
                <input type="date" name="expiry_date_id" class="form-control @error('expiry_date_id') is-invalid @enderror">
                @error('expiry_date_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="bottom-buttons">
            <button type="submit" class="save-btn">حفظ</button>
            <a href='{{ route('index') }}' class="cancel-btn">إغلاق</a>
        </div>

    </div>
<script src="{{ asset('script.js') }}"></script>

@endsection
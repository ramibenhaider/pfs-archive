@extends('layouts.user-layout')

@section('title')
    إضافة موظف
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('content')

    <form action="{{ route('user.employee.store') }}" method="post">
        @csrf
        <div class="container-createEmployee">

            <h2 class="section-title">بيانات العمل</h2>

            <div class="form-grid">
                {{-- حقل الرقم الوظيفي --}}
                <div class="form-group">
                    <label>الرقم الوظيفي</label>
                    <input type="text" placeholder="أدخل 5 أو 6 أرقام..." name="job_number"
                        class="form-control @error('job_number') is-invalid @enderror">
                    @error('job_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group management-field">
                    <label>خطوط الطيران</label>
                    <select name="airline_id">
                        @foreach ($airlines as $airline)
                            <option value="{{ $airline->id }}">{{ $airline->airline_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group management-field">
                    <label>المسمى الوظيفي</label>
                    <select name="job_title_id">
                        @foreach ($job_titles as $job_title)
                            <option value="{{ $job_title->id }}">{{ $job_title->job_title_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group management-field">
                    <label>الإدارة</label>
                    <select name="management_id">
                        @foreach ($management as $management_names)
                            <option value="{{ $management_names->id }}">{{ $management_names->management_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group status-inline">
                    <label>الحالة (موظف - غير موظف)</label>
                    <label class="switch-container">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active') == '1' ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

            <h2 class="section-title">البيانات الشخصية</h2>

            <div class="form-grid">
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" placeholder="مثل: محمد خالد العتيبي" name="name"
                        class="form-control @error('name') is-invalid @enderror" required>
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
                    <input type="text" name="passport_number"
                        class="form-control @error('passport_number') is-invalid @enderror">
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
                    <input type="text" placeholder="05xxxxxxxx" name="phone_number"
                        class="form-control @error('phone_number') is-invalid @enderror">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>تاريخ انتهاء الهوية</label>
                    <input type="date" name="expiry_date_id"
                        class="form-control @error('expiry_date_id') is-invalid @enderror">
                    @error('expiry_date_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="bottom-buttons">
                <button type="submit" class="save-btn">حفظ</button>
                <a href='{{ route('user.employee.index') }}' class="cancel-btn">إغلاق</a>
            </div>

        </div>
@endsection
@push("scripts")
<script src="{{ asset('script.js') }}"></script>
@endpush
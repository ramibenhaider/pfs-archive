@extends('layouts.user-layout')

@section('title', 'تسجيل موظف جديد')

@push('styles')
<link rel="stylesheet" href="{{ asset('styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('content')
<div class="container-createEmployee">

    <div class="section-title">تسجيل مستخدم جديد</div>

    <form method="POST" action="{{ route('user.store') }}">
        @csrf

        <div class="form-grid">

            {{-- الاسم --}}
            <div class="form-group">
                <label>الاسم</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- اسم المستخدم --}}
            <div class="form-group">
                <label>اسم المستخدم</label>
                <input type="text" name="username" value="{{ old('username') }}"
                    class="{{ $errors->has('username') ? 'is-invalid' : '' }}">
                @error('username')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- كلمة المرور --}}
            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password"
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
<br>
            <div class="form-group">
                <label>تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation"
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
            </div>

        </div>

        {{-- الأزرار --}}
        <div class="bottom-buttons">
            <a href="{{ route('login') }}" class="cancel-btn">رجوع</a>
            <button type="submit" class="save-btn">تقديم طلب التسجيل</button>
        </div>

    </form>

</div>

@endsection
@push('scripts')
<script src="{{ asset('script.js') }}"></script>
@endpush
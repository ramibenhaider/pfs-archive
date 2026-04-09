@extends('layouts.index-layout')

@section('title', 'تسجيل موظف جديد')

@section('content')
<div class="container-createEmployee">

    <div class="section-title">تسجيل مستخدم جديد</div>

    <form method="POST" action="#">
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

            {{-- المستخدم الفعال --}}
            <div class="form-group">
                <label>الحالة</label>
                <div class="status-container-under">
                    <label class="switch-container">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', 1) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                    <span>مستخدم فعال</span>
                </div>
            </div>

        </div>

        {{-- الأزرار --}}
        <div class="bottom-buttons">
            <a href="{{ route('admin.dashboard') }}" class="cancel-btn">رجوع</a>
            <button type="submit" class="save-btn">تسجيل المستخدم</button>
        </div>

    </form>

</div>

@endsection
@push('scripts')
<script src="{{ asset('script.js') }}"></script>
@endpush
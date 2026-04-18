@extends('layouts.user-layout')

@section('title', 'تسجيل موظف جديد')

@push('styles')
<style>
body {
  margin: 0;
  padding: 0;
  font-family: "Cairo", sans-serif;
  background-color: #e8e8e8 !important;
}

.logo-area {
  width: 100%;
  padding: 5px 0 0 0;
  text-align: center;
}

.logo-area img {
  max-width: min(800px, 100%);
  height: auto;
  display: block;
  margin: 0 auto;
}

.container-createEmployee {
    max-width: 1000px;
    margin: 20px auto;
    padding: clamp(12px, 4vw, 20px);
    box-sizing: border-box;
}

.section-title {
    color: #3B524A;
    margin-top: 35px;
    margin-bottom: 15px;
    font-size: clamp(17px, 5vw, 22px);
    border-right: 5px solid #3B524A;
    padding-right: 10px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    align-items: start;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 6px;
    font-weight: bold;
    color: #333;
    font-size: clamp(13px, 3.5vw, 15px);
}

.form-group input,
.form-group select {
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #bbb;
    font-size: clamp(13px, 3.5vw, 15px);
    font-family: "Cairo", sans-serif;
    width: 100%;
    box-sizing: border-box;
}

.invalid-feedback { color: red; font-size: 13px; margin-top: 5px; }
.is-invalid { border-color: red !important; }

.bottom-buttons {
    margin-top: 25px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}

.bottom-buttons button,
.bottom-buttons a {
    padding: 12px clamp(16px, 4vw, 25px);
    border: none;
    border-radius: 10px;
    font-size: clamp(13px, 3.5vw, 15px);
    cursor: pointer;
    font-family: "Cairo", sans-serif;
    min-width: 120px;
    text-align: center;
    transition: background-color 0.3s, transform 0.2s;
}

.save-btn {
    background-color: #3B524A;
    color: white;
}

.save-btn:hover {
    background-color: #497033;
    transform: translateY(-2px);
}

.save-btn:active { transform: translateY(0); }

.cancel-btn {
    background-color: #999;
    color: white;
    text-decoration: none;
    display: inline-block;
}

.cancel-btn:hover {
    background-color: #7a7a7a;
    color: white;
}

@media (max-width: 600px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .container-createEmployee {
        margin-top: 10px;
    }

    .bottom-buttons {
        flex-direction: column;
        align-items: stretch;
    }

    .bottom-buttons button,
    .bottom-buttons a {
        width: 100%;
        text-align: center;
    }
}

@media (max-width: 360px) {
    .section-title {
        font-size: 16px;
    }
}
</style>
@endpush

@section('content')
<div class="container-createEmployee">

    <div class="section-title">تسجيل مستخدم جديد</div>

    <form method="POST" action="{{ route('user.store') }}">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>الاسم</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>اسم المستخدم</label>
                <input type="text" name="username" value="{{ old('username') }}"
                    class="{{ $errors->has('username') ? 'is-invalid' : '' }}">
                @error('username')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

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

        <div class="bottom-buttons">
            <a href="{{ route('login') }}" class="cancel-btn">رجوع</a>
            <button type="submit" class="save-btn">تقديم طلب التسجيل</button>
        </div>

    </form>

</div>

@endsection
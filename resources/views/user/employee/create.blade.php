@extends('layouts.user-layout')

@section('title', 'إضافة موظف')

@push('styles')
<style>
    body {
        margin: 0; padding: 0;
        font-family: "Cairo", sans-serif;
        background-color: #e8e8e8 !important;
    }

    .success-message, .warning-message {
        position: fixed;
        top: 20px;
        right: 50%;
        transform: translateX(50%);
        padding: 14px 18px;
        border-radius: 10px;
        font-weight: bold;
        transition: opacity 0.5s ease;
        width: calc(100% - 40px);
        max-width: 400px;
        text-align: center;
        z-index: 9999;
        box-sizing: border-box;
    }
    .success-message { background-color: #e8fff3; border: 2px solid #28a745; color: #155724; }
    .warning-message { background-color: #fcebd3; border: 2px solid #f5712f; color: #a37b3e; }

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

    .form-group { display: flex; flex-direction: column; }
    .form-group label {
        margin-bottom: 6px;
        font-weight: bold;
        color: #333;
        font-size: clamp(13px, 3.5vw, 15px);
    }

    .form-group input, .form-group select {
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #bbb;
        font-size: clamp(13px, 3.5vw, 15px);
        font-family: "Cairo", sans-serif;
        outline: none;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group input:focus, .form-group select:focus {
        border-color: #3B524A;
        box-shadow: 0 0 5px rgba(59, 82, 74, 0.2);
    }

    .switch-container {
        position: relative; display: inline-block;
        width: 44px; height: 22px;
    }
    .switch-container input { opacity: 0; width: 0; height: 0; }
    .slider {
        position: absolute; cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #D30E00; transition: .4s; border-radius: 34px;
    }
    .slider:before {
        position: absolute; content: "";
        height: 16px; width: 16px; left: 3px; bottom: 3px;
        background-color: white; transition: .4s; border-radius: 50%;
    }
    input:checked + .slider { background-color: #28a745; }
    input:checked + .slider:before { transform: translateX(22px); }

    .bottom-buttons {
        margin-top: 25px;
        text-align: center;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
    }

    .save-btn {
        background-color: #3B524A;
        color: white;
        border: none;
        padding: 12px clamp(20px, 5vw, 40px);
        border-radius: 10px;
        cursor: pointer;
        font-weight: bold;
        font-family: "Cairo", sans-serif;
        font-size: clamp(14px, 4vw, 16px);
        min-width: 120px;
        transition: background-color 0.3s, transform 0.2s;
    }

    .cancel-btn {
        background-color: #999;
        color: white;
        text-decoration: none;
        padding: 12px clamp(20px, 5vw, 40px);
        border-radius: 10px;
        display: inline-block;
        font-family: "Cairo", sans-serif;
        font-size: clamp(14px, 4vw, 16px);
        min-width: 120px;
        text-align: center;
        transition: background-color 0.3s;
    }

    .save-btn:hover { background-color: #497033; transform: translateY(-2px); }
    .save-btn:active { transform: translateY(0); }
    .cancel-btn:hover { background-color: #7a7a7a; color: white; }

    .invalid-feedback { color: red; font-size: 13px; margin-top: 5px; }
    .is-invalid { border-color: red !important; }

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

        .save-btn, .cancel-btn {
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
    <form action="{{ route('employee.store') }}" method="post">
        @csrf

        <h2 class="section-title">بيانات العمل</h2>
        <div class="form-grid">
            <div class="form-group">
                <label>الرقم الوظيفي</label>
                <input type="text" placeholder="أدخل 5 أو 6 أرقام..." name="job_number" value="{{ old('job_number') }}"
                    class="@error('job_number') is-invalid @enderror">
                @error('job_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>خطوط الطيران</label>
                <select name="airline_id">
                    @foreach ($airlines as $airline)
                        <option value="{{ $airline->id }}">{{ $airline->airline_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>المسمى الوظيفي</label>
                <select name="job_title_id">
                    @foreach ($job_titles as $job_title)
                        <option value="{{ $job_title->id }}">{{ $job_title->job_title_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>الإدارة</label>
                <select name="management_id">
                    @foreach ($management as $management_names)
                        <option value="{{ $management_names->id }}">{{ $management_names->management_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
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
                <input type="text" placeholder="مثل: محمد خالد العتيبي" name="name" value="{{ old('name') }}"
                    class="@error('name') is-invalid @enderror" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                <input type="text" name="passport_number" value="{{ old('passport_number') }}" class="@error('passport_number') is-invalid @enderror">
                @error('passport_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>رقم الهوية</label>
                <input type="text" name="id_number" value="{{ old('id_number') }}" class="@error('id_number') is-invalid @enderror">
                @error('id_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>رقم الجوال</label>
                <input type="text" placeholder="05xxxxxxxx" name="phone_number" value="{{ old('phone_number') }}" class="@error('phone_number') is-invalid @enderror">
                @error('phone_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>تاريخ انتهاء الهوية</label>
                <input type="date" name="expiry_date_id" value="{{ old('expiry_date_id') }}" class="@error('expiry_date_id') is-invalid @enderror">
                @error('expiry_date_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="bottom-buttons">
            <button type="submit" class="save-btn">حفظ</button>
            <a href="{{ route('employee.index') }}" class="cancel-btn">إلغاء</a>
        </div>
    </form>
</div>
@endsection
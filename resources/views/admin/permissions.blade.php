@extends('layouts.admin-layout')

@section('title', 'لوحة التحكم')

@push('styles')
<link rel="stylesheet" href="{{ asset('styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
    .perm-container-unique {
        width: calc(100% - 250px);
        margin-right: 250px;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 0 40px;
    }

    .perm-card-wrapper {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .perm-table-header, .perm-row-item {
        display: grid;
        grid-template-columns: 2fr repeat(7, 1fr) 0.5fr;
        list-style: none;
        padding: 15px;
        margin: 0;
        align-items: center;
        text-align: center;
    }

    .perm-table-header {
        background-color: #3B524A;
        color: white;
        font-weight: bold;
        font-size: 14px;
    }

    .perm-row-item {
        border-bottom: 1px solid #eee;
        transition: 0.2s;
    }

    .perm-row-item:hover {
        background-color: #f9f9f9;
    }

    .emp-name-cell {
        text-align: right;
        color: #3B524A;
    }

    .emp-username {
        font-size: 12px;
        color: #888;
        margin-top: 3px;
    }

    .switch-perm {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch-perm input { opacity: 0; width: 0; height: 0; }

    .slider-perm {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #D30E00;
        transition: .4s;
        border-radius: 34px;
    }

    .slider-perm:before {
        position: absolute;
        content: "";
        height: 14px; width: 14px;
        left: 3px; bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider-perm {
        background-color: #28a745;
    }

    input:checked + .slider-perm:before {
        transform: translateX(20px);
    }

    .btn-delete-perm {
        background: none;
        border: none;
        color: #D20E00;
        cursor: pointer;
        font-size: 18px;
        transition: transform 0.2s;
        text-decoration: none;
    }

    .btn-delete-perm:hover { transform: scale(1.2); }

    .perm-footer-actions {
        padding: 20px;
        text-align: left;
        background: #f8f9fa;
    }

    .save-btn-perm {
        background-color: #3B524A;
        color: white;
        padding: 10px 35px;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .save-btn-perm:hover {
        background-color: #497033;
        transform: translateY(-2px);
    }

    @media (max-width: 900px) {
        .perm-table-header { display: none; }
        .perm-row-item {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            text-align: right;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 10px;
        }
    }
</style>
@endpush

@section('content')
<div class="perm-container-unique">
    <h2 class="section-title">إدارة صلاحيات المستخدمين</h2>

    <div class="perm-card-wrapper">

        <form action="{{ route('admin.user.update') }}" method="POST">
            @csrf
            @method('PUT')

            <ul class="perm-table-header">
                <li>اسم المستخدم</li>
                <li>الحالة</li>
                <li>إضافة موظف</li>
                <li>حذف موظف</li>
                <li>تعديل موظف</li>
                <li>إضافة مستند</li>
                <li>عرض مستند</li>
                <li>حذف مستند</li>
                <li>إجراء</li>
            </ul>

            <div class="perm-table-body">
                @foreach($users as $user)
                <ul class="perm-row-item">
                    <li class="emp-name-cell">
                        <strong>{{ Str::limit($user->name, 27) }}</strong>
                        <div class="emp-username">{{ Str::limit($user->username, 27) }}</div>
                        <input type="hidden" name="users[{{ $loop->index }}][id]" value="{{ $user->id }}">
                    </li>

                    <li>
                        <label class="switch-perm">
                            <input type="checkbox" 
                                name="users[{{ $loop->index }}][is_active]" 
                                value="1" 
                                {{ $user->is_active ? 'checked' : '' }}>
                            <span class="slider-perm"></span>
                        </label>
                    </li>

                    @foreach($permissions as $permission)
                    <li>
                        <label class="switch-perm">
                            <input type="checkbox"
                                name="users[{{ $loop->parent->index }}][{{ $permission->name }}]"
                                value="1"
                                {{ $user->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                            <span class="slider-perm"></span>
                        </label>
                    </li>
                    @endforeach

                    <li>
                        <button type="button" class="btn-delete-perm" title="حذف المستخدم"
                                onclick="deleteUser('{{ route('admin.user.destroy', encodeId($user->id)) }}')">
                            حذف
                        </button>
                    </li>
                </ul>
                @endforeach
            </div>

            <div class="perm-footer-actions">
                <button type="submit" class="save-btn-perm">حفظ التغييرات</button>
            </div>

        </form>

    </div>
</div>

<form id="global-delete-form" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script src="{{ asset('script.js') }}"></script>
@endsection
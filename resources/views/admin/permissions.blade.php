@extends('layouts.admin-layout')

@section('title', 'لوحة التحكم')
@section('sidebar-permissions', 'active')

@push('styles')
<style>
    .perm-container {
        width: calc(100% - 250px);
        margin-right: 250px;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 0 30px;
        box-sizing: border-box;
    }

    .section-title {
        font-size: 22px;
        font-weight: bold;
        color: #3B524A;
        margin-bottom: 20px;
    }

    .perm-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    /* ─── Desktop Table ─── */
    .perm-table-header,
    .perm-row-item {
        display: grid;
        grid-template-columns: 2fr repeat(7, 1fr) 0.5fr;
        list-style: none;
        padding: 14px 16px;
        margin: 0;
        align-items: center;
        text-align: center;
        gap: 6px;
    }

    .perm-table-header {
        background-color: #3B524A;
        color: #fff;
        font-weight: bold;
        font-size: 13px;
        position: sticky;
        top: 0;
        z-index: 1;
    }

    .perm-row-item {
        border-bottom: 1px solid #eee;
        transition: background 0.2s;
    }

    .perm-row-item:last-child {
        border-bottom: none;
    }

    .perm-row-item:hover {
        background-color: #f5f8f6;
    }

    .emp-name-cell {
        text-align: right;
    }

    .emp-name {
        font-weight: bold;
        color: #3B524A;
        font-size: 14px;
    }

    .emp-username {
        font-size: 12px;
        color: #888;
        margin-top: 3px;
    }

    /* ─── Toggle Switch ─── */
    .switch-perm {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 22px;
        flex-shrink: 0;
    }

    .switch-perm input {
        opacity: 0;
        width: 0;
        height: 0;
        position: absolute;
    }

    .slider-perm {
        position: absolute;
        cursor: pointer;
        inset: 0;
        background-color: #D30E00;
        transition: .35s;
        border-radius: 34px;
    }

    .slider-perm::before {
        content: "";
        position: absolute;
        height: 15px;
        width: 15px;
        left: 3px;
        bottom: 3.5px;
        background: #fff;
        transition: .35s;
        border-radius: 50%;
    }

    input:checked + .slider-perm {
        background-color: #28a745;
    }

    input:checked + .slider-perm::before {
        transform: translateX(19px);
    }

    /* ─── Delete Button ─── */
    .btn-delete {
        background: none;
        border: none;
        color: #D20E00;
        cursor: pointer;
        font-size: 13px;
        font-weight: bold;
        padding: 5px 8px;
        border-radius: 7px;
        transition: background 0.2s, transform 0.2s;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-delete:hover {
        background: #fde8e8;
        transform: scale(1.05);
    }

    /* ─── Footer ─── */
    .perm-footer {
        padding: 18px 20px;
        background: #f8f9fa;
        text-align: left;
        border-top: 1px solid #eee;
    }

    .save-btn {
        background-color: #3B524A;
        color: #fff;
        padding: 10px 35px;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
    }

    .save-btn:hover {
        background-color: #497033;
        transform: translateY(-2px);
    }

    /* ─── Tablet: scroll wrapper ─── */
    @media (max-width: 1024px) and (min-width: 769px) {
        .perm-container {
            width: calc(100% - 200px);
            margin-right: 200px;
            padding: 0 16px;
        }

        .table-scroll-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .perm-table-header,
        .perm-row-item {
            min-width: 720px;
        }
    }

    /* ─── Mobile: card layout ─── */
    @media (max-width: 768px) {
        .perm-container {
            width: 100%;
            margin-right: 0;
            padding: 0 12px;
        }

        .perm-table-header {
            display: none;
        }

        .perm-row-item {
            display: block;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            margin: 10px 0;
            padding: 14px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }

        .emp-name-cell {
            text-align: right;
            margin-bottom: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .perm-mobile-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 7px 0;
            border-bottom: 1px dashed #f0f0f0;
            font-size: 13px;
        }

        .perm-mobile-row:last-child {
            border-bottom: none;
        }

        .perm-mobile-label {
            color: #555;
            font-size: 13px;
        }

        .perm-mobile-delete {
            display: flex;
            justify-content: flex-end;
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        .perm-footer {
            text-align: center;
        }

        .save-btn {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="perm-container">
    <h2 class="section-title">إدارة صلاحيات المستخدمين</h2>

    <div class="perm-card">
        <form action="{{ route('admin.user.update') }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Desktop/Tablet Header --}}
            <div class="table-scroll-wrapper">
                <ul class="perm-table-header">
                    <li>اسم المستخدم</li>
                    <li>الحالة</li>
                    <li>إضافة الموظفين</li>
                    <li>تعديل الموظفين</li>
                    <li>معاينة المستندات</li>
                    <li>إضافة مستندات</li>
                    <li>عرض مستندات</li>
                    <li>حذف مستندات</li>
                    <li>إجراء</li>
                </ul>

                <div class="perm-table-body">
                    @foreach($users as $user)

                    {{-- ══ Desktop Row ══ --}}
                    <ul class="perm-row-item d-none d-md-grid">
                        <li class="emp-name-cell">
                            <div class="emp-name">{{ Str::limit($user->name, 27) }}</div>
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
                            <button type="button" class="btn-delete"
                                    onclick="deleteUser('{{ route('admin.user.destroy', encodeId($user->id)) }}')"
                                    title="حذف المستخدم">
                                حذف
                            </button>
                        </li>
                    </ul>

                    {{-- ══ Mobile Card ══ --}}
                    <ul class="perm-row-item d-md-none" style="list-style:none;margin:0;padding:0;">
                        <input type="hidden" name="users[{{ $loop->index }}][id]" value="{{ $user->id }}">

                        <li class="emp-name-cell">
                            <div class="emp-name">{{ Str::limit($user->name, 30) }}</div>
                            <div class="emp-username">{{ Str::limit($user->username, 30) }}</div>
                        </li>

                        <li class="perm-mobile-row">
                            <span class="perm-mobile-label">الحالة</span>
                            <label class="switch-perm">
                                <input type="checkbox"
                                    name="users[{{ $loop->index }}][is_active]"
                                    value="1"
                                    {{ $user->is_active ? 'checked' : '' }}>
                                <span class="slider-perm"></span>
                            </label>
                        </li>

                        @foreach($permissions as $permission)
                        <li class="perm-mobile-row">
                            <span class="perm-mobile-label">{{ $permission->label ?? $permission->name }}</span>
                            <label class="switch-perm">
                                <input type="checkbox"
                                    name="users[{{ $loop->parent->index }}][{{ $permission->name }}]"
                                    value="1"
                                    {{ $user->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                <span class="slider-perm"></span>
                            </label>
                        </li>
                        @endforeach

                        <li class="perm-mobile-delete">
                            <button type="button" class="btn-delete"
                                    onclick="deleteUser('{{ route('admin.user.destroy', encodeId($user->id)) }}')"
                                    title="حذف المستخدم">
                                حذف المستخدم
                            </button>
                        </li>
                    </ul>

                    @endforeach
                </div>
            </div>

            <div class="perm-footer">
                <button type="submit" class="save-btn">حفظ التغييرات</button>
            </div>
        </form>
    </div>
</div>

<form id="global-delete-form" action="" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script src="{{ asset('script.js') }}"></script>
@endsection
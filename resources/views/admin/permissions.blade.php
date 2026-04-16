@extends('layouts.admin-layout')

@section('title', 'لوحة التحكم')
@section('sidebar-permissions', 'active')

@push('styles')
<style>
    .perm-container-unique {
        width: calc(100% - 250px);
        margin-right: 250px;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 0 40px;
        transition: all 0.3s;
    }

    .perm-card-wrapper {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        overflow-x: auto; /* للسماح بالتمرير إذا زادت الصلاحيات */
    }

    /* Desktop Grid */
    .perm-table-header, .perm-row-item {
        display: grid;
        /* توزيع الأعمدة: اسم المستخدم (2) + الحالة (1) + 6 صلاحيات (6) + حذف (0.5) */
        grid-template-columns: 2fr repeat(7, 1fr) 0.5fr;
        list-style: none;
        padding: 15px;
        margin: 0;
        align-items: center;
        text-align: center;
        min-width: 900px; /* لضمان عدم تداخل الحقول في الشاشات المتوسطة */
    }

    .perm-table-header {
        background-color: #3B524A;
        color: white;
        font-weight: bold;
        font-size: 14px;
        position: sticky;
        top: 0;
    }

    .perm-row-item {
        border-bottom: 1px solid #eee;
    }

    .perm-row-item:hover { background-color: #f9f9f9; }

    .emp-name-cell { text-align: right; color: #3B524A; }
    .emp-username { font-size: 12px; color: #888; margin-top: 3px; }

    /* Toggle Switch Style */
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
        position: absolute; content: "";
        height: 14px; width: 14px;
        left: 3px; bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    input:checked + .slider-perm { background-color: #28a745; }
    input:checked + .slider-perm:before { transform: translateX(20px); }

    .btn-delete-perm { background: none; border: none; color: #D20E00; cursor: pointer; font-size: 14px; font-weight: bold; }

    .perm-footer-actions { padding: 20px; text-align: left; background: #f8f9fa; }
    .save-btn-perm { background-color: #3B524A; color: white; padding: 10px 35px; border: none; border-radius: 10px; font-weight: bold; cursor: pointer; }

    /* 📱 Mobile Responsive Code */
    @media (max-width: 900px) {
        .perm-container-unique {
            width: 100%;
            margin-right: 0;
            padding: 10px;
        }

        .perm-card-wrapper { overflow: visible; }

        .perm-table-header { display: none; } /* إخفاء الهيدر في الجوال */

        .perm-row-item {
            display: block; /* تحويل الشبكة إلى بلوك طولي */
            min-width: auto;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            border-radius: 12px;
            padding: 0;
            background: #fff;
        }

        .perm-row-item li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            border-bottom: 1px solid #f5f5f5;
        }

        .perm-row-item li:last-child { border-bottom: none; }

        .emp-name-cell {
            background: #f0f4f2;
            border-radius: 11px 11px 0 0;
            text-align: right !important;
            display: block !important;
        }

        /* إضافة العناوين باللغة العربية قبل كل زر Toggle */
        .perm-row-item li:not(.emp-name-cell):not(:last-child)::before {
            font-weight: bold;
            color: #555;
            font-size: 13px;
        }

        /* ترتيب العناوين حسب ترتيب الـ li في الكود */
        .perm-row-item li:nth-child(2)::before { content: "الحالة:"; }
        .perm-row-item li:nth-child(3)::before { content: "إضافة الموظفين:"; }
        .perm-row-item li:nth-child(4)::before { content: "تعديل الموظفين:"; }
        .perm-row-item li:nth-child(5)::before { content: "معاينة المستندات:"; }
        .perm-row-item li:nth-child(6)::before { content: "إضافة مستندات:"; }
        .perm-row-item li:nth-child(7)::before { content: "عرض مستندات:"; }
        .perm-row-item li:nth-child(8)::before { content: "حذف مستندات:"; }
        
        .btn-delete-perm {
            width: 100%;
            padding: 10px;
            color: #D30E00;
            text-align: center;
        }
        
        .perm-footer-actions {
            position: sticky;
            bottom: 0;
            z-index: 10;
        }
        
        .save-btn-perm { width: 100%; }
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
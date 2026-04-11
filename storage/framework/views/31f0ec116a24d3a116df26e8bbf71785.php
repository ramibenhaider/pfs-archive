

<?php $__env->startSection('title', 'لوحة التحكم'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
    /* الحاوية الكبيرة */
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

    /* هيكل الجدول (الرأس) */
    .perm-table-header, .perm-row-item {
        display: grid;
        grid-template-columns: 2fr repeat(7, 1fr) 0.5fr; /* تقسيم 9 أعمدة */
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

    /* --- تصميم زر الـ Switch (نفس الستايل القديم) --- */
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
        background-color: #D30E00; /* أحمر */
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
        background-color: #28a745; /* أخضر */
    }

    input:checked + .slider-perm:before {
        transform: translateX(20px);
    }

    /* زر الحذف الصغير */
    .btn-delete-perm {
        background: none;
        border: none;
        color: #D20E00;
        cursor: pointer;
        font-size: 18px;
        transition: transform 0.2s;
    }

    .btn-delete-perm:hover { transform: scale(1.2); }

    /* فوتر الحفظ */
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

    /* للتجاوب مع الشاشات الصغيرة */
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

    .btn-delete-perm {
        text-decoration: none;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="perm-container-unique">
    <h2 class="section-title">إدارة صلاحيات المستخدمين</h2>

    <div class="perm-card-wrapper">

        <form action="<?php echo e(route('admin.user.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

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
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul class="perm-row-item">
                    <li class="emp-name-cell">
                        <strong><?php echo e(Str::limit($user->name, 27)); ?></strong>
                        <div class="emp-username"><?php echo e(Str::limit($user->username, 27)); ?></div>
                        <input type="hidden" name="users[<?php echo e($loop->index); ?>][id]" value="<?php echo e($user->id); ?>">
                    </li>

                    <li>
                        <label class="switch-perm">
                            <input type="checkbox" name="users[<?php echo e($loop->index); ?>][is_active]" value="1" <?php echo e($user->is_active ? 'checked' : ''); ?>>
                            <span class="slider-perm"></span>
                        </label>
                    </li>

                    <li>
                        <label class="switch-perm">
                            <input type="checkbox" name="users[<?php echo e($loop->index); ?>][createEmployee]" value="1" <?php echo e($user->createEmployee ?? false ? 'checked' : ''); ?>>
                            <span class="slider-perm"></span>
                        </label>
                    </li>

                    <li>
                        <label class="switch-perm">
                            <input type="checkbox" name="users[<?php echo e($loop->index); ?>][deleteEmployee]" value="1" <?php echo e($user->deleteEmployee ?? false ? 'checked' : ''); ?>>
                            <span class="slider-perm"></span>
                        </label>
                    </li>

                    <li>
                        <label class="switch-perm">
                            <input type="checkbox" name="users[<?php echo e($loop->index); ?>][updateEmployee]" value="1" <?php echo e($user->updateEmployee ?? false ? 'checked' : ''); ?>>
                            <span class="slider-perm"></span>
                        </label>
                    </li>

                    <li>
                        <label class="switch-perm">
                            <input type="checkbox" name="users[<?php echo e($loop->index); ?>][createDoc]" value="1" <?php echo e($user->createDoc ?? false ? 'checked' : ''); ?>>
                            <span class="slider-perm"></span>
                        </label>
                    </li>

                    <li>
                        <label class="switch-perm">
                            <input type="checkbox" name="users[<?php echo e($loop->index); ?>][showDoc]" value="1" <?php echo e($user->showDoc ?? false ? 'checked' : ''); ?>>
                            <span class="slider-perm"></span>
                        </label>
                    </li>

                    <li>
                        <label class="switch-perm">
                            <input type="checkbox" name="users[<?php echo e($loop->index); ?>][deleteDoc]" value="1" <?php echo e($user->deleteDoc ?? false ? 'checked' : ''); ?>>
                            <span class="slider-perm"></span>
                        </label>
                    </li>
                    <li>
                        <button type="button" class="btn-delete-perm" title="حذف المستخدم" 
                                onclick="deleteUser('<?php echo e(route('admin.user.destroy', encodeId($user->id))); ?>')">
                            حذف
                        </button>
                    </li>
                </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="perm-footer-actions">
                <button type="submit" class="save-btn-perm">حفظ التغييرات</button>
            </div>

        </form>

    </div>
</div>
<form id="global-delete-form" action="" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
</form>
<script src="<?php echo e(asset('script.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/admin/permissions.blade.php ENDPATH**/ ?>
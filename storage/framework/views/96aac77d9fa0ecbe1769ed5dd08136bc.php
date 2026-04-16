

<?php $__env->startSection('title', 'لوحة التحكم'); ?>
<?php $__env->startSection('sidebar-permissions', 'active'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .perm-container {
            width: calc(100% - 250px);
            margin-right: 250px;
            margin-top: 24px;
            margin-bottom: 24px;
            padding: 0 30px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #3B524A;
            margin-bottom: 18px;
        }

        .perm-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        /* ─── Table Layout ─── */
        .table-scroll-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .perm-table-header,
        .perm-row-desktop {
            display: grid;
            grid-template-columns: 2fr repeat(7, 1fr) 0.6fr;
            list-style: none;
            padding: 13px 16px;
            margin: 0;
            align-items: center;
            text-align: center;
            gap: 4px;
            min-width: 750px;
        }

        .perm-table-header {
            background-color: #3B524A;
            color: #fff;
            font-weight: bold;
            font-size: 13px;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        .perm-row-desktop {
            border-bottom: 1px solid #eee;
            transition: background 0.2s;
        }

        .perm-row-desktop:hover { background-color: #f5f8f6; }

        .emp-name-cell { text-align: right; }

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

        input:checked + .slider-perm { background-color: #28a745; }
        input:checked + .slider-perm::before { transform: translateX(19px); }

        /* ─── Delete Button ─── */
        .btn-delete {
            background: none;
            border: none;
            color: #D20E00;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            padding: 5px 8px;
            border-radius: 7px;
            transition: background 0.2s, transform 0.2s;
            white-space: nowrap;
        }

        .btn-delete:hover {
            background: #fde8e8;
            transform: scale(1.05);
        }

        /* ─── Footer ─── */
        .perm-footer {
            padding: 16px 20px;
            background: #f8f9fa;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-start;
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

        /* ─── Mobile Cards (hidden by default) ─── */
        .perm-cards-mobile { display: none; }

        /* ─── Tablet ─── */
        @media (max-width: 1100px) {
            .perm-container {
                width: calc(100% - 70px);
                margin-right: 70px;
            }
        }

        /* ─── Mobile ─── */
        @media (max-width: 768px) {
            .perm-container {
                width: 100%;
                margin-right: 0;
                margin-top: 70px;
                padding: 0 12px;
            }

            .perm-table-desktop { display: none; }
            .perm-cards-mobile  { display: block; padding: 12px; }

            .mobile-user-card {
                background: #fff;
                border: 1px solid #e0e0e0;
                border-radius: 13px;
                margin-bottom: 14px;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            }

            .mobile-card-header {
                background: #f0f4f2;
                padding: 12px 14px;
                border-bottom: 1px solid #e0e0e0;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .mobile-card-body { padding: 4px 0; }

            .mobile-perm-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 10px 14px;
                border-bottom: 1px solid #f5f5f5;
                font-size: 13px;
                color: #444;
            }

            .mobile-perm-row:last-child { border-bottom: none; }

            .mobile-card-footer {
                padding: 10px 14px;
                background: #fafafa;
                border-top: 1px solid #eee;
                display: flex;
                justify-content: flex-end;
            }

            .perm-footer { justify-content: center; }
            .save-btn { width: 100%; text-align: center; }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="perm-container">
    <h2 class="section-title">إدارة صلاحيات المستخدمين</h2>

    <div class="perm-card">
        <form id="permissions-form" action="<?php echo e(route('admin.user.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="perm-table-desktop">
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

                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <ul class="perm-row-desktop">
                        <li class="emp-name-cell">
                            <div class="emp-name"><?php echo e(Str::limit($user->name, 27)); ?></div>
                            <div class="emp-username"><?php echo e(Str::limit($user->username, 27)); ?></div>
                            <input type="hidden" name="users[<?php echo e($loop->index); ?>][id]" value="<?php echo e($user->id); ?>">
                        </li>

                        
                        <li>
                            <label class="switch-perm">
                                <input type="hidden" name="users[<?php echo e($loop->index); ?>][is_active]" value="0">
                                <input type="checkbox" name="users[<?php echo e($loop->index); ?>][is_active]" value="1" <?php echo e($user->is_active ? 'checked' : ''); ?>>
                                <span class="slider-perm"></span>
                            </label>
                        </li>

                        
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <label class="switch-perm">
                                <input type="hidden" name="users[<?php echo e($loop->parent->index); ?>][<?php echo e($permission->name); ?>]" value="0">
                                <input type="checkbox" name="users[<?php echo e($loop->parent->index); ?>][<?php echo e($permission->name); ?>]" value="1" <?php echo e($user->permissions->contains('id', $permission->id) ? 'checked' : ''); ?>>
                                <span class="slider-perm"></span>
                            </label>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <li>
                            <button type="button" class="btn-delete" onclick="deleteUser('<?php echo e(route('admin.user.destroy', encodeId($user->id))); ?>')">حذف</button>
                        </li>
                    </ul>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="perm-cards-mobile">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mobile-user-card">
                    <div class="mobile-card-header">
                        <div>
                            <div class="emp-name"><?php echo e(Str::limit($user->name, 30)); ?></div>
                            <div class="emp-username"><?php echo e(Str::limit($user->username, 30)); ?></div>
                            <input type="hidden" name="users[<?php echo e($loop->index); ?>][id]" value="<?php echo e($user->id); ?>">
                        </div>
                        <label class="switch-perm">
                            <input type="hidden" name="users[<?php echo e($loop->index); ?>][is_active]" value="0">
                            <input type="checkbox" name="users[<?php echo e($loop->index); ?>][is_active]" value="1" <?php echo e($user->is_active ? 'checked' : ''); ?>>
                            <span class="slider-perm"></span>
                        </label>
                    </div>

                    <div class="mobile-card-body">
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mobile-perm-row">
                            <span><?php echo e($permission->label ?? $permission->name); ?></span>
                            <label class="switch-perm">
                                <input type="hidden" name="users[<?php echo e($loop->parent->index); ?>][<?php echo e($permission->name); ?>]" value="0">
                                <input type="checkbox" name="users[<?php echo e($loop->parent->index); ?>][<?php echo e($permission->name); ?>]" value="1" <?php echo e($user->permissions->contains('id', $permission->id) ? 'checked' : ''); ?>>
                                <span class="slider-perm"></span>
                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="mobile-card-footer">
                        <button type="button" class="btn-delete" onclick="deleteUser('<?php echo e(route('admin.user.destroy', encodeId($user->id))); ?>')">حذف المستخدم</button>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="perm-footer">
                <button type="submit" class="save-btn">حفظ التغييرات</button>
            </div>
        </form>
    </div>
</div>

<form id="global-delete-form" action="" method="POST" style="display:none;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.getElementById('permissions-form').addEventListener('submit', function(e) {
        // فحص عرض الشاشة عند الضغط على زر الحفظ
        const isMobile = window.innerWidth <= 768;

        if (isMobile) {
            // نحن على الجوال: عطل مدخلات نسخة الكمبيوتر حتى لا ترفع بيانات قديمة
            document.querySelectorAll('.perm-table-desktop input').forEach(el => el.disabled = true);
        } else {
            // نحن على الكمبيوتر: عطل مدخلات نسخة الجوال
            document.querySelectorAll('.perm-cards-mobile input').forEach(el => el.disabled = true);
        }
    });

    function deleteUser(url) {
        if (confirm('هل أنت متأكد من حذف هذا المستخدم؟')) {
            const form = document.getElementById('global-delete-form');
            form.action = url;
            form.submit();
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/admin/permissions.blade.php ENDPATH**/ ?>
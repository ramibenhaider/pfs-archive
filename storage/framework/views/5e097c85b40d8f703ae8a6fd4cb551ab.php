

<?php $__env->startSection('title', 'لوحة التحكم'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
.nags-action-group {
    display: flex;
    gap: 10px;
    align-items: center;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-right: 260px; padding: 20px; direction: rtl;">

    <h2 class="section-title">إدارة البيانات والمدخلات</h2>

    <div class="form-grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
        
        
        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">خطوط الطيران</span>
                <span class="total-count-badge"><?php echo e($airlines->count() ?? 0); ?></span>
            </div>

            <div class="p-3 bg-white">
                <form action="<?php echo e(route('admin.airline.store')); ?>" method="POST" class="search-form mb-3">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="airline_name" placeholder="إضافة خط طيران جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                
                <div class="side-list">
                    <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <form action="<?php echo e(route('admin.airline.update', encodeId($airline->id))); ?>" method="POST" class="d-flex align-items-center w-100">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <input type="text" name="airline_name" value="<?php echo e($airline->airline_name); ?>" class="form-control me-2">

                            <div class="nags-action-group">

                                <button type="submit" style="border:none; background:none; color:blue;">
                                    تعديل
                                </button>
                        </form>

                                <form action="<?php echo e(route('admin.airline.destroy', encodeId($airline->id))); ?>" method="POST" class="m-0">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" style="border:none; background:none; color:red;">
                                        حذف
                                    </button>
                                </form>

                            </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        
        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">الإدارات</span>
                <span class="total-count-badge"><?php echo e($management->count() ?? 0); ?></span>
            </div>

            <div class="p-3 bg-white">
                <form action="<?php echo e(route('admin.management.store')); ?>" method="POST" class="search-form mb-3">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="management_name" placeholder="اسم الإدارة الجديدة..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>

                <div class="side-list">
                    <?php $__currentLoopData = $management; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <form action="<?php echo e(route('admin.management.update', encodeId($manage->id))); ?>" method="POST" class="d-flex align-items-center w-100">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <input type="text" name="management_name" value="<?php echo e($manage->management_name); ?>" class="form-control me-2">

                            <div class="nags-action-group">

                                <button type="submit" style="border:none; background:none; color:blue;">
                                    تعديل
                                </button>
                        </form>

                                <form action="<?php echo e(route('admin.management.destroy', encodeId($manage->id))); ?>" method="POST" class="m-0">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" style="border:none; background:none; color:red;">
                                        حذف
                                    </button>
                                </form>

                            </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        
        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">المسميات الوظيفية</span>
                <span class="total-count-badge"><?php echo e($job_titles->count() ?? 0); ?></span>
            </div>

            <div class="p-3 bg-white">
                <form action="<?php echo e(route('admin.job_title.store')); ?>" method="POST" class="search-form mb-3">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="job_title_name" placeholder="مسمى وظيفي جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>

                <div class="side-list">
                    <?php $__currentLoopData = $job_titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <form action="<?php echo e(route('admin.job_title.update', encodeId($job_title->id))); ?>" method="POST" class="d-flex align-items-center w-100">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <input type="text" name="job_title_name" value="<?php echo e($job_title->job_title_name); ?>" class="form-control me-2">

                            <div class="nags-action-group">

                                <button type="submit" style="border:none; background:none; color:blue;">
                                    تعديل
                                </button>
                        </form>

                                <form action="<?php echo e(route('admin.job_title.destroy', encodeId($job_title->id))); ?>" method="POST" class="m-0">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" style="border:none; background:none; color:red;">
                                        حذف
                                    </button>
                                </form>

                            </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

                <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">أنواع المستندات</span>
                <span class="total-count-badge"><?php echo e($document_types->count() ?? 0); ?></span>
            </div>

            <div class="p-3 bg-white">
                <form action="<?php echo e(route('admin.document_type.store')); ?>" method="POST" class="search-form mb-3">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="type" placeholder="نوع مستند جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>

                <div class="side-list">
                    <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <form action="<?php echo e(route('admin.document_type.update', encodeId($document_type->id))); ?>" method="POST" class="d-flex align-items-center w-100">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <input type="text" name="type" value="<?php echo e($document_type->type); ?>" class="form-control me-2">

                            <div class="nags-action-group">

                                <button type="submit" style="border:none; background:none; color:blue;">
                                    تعديل
                                </button>
                        </form>

                                <form action="<?php echo e(route('admin.document_type.destroy', encodeId($document_type->id))); ?>" method="POST" class="m-0">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" style="border:none; background:none; color:red;">
                                        حذف
                                    </button>
                                </form>

                            </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">الجنسيات</span>
                <span class="total-count-badge"><?php echo e($nationalities->count() ?? 0); ?></span>
            </div>

            <div class="p-3 bg-white">
                <form action="<?php echo e(route('admin.nationality.store')); ?>" method="POST" class="search-form mb-3">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="nationality_name" placeholder="جنسية جديدة..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>

                <div class="side-list">
                    <?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <form action="<?php echo e(route('admin.nationality.update', encodeId($nationality->id))); ?>" method="POST" class="d-flex align-items-center w-100">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <input type="text" name="nationality_name" value="<?php echo e($nationality->nationality_name); ?>" class="form-control me-2">

                            <div class="nags-action-group">

                                <button type="submit" style="border:none; background:none; color:blue;">
                                    تعديل
                                </button>
                        </form>

                                <form action="<?php echo e(route('admin.nationality.destroy', encodeId($nationality->id))); ?>" method="POST" class="m-0">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" style="border:none; background:none; color:red;">
                                        حذف
                                    </button>
                                </form>

                            </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('script.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/admin/fields.blade.php ENDPATH**/ ?>
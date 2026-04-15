

<?php $__env->startSection('title', 'لوحة التحكم'); ?>
<?php $__env->startSection('sidebar-fields', 'active'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
.pfs-action-group {
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
                    <input type="text" name="airline_name"
                           class="<?php $__errorArgs = ['airline_name', 'airline_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="إضافة خط طيران جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                <?php $__errorArgs = ['airline_name', 'airline_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block mb-2"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="side-list">
                    <?php $__errorArgs = ['airline_name', 'airline_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                            <form action="<?php echo e(route('admin.airline.update', encodeId($airline->id))); ?>" method="POST" class="d-flex align-items-center flex-grow-1">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="text" name="airline_name" value="<?php echo e($airline->airline_name); ?>"
                                       class="form-control me-2 <?php $__errorArgs = ['airline_name', 'airline_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">
                                    تعديل
                                </button>
                            </form>
                            <form action="<?php echo e(route('admin.airline.destroy', encodeId($airline->id))); ?>" onsubmit="return confirm('هل أنت متأكد من حذف خط الطيران؟')" method="POST" class="m-0 ms-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">
                                    حذف
                                </button>
                            </form>
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
                    <input type="text" name="management_name"
                           class="<?php $__errorArgs = ['management_name', 'management_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="اسم الإدارة الجديدة..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                <?php $__errorArgs = ['management_name', 'management_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block mb-2"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="side-list">

                    <?php $__errorArgs = ['management_name', 'management_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__currentLoopData = $management; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                            <form action="<?php echo e(route('admin.management.update', encodeId($manage->id))); ?>" method="POST" class="d-flex align-items-center flex-grow-1">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="text" name="management_name" value="<?php echo e($manage->management_name); ?>"
                                       class="form-control me-2 <?php $__errorArgs = ['management_name', 'management_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">
                                    تعديل
                                </button>
                            </form>

                            <form action="<?php echo e(route('admin.management.destroy', encodeId($manage->id))); ?>" onsubmit="return confirm('هل أنت متأكد من حذف الإدارة؟')" method="POST" class="m-0 ms-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">
                                    حذف
                                </button>
                            </form>

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
                    <input type="text" name="job_title_name"
                           class="<?php $__errorArgs = ['job_title_name', 'job_title_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="مسمى وظيفي جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                <?php $__errorArgs = ['job_title_name', 'job_title_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block mb-2"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="side-list">
                    <?php $__errorArgs = ['job_title_name', 'job_title_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__currentLoopData = $job_titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                            <form action="<?php echo e(route('admin.job_title.update', encodeId($job_title->id))); ?>" method="POST" class="d-flex align-items-center flex-grow-1">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="text" name="job_title_name" value="<?php echo e($job_title->job_title_name); ?>"
                                       class="form-control me-2 <?php $__errorArgs = ['job_title_name', 'job_title_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">
                                    تعديل
                                </button>
                            </form>

                            <form action="<?php echo e(route('admin.job_title.destroy', encodeId($job_title->id))); ?>" onsubmit="return confirm('هل أنت متأكد من حذف المسمى الوظيفي؟')" method="POST" class="m-0 ms-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">
                                    حذف
                                </button>
                            </form>
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
                <form action="<?php echo e(route('admin.document_type.store')); ?>" method="POST" class="mb-4">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex flex-column gap-2">
                        <input type="text" name="type"
                               class="form-control form-control-sm <?php $__errorArgs = ['type', 'type.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="نوع مستند باللغة العربية..." required>
                        <?php $__errorArgs = ['type', 'type.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <input type="text" name="typeEn"
                               class="form-control form-control-sm <?php $__errorArgs = ['typeEn', 'type.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="Document type in english..." required>
                        <?php $__errorArgs = ['typeEn', 'type.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <button type="submit" class="search-submit w-100" style="margin: 0; height: 35px;">إضافة</button>
                    </div>
                </form>

                <div class="side-list">
                    <?php $__errorArgs = ['type', 'type.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex align-items-center border-bottom py-2">

                            <form action="<?php echo e(route('admin.document_type.update', encodeId($document_type->id))); ?>" method="POST" class="d-flex align-items-center flex-grow-1">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="text" name="type" value="<?php echo e($document_type->type); ?>"
                                       class="form-control form-control-sm me-2 <?php $__errorArgs = ['type', 'type.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <input type="hidden" name="typeEn" value="<?php echo e($document_type->typeEn); ?>">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">
                                    تعديل
                                </button>
                            </form>

                            <form action="<?php echo e(route('admin.document_type.destroy', encodeId($document_type->id))); ?>" onsubmit="return confirm('هل أنت متأكد من حذف نوع المستند؟')" method="POST" class="ms-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">
                                    حذف
                                </button>
                            </form>

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
                    <input type="text" name="nationality_name"
                           class="<?php $__errorArgs = ['nationality_name', 'nationality_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="جنسية جديدة..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                <?php $__errorArgs = ['nationality_name', 'nationality_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block mb-2"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="side-list">
                    <?php $__errorArgs = ['nationality_name', 'nationality_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                            <form action="<?php echo e(route('admin.nationality.update', encodeId($nationality->id))); ?>" method="POST" class="d-flex align-items-center flex-grow-1">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="text" name="nationality_name" value="<?php echo e($nationality->nationality_name); ?>"
                                       class="form-control me-2 <?php $__errorArgs = ['nationality_name', 'nationality_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">
                                    تعديل
                                </button>
                            </form>

                            <form action="<?php echo e(route('admin.nationality.destroy', encodeId($nationality->id))); ?>" onsubmit="return confirm('هل أنت متأكد من حذف الجنسية؟')" method="POST" class="m-0 ms-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">
                                    حذف
                                </button>
                            </form>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?php echo e(asset('script.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/admin/fields.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'لوحة التحكم'); ?>
<?php $__env->startSection('sidebar-fields', 'active'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
    body { 
        margin: 0; 
        padding: 0; 
        font-family: "Cairo", sans-serif; 
        background-color: #e8e8e8 !important; 
    }

    .section-title { 
        color: #3B524A; 
        margin-top: 35px; 
        margin-bottom: 15px; 
        font-size: 22px; 
        border-right: 5px solid #3B524A; 
        padding-right: 10px; 
    }

    /* التعديل الأساسي هنا ليصبح مرن */
    .form-grid { 
        display: grid; 
        gap: 18px; 
        align-items: start; 
        /* التوزيع التلقائي للكروت */
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    }

    .side-card-unique { border: 1px solid #3B524A !important; border-radius: 10px !important; overflow: hidden; }
    .side-card-header { background-color: #3B524A; color: white; padding: 10px 15px; }
    .side-title { font-weight: bold; font-size: 1rem; }
    .total-count-badge { background-color: #ffffff; color: #3B524A; padding: 2px 8px; border-radius: 4px; font-weight: bold; font-size: 0.85rem; min-width: 25px; text-align: center; }
    
    .search-form { display: flex; gap: 0; width: 100%; direction: rtl; }
    .search-form input { flex: 1; height: 50px; padding: 0 15px; border: 1px solid #ccc; border-radius: 0 10px 10px 0 !important; font-size: 16px; background-color: #fff; text-align: center; outline: none; }
    .search-submit { height: 50px; padding: 0 25px; background-color: #3B524A !important; color: #fff !important; border: 1px solid #3B524A; border-radius: 10px 0 0 10px !important; font-size: 16px; font-weight: bold; cursor: pointer; white-space: nowrap; transition: 0.25s; }
    
    .side-list { max-height: 300px; overflow-y: auto; }
    .invalid-feedback { color: red; font-size: 13px; margin-top: 5px; display: block; }
    .is-invalid { border-color: red !important; }

    /* ######## التعديلات الخاصة بالجوال ######## */
    @media (max-width: 768px) {
        /* إلغاء الهامش الأيمن (260px) لأن القائمة الجانبية غالباً تختفي أو تصبح فوق المحتوى */
        div[style*="margin-right: 260px"] {
            margin-right: 0 !important;
            padding: 10px !important; /* تقليل الحواف لتوفير مساحة */
        }

        .form-grid {
            /* كرت واحد فقط في السطر */
            grid-template-columns: 1fr !important; 
        }

        .search-form input {
            font-size: 14px; /* تصغير الخط قليلاً ليناسب العرض */
            padding: 0 10px;
        }

        .search-submit {
            padding: 0 15px;
            font-size: 14px;
        }

        /* جعل خانة التعديل تأخذ مساحة أكبر في الشاشات الصغيرة */
        .form-control.me-2 {
            width: 100% !important;
            margin-bottom: 5px;
        }

        /* جعل أزرار التعديل والحذف تحت بعضها إذا ضاق العرض جداً */
        .d-flex.justify-content-between {
            flex-wrap: wrap; 
        }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-right: 260px; padding: 20px; direction: rtl;">
    <h2 class="section-title">إدارة البيانات والمدخلات</h2>

    <div class="form-grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));">

        
        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">خطوط الطيران</span>
                <span class="total-count-badge"><?php echo e($airlines->count() ?? 0); ?></span>
            </div>
            <div class="p-3 bg-white">
                <form action="<?php echo e(route('admin.airline.store')); ?>" method="POST" class="search-form">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="airline_name" class="<?php $__errorArgs = ['airline_name', 'airline_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="إضافة خط طيران جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                <?php $__errorArgs = ['airline_name', 'airline_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback mb-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="side-list">
                    
                    <?php $__errorArgs = ['airline_name', 'airline_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback border-bottom pb-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    
                    <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <form action="<?php echo e(route('admin.airline.update', encodeId($airline->id))); ?>" method="POST" class="d-flex align-items-center flex-grow-1">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <input type="text" name="airline_name" value="<?php echo e($airline->airline_name); ?>" class="form-control me-2">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">تعديل</button>
                            </form>
                            <form action="<?php echo e(route('admin.airline.destroy', encodeId($airline->id))); ?>" onsubmit="return confirm('هل أنت متأكد؟')" method="POST" class="m-0 ms-2">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">حذف</button>
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
                <form action="<?php echo e(route('admin.management.store')); ?>" method="POST" class="search-form">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="management_name" class="<?php $__errorArgs = ['management_name', 'management_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="اسم الإدارة الجديدة..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                <?php $__errorArgs = ['management_name', 'management_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback mb-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="side-list">
                    <?php $__errorArgs = ['management_name', 'management_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback border-bottom pb-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__currentLoopData = $management; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <form action="<?php echo e(route('admin.management.update', encodeId($manage->id))); ?>" method="POST" class="d-flex align-items-center flex-grow-1">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <input type="text" name="management_name" value="<?php echo e($manage->management_name); ?>" class="form-control me-2">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">تعديل</button>
                            </form>
                            <form action="<?php echo e(route('admin.management.destroy', encodeId($manage->id))); ?>" onsubmit="return confirm('هل أنت متأكد؟')" method="POST" class="m-0 ms-2">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">حذف</button>
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
                <form action="<?php echo e(route('admin.job_title.store')); ?>" method="POST" class="search-form">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="job_title_name" class="<?php $__errorArgs = ['job_title_name', 'job_title_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="مسمى وظيفي جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                <?php $__errorArgs = ['job_title_name', 'job_title_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback mb-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="side-list">
                    <?php $__errorArgs = ['job_title_name', 'job_title_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback border-bottom pb-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__currentLoopData = $job_titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <form action="<?php echo e(route('admin.job_title.update', encodeId($job_title->id))); ?>" method="POST" class="d-flex align-items-center flex-grow-1">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <input type="text" name="job_title_name" value="<?php echo e($job_title->job_title_name); ?>" class="form-control me-2">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">تعديل</button>
                            </form>
                            <form action="<?php echo e(route('admin.job_title.destroy', encodeId($job_title->id))); ?>" onsubmit="return confirm('هل أنت متأكد؟')" method="POST" class="m-0 ms-2">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">حذف</button>
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
                <form action="<?php echo e(route('admin.document_type.store')); ?>" method="POST" class="mb-2">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex flex-column gap-2">
                        <input type="text" name="type" class="form-control form-control-sm <?php $__errorArgs = ['type', 'type.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="نوع (عربي)..." required>
                        <input type="text" name="typeEn" class="form-control form-control-sm <?php $__errorArgs = ['typeEn', 'type.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Type (En)..." required>
                        <button type="submit" class="search-submit w-100" style="margin: 0; height: 35px; border-radius:8px !important;">إضافة</button>
                    </div>
                </form>
                <?php if($errors->hasBag('type.create')): ?> <div class="invalid-feedback mb-2"><?php echo e($errors->getBag('type.create')->first()); ?></div> <?php endif; ?>

                <div class="side-list">
                    <?php $__errorArgs = ['type', 'type.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback border-bottom pb-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <form action="<?php echo e(route('admin.document_type.update', encodeId($document_type->id))); ?>" method="POST" class="d-flex align-items-center flex-grow-1">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <input type="text" name="type" value="<?php echo e($document_type->type); ?>" class="form-control form-control-sm me-2">
                                <input type="hidden" name="typeEn" value="<?php echo e($document_type->typeEn); ?>">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">تعديل</button>
                            </form>
                            <form action="<?php echo e(route('admin.document_type.destroy', encodeId($document_type->id))); ?>" onsubmit="return confirm('حذف؟')" method="POST" class="ms-2">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">حذف</button>
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
                <form action="<?php echo e(route('admin.nationality.store')); ?>" method="POST" class="search-form">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="nationality_name" class="<?php $__errorArgs = ['nationality_name', 'nationality_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="جنسية جديدة..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                <?php $__errorArgs = ['nationality_name', 'nationality_name.create'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback mb-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="side-list">
                    <?php $__errorArgs = ['nationality_name', 'nationality_name.edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback border-bottom pb-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <form action="<?php echo e(route('admin.nationality.update', encodeId($nationality->id))); ?>" method="POST" class="d-flex align-items-center flex-grow-1">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <input type="text" name="nationality_name" value="<?php echo e($nationality->nationality_name); ?>" class="form-control me-2">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">تعديل</button>
                            </form>
                            <form action="<?php echo e(route('admin.nationality.destroy', encodeId($nationality->id))); ?>" onsubmit="return confirm('حذف؟')" method="POST" class="m-0 ms-2">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">حذف</button>
                            </form>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/admin/fields.blade.php ENDPATH**/ ?>



<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
بيانات الموظف
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div id="success-message" class="success-message">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<?php if(session('warning')): ?>
    <div id="warning" class="warning-message">
        <?php echo e(session('warning')); ?>

    </div>
<?php endif; ?>

<div class="container-fluid mt-3" dir="rtl">
    <div class="row">
        <div class="col-md-7 mb-4">
            <div class="card emp-main-card-unique">
                <div class="card-header-unique">
                    <h5 class="mb-0">بيانات الموظف</h5>
                </div>
                <form method="POST" action="<?php echo e(route('employee.update', $employee->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="d-flex align-items-start">
                                <strong style="min-width: 160px;" class="mt-1">الاسم:</strong>
                                <div class="flex-grow-1 ms-4"> 
                                    <textarea name="name" rows="1" 
                                        class="form-control text-muted auto-resize <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        style="resize: none; overflow: hidden;"
                                    ><?php echo e(trim(old('name', $employee->name))); ?></textarea>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <strong style="min-width: 160px;">الرقم الوظيفي:</strong>
                                <div class="flex-grow-1 ms-4">
                                    <input type="text" name="job_number" 
                                        class="form-control text-muted <?php $__errorArgs = ['job_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        value="<?php echo e(old('job_number', $employee->job_number)); ?>">
                                    <?php $__errorArgs = ['job_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <strong style="min-width: 160px;">رقم الهوية:</strong>
                                <div class="flex-grow-1 ms-4">
                                    <input type="text" name="id_number" 
                                        class="form-control text-muted <?php $__errorArgs = ['id_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        value="<?php echo e(old('id_number', $employee->id_number)); ?>">
                                    <?php $__errorArgs = ['id_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <strong style="min-width: 160px;">رقم جواز السفر:</strong>
                                <div class="flex-grow-1 ms-4">
                                    <input type="text" name="passport_number" 
                                        class="form-control text-muted <?php $__errorArgs = ['passport_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        value="<?php echo e(old('passport_number', $employee->passport_number)); ?>">
                                    <?php $__errorArgs = ['passport_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <strong style="min-width: 160px;">رقم الجوال:</strong>
                                <div class="flex-grow-1 ms-4">
                                    <input type="text" name="phone_number" 
                                        class="form-control text-muted <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        value="<?php echo e(old('phone_number', $employee->phone_number)); ?>">
                                    <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <strong style="min-width: 160px;">تاريخ انتهاء الهوية:</strong>
                                <div class="flex-grow-1 ms-4">
                                    <input type="date" name="expiry_date_id" 
                                        class="form-control text-muted <?php $__errorArgs = ['expiry_date_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        value="<?php echo e(old('expiry_date_id', $employee->expiry_date_id)); ?>">
                                    <?php $__errorArgs = ['expiry_date_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>الإدارة:</strong>
                            <select name="management_id" class="form-select w-50 text-muted" >
                            <?php $__currentLoopData = $managements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $management): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($management->id); ?>"
                                    <?php echo e(old('management_id', $management->id) == $employee->management_id ? 'selected':''); ?>>
                                    <?php echo e($management->management_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>الجنسية:</strong>
                            <select name="nationality_id" class="form-select w-50 text-muted">
                            <?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($nationality->id); ?>"
                                    <?php echo e(old('nationality_id', $nationality->id) == $employee->nationality_id ? 'selected':''); ?>>
                                    <?php echo e($nationality->nationality_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>الحالة (موظف - غير موظف)</strong>
                            <label class="switch-container">
                                <input type="checkbox" name="is_active"
                                    value="1" <?php echo e((old('is_active') ?? $employee->is_active) == 1 ? 'checked' : ''); ?>>
                                <span class="slider"></span>
                            </label>
                        </li>
                    </ul>
                    <div class="card-footer d-flex justify-content-between border-top-0 bg-white">
                        <a href="<?php echo e(route('index')); ?>" class="btn btn-secondary btn-sm">رجوع</a>
                        <button type="submit" class="btn btn-save-custom btn-sm">حفظ التعديلات</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ###################################################################################################################-->
        <div class="col-md-5">
            <div class="card side-card-unique mb-4">
                <div class="side-card-header d-flex justify-content-between align-items-center">
                    <span class="side-title">الملاحظات</span>
                    <span class="total-count-badge"><?php echo e($employee->notes->count() ?? 0); ?></span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush side-list">
                        <?php $__empty_1 = true; $__currentLoopData = $employee->notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center side-item">
                            <span class="text-truncate" style="max-width: 70%;"><?php echo e($note->note); ?></span>
                            <div class="side-actions">
                                <a href="#" class="btn-edit-small"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn-delete-small"><i class="fas fa-trash"></i></a>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="list-group-item text-center text-muted">لا توجد ملاحظات</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="card-footer text-center bg-white border-0">
                    <a href="#" class="view-all-link">مشاهدة الكل</a>
                </div>
            </div>
<!--################################################################################################################-->
            <div class="card side-card-unique">
                <div class="side-card-header d-flex justify-content-between align-items-center">
                    <span class="side-title">المستندات</span>
                    <span class="total-count-badge"><?php echo e($employee->documents->count() ?? 0); ?></span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush side-list">
                        <?php $__empty_1 = true; $__currentLoopData = $employee->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center side-item">
                            <div class="d-flex align-items-center">
                                <span class="inner-item-count me-2"><?php echo e($doc->files_count ?? 0); ?></span>
                                <span class="text-truncate"><?php echo e($doc->file_path); ?></span>
                            </div>
                            <div class="side-actions">
                                <a href="#" class="btn-edit-small"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn-delete-small"><i class="fas fa-trash"></i></a>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="list-group-item text-center text-muted">لا توجد مستندات</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="card-footer text-center bg-white border-0">
                    <a href="#" class="view-all-link">مشاهدة الكل</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/employee/show.blade.php ENDPATH**/ ?>
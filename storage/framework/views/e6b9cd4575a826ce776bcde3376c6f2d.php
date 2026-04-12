


<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'بيانات الموظف'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid mt-3" dir="rtl">
    <div class="row">
        <div class="col-md-7 mb-4">
            <div class="card emp-main-card-unique">
                <div class="card-header-unique">
                    <h5 class="mb-0">بيانات الموظف</h5>
                </div>
                <form method="POST" action="<?php echo e(route('user.employee.update', $employee->id)); ?>">
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
                                    <?php echo e(old('management_id', $employee->management_id) == $management->id ? 'selected':''); ?>>
                                    <?php echo e($management->management_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>المسمى الوظيفي:</strong>
                            <select name="job_title_id" class="form-select w-50 text-muted" >
                            <?php $__currentLoopData = $job_titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($job_title->id); ?>"
                                    <?php echo e(old('job_title_id', $employee->job_title_id) == $job_title->id ? 'selected':''); ?>>
                                    <?php echo e($job_title->job_title_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>خطوط الطيران:</strong>
                            <select name="airline_id" class="form-select w-50 text-muted" >
                            <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($airline->id); ?>"
                                    <?php echo e(old('airline_id',$employee->airline_id) == $airline->id ? 'selected':''); ?>>
                                    <?php echo e($airline->airline_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>الجنسية:</strong>
                            <select name="nationality_id" class="form-select w-50 text-muted">
                            <?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($nationality->id); ?>"
                                    <?php echo e(old('nationality_id', $employee->nationality_id) == $nationality->id ? 'selected':''); ?>>
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
                        <a href="<?php echo e(route('user.employee.index')); ?>" class="btn btn-secondary btn-sm">رجوع</a>
                        <?php if($currentUser->hasPermission('updateEmployee')): ?>
                            <button type="submit" class="btn btn-save-custom btn-sm">حفظ التعديلات</button>
                        <?php else: ?>
                            <button type="button" class="btn btn-save-custom disabled-btn btn-sm">غير مصرح لك بإجراء تعديلات</button>
                        <?php endif; ?>
                    </div>                        
                </form>
            </div>
        </div>
<!-- ###################################################################################################################-->
       <div class="col-md-5">
            <div class="card side-card-unique mb-4">
                <div class="side-card-header d-flex justify-content-between align-items-center">
                    <span class="side-title">المستندات</span>
                    <span class="total-count-badge"><?php echo e($employee->documents->count() ?? 0); ?></span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush nags-doc-container">
                        <?php $__empty_1 = true; $__currentLoopData = $documentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="list-group-item p-0 nags-doc-wrapper position-relative">
                            <a href="<?php echo e(route('user.showFilesType', [encodeId($employee->id), encodeId($document_type->id)])); ?>" 
                            class="nags-doc-title-link d-flex justify-content-between align-items-center w-100 p-3 text-decoration-none">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-folder-open me-2"></i> 
                                    <span><?php echo e($document_type->type); ?></span>
                                </div>
                                <span class="nags-count-square"><?php echo e($document_type->documents_count ?? 0); ?></span>
                            </a>
                                            <div class="card-footer text-center bg-white border-0">
                    <a href="<?php echo e(route('user.showFilesType', [encodeId($employee->id), encodeId($document_type->id)])); ?>" class="view-all-link">مشاهدة الكل</a>
                </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="list-group-item text-center text-muted">لا توجد مستندات</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="card side-card-unique mb-4">
                <div class="side-card-header d-flex justify-content-between align-items-center">
                    <span class="side-title">الملاحظات</span>
                    <span class="total-count-badge"><?php echo e($employee->notes->count() ?? 0); ?></span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush side-list">
                        <?php $__empty_1 = true; $__currentLoopData = $employee->notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="list-group-item p-0 side-item position-relative">
                            <a href="<?php echo e(route('user.note.edit', encodeId($note->id))); ?>" 
                            class="text-decoration-none text-reset d-flex align-items-center w-100 p-3">
                                <span class="text-truncate" style="max-width: 90%;"><?php echo e($note->title); ?></span>
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="list-group-item text-center text-muted">لا توجد ملاحظات</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="text-center move-this">
        <a href="<?php echo e(route('user.library.index')); ?>" class="view-all-link">قم بإضافة مستند جديد أو ملاحظة من هنا</a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('script.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/user/employee/show.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'بيانات الموظف'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    body {
        margin: 0; padding: 0;
        font-family: "Cairo", sans-serif;
        background-color: #e8e8e8 !important;
    }

    /* كرت الموظف الرئيسي */
    .emp-main-card-unique {
        border: 1px solid #3B524A !important;
        border-radius: 12px !important;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        background: #fff;
    }

    .card-header-unique {
        background-color: #3B524A !important;
        color: #ffffff !important;
        padding: 15px 20px;
    }

    .list-group-item strong { min-width: 160px; color: #333; }
    
    .auto-resize { resize: none; overflow: hidden; }

    /* الكروت الجانبية */
    .side-card-unique {
        border: 1px solid #3B524A !important;
        border-radius: 10px !important;
        overflow: hidden;
        background: #fff;
    }

    .side-card-header {
        background-color: #3B524A;
        color: white;
        padding: 10px 15px;
        font-weight: bold;
    }

    .total-count-badge {
        background-color: #ffffff;
        color: #3B524A;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 0.85rem;
    }

    /* تنسيق المستندات */
    .pfs-doc-container { direction: rtl; }
    .pfs-doc-wrapper:hover { background-color: #f9fafb; }
    .pfs-doc-title-link {
        color: #000 !important;
        font-weight: 700;
        font-size: 0.92rem;
    }

    .pfs-count-square {
        background-color: #f1f5f9;
        color: #64748b;
        width: 26px; height: 26px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 5px; border: 1px solid #e2e8f0;
        font-size: 0.7rem;
    }

    /* سويتش الحالة */
    .switch-container {
        position: relative; display: inline-block;
        width: 44px; height: 22px;
    }
    .switch-container input { opacity: 0; width: 0; height: 0; }
    .slider {
        position: absolute; cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #D30E00; transition: .4s; border-radius: 34px;
    }
    .slider:before {
        position: absolute; content: "";
        height: 16px; width: 16px; left: 3px; bottom: 3px;
        background-color: white; transition: .4s; border-radius: 50%;
    }
    input:checked + .slider { background-color: #28a745; }
    input:checked + .slider:before { transform: translateX(22px); }

    /* الأزرار */
    .btn-save-custom {
        background-color: #3B524A !important;
        color: white !important;
        padding: 6px 20px !important;
        border-radius: 8px !important;
        transition: 0.3s;
    }
    .btn-save-custom:hover { background-color: #497033; }
    .view-all-link { color: #3B524A; font-weight: bold; text-decoration: none; font-size: 0.85rem; }
    .view-all-link:hover { text-decoration: underline; }
    
    .disabled-btn { opacity: 0.5; cursor: not-allowed; filter: grayscale(1); }
    .move-this { padding: 30px 0; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
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
                        <li class="list-group-item d-flex align-items-start py-3">
                            <strong>الاسم:</strong>
                            <div class="flex-grow-1 ms-4">
                                <textarea name="name" rows="1" class="form-control auto-resize <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('name', $employee->name)); ?></textarea>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </li>
                        
                        <li class="list-group-item d-flex align-items-center py-3">
                            <strong>الرقم الوظيفي:</strong>
                            <div class="flex-grow-1 ms-4">
                                <input type="text" name="job_number" class="form-control <?php $__errorArgs = ['job_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('job_number', $employee->job_number)); ?>">
                                <?php $__errorArgs = ['job_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </li>

                        <li class="list-group-item d-flex align-items-center py-3">
                            <strong>رقم الهوية:</strong>
                            <div class="flex-grow-1 ms-4">
                                <input type="text" name="id_number" class="form-control <?php $__errorArgs = ['id_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('id_number', $employee->id_number)); ?>">
                                <?php $__errorArgs = ['id_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </li>

                        <li class="list-group-item d-flex align-items-center py-3">
                            <strong>تاريخ انتهاء الهوية:</strong>
                            <div class="flex-grow-1 ms-4">
                                <input type="date" name="expiry_date_id" class="form-control <?php $__errorArgs = ['expiry_date_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('expiry_date_id', $employee->expiry_date_id)); ?>">
                                <?php $__errorArgs = ['expiry_date_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </li>

                        <li class="list-group-item d-flex align-items-center py-3">
                            <strong>رقم الجواز:</strong>
                            <div class="flex-grow-1 ms-4">
                                <input type="text" name="passport_number" class="form-control <?php $__errorArgs = ['passport_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('passport_number', $employee->passport_number)); ?>">
                                <?php $__errorArgs = ['passport_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </li>

                        <li class="list-group-item d-flex align-items-center py-3">
                            <strong>الجوال:</strong>
                            <div class="flex-grow-1 ms-4">
                                <input type="text" name="phone_number" class="form-control <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('phone_number', $employee->phone_number)); ?>">
                                <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <strong>الإدارة:</strong>
                            <select name="management_id" class="form-select w-50">
                                <?php $__currentLoopData = $managements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $management): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($management->id); ?>" <?php echo e(old('management_id', $employee->management_id) == $management->id ? 'selected' : ''); ?>>
                                        <?php echo e($management->management_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <strong>المسمى الوظيفي:</strong>
                            <select name="job_title_id" class="form-select w-50">
                                <?php $__currentLoopData = $job_titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($job_title->id); ?>" <?php echo e(old('job_title_id', $employee->job_title_id) == $job_title->id ? 'selected' : ''); ?>>
                                        <?php echo e($job_title->job_title_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <strong>خطوط الطيران:</strong>
                            <select name="airline_id" class="form-select w-50">
                                <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($airline->id); ?>" <?php echo e(old('airline_id', $employee->airline_id) == $airline->id ? 'selected' : ''); ?>>
                                        <?php echo e($airline->airline_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <strong>الجنسية:</strong>
                            <select name="nationality_id" class="form-select w-50">
                                <?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($nationality->id); ?>" <?php echo e(old('nationality_id', $employee->nationality_id) == $nationality->id ? 'selected' : ''); ?>>
                                        <?php echo e($nationality->nationality_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <strong>الحالة (موظف - غير موظف)</strong>
                            <label class="switch-container">
                                <input type="checkbox" name="is_active" value="1" <?php echo e((old('is_active') ?? $employee->is_active) == 1 ? 'checked' : ''); ?>>
                                <span class="slider"></span>
                            </label>
                        </li>
                    </ul>
                    <div class="card-footer d-flex justify-content-between bg-white py-3">
                        <a href="<?php echo e(route('employee.index')); ?>" class="btn btn-outline-secondary btn-sm">رجوع</a>
                        <?php if($currentUser->hasPermission('updateEmployees')): ?>
                            <button type="submit" class="btn btn-save-custom btn-sm">حفظ التعديلات</button>
                        <?php else: ?>
                            <button type="button" class="btn btn-save-custom disabled-btn btn-sm">غير مصرح لك بالتعديل</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card side-card-unique mb-4">
                <div class="side-card-header d-flex justify-content-between align-items-center">
                    <span>المستندات</span>
                    <span class="total-count-badge"><?php echo e($employee->documents->count()); ?></span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush pfs-doc-container">
                        <?php $__empty_1 = true; $__currentLoopData = $documentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item p-0 pfs-doc-wrapper">
                                <a href="<?php echo e(route('documents.showTypeFiles', [encodeId($employee->id), encodeId($document_type->id)])); ?>" 
                                   class="pfs-doc-title-link d-flex justify-content-between align-items-center p-3 text-decoration-none">
                                    <span><i class="fas fa-file-alt me-2"></i> <?php echo e($document_type->type); ?></span>
                                    <span class="pfs-count-square"><?php echo e($document_type->documents_count ?? 0); ?></span>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item text-center py-4 text-muted">لا توجد مستندات</li>
                        <?php endif; ?>
                    </ul>
                    <?php if($currentUser->hasPermission('showDocuments')): ?>
                        <div class="card-footer text-center bg-white border-0">
                            <a href="<?php echo e(route('documents.show', encodeId($employee->id))); ?>" class="view-all-link">مشاهدة تفاصيل المستندات</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card side-card-unique mb-4">
                <div class="side-card-header d-flex justify-content-between align-items-center">
                    <span>آخر الملاحظات</span>
                    <span class="total-count-badge"><?php echo e($employee->notes->count()); ?></span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <?php $__empty_1 = true; $__currentLoopData = $employee->notes->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item side-item">
                                <a href="<?php echo e(route('note.edit', encodeId($note->id))); ?>" class="text-decoration-none text-dark d-block">
                                    <i class="fas fa-sticky-note me-2 text-muted"></i> <?php echo e(Str::limit($note->title, 40)); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item text-center py-4 text-muted">لا توجد ملاحظات</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center move-this">
    <a href="<?php echo e(route('note.index')); ?>" class="view-all-link">
        <i class="fas fa-plus-circle"></i> إضافة مستند جديد أو ملاحظة من هنا
    </a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/user/employee/show.blade.php ENDPATH**/ ?>
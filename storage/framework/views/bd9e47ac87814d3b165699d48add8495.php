


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
<div class="container mt-1" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <form method="POST" action="<?php echo e(route('employee.update', $employee->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <ul class="list-group list-group-flush">
<li class="list-group-item">
    <div class="d-flex align-items-start">
        <strong style="min-width: 160px;" class="mt-1">الاسم:</strong>
        <div class="flex-grow-1 ms-4"> <textarea name="name" rows="1" 
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
                            <select name="management_id" class="text-muted" >
                            <?php $__currentLoopData = $managements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $management): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($management->id); ?>"
                                    <?php echo e($management->id == $employee->management_id ? 'selected':''); ?>>
                                    <?php echo e($management->management_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>الجنسية:</strong>
                            <select name="nationality_id" class="text-muted" value="<?php echo e($employee->nationality->nationality_name); ?>">
                            <?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($nationality->id); ?>"
                                    <?php echo e($nationality->id == $employee->nationality_id ? 'selected':''); ?>>
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

                    <div class="card-footer">
                        <a href="<?php echo e(route('index')); ?>" class="btn btn-secondary btn-sm">رجوع</a>
                        <button type="submit" class="btn btn-primary btn-sm">حفظ التعديلات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('script.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/employee/show.blade.php ENDPATH**/ ?>
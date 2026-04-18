

<?php $__env->startSection('title', 'إضافة موظف'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    body {
        margin: 0; padding: 0;
        font-family: "Cairo", sans-serif;
        background-color: #e8e8e8 !important;
    }

    /* الرسائل التنبيهية */
    .success-message, .warning-message {
        position: fixed; right: 80px; top: 80px; padding: 14px 18px;
        border-radius: 10px; font-weight: bold; transition: opacity 0.5s ease;
        width: fit-content; max-width: 400px; text-align: center; z-index: 9999;
    }
    .success-message { background-color: #e8fff3; border: 2px solid #28a745; color: #155724; }
    .warning-message { background-color: #fcebd3; border: 2px solid #f5712f; color: #a37b3e; }

    /* الحاوية الرئيسية */
    .container-createEmployee {
        max-width: 1000px;
        margin: 20px auto;
        padding: 20px;
    }

    .section-title {
        color: #3B524A;
        margin-top: 35px; margin-bottom: 15px;
        font-size: 22px; border-right: 5px solid #3B524A;
        padding-right: 10px;
    }

    /* شبكة الحقول */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        align-items: start;
    }

    .form-group { display: flex; flex-direction: column; }
    .form-group label { margin-bottom: 6px; font-weight: bold; color: #333; }

    .form-group input, .form-group select {
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #bbb;
        font-size: 15px;
        font-family: "Cairo", sans-serif;
        outline: none;
    }

    .form-group input:focus, .form-group select:focus {
        border-color: #3B524A;
        box-shadow: 0 0 5px rgba(59, 82, 74, 0.2);
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
    .bottom-buttons { margin-top: 25px; text-align: center; }
    .save-btn { background-color: #3B524A; color: white; border: none; padding: 12px 40px; border-radius: 10px; cursor: pointer; font-weight: bold; }
    .cancel-btn { background-color: #999; color: white; text-decoration: none; padding: 12px 40px; border-radius: 10px; display: inline-block; }
    .save-btn:hover { background-color: #497033; }

    /* التنبيهات */
    .invalid-feedback { color: red; font-size: 13px; margin-top: 5px; }
    .is-invalid { border-color: red !important; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-createEmployee">
    <form action="<?php echo e(route('employee.store')); ?>" method="post">
        <?php echo csrf_field(); ?>

        <h2 class="section-title">بيانات العمل</h2>
        <div class="form-grid">
            <div class="form-group">
                <label>الرقم الوظيفي</label>
                <input type="text" placeholder="أدخل 5 أو 6 أرقام..." name="job_number" value="<?php echo e(old('job_number')); ?>"
                    class="<?php $__errorArgs = ['job_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['job_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label>خطوط الطيران</label>
                <select name="airline_id">
                    <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($airline->id); ?>"><?php echo e($airline->airline_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label>المسمى الوظيفي</label>
                <select name="job_title_id">
                    <?php $__currentLoopData = $job_titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($job_title->id); ?>"><?php echo e($job_title->job_title_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label>الإدارة</label>
                <select name="management_id">
                    <?php $__currentLoopData = $management; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $management_names): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($management_names->id); ?>"><?php echo e($management_names->management_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label>الحالة (موظف - غير موظف)</label>
                <label class="switch-container">
                    <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active') == '1' ? 'checked' : ''); ?>>
                    <span class="slider"></span>
                </label>
            </div>
        </div>

        <h2 class="section-title">البيانات الشخصية</h2>
        <div class="form-grid">
            <div class="form-group">
                <label>الاسم</label>
                <input type="text" placeholder="مثل: محمد خالد العتيبي" name="name" value="<?php echo e(old('name')); ?>"
                    class="<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label>الجنسية</label>
                <select name="nationality_id">
                    <?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($nationality->id); ?>"><?php echo e($nationality->nationality_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label>رقم جواز السفر</label>
                <input type="text" name="passport_number" value="<?php echo e(old('passport_number')); ?>" class="<?php $__errorArgs = ['passport_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['passport_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label>رقم الهوية</label>
                <input type="text" name="id_number" value="<?php echo e(old('id_number')); ?>" class="<?php $__errorArgs = ['id_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['id_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label>رقم الجوال</label>
                <input type="text" placeholder="05xxxxxxxx" name="phone_number" value="<?php echo e(old('phone_number')); ?>" class="<?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label>تاريخ انتهاء الهوية</label>
                <input type="date" name="expiry_date_id" value="<?php echo e(old('expiry_date_id')); ?>" class="<?php $__errorArgs = ['expiry_date_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['expiry_date_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="bottom-buttons">
            <button type="submit" class="save-btn">حفظ</button>
            <a href="<?php echo e(route('employee.index')); ?>" class="cancel-btn">إلغاء</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/user/employee/create.blade.php ENDPATH**/ ?>
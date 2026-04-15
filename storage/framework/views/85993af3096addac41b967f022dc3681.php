

<?php $__env->startSection('title', 'تسجيل موظف جديد'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-createEmployee">

    <div class="section-title">تسجيل مستخدم جديد</div>

    <form method="POST" action="<?php echo e(route('user.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-grid">

            
            <div class="form-group">
                <label>الاسم</label>
                <input type="text" name="name" value="<?php echo e(old('name')); ?>"
                    class="<?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group">
                <label>اسم المستخدم</label>
                <input type="text" name="username" value="<?php echo e(old('username')); ?>"
                    class="<?php echo e($errors->has('username') ? 'is-invalid' : ''); ?>">
                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password"
                    class="<?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
<br>
            <div class="form-group">
                <label>تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation"
                    class="<?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>">
            </div>

        </div>

        
        <div class="bottom-buttons">
            <a href="<?php echo e(route('login')); ?>" class="cancel-btn">رجوع</a>
            <button type="submit" class="save-btn">تقديم طلب التسجيل</button>
        </div>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/user/registerUser.blade.php ENDPATH**/ ?>
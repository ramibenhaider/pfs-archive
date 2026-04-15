

<?php $__env->startSection('note-title', 'تعديل ملاحظة: '. $note->employee->name); ?>

<?php $__env->startSection('method'); ?>
<?php echo method_field('PUT'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action', route('note.update', $note->id)); ?>

<?php $__env->startSection('actionForDelete', route('note.destroy', $note->id)); ?>

<?php $__env->startSection('backTo', route('employee.edit', encodeId($note->employee->id))); ?>

<?php $__env->startSection('deleteButton'); ?>
    <form action="<?php echo e(route('note.destroy', $note->id)); ?>"  method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="btn-delete-sm" onclick="return confirm('هل أنت متأكد من حذف هذه الملاحظة نهائياً؟');" style="padding: 10px 30px !important; height: 100%; cursor: pointer;">
            حذف الملاحظة
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.note-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/user/notes/edit.blade.php ENDPATH**/ ?>
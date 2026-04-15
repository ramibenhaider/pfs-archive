

<?php $__env->startSection('note-title', 'إضافة ملاحظة شخصية'); ?>

<?php $__env->startSection('action', route('myNote.store')); ?>

<?php $__env->startSection('backTo', route('note.index')); ?>
<?php echo $__env->make('layouts.note-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/user/notes/createMyNote.blade.php ENDPATH**/ ?>
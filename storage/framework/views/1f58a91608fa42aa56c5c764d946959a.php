<?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<h1><?php echo e($document->employee->name); ?></h1>
<h2><?php echo e($document->document_type->type); ?></h2>
<h3><?php echo e($document->file_path); ?></h3>
<h3><?php echo e($document->comment); ?></h3>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/library/document/show.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'دار الوثائق'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    
    <a href="<?php echo e(route('employee.index')); ?>" class="btn btn-back-note">
        <i class="bi bi-x-circle"></i> عودة للرئيسية
    </a>
            <br><br>
   <div class="note-section-card">
    <div class="notes-toolbar">
        <h5 class="notes-toolbar__title">ملاحظاتي الشخصية</h5>
        <a href="<?php echo e(route('myNote.create')); ?>"
           class="btn-main d-flex justify-content-center align-items-center text-decoration-none"
           style="width: 250px; height: 45px; margin: 0 auto;">إضافة ملاحظة شخصية +
        </a>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th><strong>العنوان</strong></th>
                    <th><strong>الملاحظة</strong></th>
                    <th><strong>تاريخ الإضافة</strong></th>
                    <th><strong>تاريخ آخر تعديل</strong></th>
                    <th><strong>إجراءات</strong></th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $myNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(Str::limit($myNote->title, 50)); ?></td>
                    <td><?php echo e(Str::limit($myNote->note, 50)); ?></td>
                    <td><?php echo e($myNote->created_at->format('Y-m-d')); ?></td>
                    <td><?php echo e($myNote->updated_at); ?></td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="<?php echo e(route('myNote.edit', encodeId($myNote->id))); ?>" class="btn btn-edit-sm">عرض</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="pagination-wrapper">
        <?php echo e($myNotes->links()); ?>

    </div>
</div>
<!--############################################################################################################################-->
<div class="row">
    <div class="col-md-6">
        <div class="note-section-card">
            <h5 class="section-header">رفع المستندات</h5>
            <form action="<?php echo e(route('documents.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label">الموظف</label>
                    <select name="employee_id" id="employee_id" class="form-select custom-input <?php $__errorArgs = ['employee_id', 'doc_errors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($employee->id); ?>" <?php echo e(old('employee_id') == $employee->id ? 'selected' : ''); ?>><?php echo e($employee->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['employee_id', 'doc_errors'];
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

                <div class="mb-3">
                    <label class="form-label">نوع المستند</label>
                    <select name="document_type_id" class="form-select custom-input <?php $__errorArgs = ['document_type_id', 'doc_errors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($document_type->id); ?>" <?php echo e(old('document_type_id') == $document_type->id ? 'selected' : ''); ?>><?php echo e($document_type->type); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['document_type_id', 'doc_errors'];
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

                <div class="mb-3">
                    <label class="form-label">الملفات</label>
                    <input type="file" id="fileInput"
                        class="form-control custom-input <?php if($errors->doc_errors->has('files') || $errors->doc_errors->has('files.*')): ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        multiple accept=".pdf,.doc,.docx,.xls,.xlsx">
                    <div id="fileList" class="mt-2"></div>
                    <input type="file" name="files[]" id="hiddenFiles" multiple style="display:none">
                    <?php $__errorArgs = ['files', 'doc_errors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__errorArgs = ['files.*', 'doc_errors'];
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
                <?php if($currentUser->hasPermission('createDocuments')): ?>
                    <button type="submit" class="btn-main w-100">بدء الرفع</button>
                <?php elseif(!$currentUser->is_ac): ?>
                    <button type="button" class="btn-main w-100 disabled-btn">غير مصرح لك برفع ملف</button>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <div class="note-section-card">
            <h5 class="section-header">إضافة ملاحظة جديدة</h5>
            <form action="<?php echo e(route('note.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label">الموظف</label>
                    <select name="employee_id" id="employee_id_note" class="form-select custom-input <?php $__errorArgs = ['employee_id', 'note_errors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($employee->id); ?>" <?php echo e(old('employee_id') == $employee->id ? 'selected' : ''); ?>><?php echo e($employee->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['employee_id', 'note_errors'];
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

                <div class="mb-3">
                    <label class="form-label">عنوان الملاحظة</label>
                    <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control custom-input <?php $__errorArgs = ['title', 'note_errors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['title', 'note_errors'];
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

                <div class="mb-3">
                    <label class="form-label">نص الملاحظة</label>
                    <textarea name="note" class="form-control custom-input <?php $__errorArgs = ['note', 'note_errors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3"placeholder="اكتب ملاحظاتك هنا..."><?php echo e(old('note')); ?></textarea>
                    <?php $__errorArgs = ['note', 'note_errors'];
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
                    <button type="submit" class="btn-main w-100">حفظ الملاحظة</button>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/user/library/index.blade.php ENDPATH**/ ?>
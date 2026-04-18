

<?php $__env->startSection('title', 'دار الوثائق'); ?>

<?php $__env->startPush('styles'); ?>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Cairo", sans-serif;
        background-color: #e8e8e8 !important;
    }

    .logo-area {
        width: 100%;
        padding: 5px 0 0 0;
        text-align: center;
    }

    .container {
        max-width: 900px;
        margin: 40px auto 0 auto;
        padding: 20px;
    }

    .btn-back-note {
        background-color: #6c757d !important;
        color: #ffffff !important;
        text-decoration: none !important;
        padding: 10px 30px !important;
        border-radius: 10px !important;
        font-weight: bold !important;
        transition: 0.3s !important;
        display: inline-block;
    }

    .note-section-card {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        border-top: 4px solid #3B524A;
    }

    .section-header {
        color: #3B524A;
        font-weight: bold;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .notes-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 30px;
        padding: 18px 22px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.06);
    }

    .custom-table {
        width: 100%;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .custom-table thead {
        background-color: #3B524A;
        color: white;
    }

    .custom-table th, .custom-table td {
        padding: 15px;
        text-align: center;
        vertical-align: middle;
    }

    .btn-main {
        background-color: #3B524A !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 8px 20px !important;
        border: none !important;
        transition: 0.3s;
    }

    .btn-main:hover {
        background-color: #497033 !important;
        transform: translateY(-2px);
    }

    .custom-input {
        border-radius: 10px !important;
        padding: 12px 15px !important;
        border: 1px solid #ddd !important;
    }

    /* تنسيق خاص لـ TomSelect ليتناسب مع تصميمك */
    .ts-control {
        border-radius: 10px !important;
        padding: 10px !important;
        border: 1px solid #ddd !important;
    }
    .ts-wrapper.is-invalid .ts-control {
        border-color: red !important;
    }
</style>
<?php $__env->stopPush(); ?>

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
                        <th>العنوان</th>
                        <th>الملاحظة</th>
                        <th>تاريخ الإضافة</th>
                        <th>تاريخ آخر تعديل</th>
                        <th>إجراءات</th>
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

    <div class="row">
        <div class="col-md-6">
            <div class="note-section-card">
                <h5 class="section-header">رفع المستندات</h5>
                <form action="<?php echo e(route('documents.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">الموظف</label>
                        <select name="employee_id" id="select-employee-doc" class="searchable-select <?php $__errorArgs = ['employee_id', 'doc_errors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="ابحث عن موظف...">
                            <option value=""></option>
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
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الملفات</label>
                        <input type="file" name="files[]" class="form-control custom-input" accept=".pdf,.doc,.docs,.xls,.xlsx" multiple>
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
                        <?php $__errorArgs = ['comments', 'doc_errors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php $__errorArgs = ['comments.*', 'doc_errors'];
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
                    <?php else: ?>
                        <button type="button" class="btn-main w-100" disabled>غير مصرح لك برفع الملفات</button>
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
                        <select name="employee_id" id="select-employee-note" class="searchable-select <?php $__errorArgs = ['employee_id', 'note_errors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="ابحث عن موظف...">
                            <option value=""></option>
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
                        <input type="text" name="title" class="form-control custom-input">
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
                        <textarea name="note" class="form-control custom-input" rows="3"></textarea>
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
</div>
<script src="<?php echo e(asset('script.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/user/library/index.blade.php ENDPATH**/ ?>
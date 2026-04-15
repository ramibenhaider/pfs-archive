document.addEventListener("DOMContentLoaded", function () {

    // ======== رسالة النجاح ========
    const msg = document.getElementById("success-message");
    if (msg) {
        setTimeout(() => {
            msg.style.transition = "opacity 0.5s ease";
            msg.style.opacity = "0";
            setTimeout(() => msg.remove(), 500);
        }, 5000);
    }

    const wmsg = document.getElementById("warning-message");
    if (wmsg) {
        setTimeout(() => {
            wmsg.style.transition = "opacity 0.5s ease";
            wmsg.style.opacity = "0";
            setTimeout(() => wmsg.remove(), 500);
        }, 5000);
    }

    // ======== File Upload ========
    const fileInput   = document.getElementById('fileInput');
    const hiddenFiles = document.getElementById('hiddenFiles');
    const fileList    = document.getElementById('fileList');

    let allFiles = new DataTransfer();
    const comments = new Map();

    if (fileInput) {
        fileInput.addEventListener('change', function () {
            Array.from(this.files).forEach(file => {
                const exists = Array.from(allFiles.files)
                    .some(f => f.name === file.name && f.size === file.size);
                if (!exists) allFiles.items.add(file);
            });

            const dt = new DataTransfer();
            Array.from(allFiles.files).forEach(f => dt.items.add(f));
            hiddenFiles.files = dt.files;

            updateList();
            this.value = '';
        });
    }

    function updateList() {
        fileList.innerHTML = '';
        Array.from(allFiles.files).forEach((file, index) => {
            const key = file.name + file.size;
            const row = document.createElement('div');
            row.style.cssText = "display:flex; align-items:center; gap:10px; margin-bottom:8px;";
            row.innerHTML = `
                <span style="min-width:150px">${file.name}</span>
                <input type="text" name="comments[]" placeholder="تعليق..." style="flex:1; padding:4px">
                <button type="button" onclick="removeFile(${index})">حذف</button>
            `;
            fileList.appendChild(row);

            const input = row.querySelector('input[name="comments[]"]');
            input.value = comments.get(key) || '';
            input.addEventListener('input', e => comments.set(key, e.target.value));
        });
    }

    window.removeFile = function(index) {
        const newFiles = new DataTransfer();
        Array.from(allFiles.files).forEach((file, i) => {
            if (i !== index) newFiles.items.add(file);
        });
        allFiles = newFiles;

        const dt = new DataTransfer();
        Array.from(allFiles.files).forEach(f => dt.items.add(f));
        hiddenFiles.files = dt.files;

        updateList();
    };

    // ======== Textarea Auto Resize ========
    document.querySelectorAll('textarea').forEach(el => {
        el.addEventListener('input', () => {
            el.style.height = 'auto';
            el.style.height = el.scrollHeight + 'px';
        });
    });

    const customTextarea = document.querySelector('.custom-textarea');
    if (customTextarea) {
        customTextarea.style.height = customTextarea.scrollHeight + 'px';
    }

    // ======== TomSelect ========
    if (document.getElementById('employee_id')) {
        new TomSelect('#employee_id', {
            placeholder: 'ابحث عن موظف لإدراج مستنداته...',
        });
    }

    if (document.getElementById('employee_id_note')) {
        new TomSelect('#employee_id_note', {
            placeholder: 'ابحث عن موظف لإدراج ملاحظة عليه...',
        });
    }

});

function deleteUser(fullRoute) {
    if (confirm('هل أنت متأكد من حذف هذا المستخدم؟')) {
        let form = document.getElementById('global-delete-form');
        form.action = fullRoute;
        form.submit();
    }
}

function viewDocument(url, originalName) {
    const extension = originalName.split('.').pop().toLowerCase();
    const officeExtensions = ['doc', 'docx', 'xls', 'xlsx'];

    if (officeExtensions.includes(extension)) {
        window.open(`https://view.officeapps.live.com/op/view.aspx?src=${encodeURIComponent(url)}`, '_blank');
    } else {
        window.open(url, '_blank');
    }
}
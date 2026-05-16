document.addEventListener("DOMContentLoaded", function () {

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

    // TomSelect — مرة وحدة فقط مع حماية
    if (typeof TomSelect !== 'undefined') {
        document.querySelectorAll('.searchable-select').forEach((el) => {
            if (el && !el.tomselect) {
                new TomSelect(el, {
                    create: false,
                    sortField: { field: "text", order: "asc" },
                    allowEmptyOption: true,
                });
            }
        });
    }

    class DocumentUploader {
        constructor(config) {
            this.fileInput    = document.getElementById(config.inputId);
            if (!this.fileInput) return;

            this.fileList     = document.getElementById(config.listId);
            this.uploadErrors = document.getElementById(config.errorsId);
            this.errFiles     = document.getElementById(config.errFilesId);
            this.form         = this.fileInput.closest('form');

            this.selectedFiles = [];
            this.maxSizeMB     = 10;

            this._initEvents();
        }

        _initEvents() {
            this.fileInput.addEventListener('change', (e) => {
                this._addFiles(Array.from(e.target.files));
                this.fileInput.value = '';
            });

            this.form.addEventListener('submit', (e) => {
                if (!this._prepareSubmit()) e.preventDefault();
            });
        }

        _addFiles(files) {
            const errors = [];

            files.forEach(file => {
                const isDupe = this.selectedFiles.some(
                    f => f.file.name === file.name && f.file.size === file.size
                );
                if (isDupe) {
                    errors.push(`"${file.name}" مضاف مسبقاً.`);
                    return;
                }

                if (file.size > this.maxSizeMB * 1024 * 1024) {
                    errors.push(`"${file.name}" يتجاوز الحد الأقصى (${this.maxSizeMB} MB).`);
                    return;
                }

                this.selectedFiles.push({
                    id: `${Date.now()}_${Math.random().toString(36).slice(2)}`,
                    file,
                    comment: ''
                });
            });

            if (errors.length) this._showError(errors.join('<br>'));
            this._clearFieldError();
            this._render();
        }

        _removeFile(id) {
            this.selectedFiles = this.selectedFiles.filter(f => f.id !== id);
            this._render();
        }

        _updateComment(id, value) {
            const entry = this.selectedFiles.find(f => f.id === id);
            if (entry) entry.comment = value;
        }

        _prepareSubmit() {
            this.form.querySelectorAll('[data-uploader]').forEach(el => el.remove());

            if (this.selectedFiles.length === 0) {
                this._showFieldError('يجب رفع ملف واحد على الأقل!');
                return false;
            }

            const dt = new DataTransfer();
            this.selectedFiles.forEach(entry => dt.items.add(entry.file));

            const filesInput = document.createElement('input');
            filesInput.type             = 'file';
            filesInput.name             = 'files[]';
            filesInput.multiple         = true;
            filesInput.style.display    = 'none';
            filesInput.dataset.uploader = '1';
            filesInput.files            = dt.files;
            this.form.appendChild(filesInput);

            const paddingInput = document.createElement('input');
            paddingInput.type             = 'hidden';
            paddingInput.name             = 'comments[]';
            paddingInput.value            = '';
            paddingInput.dataset.uploader = '1';
            this.form.appendChild(paddingInput);

            this.selectedFiles.forEach(entry => {
                const commentInput = document.createElement('input');
                commentInput.type             = 'hidden';
                commentInput.name             = 'comments[]';
                commentInput.value            = entry.comment;
                commentInput.dataset.uploader = '1';
                this.form.appendChild(commentInput);
            });

            return true;
        }

        _render() {
            this.fileList.innerHTML = '';

            this.selectedFiles.forEach(entry => {
                const card = document.createElement('div');
                card.className = 'card mb-2 p-2 shadow-sm border-0';
                card.style.backgroundColor = '#fdfdfd';

                card.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-file-earmark-text text-primary"></i>
                            <span class="small fw-bold text-dark text-truncate"
                                  style="max-width:425px;"
                                  title="${this._esc(entry.file.name)}">
                                ${this._esc(entry.file.name)}
                            </span>
                            <span class="text-muted" style="font-size:11px;">
                                ${this._formatSize(entry.file.size)}
                            </span>
                        </div>
                        <button type="button" 
                                class="btn btn-link text-danger p-0" 
                                style="text-decoration:none; font-size:14px;"
                                data-id="${entry.id}">
                           X
                        </button>
                    </div>
                    <input type="text"
                           class="form-control form-control-sm"
                           placeholder="أضف تعليقاً (اختياري)..."
                           maxlength="255"
                           value="${this._esc(entry.comment)}"
                           data-id="${entry.id}">
                `;

                card.querySelector('button[data-id]').addEventListener('click', (e) => {
                    this._removeFile(e.currentTarget.dataset.id);
                });

                card.querySelector('input[data-id]').addEventListener('input', (e) => {
                    this._updateComment(e.currentTarget.dataset.id, e.currentTarget.value);
                });

                this.fileList.appendChild(card);
            });
        }

        _showError(html) {
            if (!this.uploadErrors) return;
            this.uploadErrors.innerHTML = `
                <div class="alert alert-warning alert-dismissible fade show py-2 px-3" role="alert">
                    ${html}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
                </div>`;
        }

        _showFieldError(msg) {
            if (!this.errFiles) return;
            this.errFiles.textContent   = msg;
            this.errFiles.style.display = 'block';
        }

        _clearFieldError() {
            if (!this.errFiles) return;
            this.errFiles.textContent   = '';
            this.errFiles.style.display = 'none';
        }

        _esc(str) {
            return String(str)
                .replace(/&/g, '&amp;').replace(/"/g, '&quot;')
                .replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }

        _formatSize(bytes) {
            if (bytes >= 1024 * 1024) return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
            if (bytes >= 1024)        return (bytes / 1024).toFixed(0) + ' KB';
            return bytes + ' B';
        }
    }

    new DocumentUploader({
        inputId:   'fileInput',
        listId:    'fileList',
        errorsId:  'upload-errors',
        errFilesId: 'err-files'
    });

    new DocumentUploader({
        inputId:   'companyFileInput',
        listId:    'companyFileList',
        errorsId:  'company-upload-errors',
        errFilesId: 'company-err-files'
    });

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
    
    if (['doc', 'docx', 'xls', 'xlsx'].includes(extension)) {
        window.open("https://view.officeapps.live.com/op/embed.aspx?src=" + encodeURIComponent(url), '_blank');
    } else {
        window.open(url, '_blank');
    }
}
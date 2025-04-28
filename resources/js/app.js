import './bootstrap.js';
import './filepond.min.js';
import $ from 'jquery';

import * as FilePond from 'filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImageTransform from 'filepond-plugin-image-transform';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImageFilter from 'filepond-plugin-image-filter';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginImageResize from 'filepond-plugin-image-resize';
import FilePondPluginImageEdit from 'filepond-plugin-image-edit';
import FilePondPluginFilePoster from 'filepond-plugin-file-poster';
import FilePondPluginFileEncode from 'filepond-plugin-file-encode';

import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import 'filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css';
import 'filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css';

import ImageEditor from 'tui-image-editor';
import 'tui-image-editor/dist/tui-image-editor.css';

window.$ = $;
window.jQuery = $;
window.FilePond = FilePond;

FilePond.registerPlugin(
    FilePondPluginFileValidateType,
    FilePondPluginFileValidateSize,
    FilePondPluginImageExifOrientation,
    FilePondPluginImageTransform,
    FilePondPluginImageCrop,
    FilePondPluginImageFilter,
    FilePondPluginImagePreview,
    FilePondPluginImageResize,
    FilePondPluginImageEdit,
    FilePondPluginFilePoster,
    FilePondPluginFileEncode
);

const toastEditor = {
    instance: null,
    modal: null,
    confirmButton: null,
    cancelButton: null,

    open(file) {
        return new Promise((resolve, reject) => {
            const template = document.getElementById('tui-editor-template');
            const fragment = template.content.cloneNode(true);
            document.body.appendChild(fragment);

            this.modal = document.getElementById('tui-editor-modal');
            const container = document.getElementById('tui-editor-container');
            this.confirmButton = document.getElementById('tui-editor-confirm');
            this.cancelButton = document.getElementById('tui-editor-cancel');

            const reader = new FileReader();
            reader.onload = (e) => {
                this.instance = new ImageEditor(container, {
                    includeUI: {
                        loadImage: {
                            path: e.target.result,
                            name: 'EditedImage',
                        },
                        menu: ['crop', 'flip', 'rotate', 'draw', 'shape', 'icon', 'text', 'filter'],
                        initMenu: 'filter',
                        uiSize: {
                            width: '100%',
                            height: '600px',
                        },
                        menuBarPosition: 'bottom',
                    },
                    cssMaxWidth: 800,
                    cssMaxHeight: 600,
                    selectionStyle: {
                        cornerSize: 20,
                        rotatingPointOffset: 70,
                    }
                });

                this.modal.classList.remove('hidden');
            };
            reader.readAsDataURL(file);

            this.confirmButton.onclick = () => {
                const dataURL = this.instance.toDataURL();
                fetch(dataURL)
                    .then(res => res.blob())
                    .then(blob => {
                        const editedFile = new File([blob], 'edited-image.jpg', { type: blob.type });

                        const pond = FilePond.find(document.querySelector('input.filepond'));
                        if (pond) {
                            pond.removeFiles();
                            pond.addFile(editedFile);
                        }

                        resolve(blob);
                        this.close();
                    });
            };

            this.cancelButton.onclick = () => {
                reject('User canceled editing');
                this.close();
            };
        });
    },

    close() {
        if (this.instance) {
            this.instance.destroy();
            this.instance = null;
        }
        if (this.modal && this.modal.parentNode) {
            this.modal.parentNode.removeChild(this.modal);
            this.modal = null;
        }
    }
};

// Initialize FilePond
document.addEventListener('DOMContentLoaded', function () {
    FilePond.setOptions({
        instantUpload: false,
        storeAsFile: true,
        allowReplace: true,
        maxFileSize: '2MB',
        allowImagePreview: true,
        imagePreviewMaxHeight: 500,
        allowImageExifOrientation: true,
        allowFileTypeValidation: true,
        allowImageCrop: true,
        allowImageResize: true,
        allowImageTransform: true,
        allowImageFilter: true,
        allowImageEdit: true,
        allowRemove: true,
        imageEditEditor: {
            open: (file) => {
                console.log('Opening editor...');
                return toastEditor.open(file);
            },
            close: () => {
                console.log('Editor closed');
            }
        },
        server: {
            // process: '/uploads/process', // saves to public/tmp/ folder but no way to retrieve yet
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        },
        labelIdle: 'Arraste e largue ou <span class="filepond--label-action">Escolha</span>',
    });

    const inputs = document.querySelectorAll('input[type="file"].filepond');
    inputs.forEach(input => {
        FilePond.create(input);
    });
});

console.log('app.js loaded');

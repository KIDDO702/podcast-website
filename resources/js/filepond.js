import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImageResize from 'filepond-plugin-image-resize';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';

import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
// import 'filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css';

const inputElement = document.querySelector('#avatar');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Plugins
FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginFileValidateType,
    FilePondPluginImageCrop,
    FilePondPluginFileValidateSize);


FilePond.create(inputElement).setOptions({
    imagePreviewHeight: 170,
    imageCropAspectRatio: '1:1',
    imageResizeTargetWidth: 200,
    imageResizeTargetHeight: 200,
    allowFileSizeValidation: true,
    maxFileSize: '750kb',
    minFileSize: '15kb',
    labelMaxFileSizeExceeded: 'max file size 750kb',
    labelMinFileSize: 'min file size 50kb',
    server: {
        process: '/tmp-upload',
        revert: '/tmp-revert',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    },
    acceptedFileTypes: [
        'image/png', 'image/jpeg'
    ],
});

import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

const inputElement = document.querySelector('input[type="file"]');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Plugins
FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.create(inputElement).setOptions({
    server: '/upload',

    headers: {
        'X-CSRF-TOKEN': csrfToken,
    }
});

(function($) {
    'use strict';
    const addBtn = $('#media-add'),
        delBtn = $('#media-del'),
        previewImg = $('#media-preview'),
        mediaFrame = wp.media({
            title: 'Select or Upload Media',
            button: {
                text: 'Use this media'
            },
            multiple: false
        });
    $(document).on('click', '#media-add', (e) => {
        e.preventDefault();
        $('#status').addClass('d-none');
        $('#submit').text('Save');
        mediaFrame.on( 'select', () => {
            let attachment = mediaFrame.state().get('selection').first().toJSON();
            previewImg.attr('src', attachment.url)
                .removeClass('d-none');
            $('#media-id').val(attachment.id)
                .trigger('change');
            addBtn.addClass('d-none');
            delBtn.removeClass('d-none');
        });
        if (mediaFrame) {
            mediaFrame.open();
            return;
        }
        mediaFrame.open();
    });
    $(document).on('click', '#media-del', (e) => {
        e.preventDefault();
        $('#status').addClass('d-none');
        $('#submit').text('Save');
        previewImg.attr('src', '')
            .addClass('d-none');
        $('#media-id').val('')
            .trigger('change');
        addBtn.removeClass('d-none');
        delBtn.addClass('d-none');
    });
    $(document).on('focus', '.kbtcba-opts .form-control, .form-check-input', () => {
        $('#status').addClass('d-none');
        $('#submit').text('Save');
    });
}(jQuery));
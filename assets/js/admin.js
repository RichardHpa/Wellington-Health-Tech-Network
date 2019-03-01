$ = jQuery;
$(document).ready(function(){
    displayMetaBoxes();
    $("input[name='post_format']").change(function(){
        displayMetaBoxes();
    })

});

function displayMetaBoxes(){
    var selectedFormat = $("input[name='post_format']:checked").attr("id");
    var allFormats = formats.allFormats;
    for (var format in allFormats) {
        if(format === selectedFormat){
            $("#"+allFormats[format]).fadeIn();
        } else {
            // $("#"+allFormats[format]).find(".customInput").val("");
            $("#"+allFormats[format]).hide();
        }
    }

}

$(document).on('click','.removeButton', function(e){
    e.preventDefault();
    var button = $(this);
    var formGroup = $(this).parent('.form-group');
    formGroup.find('.hiddenCustomInput').val('');
    switch(button.data('type')){
        case 'audio':
            formGroup.addClass('noAudio').removeClass('validAudio');
        break;
        case 'image':
            formGroup.addClass('noImage').removeClass('validImage');
            formGroup.find('img').attr('src', '');
        break;
        case 'video':
            formGroup.addClass('noVideo').removeClass('validVideo');
        break;
    }
    button.hide();
})

$(document).on('click', '.customUpload', function(e){
    e.preventDefault();
    var button = $(this);
    var formGroup = $(this).parent('.form-group');
    var items_frame;

    if ( items_frame ) {
        items_frame.open();
        return;
    }

    switch(button.data('type')){
        case 'audio':
            items_frame = wp.media.frames.items = wp.media({
                title: 'Add to Gallery',
                button: {
                    text: 'Select or Upload Audio Clip'
                },
                library: {
                    type: [ 'audio' ]
                },
            });
            items_frame.open();
            items_frame.on( 'select', function() {
                var attachment = items_frame.state().get('selection').first().toJSON();
                if(attachment.type !== 'audio'){
                    formGroup.prepend('<p class="errors">Error: must be a audio clip</p>');
                } else {
                    formGroup.find('.hiddenCustomInput').val(attachment.id);
                    formGroup.find('source').attr('src', attachment.url);
                    var player = formGroup.find('audio');
                    player.get(0).pause();
                    player.get(0).load();
                    formGroup.removeClass('noAudio').addClass('validAudio');
                    formGroup.find('.removeButton').show();
                }
            });
        break;
        case 'image':
            items_frame = wp.media.frames.items = wp.media({
                title: 'Add to Gallery',
                button: {
                    text: 'Select or Upload a Image'
                },
                library: {
                    type: [ 'image' ]
                },
            });
            items_frame.open();
            items_frame.on( 'select', function() {
                var attachment = items_frame.state().get('selection').first().toJSON();
                if(attachment.type !== 'image'){
                    formGroup.prepend('<p class="errors">Error: must be a image</p>');
                } else {
                    formGroup.find('.hiddenCustomInput').val(attachment.id);
                    formGroup.find('img').attr('src', attachment.url);
                    formGroup.removeClass('noImage').addClass('validImage');
                    formGroup.find('.removeButton').show();
                }
            });
        break;
        case 'video':
        items_frame = wp.media.frames.items = wp.media({
            title: 'Add to Gallery',
            button: {
                text: 'Select or Upload a Video'
            },
            library: {
                type: [ 'video' ]
            },
        });
        items_frame.open();
        items_frame.on( 'select', function() {
            var attachment = items_frame.state().get('selection').first().toJSON();
            if(attachment.type !== 'video'){
                formGroup.prepend('<p class="errors">Error: must be a video</p>');
            } else {
                formGroup.find('.hiddenCustomInput').val(attachment.id);
                formGroup.find('source').attr('src', attachment.url);
                var player = formGroup.find('video');
                player.get(0).pause();
                player.get(0).load();
                formGroup.removeClass('noVideo').addClass('validVideo');
                formGroup.find('.removeButton').show();
            }
        });
        break;
    }
});

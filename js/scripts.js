$(document).ready(function() {

    // $('#video_ready_hang').click(function(){
    //     modal();
    // });

    $('.modal').live('click', function(){
        var theLink = $(this).attr('rel');
        var content = $('#'+theLink).html();
        modalWindow(content);
    });

    $('#overlay, #close').live('click', function(){
        $('#overlay, #modal').fadeOut(function(){
            $(this).remove();
        });
    });

    // function modal() {
    //     var mainWidth = $('body').outerWidth();
    //     $('body').append($('#holder').contents().hide().fadeIn().css('display', 'block'));
    //     centerModal();
    //     $('.close, .overlay').click(function(){ closeModal(); });
    // }

    // function closeModal() {
    //     $('.overlay, .modal').fadeOut(function(){ $('#holder').append(this); });
    // }

    // function centerModal() {
    //     var left = ($('.modal').outerWidth() / 2);
    //     var top = ($('.modal').outerHeight() / 2);
    //     $('.modal').css({'margin-top' : '-'+top+'px', 'margin-left' : '-'+left+'px'});
    // }

});

function modalWindow(content) {
    $('body').append($(
        '<div id="overlay"></div>' +
        '<div id="modal">' +
            '<a href="###" id="close"></a>' +
            '<div id="modal_content">' +
            content +
            '</div>' +
            '<div class="clear"></div>' +
        '</div>'
    ).hide().fadeIn().css('display', 'block'));

    var top = ($('#modal').outerHeight() / 2);
    var left = ($('#modal').outerWidth() / 2);
    
    $('#modal').css({'margin-top' : '-'+top+'px', 'margin-left' : '-'+left+'px'});
}
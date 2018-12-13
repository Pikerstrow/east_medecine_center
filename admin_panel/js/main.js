/*SIDEBAR DROPDOWN SUBMENU SWITCHER*/
$(document).ready(function () {
    $('ul.sidebar-menu').find('li.dropdown>a').click(function () {
        $(this).closest('.dropdown').find('a>i.fa-angle-right').toggleClass('down');
        $(this).siblings('ul.sidebar_submenu').slideToggle(200);
    });
});


/* HIDE / SHOW SIDEBAR */
$(document).ready(function () {
    var menuClicksCounter = 0;
    $('#hamburger_menu').click(function () {
        if ($(window).width() > 815) {
            if (menuClicksCounter == 0) {
                $('#sidebar-nav').css({'left': '-200px'});
                menuClicksCounter++;
            } else {
                $('#sidebar-nav').css({'left': '0px'});
                menuClicksCounter = 0;
            }
            /*$('#sidebar-nav').toggleClass('sidebar-hide');*/
            $('#main-content').find('div.content').toggleClass('content_full_width');
        } else {
            $('.sidebar-menu').slideToggle();
        }
    });
});



/*FOR APPLYNG BOOTSTRAP VALIDATION CLASSES TO FORMS*/
$(document).ready(function(){
    $('.error-span').each(function(){
        var input = $(this).closest('.form-group');
        input.addClass('has-error has-feedback');
        input.find('.input-group').append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
        input.find('#q-container').addClass('invalid-quill');
        input.find('.ck-editor').addClass('invalid-ck');
    });

    /*Remove bootstrap validation classes on focus and change*/
    $('.input-admin').on('focus', function() {
        var input = $(this).closest('.form-group');

        if ( input.hasClass('has-error') ) {
            input.removeClass('has-error has-success has-feedback');
            input.find('.glyphicon-remove, .glyphicon-ok').remove();
        }
    });
});


/*QUILL EDITOR REPLY MESSAGE*/
$(document).ready(function () {

    var quill = new Quill('#reply_text_editor', {
        modules: {
            toolbar: [
                [{header: [1, 2, 3]}],
                ['bold', 'italic', 'underline']
            ]
        },
        placeholder: '',
        theme: 'snow'
    });

    var form = $('#reply_message');
    $(form).submit(function () {
        $(form).find("input[name='reply_text']").val(quill.root.innerHTML);
    });
});


/*PAGINATION FOR TABLES*/
<!-- Pagination for table with products -->

$(document).ready(function () {
    $('.table-admin').after("<div id='table_nav'><button class='a-prev btn btn-primary btn-sm'><i class=\"fas fa-backward\"></i> </button> <button class='a-next btn btn-primary btn-sm'><i class=\"fas fa-forward\"></i> </button> <span class='pages-descr'>Сторінка <span class='page-num'> </span> із <span class='total_pages'> </span></span></div>");

    $('button.a-prev').prop('disabled', true);
    var rows_to_show = 7;
    var total_rows_quantity = $('.table-admin tbody').find('tr').length;
    var pages_quantity = Math.ceil(total_rows_quantity / rows_to_show);

    if (pages_quantity == 1) {
        $('button.a-next').prop('disabled', true);
    }

    $('.table-admin tbody').find('tr').hide();
    $('.table-admin tbody').find('tr').slice(0, rows_to_show).show();

    var current_page = 0;

    $('#table_nav .a-next').bind('click', function () {
        $('button.a-prev').prop('disabled', false);
        if (current_page < pages_quantity - 1) {
            current_page++;
        }
        if (current_page == pages_quantity - 1) {
            $(this).prop('disabled', true);
        }

        var start = current_page * rows_to_show;
        var end = start + rows_to_show;

        $('.table-admin tbody').find('tr').css('opacity', '0.0').hide().slice(start, end).css('display', 'table-row').animate({'opacity': 1}, 300);
        $('span.page-num').text(current_page + 1);
    });

    $('#table_nav .a-prev').bind('click', function () {
        $('button.a-next').prop('disabled', false);

        if (current_page > 0) {
            current_page--;
        }
        if (current_page == 0) {
            $(this).prop('disabled', true);
        }

        var start = current_page * rows_to_show;
        var end = start + rows_to_show;

        $('.table-admin tbody').find('tr').css('opacity', '0.0').hide().slice(start, end).css('display', 'table-row').animate({'opacity': 1}, 300);
        $('span.page-num').text(current_page + 1);
    });

    $('span.page-num').text(current_page + 1);
    $('span.total_pages').text(pages_quantity);

});

/*SETTING CHART HEIGHT ON INDEX PAGE*/
$(document).ready(function () {
    var height = ($('#add-buttons-admin').height())-25;
    $('#chart_div').css('height', height + "px");
});

/*SETTING CHART HEIGHT EMPTY SPACE ON INDEX PAGE*/
$(document).ready(function () {
    var height = ($('#add-buttons-admin').height())-25;
    $('.no-services').css('height', height + "px");
});


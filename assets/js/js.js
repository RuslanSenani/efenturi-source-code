/*---Browse by category js code---*/
$(document).ready(function () {
    $('.slider').slick({
        arrows: false,
        dots: false,
        slidesToShow: 6,
        infinite: true,
        autoplay: true,
        // initialSlide: 0,
        // waitForAnimate: false,
        // variableWidth: true,
        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 993,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 569,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
})
//
/*---Top Organizers js code*/
$(document).ready(function () {
    $('.slide-top-org').slick({
        arrows: false,
        dots: true,
        adaptiveHeight: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 1500,
        initialSlide: 0,
        variableWidth: true,
        waitForAnimate: true,
        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 993,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 569,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });
})

/*--- moadl js----*/
$(".videolink").modalVideo();
/*--- happening-nowslide js code----*/
$(function () {
    $('.happening-now-slider').slick({
        dots: false,
        adaptiveHeight: true,
        slidesToShow: 1,
    })
})

/*---js code organizer about us----*/
$(function () {
    $('.organizer-about-us').slick({
        arrows: false,
        dots: false,
        adaptiveHeight: false,
        slidesToShow: 1,
        infinite: true,
        waitForAnimate: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    })
})

/*--- partnersjs code----*/
$(document).ready(function () {
    $('.partners').slick({
        arrows: false,
        dots: false,
        slidesToShow: 5,
        infinite: true,
        initialSlide: 0,
        autoplay: true,
        autoplaySpeed: 1000,
        waitForAnimate: false,
        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 993,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 569,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });
})

$('.img-fluid').click(function () {
    alert("Bele Isler");
});

/*--- happening-nowslide js code----*/
$('.for-under-line').click(function () {
    $('.underline .active').removeClass("active");
    $(this).addClass("active");
    $('input[name=type]').val($(this).attr('data-type'));
});

$(function () {
    $('.for-chechbox label').click(function () {
        if ($(this).hasClass('check-active')) {
            // alert(1);
            $(this).find('input').prop('checked', false);
            $(this).removeClass('check-active');
        }
        else {
            $(this).find('input').prop('checked', true);
            $(this).addClass('check-active');
        }
        return false;
    })

    var divs = 1;
    $('.add-events-button .next').click(function () {
        if (divs < $('.for-all').length) {
            divs++;
        }

        show_divs(divs);
        return false;
    })
    $(".add-events-button .prev").click(function () {
        if (divs > 1) {
            divs--;
        }
        show_divs(divs);
        return false;
    })

    $('.for-numbers ul li').click(function () {
        divs = $(this).index() + 1;
        show_divs(divs);
    })
    function show_divs(index) {
        $('.for-all').hide();
        $("#b" + index).show();
        $(".for-numbers .active").removeClass('active');
        for (i = 0; i < index; i++) {
            $('.for-numbers li:eq(' + i + ')').addClass('active')
        }
    }
})
/*--- partnersjs code----*/
$(document).ready(function () {
    $('.event-profile-slider').slick({
        arrows: true,
        dots: false,
        slidesToShow: 3,
        infinite: true,
        initialSlide: 0,
        autoplay: false,
        autoplaySpeed: 1000,
        waitForAnimate: false,
        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 993,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 569,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
})


$(function () {

    function success_message(text) {
        console.log(text);
        $('body').append('<div class="alert-message"><div class="alert alert-info">' + text + ' <span class="fa fa-close"></span></div></div>');
        $(document).on('click', '.alert-message .fa-close', function () {
            $('.alert-message').remove();
        })
    }

    //  success_message('salam');

    function loading(com = true) {
        if (com == true) {
            $('body').append('<div class="loading"></div>');
        }
        else {
            $('body').find('.loading').remove();
        }
    }

    $('form:not([data-stop])').ajaxForm({

        beforeSend: function () {
            loading(true);
        },
        uploadProgress: function (h, o, t, faiz) {

        },
        complete: function (x) {
            loading(false);
            var result = x.responseText;
            console.log(result);
            var json = JSON.parse(result);
            if (json.success != undefined) {
                success_message(json.success);
            }
            else {
                $.each(json, function (i, item) {
                    $('[data-error=' + i + ']').html(item);
                });
            }

        }
    })

    // $('#search_form').ajaxForm({

    //     beforeSend: function () {

    //         loading(true);
    //     },
    //     uploadProgress: function (h, o, t, faiz) {

    //     },
    //     complete: function (x) {
    //         loading(false);
    //         var result = x.responseText;
    //       //  window.location = base_url + 'search/' + x.responseText;

    //     }
    // })

    ////////////////////////
    $(document).on('click', '[data-send-form]:not([disabled])', function () {
        $('form:not([data-stop])').submit();
    })

    var base_url = $('#base_url').val();

    $(document).on('change', '#country', function () {
        read_cityes($(this).val());
    })


    read_cityes($('#country').val());

    function read_cityes(country_id) {
        $.post(base_url + 'read-cityes', { 'country_id': country_id }, function (e) {
            $('#city').html(e);
        })
    }

    $(document).on('change', "#choosen", function () {

        var name = $('select[name=selected_num]').val();
        if (name != "0") {
            if (name == "event") {
                $('.jobs_container').hide();
                $('.media_container').hide();
                $('.event_container').show();
            }
            if (name == "jobs") {
                $('.jobs_container').show();
                $('.media_container').hide();
                $('.event_container').hide();
            }
            if (name == "media") {
                $('.jobs_container').hide();
                $('.media_container').show();
                $('.event_container').hide();
            }

        } else {
            $('.jobs_container').hide();
            $('.media_container').hide();
            $('.event_container').hide();
        }


    })

    $(document).ready(function () {
        $('.event_container').hide();
        $('.jobs_container').hide();
        $('.media_container').hide();
    })

    $('input[name=terms]').change(function () {
        if ($(this).prop('checked')) {
            $('#reg').prop('disabled', false);
        }
        else {
            $('#reg').prop('disabled', true);
        }
    })


    $('.search-filter select,.search-filter input').change(function () {
        search();
    })

    // $('.center-search input').change(function () {

    //     search();
    // });
    function search() {

        data = {
            'country_id': $('select[name=country_id]').val(),
            'status_id': $('select[name=status_id]').val(),
            'entry_id': $('select[name=entry_id]').val(),
            'time': $('input[name=time]').val(),
            'industry_id': $('select[name=industry_id]').val(),
            'type_id': $('select[name=type_id]').val(),
            'stream_id': $('select[name=stream_id]').val(),
            'date': $('input[name=date]').val(),
            'enddate': $('input[name=enddate]').val()


        };
        loading();
        $.ajax({
            url: base_url + 'search_results',
            type: 'get',
            // dataType:'json',
            data: data,
            success: function (e) {
                loading(false);
                $('#search_results').html(e);
            }
        })
    }

    if ($('#search_results').html() != undefined) {
        search();
    }

    // $(".form-group").on('click', '.isComment', function () {
    //     data = {
    //         'comment': $('textarea[name=comment]').val(),
    //         'event_id': $('input[name=event_id]').val(),
    //         'time': $('input[name=time]').val()
    //     }
    //     $.ajax({
    //         url: base_url + 'addcomment/comment',
    //         type: 'post',
    //         data: data,
    //         success: function (e) {
    //             $('#commentContent').append(e);
    //             $('textarea[name=comment]').val("");
    //         }
    //     })
    // })



    $(".attendee").on('click', '.btn', function () {
        data = {
            '0': $('input[name=attendee]').val(),
            'event_id': $('input[name=event_id]').val()
        }
        loading();
        $.ajax({
            url: base_url + 'send_request',
            type: 'post',
            data: data,
            success: function (e) {
                //success_message("Message Sended <script>setTimeout(function(){location.reload();},500)</script>");
                loading(false);
            }

        })
    })


    $(".participant_booth").on('click', '.btn', function () {
        data = {
            '0': $('input[name=participant_booth]').val(),

            'event_id': $('input[name=event_id]').val()
        }
        loading();
        $.ajax({
            url: base_url + 'send_request',
            type: 'post',
            data: data,
            success: function (e) {
                // success_message("Message Sended <script>setTimeout(function(){location.reload();},500)</script>");

                loading(false);
            }
        })
    })


    $(".speaker_pass").on('click', '.btn', function () {
        data = {
            '0': $('input[name=speaker_pass]').val(),

            'event_id': $('input[name=event_id]').val()
        }
        loading();
        $.ajax({
            url: base_url + 'send_request',
            type: 'post',
            data: data,
            success: function (e) {
                //success_message("Message Sended <script>setTimeout(function(){location.reload();},500)</script>");
                loading(false);
            }
        })
    })


    $(".sponsorship_partner").on('click', '.btn', function () {
        data = {
            '0': $('input[name=sponsorship_partner]').val(),

            'event_id': $('input[name=event_id]').val()
        }
        loading();
        $.ajax({
            url: base_url + 'send_request',
            type: 'post',
            data: data,
            success: function (e) {
                //success_message("Message Sended <script>setTimeout(function(){location.reload();},500)</script>");
                loading(false);
            }
        })
    })


    $(".media_partner").on('click', '.btn', function () {
        data = {
            '0': $('input[name=media_partner]').val(),

            'event_id': $('input[name=event_id]').val()
        }
        loading();
        $.ajax({
            url: base_url + 'send_request',
            type: 'post',
            data: data,
            success: function (e) {
                //success_message("Message Sended<script>setTimeout(function(){location.reload();},500)</script>");
                loading(false);
            }
        })
    })


    $(".entry_ticket").on('click', '.btn', function () {
        data = {
            '0': $('input[name=entry_ticket]').val(),

            'event_id': $('input[name=event_id]').val()
        }
        loading();
        $.ajax({
            url: base_url + 'send_request',
            type: 'post',
            data: data,
            success: function (e) {
                //success_message("Message Sended <script>setTimeout(function(){location.reload();},500)</script>");
                loading(false);
            }
        })
    })


    $(".word").froalaEditor({
        language: "tr",
        heightMin: 300,
        // Set the image upload parameter.
        toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'clearFormatting', 'insertTable', 'html', 'fontSize'],
    })

    // $('.job_search').on('click', '.btn', function () {
    //     data = {
    //         'job_graphic': $('select[name=job_graphic]').val()
    //     }
    //     loading();
    //     $.ajax({
    //         url: base_url + 'organizer_post',
    //         type: 'post',
    //         data: data,
    //         success: function (e) {
    //             loading(false);
    //         }
    //     })
    // })

})

$(function () {
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;

    var day = dtToday.getDate();

    var year = dtToday.getFullYear();

    if (month < 10) {
        month = '0' + month.toString();
    }
    if (day < 10) {
        day = '0' + day.toString();
    }
    var maxDate = year + '-' + month + '-' + day;
    $('#txtDate').attr('min', maxDate);
});
$(function () {
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10) {
        month = '0' + month.toString();
    }
    if (day < 10) {
        day = '0' + day.toString();
    }
    var maxDate = year + '-' + month + '-' + day;
    $('#txtDate1').attr('min', maxDate);
});
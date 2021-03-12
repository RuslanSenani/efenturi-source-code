$(function () {
    var controller = window.location.href.split("/")[5];
    var edit_link = controller.split("#");
    controller = edit_link[0];
    var base_url = $('#base_url').val() + 'admin/';
    //notification
    function show_noft(type, text) {
        var icon = '';
        switch (type) {
            case 'info':
                icon = 'info';
                break;
            case 'warning':
                icon = 'warning';
                break;
            case 'danger':
                icon = 'error';
                break;
            case 'success':
                icon = 'done_outline';
                break;
        };
        $.notify({
            icon: icon,
            message: text
        }, {
            type: type,
            timer: 1000,
            placement: {
                from: 'bottom',
                align: 'center'
            }
        });
    };
    var lang_id = 0;
    $('.header_lang_btn button').click(function () {
        lang_id = $(this).attr('id');
        $(this).parent().find('button').removeClass('btn-info').addClass('btn-primary');
        $(this).removeClass('btn-primary').addClass('btn-info');
        $('#' + controller).find('tr:not([data-lang=' + lang_id + '])').hide();
        $('#' + controller).find('tr[data-lang=' + lang_id + ']').show();
    })
    //image preview
    $(document).on('change', "input[type=file]", function (event) {
        $(this).parent().find('.custom-file-label').text($(this).val());
        var obj = $(this).parent().parent().parent().find('.form-image');
        var input = $(event.currentTarget);
        var files = input[0].files;
        var filedialog = $(this);
        for (var i = 0; i < files.length; i++) {
            file = files[i];
            var reader = new FileReader();
            reader.onload = function (e) {
                image_base64 = e.target.result;
                if (filedialog.attr('multiple') != undefined) {
                    obj.prepend('<img class="form-image-thumb" src="' + image_base64 + '"/>')
                } else {
                    obj.attr('src', image_base64);
                }
            };
            reader.readAsDataURL(file);
        }


    });
    //ajax not refresh form function
    var agent_button = true;
    $('form:not([data-stop])').ajaxForm({
        beforeSend: function () {
            $('#modal_progress').show().find('.progress-bar').removeAttr('style');
        },
        uploadProgress: function (h, o, t, faiz) {
            $('#modal_progress>.progress-bar').css('width', faiz + '%').html(faiz + ' %');
        },
        complete: function (x) {
            $(document).find('title').text('Correct Technology');
            if (x.responseText == 'ok') {
                show_noft('success', 'Yükləndi');
                read();
                if (agent_button == true) {
                    $('.modal').modal('hide');
                    reset_form();
                } else {
                    agent_button = true;
                }

            } else {
                show_noft('danger', x.responseText);
            }
            $('#modal_progress').hide();
        }
    });
    //ajax data read for content
    function ajax_read(url, data, obj) {
        $.ajax({
            type: 'post',
            url: base_url + url,
            dataType: 'json',
            data: data,
            success: function (e) {
                obj.html(e.content);
                if (lang_id != 0) {
                    obj.find('tr:not([data-lang=' + lang_id + '])').hide();
                }
                start_table();
                $('.page-loading').hide();
            }

        })
    };
    //ajax read data function for form
    function ajax_post(url, data, refresh = false) {
        $.ajax({
            type: 'post',
            url: base_url + url,
            dataType: 'json',
            data: {
                'id': data
            },
            success: function (e) {
                if (refresh == true) {
                    read();
                    show_noft('info', e.msg);
                } else {
                    //
                    write_form(e);
                    //
                }
            }
        })
    };

    //write form function
    function write_form(e) {
        var object = $('#' + controller + '_panel');
        object.find('input[name=ch_id]').val(e.id);


        switch (controller) {

            case 'types':
                var object2 = $('#' + controller + '_settings');
                object.find('input[name=title]').val(e.title);
                object2.find('select[name=l_id]').val(e.l_id);
                object2.find('input[name=share]').prop('checked', e.share);
                object2.find('input[name=home]').prop('checked', e.home);
                object2.find('select[name=num]').val(e.num);
                break;


            case 'streams':
                var object2 = $('#' + controller + '_settings');
                object.find('input[name=title]').val(e.title);
                object2.find('select[name=l_id]').val(e.l_id);
                object2.find('input[name=share]').prop('checked', e.share);
                object2.find('select[name=num]').val(e.num);
                break;

            case 'countries':
                var object2 = $('#' + controller + '_settings');
                object.find('input[name=title]').val(e.title);
                object2.find('select[name=l_id]').val(e.l_id);
                object.find('textarea[name=cityes]').val(e.cityes);
                object2.find('input[name=share]').prop('checked', e.share);
                object2.find('select[name=num]').val(e.num);
                break;

            case 'industry':
                var object2 = $('#' + controller + '_settings');
                object.find('input[name=title]').val(e.title);
                object2.find('select[name=l_id]').val(e.l_id);
                object2.find('input[name=share]').prop('checked', e.share);
                object2.find('select[name=num]').val(e.num);
                break;


            case 'users':
                var object2 = $('#' + controller + '_settings');
                object.find('input[name=firstname]').val(e.firstname);
                object.find('input[name=lastname]').val(e.lastname);
                object.find('input[name=email]').val(e.email);
                object.find('input[name=location]').val(e.location);
                object.find('input[name=company]').val(e.company);
                object2.find('select[name=status]').val(e.status);
                object2.find('select[name=num]').val(e.num);
                object.find('.form-image').attr('src', e.image);

                break;
            case 'products':
                var object2 = $('#' + controller + '_settings');
                object.find('input[name=title]').val(e.title);
                object.find('select[name=category_id]').val(e.category_id);
                object.find('input[name=url_tag]').val(e.url_tag);
                object.find('input[name=description]').val(e.description);
                object.find('input[name=brand]').val(e.brand);
                object.find('input[name=model]').val(e.model);
                object.find('input[name=price]').val(e.price);
                object.find('input[name=discount]').val(e.discount);
                object.find('select[name=status]').val(e.status);
                object.find('textarea[name=content]').val(e.content).froalaEditor('html.set', e.content);

                object.find('textarea[name=color]').val(e.color);
                object.find('textarea[name=size]').val(e.size);

                object2.find('select[name=l_id]').val(e.l_id);
                object2.find('input[name=share]').prop('checked', e.share);
                object2.find('input[name=home]').prop('checked', e.home);
                object2.find('select[name=num]').val(e.num);
                object.find('.form-image').html(e.image);
                break;

            case 'categories':
                var object2 = $('#' + controller + '_settings');
                object.find('input[name=title]').val(e.title);
                object.find('input[name=url_tag]').val(e.url_tag);
                object.find('input[name=description]').val(e.description);
                object.find('input[name=keywords]').val(e.keywords);
                object2.find('select[name=l_id]').val(e.l_id);
                object2.find('select[name=parent_id]').val(e.parent_id);
                object2.find('input[name=share]').prop('checked', e.share);
                object2.find('input[name=home]').prop('checked', e.home);
                object2.find('input[name=categorylist_share]').prop('checked', e.categorylist_share);
                object2.find('select[name=num]').val(e.num);
                object.find('#image').attr('src', e.image);
                console.log(e);
                break;

            case 'account':
                object.find('input[name=firstname]').val(e.firstname);
                object.find('input[name=lastname]').val(e.lastname);
                object.find('input[name=username]').val(e.username);
                object.find('input[name=phone]').val(e.phone);
                object.find('input[name=mail]').val(e.mail);
                object.find('input[name=address]').val(e.address);
                object.find('select[name=position]').val(e.position);
                break;

            case 'language':

                var object2 = $('#' + controller + '_settings');
                object.find('input[name=title]').val(e.title);
                object.find('input[name=url_tag]').val(e.url_tag);
                object2.find('select[name=num]').val(e.num);
                object2.find('input[name=share]').prop('checked', e.share);

                break;
            case 'pages':
                var object2 = $('#' + controller + '_settings');

                object.find('input[name=title]').val(e.title);
                object.find('input[name=page_title]').val(e.page_title);
                object.find('input[name=url_tag]').val(e.url_tag);
                object.find('textarea[name=content]').val(e.content).froalaEditor('html.set', e.content);
                object.find('input[name=description]').val(e.description);
                object.find('input[name=keywords]').val(e.keywords);
                object.find('select[name=include]').val(e.include);

                object2.find('select[name=l_id]').val(e.l_id);
                object2.find('select[name=parent_id]').val(e.parent_id);
                object2.find('select[name=num]').val(e.num);


                object2.find('input[name=share]').prop('checked', e.share);
                object2.find('input[name=footer]').prop('checked', e.footer);
                object2.find('input[name=header]').prop('checked', e.header);
                object2.find('input[name=seo_index]').prop('checked', e.seo_index);
                object.find('.form-image').attr('src', e.image);


                break;
            case 'sliders':
                var object2 = $('#' + controller + '_settings');
                object.find('textarea[name=description]').val(e.description);
                object.find('input[name=title]').val(e.title);
                object.find('input[name=btn_title]').val(e.btn_title);
                object.find('input[name=btn_link]').val(e.btn_link);
                object.find('.form-image').attr('src', e.image);
                object2.find('select[name=l_id]').val(e.l_id);
                object2.find('select[name=num]').val(e.num);
                object2.find('input[name=share]').prop('checked', e.share);

                break;
            case 'blogs':
                var object2 = $('#' + controller + '_settings');
                object.find('select[name=account_id]').val(e.account_id);
                object.find('input[name=title]').val(e.title);
                object.find('input[name=url_tag]').val(e.url_tag);
                object.find('textarea[name=content]').val(e.content).froalaEditor('html.set', e.content);
                object.find('input[name=description]').val(e.description);
                object.find('input[name=keywords]').val(e.keywords);
                object.find('.form-image').attr('src', e.image);

                object2.find('select[name=l_id]').val(e.l_id);
                object2.find('input[name=c_date]').val(e.c_date);
                object2.find('input[name=share]').prop('checked', e.share);
                break;
            case 'promo':
                var object2 = $('#' + controller + '_settings');
                object.find('select[name=type]').val(e.type);
                object.find('input[name=url_tag]').val(e.url_tag);

                object.find('.form-image').attr('src', e.image);

                object2.find('input[name=share]').prop('checked', e.share);
                break;
            case 'text':
                var object2 = $('#' + controller + '_settings');
                object.find('input[name=title]').val(e.title);
                object.find('textarea[name=text]').val(e.text);
                object2.find('input[name=share]').prop('checked', e.share);
                break;

            case 'partners':
                var object2 = $('#' + controller + '_settings');
                object.find('input[name=title]').val(e.title);
                object.find('.form-image').attr('src', e.image);
                object2.find('select[name=num]').val(e.num);
                object2.find('select[name=l_id]').val(e.l_id);
                object2.find('input[name=share]').prop('checked', e.share);

                break;

            case 'lang_settings':
                object.find('input[name=selector]').val(e.selector);
                for (var i = 0; i < object.find('.value').length; i++) {
                    object.find('.value:eq(' + i + ')').val(e.value[i]);
                    object.find('.lang:eq(' + i + ')').val(e.lang[i]);
                }
                break;
            case 'events':
                var json_data_object = eval("(" + e.send_request + ")");

                var object2 = $('#' + controller + '_settings');
                object.find('input[name=title]').val(e.title);
                object.find('select[name=user_id]').val(e.user_id);
                object.find('input[name=enddate]').val(e.enddate);
                object.find('input[name=endtime]').val(e.endtime);
                object.find('select[name=country_id]').val(e.country_id);
                read_cities(e.country_id, e.city_id);
                object.find('input[name=date]').val(e.date);
                object.find('input[name=time]').val(e.time);
                object.find('select[name=status_id]').val(e.status_id);
                object.find('select[name=type_id]').val(e.type_id);
                object.find('select[name=entry_id]').val(e.entry_id);
                object.find('select[name=stream_id]').val(e.stream_id);
                object.find('select[name=industry_id]').val(e.industry_id);
                object.find('input[name=mail]').val(e.mail);
                object.find('input[name=phone]').val(e.phone);
                object.find('input[name=website]').val(e.website);
                object.find('textarea[name=content]').val(e.content);
                object.find('input[name=facebook]').val(e.facebook);
                object.find('input[name=twitter]').val(e.twitter);
                object.find('input[name=linkedin]').val(e.linkedin);
                object.find('input[name=map]').val(e.map);
                object.find('input[name=video_link]').val(e.video_link);

                object2.find('select[name=num]').val(e.num);
                object2.find('input[name=share]').prop('checked', e.share);

                json_data_object.forEach(element => {
                    if (element == "attendee") {
                        document.getElementById('att1').setAttribute("class", "check-active");
                        object.find('input[id=sndrqst1]').prop('checked', e.send_request)
                    }
                    if (element == "participant_booth") {
                        document.getElementById('att2').setAttribute("class", "check-active");
                        object.find('input[id=sndrqst2]').prop('checked', e.send_request)
                    }
                    if (element == "speaker_pass") {
                        document.getElementById('att3').setAttribute("class", "check-active");
                        object.find('input[id=sndrqst3]').prop('checked', e.send_request)
                    }
                    if (element == "sponsorship_partner") {
                        document.getElementById('att4').setAttribute("class", "check-active");
                        object.find('input[id=sndrqst4]').prop('checked', e.send_request)
                    }
                    if (element == "media_partner") {
                        document.getElementById('att5').setAttribute("class", "check-active");
                        object.find('input[id=sndrqst5]').prop('checked', e.send_request)
                    }
                    if (element == "entry_ticket") {
                        document.getElementById('att6').setAttribute("class", "check-active");
                        object.find('input[id=sndrqst6]').prop('checked', e.send_request)
                    }
                });
                break;
            case 'jobs':
                var object2 = $('#' + controller + '_settings');
                object.find('select[name=country_id]').val(e.country_id);
                object.find('select[name=work_graphic]').val(e.work_graphic);
                object.find('select[name=user_id]').val(e.user_id);
                read_cities(e.country_id, e.city_id);
                object.find('select[name=organizer_email]').val(e.user_id);
                object.find('input[name=vacancy_name]').val(e.vacancy_name);
                object.find('textarea[name=content]').val(e.description).froalaEditor('html.set', e.description);

                object2.find('select[name=num]').val(e.num);
                object2.find('input[name=share]').prop('checked', e.share);

                break;

            case 'review':
                var object2 = $('#' + controller + '_settings');
                object.find('select[name=user_id]').val(e.user_id);
                object.find('input[name=video_link]').val(e.video_link);
                object.find('textarea[name=content]').val(e.review).froalaEditor('html.set', e.review);

                object2.find('select[name=num]').val(e.num);
                object2.find('input[name=share]').prop('checked', e.share);
                object.find('.form-image').attr('src', e.image);
                break;

        }

        convert_title();
        convert_description();

    }

    //form all element reset function

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
    function reset_form() {


        var object = $('#' + controller + '_panel');
        object.find('input:not([type=hidden])').val('');
        object.find('textarea').val('');
        object.find('select').val('');
        object.find('input[name=ch_id]').val(0);
        object.find('.form-image').removeAttr('src');
        object.find('.form-image').empty().removeAttr('src');
    }

    // $(document).on('change', 'select[data-modal=okay]', function () {
    //     if ($(this).val() === "image") {
    //         $(".image-upload-container").fadeIn();
    //         $(".video-url-container").hide();
    //     } else if ($(this).val() === "video") {
    //         $(".image-upload-container").hide();
    //         $(".video-url-container").fadeIn();
    //     }
    // });
    //modal save button
    $(document).on('click', 'button[data-modal=ok]', function () {

        var parent_id = $(this).attr('data-id');

        $('#' + parent_id).find('form').submit();
    });
    /* $(document).keyup(function(e){
        if(e.keyCode==192){
            agent_button=false;
            $('#'+controller+'_panel').find('form').submit();
        }
    }) */
    //page content read function 
    function read() {
        $('.page-loading').show();
        ajax_read(controller + '/read', {
            'id': 'true'
        }, $('#' + controller));
    }
    if (controller != 'dashboard' && controller != 'settings' && controller != 'account/profile') {
        read();
    }
    //delete function
    function del(id) {
        ajax_post(controller + '/delete', id, true);
    };
    //delete button
    var del_id = 0;
    $(document).on('click', '#' + controller + ' .btn-danger[id]', function () {
        del_id = $(this).attr('id');
        $('#delete_panel').modal('show');
    })
    //table check input array
    function check_input_array() {
        var ar = $('#' + controller + ' input[type=checkbox][id]:checked');
        var id_ar = Array(ar.length);
        for (var i = 0; i < ar.length; i++) {
            id_ar[i] = ar.eq(i).attr('id');
        }
        return id_ar;
    }
    //all delete button
    $(document).on('click', '#alldelete', function () {
        del_id = check_input_array();

        if (del_id.length > 0) {
            $('#delete_panel').modal('show');
        } else {
            show_noft('warning', 'Silmək istədiyiniz sətirləri seçin!');
        }
        return false;
    })
    //confirim delete
    $('#delete_panel .btn-danger').click(function () {
        $('.modal').modal('hide');
        del(del_id);
    })
    //edit button
    $(document).on('click', '#' + controller + ' .btn-warning[id]', function () {

        ajax_post(controller + '/read_row', $(this).attr('id'));
        $('#' + controller + '_panel').modal('show');
    })

    if (edit_link[1] != undefined && edit_link[1] != 0) {

        setTimeout(function () {
            ajax_post(controller + '/read_row', edit_link[1]);
            $('#' + controller + '_panel').modal('show');
        }, 500)
    }
    //copy button
    $(document).on('click', '#' + controller + ' .btn-info[id]', function () {
        ajax_post(controller + '/copy_row', $(this).attr('id'), true);
    })
    //all copy button
    $(document).on('click', '#allcopy', function () {
        var copy_id = check_input_array();
        if (copy_id.length > 0) {
            ajax_post(controller + '/copy_row', copy_id, true);
        } else {
            show_noft('warning', 'Kopyalamaq istədiyiniz sətirləri seçin!');
        }
    })
    //settings button
    $(document).on('click', '#' + controller + ' .btn-primary[id]', function () {

        ajax_post(controller + '/read_row', $(this).attr('id'));
        $('#' + controller + '_settings').modal('show').find('input[name=ch_id]').val($(this).attr('id'));

    })
    //info button
    $(document).on('click', '#' + controller + ' .btn-success[id]', function () {

        id = $(this).attr('id');
        ajax_read(controller + '/read_info', {
            'id': id
        }, $('#' + controller + '_info .modal-body'));
        $('#' + controller + '_info').modal('show');
    })
    //all settings button
    $(document).on('click', '#allsettings', function () {
        id_ar = check_input_array();
        if (id_ar.length > 0) {
            $('input[name=ch_id]').val(id_ar);
            $('#' + controller + '_settings').modal('show');
        } else {
            show_noft('warning', 'Tənzimləmək istədiyiniz sətirləri seçin!');
        }
    })
    //page title length
    $('input[name=title]').focusout(function () {
        if ($(this).val() != '' && $('input[name=url_tag]').attr('name') != undefined) {
            $.post(base_url + 'url', {
                'title': $(this).val()
            }, function (e) {
                $('input[name=url_tag]').val(e);
            })
        }
    })

    function start_table() {
        $('.card-body .table').DataTable();
    }

    //seo title convert 
    var text_length;
    var text_obj;




    function convert_title() {
        text_obj = $('input[name][data-title]');
        if (text_obj.val() != undefined) {
            text_length = text_obj.val().length;
            if (text_length == 0) {
                $('#page_title').hide();
            } else if (text_length <= 63) {
                $('#page_title').show().text(text_length);
            } else {
                $('#page_title').show().html('<u style="color:red">' + text_length + '<u>');
            }
        }
    }
    convert_title();

    //seo description
    function convert_description() {
        text_obj = $('input[name][data-description]');
        if (text_obj.val() != undefined) {
            text_length = text_obj.val().length;
            if (text_length == 0) {
                $('#page_description').hide();
            } else if (text_length <= 160) {
                $('#page_description').show().text(text_length);
            } else {
                $('#page_description').show().html('<u style="color:red">' + text_length + '<u>');
            }
        }
    }
    convert_description();


    $(document).on('change', 'input[name][data-title]', function () {
        convert_title();
    })
    $(document).on('change', 'input[name][data-description]', function () {
        convert_description();
    })

    //message detele functions
    $(document).on('click', '.message-btn[id]', function () {
        ajax_post('account/delete_message', $(this).attr('id'), true);
        show_noft('danger', 'Mesaj silindi!');
        $(this).parent().parent().remove();
    })

    /*table all check functions */
    $(document).on('change', '.table input', function () {
        $(this).parent().parent().parent().toggleClass('number-active');
    })
    $(document).on('change', '#all_check', function () {
        var com = $(this).prop('checked');
        for (var i = 0; i < $('.table input[id]').length; i++) {
            $('.table input[id]:eq(' + i + ')').prop('checked', com).parent().parent().parent().toggleClass('number-active');
        }
    })


    /*yeni funksyalar */
    $(document).on('change', '.form-image-thumb select[id]', function () {
        $.post(base_url + 'products/image_num', {
            'image_id': $(this).attr('id'),
            'val': $(this).val()
        }, function (e) {
            show_noft('success', e)
        });
    })

    $(document).on('click', '.form-image span[id]', function () {
        ajax_post(controller + '/delete_image', $(this).attr('id'));
        $(this).parent().remove();
    })




    $('#job_user_id').change(function () {
        read_jobs_users($(this).val());
    })


    function read_jobs_users(user_id, index = 0) {
        $.post(base_url + controller + '/read_events', { 'user_id': user_id }, function (e) {
            $('#job_event_id').html(e);
            $('#job_event_id').val(index);
        })
    }

    $('#country').change(function () {

        read_cities($(this).val());
    })


    function read_cities(country_id, index = 0) {
        $.post(base_url + controller + '/read_events', { 'country_id': country_id }, function (e) {
            $('#city').html(e);
            $('#city').val(index);
        })
    }
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
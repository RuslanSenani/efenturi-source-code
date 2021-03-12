<!----------- add event start --------->
<section>
    <div class="container m-auto">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
            <div class="form-one">
                <div class="city_country">
                    <div class="form-group">
                        <label><?= $string['choosen']; ?>
                            *</label>
                        <select name="selected_num" id="choosen">
                            <option value="0">--secin--</option>
                            <option value="event"><?= $string['event']; ?></option>
                            <option value="jobs"><?= $string['organizer_job_button']; ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="jobs_container">
            <div class="col-lg-10 col-md-12 col-sm-12 col-12 m-auto">
                <form action="<?= get_base_url('addevent/savejobs'); ?>" method='POST'>
                    <div class="form-group">
                        <label><?= $string['job_title']; ?>
                            *</label>
                        <textarea class="word" name="contentjob"></textarea>
                        <div data-error="contentjob"></div>
                        <br>
                        <button class="btn btn-info col-md-12"><?= $string['send_button']; ?> </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="event_container">

            <div class='for-numbers'>
                <ul>
                    <li class='active'>
                        <span>1</span>
                    </li>
                    <li>
                        <span>2</span>
                    </li>
                    <li>
                        <span>3</span>
                    </li>
                    <li>
                        <span>4</span>
                    </li>

                </ul>
            </div>

            <div class="col-lg-10 col-md-12 col-sm-12 col-12 m-auto">
                <form action="<?= get_base_url('addevent/save'); ?>" method='POST'>

                    <div class="form-one for-all" id="b1">
                        <div class="city_country">
                            <div class="form-group">
                                <label><?= $string['country_title']; ?>
                                    *</label>
                                <select name="country_id" id="country">
                                    <?php foreach ($this->home_model->countries() as $country) : ?>
                                        <option value="<?= $country['country_id']; ?>"><?= $country['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div data-error="country_id"></div>
                            </div>
                            <div class="form-group">


                                <label><?= $string['city_title']; ?>
                                    *</label>
                                <select name="city_id" id="city">
                                    <option></option>
                                </select>
                                <div data-error="city_id"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= $string['event_title']; ?>
                                *</label>
                            <input type="text" name='title'>
                            <div data-error="title"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $string['date_title']; ?>
                                *</label>
                            <input type="date" id="txtDate" name="date">
                            <div data-error="date"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $string['oclock_title']; ?>
                                *</label>
                            <input type="time" name="time">
                            <div data-error="time"></div>
                        </div>
                        <!-- ///////////////////////////////////////////////////////////////////////////////// -->
                        <div class="form-group">
                            <label><?= $string['enddate_title']; ?>
                                *</label>
                            <input id="txtDate1" type="date" name="enddate">
                            <div data-error="enddate"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $string['endoclock_title']; ?>
                                *</label>
                            <input type="time" name="endtime">
                            <div data-error="endtime"></div>
                        </div>
                    </div>

                    <div class="form-two for-all" id="b2">
                        <div class="event-status-type">
                            <div class="form-group">
                                <label><?= $string['status_title']; ?>
                                    *</label>
                                <select name="status_id">
                                    <option value="active"><?= $string['status_option_1']; ?></option>
                                    <option value="cancelled"><?= $string['status_option_2']; ?> </option>
                                    <option value="postponed"><?= $string['status_option_3']; ?></option>
                                </select>
                                <div data-error="status_id"></div>
                            </div>
                            <div class="form-group">
                                <label><?= $string['type_title']; ?>
                                    *</label>
                                <select name="type_id">
                                    <?php foreach ($this->home_model->types() as $row) : ?>
                                        <option value="<?= $row['type_id']; ?>"><?= $row['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div data-error="event-type"></div>
                            </div>
                        </div>
                        <div class="event-status-type">
                            <div class="form-group">
                                <label><?= $string['entry_title']; ?>
                                    *</label>
                                <select name="entry_id">
                                    <option value="free"><?= $string['entry_option_1']; ?></option>
                                    <option value="paid"><?= $string['entry_option_2']; ?></option>
                                </select>
                                <div data-error="status"></div>
                            </div>

                            <div class="form-group">
                                <label><?= $string['stream_title']; ?>
                                    *</label>
                                <select name="stream_id">
                                    <?php foreach ($this->home_model->streams() as $row) : ?>
                                        <option value="<?= $row['stream_id']; ?>"><?= $row['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div data-error="stream_id"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= $string['industry_title']; ?></label>
                            <select name="industry_id">
                                <?php foreach ($this->home_model->industry() as $row) : ?>
                                    <option value="<?= $row['industry_id']; ?>"><?= $row['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div data-error="industry"></div>
                        </div>
                    </div>

                    <div class="form-three for-all" id="b3">
                        <div class="email-tel">
                            <div class="form-group">
                                <label for=""><?= $string['email_title']; ?>
                                    *</label>
                                <input type="email" name="mail" />
                                <div data-error="mail"></div>
                            </div>
                            <div class="form-group">
                                <label><?= $string['phone_title']; ?>
                                    *</label>
                                <input type="tel" name="phone" />
                                <div data-error="phone"></div>
                            </div>
                        </div>


                        <div class="website-logo">
                            <div class="form-group">
                                <label><?= $string['website_title']; ?>
                                    *</label>
                                <input type='url' name='website' />
                                <div data-error="website"></div>
                            </div>
                            <div class="form-group">
                                <label><?= $string['img_title']; ?>
                                    *</label>
                                <input type='file' name='image[]' />
                                <div data-error="image"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label><?= $string['content_title']; ?>
                                *</label>


                            <textarea class="word" name="content"></textarea>

                            <div data-error="content"></div>
                        </div>
                    </div>

                    <div class="form-four for-all" id="b4">
                        <div class="form-group">
                            <label><?= $string['facebook_title']; ?></label>
                            <input type="url" name="facebook">
                            <div data-error="facebook"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $string['twitter-title']; ?></label>
                            <input type="url" name="twitter">
                            <div data-error="twitter"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $string['linkedin_title']; ?></label>
                            <input type="url" name="linkedin">
                            <div data-error="linkedin"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $string['map_title']; ?>
                                *</label>
                            <input type="url" name="map">
                            <div data-error="map"></div>
                        </div>
                        <div class="form-group">
                            <label><?= $string['event_video_title']; ?>
                                *</label>
                            <input type="url" name="video_link">
                            <div data-error='video_link'></div>
                        </div>

                    </div>
                    <div class="from-group for-chechbox">
                        <div>
                            <label>
                                <input type="checkbox" name="send_request[]" value="attendee" />
                                <img src="<?= get_img('1.png'); ?>">
                                <span><?= $string['send_request_1']; ?></span>
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" name="send_request[]" value="participant_booth" />
                                <img src="<?= get_img('2.png'); ?>">
                                <span><?= $string['send_request_2']; ?></span>
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" name="send_request[]" value="speaker_pass" />
                                <img src="<?= get_img('3.png'); ?>">
                                <span><?= $string['send_request_3']; ?></span>
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" name="send_request[]" value="sponsorship_partner">
                                <img src="<?= get_img('4.png'); ?>">
                                <span><?= $string['send_request_4']; ?></span>
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" name="send_request[]" value="media_partner">
                                <img src="<?= get_img('5.png'); ?>">
                                <span><?= $string['send_request_5']; ?></span>
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" name="send_request[]" value="entry_ticket">
                                <img src="<?= get_img('6.png'); ?>">
                                <span><?= $string['send_request_6']; ?></span>
                            </label>
                        </div>
                    </div>
            </div>
            <!---prev_button,send_button,next_button ---->
            <div class="row add-events-button">

                <button class="btn btn-info prev"><?= $string['prev_button']; ?>
                    <i class="fas fa-angle-left"></i>
                </button>
                <button class="btn btn-info"><?= $string['send_button']; ?> </button>
                <button class="btn btn-info next"><?= $string['next_button']; ?>
                    <i class="fas fa-angle-right"></i>
                </button>
            </div>
            </form>
        </div>

    </section>
    <!----------- add event end ----------->
<!-----event-profile-section-start----->
<?php $results = $this->front_database_model->front_read('events', array('id!=' => 0, 'share' => 'true', 'user_id!=' => 0), array('id', 'desc'), 7); ?>
<section>

    <div class="col-lg-12 event-hd-section">

        <div class="container-fluid evnt-profil-hd-part">

            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-12  to-logo">
                    <img src="<?= get_image($this->home_model->get_event_images($content['event_id'])[0]['image']); ?>" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12  pr-0  event-for-healthcare">
                    <div class="calendar">
                        <p>
                            <span><?= $content['title']; ?></span>
                        </p>
                    </div>
                    <div class="calendar">
                        <p>

                            <span><?= $content['date']; ?></span><br>
                            <span><?= $content['enddate']; ?></span>
                        </p>
                    </div>
                    <div class="btns">
                        <a href="<?= get_base_url('search/' . $this->home_model->get_stream($content['stream_id'])['stream_id']); ?>" class="btn"><?= $this->home_model->get_stream($content['stream_id'])['title']; ?></a>
                        <a href="<?= get_base_url('search/' . $this->home_model->get_industry($content['industry_id'])['industry_id']); ?>" class="btn"><?= $this->home_model->get_industry($content['industry_id'])['title']; ?></a>
                        <a href="<?= get_base_url('search/' . $this->home_model->get_type($content['type_id'])['type_id']); ?>" class="btn"><?= $this->home_model->get_type($content['type_id'])['title']; ?></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12  social-information">
                    <div class="for-border">
                        <div>
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?= $this->home_model->get_country($content['country_id'])['title']; ?> ,
                                <?= $this->home_model->get_city($content['city_id'])['title']; ?>
                            </span>
                        </div>
                        <div>
                            <i class="fas fa-phone-alt"></i>
                            <span><?= $content['phone']; ?> </span>
                        </div>
                        <div>
                            <i class="fas fa-globe"></i>
                            <a href="mailto:[email protected]?subject=<?= $content['mail']; ?>"><?= $content['mail']; ?> </a>
                        </div>
                        <div class="text-center">
                            <ul>

                                <!-- instagram -->
                                <!-- <li>
                                    <a href="">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li> -->

                                <?php if ($content['linkedin'] != null) : ?>
                                    <!-- linkedin -->
                                    <li>
                                        <a href="<?= $content['linkedin'] ?>">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <!-- twitter -->
                                <?php if ($content['twitter'] != null) : ?>
                                    <li>
                                        <a href="<?= $content['twitter'] ?>">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>


                                <!-- youtube -->
                                <?php if ($content['video_link'] != null) : ?>
                                    <li>
                                        <a href="">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <!-- facebook -->
                                <?php if ($content['facebook'] != null) : ?>
                                    <li>
                                        <a href="<?= $content['facebook'] ?>">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <!-- google -->
                                <!-- <li>
                                    <a href="">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                </li> -->


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!------event-profile-slide-start------>



<section>
    <div class="container-fluid p-0">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 p-0">
            <div class="all-section-border">
                <div class="row event-profile-footer">

                    <div class="col-lg-8 col-md-12 col-sm-12 col-12 event-profile-footer-left">
                        <div class="p-0 first-section">
                            <div>
                            </div>
                            <div>
                                <div>
                                    <h3>
                                        <span><?php echo $content['title']; ?> :</span>
                                    </h3>
                                    <p>
                                        <span>
                                            <?php echo $content['content']; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php $rslt = json_decode($content['send_request']); ?>
                        <?php if ($rslt != null) : ?>
                            <div class="third-section">
                                <div class="third-section-inner-bg">
                                    <div class="col-lg-12 col-sm-12 col-xs-12 col-12 col-md-12 ask-for">
                                        <h3>
                                            <span><?= $string['ask_for']; ?></span>
                                        </h3>
                                    </div>

                                    <div class="all-div">
                                        <?php foreach ($rslt as $rt) : ?>
                                            <?php if ($rt == 'attendee') : ?>
                                                <div class="attence for-all-part-divs">
                                                    <div>
                                                        <label>
                                                            <img src="<?= get_img('1.png'); ?>">
                                                            <span><?= $string['send_request_1']; ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="send-request attendee">
                                                        <input type="hidden" name="attendee" value="<?= $rt; ?>">

                                                        <input type="hidden" name="event_id" value="<?= $content['event_id']; ?>">
                                                        <a class="btn"><?= $string['send_request_button']; ?></a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($rt == 'participant_booth') : ?>
                                                <div class="attence for-all-part-divs">
                                                    <div>
                                                        <label>
                                                            <img src="<?= get_img('2.png'); ?>">
                                                            <span><?= $string['send_request_2']; ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="send-request participant_booth">
                                                        <input type="hidden" name="participant_booth" value="<?= $rt; ?>">

                                                        <input type="hidden" name="event_id" value="<?= $content['event_id']; ?>">
                                                        <a class="btn"><?= $string['send_request_button']; ?></a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($rt == 'speaker_pass') : ?>
                                                <div class="attence for-all-part-divs">
                                                    <div>
                                                        <label>
                                                            <img src="<?= get_img('3.png'); ?>">
                                                            <span><?= $string['send_request_3']; ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="send-request speaker_pass">
                                                        <input type="hidden" name="speaker_pass" value="<?= $rt; ?>">

                                                        <input type="hidden" name="event_id" value="<?= $content['event_id']; ?>">
                                                        <a class="btn"><?= $string['send_request_button']; ?></a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($rt == 'sponsorship_partner') : ?>
                                                <div class="attence for-all-part-divs">
                                                    <div>
                                                        <label>
                                                            <img src="<?= get_img('4.png'); ?>">
                                                            <span><?= $string['send_request_4']; ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="send-request sponsorship_partner">
                                                        <input type="hidden" name="sponsorship_partner" value="<?= $rt; ?>">

                                                        <input type="hidden" name="event_id" value="<?= $content['event_id']; ?>">
                                                        <a class="btn"><?= $string['send_request_button']; ?></a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($rt == 'media_partner') : ?>
                                                <div class="attence for-all-part-divs">
                                                    <div>
                                                        <label>
                                                            <img src="<?= get_img('5.png'); ?>">
                                                            <span><?= $string['send_request_5']; ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="send-request media_partner">
                                                        <input type="hidden" name="media_partner" value="<?= $rt; ?>">

                                                        <input type="hidden" name="event_id" value="<?= $content['event_id']; ?>">
                                                        <a class="btn"><?= $string['send_request_button']; ?></a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($rt == 'entry_ticket') : ?>
                                                <div class="attence for-all-part-divs">
                                                    <div>
                                                        <label>
                                                            <img src="<?= get_img('6.png'); ?>">
                                                            <span><?= $string['send_request_6']; ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="send-request entry_ticket">
                                                        <input type="hidden" name="entry_ticket" value="<?= $rt; ?>">

                                                        <input type="hidden" name="event_id" value="<?= $content['event_id']; ?>">
                                                        <a class="btn"><?= $string['send_request_button']; ?></a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>

                                </div>

                            </div>
                        <?php endif; ?>
                        <?php
                        $rslt = $this->front_database_model->front_read('comments', array('event_id=' => $content['event_id']), array('id', 'asc'));
                        ?>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12 event-profile-footer-right">

                        <div class="event-footer-right-border">
                            <div class="event-profile-slider-item">
                                <img src="<?= get_image($this->home_model->get_event_images($content['event_id'])[0]['image']); ?>" alt="">
                            </div>
                        </div>

                        <div class="event-footer-right-border">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 right-title">
                                <h3>
                                    <span><?= $string['event_item_title']; ?></span>
                                </h3>
                            </div>

                            <?php foreach ($results as $result) : ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 right-body">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-12 col-xs-12 body-left">
                                            <div class="body-relative-img">

                                                <img src="<?= get_image($this->home_model->get_event_images($result['event_id'])[0]['image']); ?>" alt="" class="img-fluid">
                                                <!-- <div class="body-right-absolute-img">
                                                    <img src="" alt="" class="img-fluid">
                                                </div> -->

                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 col-12  body-right">
                                            <div>
                                                <h5>
                                                    <a href="<?= get_base_url($result['url_tag']); ?>">
                                                        <u>
                                                            <?= $result['title']; ?>
                                                        </u>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div>
                                                <div>

                                                </div>
                                                <div>
                                                    <?= $this->home_model->get_country($result['country_id'])['title']; ?>,
                                                    <?= $this->home_model->get_city($result['city_id'])['title']; ?>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <div class="data">
                                                        <span><?= $content['date']; ?></span><br>
                                                        <span><?= $content['enddate']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </div>
                                                <div>
                                                    <div><?= $this->home_model->get_country($result['country_id'])['title']; ?>,</div>
                                                    <div> <?= $this->home_model->get_city($result['city_id'])['title']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="right-body-see-all">
                                <a href="<?= get_base_url('search'); ?>"><?= $string['see_all_button'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-----event-profile-slide-end--------->
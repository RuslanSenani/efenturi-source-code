<!-- Review -->

<section>
    <div class="container p-0">
        <div class="organizer-about-us">
            <?php $cntnt = $this->front_database_model->front_read("review"); ?>
            <?php foreach ($cntnt as $part) : ?>
                <div class="row oragnizer-talking-about-us">


                    <div class="col-lg-6 col-md-12 col-sm-12 col-12  organizer-talking-left">
                        <div class="for-play">
                            <img src="<?= get_image($part['image_url']); ?>" alt="">
                            <div class="for-play-icon">
                                <a href="#videostory" class="videolink" data-video-id="<?= $part['video_link']; ?>">
                                    <i class="fa fa-play">&nbsp;</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 organizer-talking-right">
                        <div class="main">
                            <h3>
                                <span><?= $string['organizer_talking_about_us']; ?></span>
                            </h3>
                        </div>
                        <div class="client">
                            <div class="client-said">
                                <span>
                                    <?= $part['review']; ?>
                                </span>
                            </div>
                            <div class="client-name">
                                <div class="client-img"></div>
                                <div class="user-name">
                                    <h4>
                                        <span>
                                            <?php
                                            $name = $this->home_model->get_user_info($part['user_id']);
                                            echo $name['firstname'];
                                            ?>
                                        </span>
                                    </h4>
                                    <p>
                                        <span><?php echo $name['lastname']; ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
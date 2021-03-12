<section>
    <div class="container p-0">
        <div class="row">

            <?php if (count($content['results']) > 0) : ?>
                <?php foreach ($content['results'] as $result) : ?>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 col-12 card-one for-organizers-file">
                        <div class="card-header">
                            <img src="<?= get_image($this->home_model->get_event_images($result['event_id'])[0]['image']); ?>" alt="">
                            <div class="overlay"></div>
                            <div class="under-logo-img">
                                <img src="<?= get_image($this->home_model->get_user_info($result['user_id'])['image']); ?>" alt="">
                            </div>
                            <div class="row">
                                <div class="under-img-ask col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div><?= $string['ask']; ?></div>
                                    <div><?= count($this->front_database_model->front_read("log", array('event_id' => $result['event_id']))); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 body-title text-left">
                                <h3>
                                    <a href="<?= get_base_url($result['url_tag']); ?>"><?= $result['title']; ?></a>
                                </h3>
                            </div>
                            <div class=" for-padding">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 body-info">
                                    <div class="row">
                                        <div class="col-md-10 col-sm-10 col-10 category">
                                            <div class="top">
                                                <p>
                                                    <span><?= $this->home_model->get_stream($result['stream_id'])['title']; ?></span>
                                                    <span></span>
                                                    <span><?= $this->home_model->get_type($result['type_id'])['title']; ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 body-info-right">
                                    <div>
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>
                                            <?= $this->home_model->get_country($result['country_id'])['title']; ?>,
                                            <?= $this->home_model->get_city($result['city_id'])['title']; ?>,
                                        </span>
                                    </div>
                                    <div class="data">
                                        <span> <?= get_date($result['date'], $string['month_name']); ?>/</span>
                                        <span> <?= get_date($result['enddate'], $string['month_name']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="alert alert-warning">
                    <?= $string['results_not_found']; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
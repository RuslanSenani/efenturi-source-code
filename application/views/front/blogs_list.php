<!----------Media-section-start------->
<?php $blogs = $this->home_model->blogs_list(900000); ?>
<!---------media-search-header-start------->
<section>
    <div class="col-lg-12 job-search-hd-bg">
        <div class="container">
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="header-center-part">
                    <div class="header-center-under-word">
                        <h1>
                            <span>
                                <?= $string['media']; ?></span>
                        </h1>
                        <p>
                            <span>
                                <?= $string['search_description']; ?></span>
                        </p>
                    </div>
                    <form data-stop method="POST" action="<?= get_base_url('blogs'); ?>">
                        <div class=search-input row>
                            <div class="">
                                <input type="text" name="media" placeholder="<?= $string['search_button']; ?>">
                            </div>

                            <div class="">
                                <button type="submit" class="btn btn-info">
                                    <?= $string['search_button']; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!---------media-search-header-end--------->
<section>
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 text-center media-center">
            <h2>
                <span><?= $string['media']; ?></span>
            </h2>
        </div>
        <div class="row media-card ">


            <?php if (!empty($content)) { ?>
                <?php if (count($content['search_results']) > 0) { ?>
                    <?php foreach ($content['search_results'] as $part) : ?>

                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 col-12 ">
                            <div class="media-card-item">
                                <a href="<?= get_base_url($part['url_tag']); ?>" class="for-media-img">
                                    <div class="media-img">
                                        <img src="<?= get_image($part['image']); ?>" alt="">
                                        <div class=under-img-word>
                                            <div class="by-client">
                                                <div><?= $part['title']; ?></div>
                                                <div><?= get_date($part['c_date'], $string['month_name']); ?></div>
                                            </div>
                                            <div>
                                                <?= $part['description']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-9 job-search-main-left">
                        <div class="alert alert-warning">
                            <?= $string['results_not_found']; ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <?php if (count($blogs) > 0) { ?>
                    <?php foreach ($blogs as $part) : ?>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 col-12 ">
                            <div class="media-card-item">
                                <a href="<?= get_base_url($part['url_tag']); ?>" class="for-media-img">
                                    <div class="media-img">
                                        <img src="<?= get_image($part['image']); ?>" alt="">
                                        <div class=under-img-word>
                                            <div class="by-client">
                                                <div><?= $part['title']; ?></div>
                                                <div><?= get_date($part['c_date'], $string['month_name']); ?></div>
                                            </div>
                                            <div>
                                                <?= $part['description']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-9 job-search-main-left">
                        <div class="alert alert-warning">
                            <?= $string['results_not_found']; ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</section>
<!----------Media-section-end--------->
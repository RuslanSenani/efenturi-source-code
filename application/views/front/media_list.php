<!----------Media-section-start------->
<section>
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 text-center media-center">
            <h2>
                <span><?= $string['media']; ?></span>
            </h2>
        </div>
        <div class="row media-card ">

            <?php foreach ($content_2['blogs_list'] as $part) : ?>
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 col-12">
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
            <?php if (count($this->home_model->blogs_list()) > 8) { ?>
                <div class="view-more text-center">
                    <a style="margin:auto;" href="<?= get_base_url('blogs'); ?>" class="btn"><?= $string['view_more_button']; ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!----------Media-section-end--------->
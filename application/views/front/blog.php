<?php
$users = $this->home_model->get_account_info($content['account_id']);
$ads = $this->front_database_model->front_read("promo", array("type" => 'reklam_3'));
?>

<section>
    <div class="container-fluid media-page-header">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 all-header">
            <div class="row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-3 media-page-left">
                    <div>
                        <h2>

                        </h2>
                    </div>
                    <div>
                        <img>
                    </div>
                    <div>
                        <p><span><?= $users['firstname']; ?> <?= $users['lastname']; ?></span></p>
                        <p><?= get_date($content['c_date'], $string['month_name']); ?></p>
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-9  media-page-right" style="background-image: url(<?= get_image($content['image']); ?>);">
                    <div class="my-everlay"></div>
                    <div class="media-header-under-word">
                        <div>
                            <div>

                            </div>
                        </div>
                        <div>
                            <h1>
                                <span><?= $content['title']; ?></span>
                            </h1>
                        </div>
                        <div>
                            <p>
                                <span><?= $content['description']; ?></span>
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Reklam Bolmesi Bu Hisse  Dinamik Deyil -->
<!-- hellooo bakuu-->
<section>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-9 media-content-part">
                <div class="fr-view">
                    <?= $content['content']; ?>
                </div>
            </div>
            <div class="col-12 colxs-12 col-sm-12 col-md-6 col-lg-3">
                <?php foreach ($ads as $ad) { ?>
                    <div class="medi-page-right-card for-reklams">
                        <a target="_blank" href="<?= $ad['url_tag']; ?>" class="for-media-page-img">
                            <img src="<?= get_image($ad['image']); ?>" alt="">
                        </a>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!---------job-search-header-start------->
<?php
$ads = $this->front_database_model->front_read("promo", array("type" => 'reklam_1'));
$textandtitle = $this->front_database_model->front_read("text", array("share" => 'true'));
$say = count($textandtitle);
?>
<section>
    <div class="col-lg-12 job-search-hd-bg">
        <div class="container">
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="header-center-part">
                    <div class="header-center-under-word">
                        <h1>
                            <span>
                                <?= $string['organizer']; ?></span>
                        </h1>
                        <p>
                            <span>
                                <?= $string['search_description']; ?></span>
                        </p>
                    </div>
                    <form data-stop method="POST" action="<?= get_base_url('search-organizer'); ?>">
                        <div class=search-input row>
                            <div class="">
                                <input type="text" name="organizer" placeholder="<?= $string['search_button']; ?>">
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
<!---------job-search-header-end--------->
<section>
    <div class="container">
        <div class="text-center p-3 organizer-center-link-foto">

            <a target="_blank" href="<?= $ads[0]['url_tag']; ?>">
                <img class="" src="<?= get_image($ads[0]['image']) ?>" alt="" />
            </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 text-center media-center organizer-center-word">
            <h2>
                <span>
                    <?= $string['organizer']; ?></span>
            </h2>
        </div>
        <div class="row media-card ">
            <?php $users = $this->front_database_model->front_read('users', array('status' => "true", 'type' => "company")); ?>
            <?php if (count($users) > 0) { ?>
                <?php foreach ($users as $user) : ?>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 col-12 for-card-margins">
                        <div class="card" style="width: 16rem;">
                            <img class="card-img-top" src="<?= get_image($user['image']); ?>" alt="Card image cap" />
                            <div class="for-flex-organizer-adds">
                                <div class="card-body">
                                    <div class="btn-group-vertical col-md-12" role="group" aria-label="Basic example">
                                        <input type="hidden" value="<?= $user['id']; ?>">
                                        <a href="<?= get_base_url('organizer/events/' . $user['id']); ?>" type="button" class="btn btn-primary">
                                            <?= $string['organizer_event_button'] ?></a>
                                    </div>
                                </div>
                            </div>
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
        </div>
        <?php if ($say > 0) { ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 text-center media-center organizer-center-word">
                <h2>
                    <span>
                        <?= $textandtitle[0]['title']; ?>
                    </span>
                </h2>
                <h5>
                    <span>
                        <?= $textandtitle[0]['text']; ?>
                    </span>
                </h5>
            </div>
        <?php } ?>
    </div>
</section>
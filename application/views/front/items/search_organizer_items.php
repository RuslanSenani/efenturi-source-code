<!---------job-search-header-start------->
<section>
    <div class="col-lg-12 job-search-hd-bg">
        <div class="container">
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="header-center-part">
                    <div class="header-center-under-word">
                        <h1>
                            <span><?= $string['organizer']; ?></span>
                        </h1>
                        <p>
                            <span> <?= $string['search_description']; ?></span>
                        </p>
                    </div>
                    <form data-stop method="POST" action="<?= get_base_url('search-organizer'); ?>">
                        <div class=search-input row>
                            <div class="">
                                <input type="text" name="organizer" placeholder="<?= $string['search_button']; ?>">
                            </div>

                            <div class="">
                                <button type="submit" class="btn btn-info"><?= $string['search_button']; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!---------job-search-header-end--------->
<?php if (count($content['userdata']) > 0) { ?>

    <section>
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 text-center media-center">
                <h2>
                    <span><?= $string['organizer']; ?></span>
                </h2>
            </div>
            <div class="row media-card ">
                <?php foreach ($content['userdata']  as $user) : ?>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 col-12">
                        <div class="card" style="width: 16rem;">
                            <img class="card-img-top" src="<?= get_image($user['image']); ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="text-align: center;"><?= $string['organizers_event'] ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="btn-group-vertical col-md-12" role="group" aria-label="Basic example">
                                    <input type="hidden" value="<?= $user['id']; ?>">
                                    <a href="<?= get_base_url('organizer/events/' . $user['id']); ?>" type="button" class="btn btn-primary"><?= $string['organizer_event_button'] ?></a>
                                </div>
                                
                                
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
<?php } else { ?>

    <div class="row">
        <div class="alert alert-warning">
            <?= $string['results_not_found']; ?>
        </div>
    </div>
<?php } ?>
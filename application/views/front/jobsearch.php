<section>
    <?php if (count($content['jobs']) > 0) { ?>
        <div class="container-fluid p-0">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 p-0">
                <div class="all-section-border">
                    <div class="row event-profile-footer">
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12 event-profile-footer-left">
                            <div class="p-0 first-section">
                                <div>
                                    <div class="one">
                                        <h3>
                                            <span><?= $content['jobs'][0]['vacancy_name']; ?></span>
                                        </h3>
                                        <?= $content['jobs'][0]['description']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-9 job-search-main-left">
            <div class="alert alert-warning">
                <?= $string['results_not_found']; ?>
            </div>
        </div>
    <?php } ?>
</section>
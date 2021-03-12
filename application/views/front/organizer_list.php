<!---------Top Organizers start-------->
<section>
    <div class="container p-0">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0 top-organizer">
            <div class="col-lg-12 col-sm-12 col-12 p-0 text-center title-organizer">
                <h3>
                    <span><?= $string['top_organizers']; ?></span>
                </h3>
            </div>
            <div class="slide-top-org">
                <?php foreach ($content_2['partners'] as $part) : ?>
                    <div class="slide-top-org-item">
                        <img src="<?= get_image($part['image']); ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!---------Top Organizers end---------->
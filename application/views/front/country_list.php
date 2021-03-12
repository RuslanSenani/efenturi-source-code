<!-- Olkelere Gore Olan Yer -->
<section>
    <div class="container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-left p-2">
        <div class="happening-now-center-word">
            <h2>
                <span><?= $string['countries']; ?></span>
            </h2>
            <!--  <p>
                <span><?= $string['search_by_countries']; ?></span>
            </p> -->
        </div>
    </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 by-category p-0">
            <div class="slider">
                <?php foreach ($contries_categories as $cat) : ?>
                    <ul class="buttons">
                        <li><a href="<?= get_base_url('search/' . $cat['country_id']); ?>"><?= $cat['title']; ?></a></li>
                    </ul>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>
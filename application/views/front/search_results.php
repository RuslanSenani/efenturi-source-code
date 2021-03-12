<!---------Happening-now-start--------->
<?php
$textandtitle = $this->front_database_model->front_read("text", array("share" => 'true'));
$say = count($textandtitle);
?>
<section>
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
    <div class="container p-0">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center search-header">
            <div class="search-filter">
                <div>
                    <label><?= $string['country_title']; ?></label>
                    <select name="country_id">
                        <option value="0">--choose--</option>
                        <?php foreach ($this->home_model->countries() as $country) : ?>
                            <option <?= $content['type_id'] == $country['country_id'] ? 'selected' : ''; ?> value="<?= $country['country_id']; ?>"><?= $country['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label><?= $string['status_title']; ?></label>
                    <select name="status_id">
                        <option value="0">--choose--</option>
                        <option value="active"><?= $string['status_option_1']; ?></option>
                        <option value="cancelled"><?= $string['status_option_2']; ?> </option>
                        <option value="postponed"><?= $string['status_option_3']; ?></option>
                    </select>
                </div>

                <div>
                    <label><?= $string['entry_title']; ?></label>
                    <select name="entry_id">
                        <option value="0">--choose--</option>
                        <option value="free"><?= $string['entry_option_1']; ?></option>
                        <option value="paid"><?= $string['entry_option_2']; ?></option>
                    </select>
                </div>
                <div>
                    <label><?= $string['date_title']; ?></label>
                    <input type="date" name="date">
                </div>

                <div>
                    <label><?= $string['enddate_title']; ?></label>
                    <input type="date" name="enddate">
                </div>

                <div>
                    <label><?= $string['industry_title']; ?></label>
                    <select name="industry_id">
                        <option value="0">--choose--</option>
                        <?php foreach ($this->home_model->industry() as $row) : ?>
                            <option <?= $content['type_id'] == $row['industry_id'] ? 'selected' : ''; ?> value="<?= $row['industry_id']; ?>"><?= $row['title']; ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label><?= $string['type_title']; ?></label>
                    <select name="type_id">
                        <option value="0">--choose--</option>
                        <?php foreach ($this->home_model->types() as $row) : ?>
                            <option <?= $content['type_id'] == $row['type_id'] ? 'selected' : ''; ?> value="<?= $row['type_id']; ?>"><?= $row['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>

                    <label><?= $string['stream_title']; ?></label>
                    <select name="stream_id">
                        <option value="0">--choose--</option>
                        <?php foreach ($this->home_model->streams() as $row) : ?>
                            <option value="<?php echo $row['stream_id']; ?>" <?php if ($row['stream_id'] == $content['type_id']) { ?>selected <?php } ?>>
                                <?= $row['title']; ?>

                            </option>

                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

        </div>

        <div class="row" id="search_results">

        </div>
    </div>
</section>
<!-------Happening-now-end------------->
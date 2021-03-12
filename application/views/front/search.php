<?php
$home_categories = $this->home_model->streams();
$types_categories = $this->home_model->types();
$contries_categories = $this->home_model->countries();
$events_list = $this->front_database_model->front_read('events', array('id!=' => 0,'share'=>'true','user_id!='=>0), array('num', 'desc'), 12);
?>
<?php include_once 'search_setions.php'; ?>
<?php include_once 'streams_list.php'; ?>
<?php include_once 'types_list.php'; ?>
<?php include_once 'country_list.php'; ?>

<?php include_once 'events_list.php'; ?>

<?php include_once 'organizer_list.php'; ?>
<?php include_once 'review_list.php'; ?>
<?php include_once 'media_list.php'; ?>

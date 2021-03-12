<div class="sidebar" data-color="purple" data-background-color="white" data-image="<?php echo base_url() ?>/assets/admin_img/sidebar-1.jpg">
  <!--Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"-->
  <div class="logo">
    <a href="<?php echo base_url(); ?>admin/dashboard" class="simple-text logo-normal">
      <img style="max-width:90%;" src="<?= base_url(); ?>assets/img/main-page-img/logo.png" />
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">

      <?php
      // echo '<pre>';
      // print_r($menu);
      // die;
      foreach ($menu as $m) :
        $active = '';
        if ($m['url_tag'] == $s_menu) {
          $active = 'active';
        }
        if ($m['type'] == 'menu') :
      ?>
          <li class="nav-item <?= $active; ?>">
            <a class="nav-link" href="<?= base_url() . $m['url_tag']; ?>">
              <i class="material-icons"><?= $m['icon']; ?></i>
              <p><?= $m['title']; ?></p>
            </a>
          </li>
      <?php endif;
      endforeach; ?>
    </ul>
  </div>
</div>
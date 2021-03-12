<?php
  include "header.php";
?>
  <div class="wrapper">
<?php include "menu.php"?>;
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="<?=base_url();?>admin/dashboard">
              <b class="text-primary">İdarə paneli</b>
            </a>
            <div class="page-loading">
            <img src="<?=base_url();?>assets/admin_img/loading.gif"/>
            </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <!-- <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form> -->
            <ul class="navbar-nav">
              <?php foreach($menu as $m):
                if($m['type']=='top'):  
              ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?=base_url().$m['url_tag'];?>">
                  <i class="material-icons"><?=$m['icon'];?></i>
                    <?=$m['title'];?>
                  </a>
                </li>
              <?php endif;endforeach;?>
              <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdownMenuLink" data-toggle="modal" data-target="#message_modal">
                  <i class="material-icons">notifications</i>
                  <span class="notification"><?=count($message);?></span>
                 
                </a>
                
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  
                </a>
                <div class="dropdown-menu dropdown-menu-right col-2" aria-labelledby="navbarDropdownProfile">
                  <!-- <a class="dropdown-item" href="#">Hesab</a>
                  <a class="dropdown-item" href="#">Ayarlar</a>
                  <div class="dropdown-divider"></div> -->
                  <a class="dropdown-item" href="<?php echo base_url()?>admin/account/profile">Hesab</a>
                  <a class="dropdown-item" href="<?php echo base_url()?>admin/account/logout">Çıxış</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <?php echo $content;?>
      </div>
<?php
include "notifications.php";
include "footer.php";
?>
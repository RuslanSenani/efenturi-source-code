<?php include "header.php";?>
<div class="wrapper text-center login-background" style="background-image:url(https://source.unsplash.com/collection/827743/1600x900)">
    <div class="col-md-12">
    <div class="col-md-4">
    <div class="card">
        <div class="card-body" style="padding-top:20px;">
        <img style="width:70%;margin-bottom:50px" src="<?=base_url();?>assets/img/main-page-img/logo.png"/>
        <form method="post" action="<?php echo base_url()?>admin/account/login">
            <div class="form-group bmd-form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="material-icons">account_circle</i></div>
                    </div>
                    <input name="username" type="text" class="form-control" placeholder="İstifadəçi adı...">
                </div>
            </div>
            <div class="form-group bmd-form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="material-icons">lock</i></div>
                    </div>
                    <input name="password" type="password" class="form-control" placeholder="Şifrə...">
                </div>
            </div>
            <label class="label label-danger" style="color:red"><?php echo $msg;?></label>
            <div class="col-12 text-center"><input class="btn btn-primary btn-round" type="submit" value="Giris"/></div>
        </form>
        </div>
    </div>
  </div>

    </div>
  </div>
</body>
</html>



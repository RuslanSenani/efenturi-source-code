<div class="container-fluid">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Hesab məlumatları</h4>
        </div>
        <div class="card-body">
          <form method="post" action="<?php echo base_url() ?>admin/account/change_information">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Ad</label>
                  <input value="<?= $firstname; ?>" type="text" class="form-control" name="firstname">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Soyad</label>
                  <input value="<?= $lastname; ?>" type="text" class="form-control" name="lastname">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Ünvan</label>
                  <input value="<?= $address; ?>" type="text" class="form-control" name="address">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Mail</label>
                  <input value="<?= $mail; ?>" type="mail" class="form-control" name="mail">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Telefon</label>
                  <input value="<?= $phone; ?>" type="text" class="form-control" name="phone">
                </div>
              </div>

            </div>

            <button type="submit" class="btn btn-primary pull-right btn-sm">Redaktə et</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Şifrəni dəyiş</h4>
        </div>
        <div class="card-body">
          <form action="<?php echo base_url() ?>admin/account/change_password" method="post">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Mövcut şifrə</label>
                  <input type="password" class="form-control" name="oldpassword">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Şifrə</label>
                  <input type="password" class="form-control" name="password">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Təkrar Şifrə</label>
                  <input type="password" class="form-control" name="retrypassword">
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right btn-sm">Redaktə Et</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
<?php
class settings extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->admin_model->get_page_permission();
    $this->load->model('front/home_model');
  }


  public function index()
  {
    $string = $this->home_model->string();
    $results = $this->database_model->read('settings');
    $settings = array();
    foreach ($results as $r) {
      $settings[$r['selector']] = $r['value'];
    }


    $content = '
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">' . $string['settings'] . '</h4>
                </div>
                <div class="card-body">
                <form method="post" action="' . base_url() . 'admin/settings/add" enctype="multipart/form-data">
                <h3>' . $string['contact_info'] . '</h3>
                  <div class="col-6">
                    <div class="form-group bmd-form-group">
                      <label class="">' . $string['map'] . '</label>
                      <input name="map" type="text" class="form-control" value="' . $settings['map'] . '"/>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group bmd-form-group">
                      <label class="">' . $string['facebook_title'] . '</label>
                      <input name="facebook" type="text" class="form-control" value="' . $settings['facebook'] . '"/>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group bmd-form-group">
                      <label class="">' . $string['instagram_title'] . '</label>
                      <input name="instagram" type="text" class="form-control" value="' . $settings['instagram'] . '"/>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group bmd-form-group">
                      <label class="">' . $string['youtube_title'] . '</label>
                      <input name="youtube" type="text" class="form-control" value="' . $settings['youtube'] . '"/>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group bmd-form-group">
                      <label class="">' . $string['linkedin_title'] . '</label>
                      <input name="linked" type="text" class="form-control" value="' . $settings['linked'] . '"/>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group bmd-form-group">
                      <label class="">' . $string['twitter-title'] . '</label>
                      <input name="twitter" type="text" class="form-control" value="' . $settings['twitter'] . '"/>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label class="">' . $string['phone_title'] . '</label>
                      <textarea name="phone" type="text" class="form-control">' . $settings['phone'] . '</textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label class="">' . $string['email_title'] . '</label>
                      <textarea name="mail" type="text" class="form-control">' . $settings['mail'] . '</textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label class="">' . $string['addres_title'] . '</label>
                      <textarea name="address" type="text" class="form-control">' . $settings['address'] . '</textarea>
                    </div>
                  </div>
                  <div class="text-center">
                      <button class="btn btn-primary btn-sm"> ' . $string['settings_edit_btn'] . '</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
     ';
    $this->admin_model->show($content);
  }
  public function add()
  {

    $map          = $this->input->post("map");
    $facebook     = $this->input->post("facebook");
    $instagram    = $this->input->post("instagram");
    $youtube      = $this->input->post("youtube");
    $linked       = $this->input->post("linked");
    $twitter      = $this->input->post("twitter");
    $phone        = $this->input->post('phone');
    $mail         = $this->input->post('mail');
    $address      = $this->input->post('address');
    $ar = array(
      'map' => $map,
      'facebook' => $facebook,
      'instagram' => $instagram,
      'youtube' => $youtube,
      'linked' => $linked,
      'twitter' => $twitter,
      'phone' => $phone,
      'mail' => $mail,
      'address' => $address
    );
    $this->database_model->delete_array('settings', array('id!=' => 0));
    foreach ($ar as $key => $value) {
      $this->database_model->insert('settings', array(
        'selector' => $key,
        'value'   => $value
      ));
    }


    echo 'ok';
  }
}

<?php
class lang_settings extends CI_Controller
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
    $content = '
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">' . $string['language_settings'] . '</h4>
                  <p class="card-category">' . $string['language_title'] . '</p>
                  ' . $this->admin_model->get_page_button('lang_settings') . '
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                        ' . $string['terms_link'] . '
                        </th>
                        <th>
                        ' . $string['selector'] . '
                        </th>
                        <th>
                        ' . $string['value'] . '
                        </th>
                        <th>
                        </th>
                      </thead>
                      <tbody id="lang_settings">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     ';
    $this->load->model('admin/modal_model');
    $html = '
      <form method="post" action="' . base_url() . 'admin/lang_settings/add">
      <input type="hidden" name="ch_id" value="0"/>
      <div class="col-12">
      <div class="form-group bmd-form-group">
        <label class="">' . $string['selector'] . '</label>
        <input name="selector" type="text" class="form-control">
      </div>
      </div>
      <div id="s_panel">';
    $language = $this->database_model->read("language");
    $n = 0;
    foreach ($language as $l) {
      $html .= '<div class="col-12">
            <div class="form-group bmd-form-group">
              <label class="">' . $l['title'] . ' (' . $l['url_tag'] . ')</label>
              <textarea name="value[' . $n . ']" class="form-control value"></textarea>
              <input type="hidden" name="lang[' . $n . ']" value="' . $l['id'] . '" class="lang"/>
            </div>
            </div>';
      $n++;
    }
    $html .= '
      </div>
      </form>
     ';
    $content .= $this->modal_model->dialog($html, 'lang_settings_panel', 'md', $string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }


  public function read()
  {
    $lang_settings = $this->database_model->read('lang_settings', array('id', 'desc'), 'id');
    $content = '';
    $n = 0;
    foreach ($lang_settings as $l) {
      $n++;
      $content .= '
            <tr>
                <td>' . $n . '</td>
                <td>' . $l['selector'] . '</td>
                <td>' . $l['value'] . '</td>
                <td class="text-right">
                <div class="btn-group">
                <button id="' . $l['id'] . '" class="btn-link btn btn-sm btn-warning"><i class="material-icons">edit</i></button>
                <button id="' . $l['id'] . '" class="btn-link btn btn-sm btn-danger"><i class="material-icons">delete_forever</i></button>
                </div>
                </td>
            </tr>';
    }
    echo json_encode(array('content' => $content));
  }


  public function read_row()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $settings = $this->database_model->read('lang_settings', array('id', 'desc'), 'l_id', array('id' => $id));
      $ar = array(
        'id' => 0,
        'selector' => '',
        'lang' => array(),
        'value' => array()
      );
      foreach ($settings as $s) {
        $ar['id'] = $s['id'];
        $ar['selector'] = $s['selector'];
        array_push($ar['lang'], $s['l_id']);
        array_push($ar['value'], $s['value']);
      }
      echo json_encode($ar);
    }
  }


  public function add()
  {
    $string = $this->home_model->string();
    $selector = $this->input->post('selector');
    $ch_id = $this->input->post('ch_id');
    $this->database_model->delete('lang_settings', $ch_id);
    if (!empty($selector)) {
      for ($n = 0; $n < count($_POST['value']); $n++) {
        $ar = array(
          'id' => time(),
          'selector' => $selector,
          'value' => $_POST['value'][$n],
          'l_id' => $_POST['lang'][$n]
        );
        $this->database_model->insert('lang_settings', $ar);
      }
      echo 'ok';
    } else {
      echo $string['enter_the_selector'];
    }
  }


  public function delete()
  {
    $id = $this->input->post('id');
    if ($id != 0 and !empty($id)) {
      $this->database_model->delete('lang_settings', $id);
      echo json_encode(array('msg' => 'Silindi'));
    }
  }
}

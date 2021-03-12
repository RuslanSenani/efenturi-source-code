<?php
class language extends CI_Controller
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
                  <h4 class="card-title ">' . $string['cv_language'] . '</h4>
                  <p class="card-category">' . $string['all_language'] . '</p>
                  ' . $this->admin_model->get_page_button('language') . '
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                        ' . $string['terms_link'] . '
                        </th>
                        <th>
                        ' . $string['cv_language'] . ' 
                        </th>
                        <th>
                        ' . $string['language_abbreviation'] . ' 
                        </th>
                        <th>
                        </th>
                      </thead>
                      <tbody id="language">
                        
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
      <form method="post" action="' . base_url() . 'admin/language/add">
      <input type="hidden" name="ch_id" value="0"/>
      <div class="col-12">
      <div class="form-group bmd-form-group">
        <label class="">' . $string['cv_language'] . ' </label>
        <input name="title" type="text" class="form-control">
      </div>
      </div>
      <div class="col-12">
      <div class="form-group bmd-form-group">
        <label class="">' . $string['language_abbreviation'] . ' </label>
        <input name="url_tag" type="text" class="form-control">
      </div>
      </div>
      </form>
     ';
    $content .= $this->modal_model->dialog($html, 'language_panel', 'md', $string['save']);
    $html = '<form method="post" action="' . base_url() . 'admin/language/settings" enctype="multipart/form-data">
     <input type="hidden" value="0" name="ch_id"/>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="bmd-label-static">' . $string['ranking'] . '</label>
        <select name="num" type="text" class="form-control">
        <option value="0">--' . $string['choosed'] . '--</option>
        ';
    for ($n = 1; $n < 21; $n++) {
      $html .= "<option value='" . $n . "'>" . $n . "</option>";
    }
    $html .= '
        </select>
      </div>
      </div>
      <div class="col-12" style="margin-top:20px;">
      <div class="form-check">
      <label class="form-check-label">
         <input class="form-check-input" name="share"  type="checkbox" value="1">
         ' . $string['share'] . '
         <span class="form-check-sign">
             <span class="check"></span>
         </span>
      </label>
      </div>
      </div>
     </form>';
    $content .= $this->modal_model->dialog($html, 'language_settings', 'md', $string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }


  public function read()
  {
    $content = '';
    $n = 0;
    $ar = $this->database_model->read('language', array('num', 'DESC'));
    foreach ($ar as $a) {
      $n++;
      $content .= '<tr class="' . get_status($a['share']) . '">
          <td class="number-rel">' . $n . '</td>
          <td>' . $a['title'] . '</td>
          <td>' . $a['url_tag'] . '</td>
          <td class="text-right">
          <div class="btn-group">
          <button id="' . $a['id'] . '" class="btn-link btn btn-sm btn-primary"><i class="material-icons">settings</i></button>
          <button id="' . $a['id'] . '" class="btn-link btn btn-sm btn-warning"><i class="material-icons">edit</i></button>
          <button id="' . $a['id'] . '" class="btn-link btn btn-sm btn-danger"><i class="material-icons">delete_forever</i></button>
          </div>
          </td></tr>';
    }
    echo json_encode(array('content' => $content));
  }


  public function add()
  {
    $title = $this->input->post('title');
    $url_tag = set_link($this->input->post('url_tag'));
    $ch_id = $this->input->post('ch_id');
    if (!empty($title) and !empty($url_tag)) {
      if (strlen($url_tag) <= 3) {
        if ($ch_id == 0) {
          $this->database_model->insert('language', array('title' => $title, 'url_tag' => $url_tag));
        } else {
          $this->database_model->update('language', array('title' => $title, 'url_tag' => $url_tag), $ch_id);
        }

        echo 'ok';
      } else {
        echo "3 simvoldan cox ola bilməz";
      }
    } else
      echo "Boş saxlamaq olmaz";
  }


  public function read_row()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      echo json_encode($this->database_model->read_row('language', $id));
    }
  }


  public function delete()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $this->database_model->delete('language', $id);
      echo json_encode(array('msg' => 'Silindi'));
    }
  }


  public function settings()
  {
    $ch_id = $this->input->post('ch_id');
    $share = $this->input->post('share');
    $num = $this->input->post('num');
    $ar = array('share' => 0, 'num' => $num);
    if (isset($share) and $share == 1) {
      $ar['share'] = 1;
    }
    $this->database_model->update('language', $ar, $ch_id);

    echo 'ok';
  }
}

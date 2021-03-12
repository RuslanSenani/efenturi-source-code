<?php
class partners extends CI_Controller
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
                  <h4 class="card-title col-md-4">' . $string['partners_title'] . '</h4>
                  ' . $this->admin_model->get_page_header() . $this->admin_model->get_page_button('partners', true, true, true) . '
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                        <div class="form-check">
                        <label class="form-check-label">
                           <input id="all_check" class="form-check-input" type="checkbox" value="1">
                           <span class="form-check-sign">
                               <span class="check"></span>
                           </span>
                        </label>
                        </div>
                        </th>
                        <th>
                        ' . $string['image'] . '
                        </th>
                        <th>
                        ' . $string['name'] . '
                        </th>
                        <th>
                        ' . $string['cv_language'] . '
                        </th>
                        <th>
                        ' . $string['ranking'] . '
                        </th>
                        <th>
                        </th>
                      </thead>
                      <tbody id="partners">
                        
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
    <form method="post" action="' . base_url() . 'admin/partners/add" enctype="multipart/form-data">
     <input type="hidden" name="ch_id" value="0"/>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['name'] . '</label>
        <input name="title" type="text" class="form-control">
     </div>
     </div>     
     <div class="col-12">
     <img class="form-image"/>
     <div class="input-group">
      <div class="custom-file">
        <input type="file" name="image" class="custom-file-input" id="image" aria-describedby="inputGroupFileAddon01">
        <label class="custom-file-label" for="image">' . $string['choose_file'] . '</label>
      </div>
    </div>
    </div>
    </form>
     ';
    $content .= $this->modal_model->dialog($html, 'partners_panel', 'md', $string['save']);
    $html = '<form method="post" action="' . base_url() . 'admin/partners/settings" enctype="multipart/form-data">
     <input type="hidden" value="0" name="ch_id"/>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="bmd-label-static">' . $string['ranking'] . '</label>
        <select name="num" type="text" class="form-control">
        <option value="0">--' . $string['choosed'] . '--</option>
        ';
    for ($n = 1; $n < 51; $n++) {
      $html .= '<option value="' . $n . '">' . $n . '</option>';
    }
    $html .= '
        </select>
     </div>
     </div>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="bmd-label-static">' . $string['cv_language'] . '</label>
        <select name="l_id" type="text" class="form-control">
        <option value="0">--' . $string['all_language'] . '--</option>
        ';
    $lang = $this->database_model->read("language");
    foreach ($lang as $l) {
      $html .= "<option value='" . $l['id'] . "'>" . $l['title'] . " (" . $l['url_tag'] . ")</option>";
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
    $content .= $this->modal_model->dialog($html, 'partners_settings', 'md', $string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }


  public function read()
  {
    $content = '';
    $n = 0;
    $ar = $this->database_model->read('partners', array('num', 'DESC'));
    foreach ($ar as $a) {
      $lang = $this->admin_model->get_lang($a['l_id']);
      $n++;
      $content .= '<tr data-lang="' . $a['l_id'] . '" class="' . get_status($a['share']) . '">
        <td>
          <div class="number">' . $n . '</div>
          <div class="form-check">
          <label class="form-check-label">
            <input id="' . $a['id'] . '" class="form-check-input" name="seo_index"  type="checkbox" value="1">
            <span class="form-check-sign">
                <span class="check"></span>
            </span>
          </label>
          </div>
        </td>
        <td><img class="table-image" src="' . get_image($a['image']) . '"/></td>
        <td>' . $a['title'] . '</td>
        <td>' . $lang['url_tag'] . '</td>
        <td>' . $a['num'] . '</td>
        <td class="text-right">
        <div class="btn-group">
          <button id="' . $a['id'] . '" class="btn-link btn btn-sm btn-primary"><i class="material-icons">settings</i></button>
          <button id="' . $a['id'] . '" class="btn-link btn btn-sm btn-info"><i class="material-icons">file_copy</i></button>
          <button id="' . $a['id'] . '" class="btn-link btn btn-sm btn-warning"><i class="material-icons">edit</i></button>
          <button id="' . $a['id'] . '" class="btn-link btn btn-sm btn-danger"><i class="material-icons">delete_forever</i></button>
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
      $result = $this->database_model->read_row('partners', $id);
      $result['image'] = get_image($result['image']);
      echo json_encode($result);
    }
  }


  public function add()
  {
    $title = $this->input->post('title');
    $content = $this->input->post('content');
    $description = $this->input->post('description');
    $link = $this->input->post('link');
    $type_img = array('image/png', 'image/gif', 'image/jpeg');
    $ch_id = $this->input->post('ch_id');
    $ar = array(
      'title' => $title
    );
    if (!empty($title)) {
      if (!empty($_FILES['image']['name'])) {
        $this->load->model("admin/upload_model");
        $ar = array_merge($ar, array('image' => $this->upload_model->image("image", 172)));
      }
      if (empty($ch_id)) {
        $ar['partner_id'] = time();
        $this->database_model->insert('partners', $ar);
      } else {
        $this->database_model->update('partners', $ar, $ch_id);
      }
      echo 'ok';
    } else {
      echo 'Başlıq yazın';
    }
  }


  public function delete()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $this->database_model->delete('partners', $id);
      echo json_encode(array('msg' => 'Silindi'));
    }
  }


  public function copy_row()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $column = array('share', 'l_id', 'title', 'image', 'num');
      $this->database_model->copy_row('partners', $column, $id);
      echo json_encode(array('msg' => 'partners kopyalandı'));
    }
  }


  public function settings()
  {
    $l_id = $this->input->post('l_id');
    $num = $this->input->post('num');
    $ch_id = $this->input->post('ch_id');
    $share = $this->input->post('share');
    $ar = array('l_id' => $l_id, 'num' => $num, 'share' => false);
    if (isset($share) and $share == 1) {
      $ar['share'] = true;
    }
    $this->database_model->update('partners', $ar, $ch_id);
    echo 'ok';
  }
}

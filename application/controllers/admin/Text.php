<?php
class Text extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->admin_model->get_page_permission();
    $this->load->model('front/front_database_model');
    $this->load->model('front/home_model');
  }


  public function index()
  {
    $say = count($this->database_model->read('text'));
    $string = $this->home_model->string();
    $content = '
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title col-md-4">' . $string['text_and_title'] . '</h4>';
    if ($say == 0) {
      $content .= $this->admin_model->get_page_button('text');
    }
    $content .= ' <p class="card-category">' . $string['text_and_title_list'] . '</p>
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
                        ' . $string['title'] . '
                        </th>
                        <th>
                        ' . $string['text'] . '
                        </th>
                        <th>
                        </th>
                      </thead>
                      <tbody id="text">
                        
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
    <form method="post" action="' . base_url() . 'admin/text/add">
     <input type="hidden" name="ch_id" value="0"/>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['title'] . '</label>
        <input data-title name="title" type="text" class="form-control">
     </div>
     </div>

     <div class="col-12" style="padding:10px 0px 10px 0px;">
     <div class="form-group">
        <textarea  class="word" name="text"></textarea>
     </div>
     </div>

    </form>
     ';
    $content .= $this->modal_model->dialog($html, 'text_panel', 'md', $string['save']);
    $html = '<form method="post" action="' . base_url() . 'admin/text/settings">
     <input type="hidden" value="0" name="ch_id"/>
     
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
    $content .= $this->modal_model->dialog($html, 'text_settings', 'md', $string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }

















  public function read()
  {
    $say = count($this->database_model->read('text', array('id', 'desc'), 'id', array('text=' => '')));
    $content = '';
    $n = 0;
    $ar = $this->database_model->read('text');
    $string = $this->home_model->string();
    foreach ($ar as $a) {
      $n++;
      $content .= '<tr class="' . get_status($a['share']) . '">
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
            </th>
            <td>' . $a['title'] . '</td>
            <td>';
      if ($say > 0) {
        $content .= $string['empty'];
      } else {
        $content .= $string['text_full'];
      }
      $content .= '</td>
          <td class="text-right">
          <div class="btn-group">
            <button id="' . $a['id'] . '" class="btn btn-link btn-sm btn-primary"><i class="material-icons">settings</i></button>
            <button id="' . $a['id'] . '" class="btn btn-link btn-sm btn-warning"><i class="material-icons">edit</i></button>
            <button id="' . $a['id'] . '" class="btn btn-link btn-sm btn-danger"><i class="material-icons">delete_forever</i></button>
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
      $result = $this->database_model->read_row('text', $id);
      echo json_encode($result);
    }
  }


  public function add()
  {
    $ch_id = $this->input->post('ch_id');
    $title = $this->input->post("title");
    $text = $this->input->post("text");

    if (!empty($title) and !empty($text)) {
      $ar = array(
        'title' => $title,
        'text' => $text,
        'share' => false
      );
      if (empty($ch_id)) {
        $this->database_model->insert('text', $ar);
      } else {
        $this->database_model->update('text', $ar, $ch_id);
      }
    } else {
      echo "Xanalar Boş Buraxılmamalıdır!";
      die;
    }
    echo 'ok';
  }


  public function delete()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $this->database_model->delete('text', $id);
      echo json_encode(array('msg' => 'Silindi'));
    }
  }


  public function settings()
  {
    $ch_id = $this->input->post('ch_id');
    $share = $this->input->post('share');
    $ar = array('share' => false);
    if (isset($share) and $share == 1) {
      $ar['share'] = 'true';
    }
    $this->database_model->update('text', $ar, $ch_id);

    echo 'ok';
  }
}

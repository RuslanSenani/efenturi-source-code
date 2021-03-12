<?php
class blogs extends CI_Controller
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
                  <h4 class="card-title col-md-4">' . $string['blogs'] . '</h4>
                  ' . $this->admin_model->get_page_header() . $this->admin_model->get_page_button('blogs', true, true, true) . '
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
                        ' . $string['date'] . '
                        </th>
                        <th>
                        </th>
                      </thead>
                      <tbody id="blogs">
                        
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
    <form method="post" action="' . base_url() . 'admin/blogs/add" enctype="multipart/form-data">
     <input type="hidden" name="ch_id" value="0"/>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['name'] . '  <b id="page_title"></b></label>
        <input data-title name="title" type="text" class="form-control">
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['link'] . '</label>
        <input name="url_tag" type="text" class="form-control">
     </div>
     </div>

     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="bmd-label-static">' . $string['organizer'] . '</label>
        <select name="account_id" type="text" class="form-control">
        <option value="0">--' . $string['choosed'] . '--</option>
        ';
    $organizers = $this->database_model->read("account", array('id', 'desc'), 'id', array('id' => $_SESSION['user_id']));
    foreach ($organizers as $o) {
      if ($o['admin'] == 'true') {
        $html .= "<option value='" . $o['id'] . "'>" . $o['position'] . "</option>";
      }
    }
    $html .= '
        </select>
      </div>
      </div>



     
     <div class="col-12" style="padding:10px 0px 10px 0px;">
     <div class="form-group">
        <textarea  class="word" name="content"></textarea>
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['description'] . '  <b id="page_description"></b></label>
        <input data-description name="description" type="text" class="form-control"/>
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['key_words'] . '</label>
        <input name="keywords" type="text" class="form-control"/>
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
    $content .= $this->modal_model->dialog($html, 'blogs_panel', 'lg',$string['save']);
    $html = '<form method="post" action="' . base_url() . 'admin/blogs/settings" enctype="multipart/form-data">
     <input type="hidden" value="0" name="ch_id"/>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="bmd-label-static">' . $string['date'] . '</label>
        <input type="date" name="c_date" class="form-control"/>
     </div>
     </div>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="bmd-label-static">' . $string['cv_language'] . '</label>
        <select name="l_id" type="text" class="form-control">
        <option value="0">--' . $string['choosed'] . '--</option>
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
    $content .= $this->modal_model->dialog($html, 'blogs_settings', 'md',$string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }


  public function read()
  {

    $content = '';
    $n = 0;
    $ar = $this->database_model->read('blogs');
    foreach ($ar as $a) {
      $lang = $this->admin_model->get_lang($a['l_id']);
      $n++;
      $content .= '<tr class="' . get_status($a['share']) . '" data-lang="' . $a['l_id'] . '">
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
        <td><img src="' . get_image($a['image']) . '" class="table-image"/></td>
        <td><a target="_blank" href="' . base_url() . $a['url_tag'] . '">' . ($a['title']) . '</a></td>
        <td>' . $lang['url_tag'] . '</td>
        <td>' . $a['c_date'] . '</td>
        <td class="text-right">
        <div class="btn-group">
          <button id="' . $a['id'] . '" class="btn btn-link btn-sm btn-primary"><i class="material-icons">settings</i></button>
          <button id="' . $a['id'] . '" class="btn btn-link btn-sm btn-info"><i class="material-icons">file_copy</i></button>
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
      $result = $this->database_model->read_row('blogs', $id);
      $result['image'] = get_image($result['image']);
      echo json_encode($result);
    }
  }


  public function add()
  {
    $ch_id = $this->input->post('ch_id');
    $title = $this->input->post("title");
    $url_tag = set_link($this->input->post("url_tag"));
    $content = $this->input->post("content");
    $description = $this->input->post("description");
    $keywords = $this->input->post("keywords");
    $account_id = $this->input->post("account_id");

    $blog_id = time();
    if (!empty($title) and !empty($url_tag)) {
      $ar = array(
        'title' => $title,
        'url_tag' => $url_tag,
        'content' => $content,
        'description' => $description,
        'keywords' => $keywords,
        'account_id' => $account_id,
        'c_date' => date('Y-m-d')
      );
      if (!empty($_FILES['image']['name'])) {
        $this->load->model("admin/upload_model");
        $ar = array_merge($ar, array('image' => $this->upload_model->image("image", 500, 200)));
      }
      if (empty($ch_id)) {
        $ar['blog_id'] = $blog_id;
        $this->database_model->insert('blogs', $ar);
      } else {
        $this->database_model->update('blogs', $ar, $ch_id);
      }

      echo 'ok';
    } else {
      echo "Bloq adını və linkini daxil edin!";
    }
  }


  public function delete()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $this->database_model->delete('blogs', $id);
      echo json_encode(array('msg' => 'Silindi'));
    }
  }


  public function copy_row()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $column = array('share', 'blog_id', 'l_id', 'title', 'c_date', 'content', 'image', 'url_tag', 'keywords', 'description');
      $this->database_model->copy_row('blogs', $column, $id);
      echo json_encode(array('msg' => 'blogs kopyalandı'));
    }
  }


  public function settings()
  {
    $l_id = $this->input->post('l_id');
    $c_date = $this->input->post('c_date');
    $ch_id = $this->input->post('ch_id');
    $share = $this->input->post('share');
    $ar = array('c_date' => $c_date, 'l_id' => $l_id, 'share' => false);

    if (isset($share) and $share == 1) {
      $ar['share'] = true;
    }
    $this->database_model->update('blogs', $ar, $ch_id);

    echo 'ok';
  }

  /*public function get_compress(){
         $ar=$this->database_model->read('blogs');
         $this->load->model("admin/upload_model");
         foreach($ar as $a){
             $file=get_json($a['image'])->link;
             $file_name=str_replace('https://www.correcttechno.com/uploads/images/','',$file);
             $this->upload_model->resize_image($file_name,$file,70);
             echo $file.'    '.$file_name.'</br>';
         }
    }*/
}

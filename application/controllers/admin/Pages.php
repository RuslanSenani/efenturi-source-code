<?php
class pages extends CI_Controller
{


  function __construct()
  {
    parent::__construct();
    $this->admin_model->get_page_permission();
    $this->load->model('front/home_model');
  }


  public function index($id = 0)
  {
    $string = $this->home_model->string();
    $content = '
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title col-md-4">' . $string['pages'] . '</h4>
                  ' . $this->admin_model->get_page_header() . $this->admin_model->get_page_button('pages', true, true, true) . '
                  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table ">
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
                      <tbody id="pages">
                        
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
    <form method="post" action="' . base_url() . 'admin/pages/add" enctype="multipart/form-data">
     <input type="hidden" name="ch_id" value="0"/>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['page_title'] . '<b id="page_title"></b></label>
        <input data-title name="page_title" type="text" class="form-control">
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['name'] . '</label>
        <input name="title" type="text" class="form-control">
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['link'] . '</label>
        <input name="url_tag" type="text" class="form-control">
     </div>
     </div>
     <div class="col-12" style="padding:10px 0px 10px 0px;">
     <div class="form-group">
        <textarea  class="word" name="content"></textarea>
     </div>
     </div>
     <div class="col-12">
     <div class="form-group ">
        <label class="bmd-label-static">' . $string['enter'] . '</label>
        <select name="include" type="text" class="form-control">
        <option value="0">--' . $string['choosed'] . '--</option>
        ';
    foreach ($this->database_model->read('include') as $inc) {
      $html .= '<option value="' . $inc['id'] . '">' . $inc['title'] . '</option>';
    }


    $html .= '
        </select>
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label>' . $string['page_description'] . ' <b id="page_description"></b></label>
        <input data-description name="description" type="text" class="form-control"/>
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label>' . $string['key_words'] . '</label>
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
    $content .= $this->modal_model->dialog($html, 'pages_panel', 'lg',$string['save']);


    $html = '<form method="post" action="' . base_url() . 'admin/pages/settings" enctype="multipart/form-data">
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
        <label class="bmd-label-static">' . $string['upper_page'] . '</label>
        <select name="parent_id" type="text" class="form-control">
        <option value="0">--' . $string['choosed'] . '--</option>
        ';
    $pages = $this->database_model->read("pages", array('id', 'asc'), 'page_id');
    foreach ($pages as $p) {
      $html .= "<option value='" . $p['page_id'] . "'>" . $p['title'] . "</option>";
    }
    $html .= '
        </select>
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


      <div class="col-6" style="margin-top:20px;">
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

      <div class="col-6" style="margin-top:20px;">
      <div class="form-check">
      <label class="form-check-label">
         <input class="form-check-input" name="footer"  type="checkbox" value="1">
         ' . $string['footer_menu'] . '
         <span class="form-check-sign">
             <span class="check"></span>
         </span>
      </label>
      </div>
      </div>

      <div class="col-6" style="margin-top:20px;">
      <div class="form-check">
      <label class="form-check-label">
         <input class="form-check-input" name="header"  type="checkbox" value="1">
         ' . $string['header_menu'] . '
         <span class="form-check-sign">
             <span class="check"></span>
         </span>
      </label>
      </div>
      </div>
      
      <div class="col-6" style="margin-top:20px;">
      <div class="form-check">
      <label class="form-check-label">
         <input class="form-check-input" name="seo_index"  type="checkbox" value="1">
         ' . $string['seo'] . '
         <span class="form-check-sign">
             <span class="check"></span>
         </span>
      </label>
      </div>
      </div>

     </form>';
    $content .= $this->modal_model->dialog($html, 'pages_settings', 'md',$string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }

  public function read()
  {
    $content = '';
    $n = 0;
    $ar = $this->database_model->read('pages', array('num', 'DESC'));
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
        <td><img class="table-image" src="' . get_image($a['image']) . '"/></td>
        <td><a target="_blank" href="' . base_url() . $a['url_tag'] . '">' . $a['title'] . '</a></td>
        <td>' . $lang['url_tag'] . '</td>
        <td>' . $a['num'] . '</td>
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
      $result = $this->database_model->read_row('pages', $id);
      $result['image'] = get_image($result['image']);
      echo json_encode($result);
    }
  }


  public function add()
  {

    $ch_id          = $this->input->post('ch_id');
    $title          = $this->input->post("title");
    $page_title     = $this->input->post('page_title');
    $url_tag        = set_link($this->input->post("url_tag"));
    $content        = $this->input->post("content");
    $include        = $this->input->post('include');
    $description    = $this->input->post("description");
    $keywords       = $this->input->post("keywords");
    $page_id        = time();
    if (!empty($title) and !empty($url_tag)) {
      $ar = array(
        'title'         => $title,
        'page_title'    => $page_title,
        'url_tag'       => $url_tag,
        'content'       => $content,
        'description'   => $description,
        'keywords'      => $keywords,
        'include'       => $include
      );
      if (!empty($_FILES['image']['name'])) {
        $this->load->model("admin/upload_model");
        $ar = array_merge($ar, array('image' => $this->upload_model->image("image", 500)));
      }
      if (empty($ch_id)) {
        $ar['page_id'] = $page_id;
        $this->database_model->insert('pages', $ar);
      } else {
        $this->database_model->update('pages', $ar, $ch_id);
      }

      echo 'ok';
    } else {
      echo "Səhifə adını və linkini daxil edin!";
    }
  }










  //get_image($result['image']);
  public function delete()
  {
    $id = $this->input->post('id');

    if (!empty($id) and $id != 0) {
      $this->database_model->delete('pages', $id);
      echo json_encode(array('msg' => 'Silindi'));
    }
  }


  public function copy_row()
  {
    $id = $this->input->post('id');

    if (!empty($id) and $id != 0) {
      $column = array('share', 'footer', 'page_id', 'include', 'parent_id', 'l_id', 'title', 'page_title', 'content', 'image', 'url_tag', 'keywords', 'description', 'num');
      $this->database_model->copy_row('pages', $column, $id);
      echo json_encode(array('msg' => 'Səhifə kopyalandı'));
    }
  }


  public function settings()
  {
    $l_id         = $this->input->post('l_id');
    $parent_id    = $this->input->post('parent_id');
    $ch_id        = $this->input->post('ch_id');
    $share        = $this->input->post('share');
    $footer       = $this->input->post('footer');
    $header       = $this->input->post('header');
    $seo_index    = $this->input->post('seo_index');
    $num = $this->input->post('num');

    $ar = array('parent_id' => $parent_id, 'l_id' => $l_id, 'num' => $num, 'share' => false, 'footer' => false, 'seo_index' => false, 'header' => false);

    if (isset($share) and $share == 1) {
      $ar['share'] = true;
    }
    if (isset($footer) and $footer == 1) {
      $ar['footer'] = true;
    }
    if (isset($seo_index) and $seo_index == 1) {
      $ar['seo_index'] = true;
    }
    if (isset($header) and $header == 1) {
      $ar['header'] = true;
    }

    $this->database_model->update('pages', $ar, $ch_id);

    echo 'ok';
  }
}

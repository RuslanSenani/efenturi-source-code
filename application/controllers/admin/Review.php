<?php
class review extends CI_Controller
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
                  <h4 class="card-title col-md-4">' . $string['review'] . '</h4>
                  ' . $this->admin_model->get_page_header() . $this->admin_model->get_page_button('review', false, true, true) . '
                  
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
                        ' . $string['video'] . '
                        </th>
                        <th>
                        ' . $string['ranking'] . '
                        </th>
                        <th>
                        </th>
                      </thead>
                      <tbody id="review">
                        
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
    <form method="post" action="' . base_url() . 'admin/review/add">
    <input type="hidden" value="0" name="ch_id"/>
    <div class="col-12">
    <div class="form-group ">
       <label class="bmd-label-static">' . $string['enter_the_company'] . '</label>
       <select name="user_id" type="text" class="form-control">
       <option value="0">--' . $string['choosed'] . '--</option>
       ';
    foreach ($this->database_model->read('users', array('id', 'desc'), 'id', array('type' => 'company')) as $inc) {
      $html .= '<option value="' . $inc['id'] . '">' . $inc['company'] . '</option>';
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
     
 




<div class="col-12">
<img class="form-image"/>
<div class="input-group">
 <div class="custom-file">
   <input type="file" name="image" class="custom-file-input" id="image" aria-describedby="inputGroupFileAddon01">
   <label class="custom-file-label" for="image">' . $string['choose_file'] . '</label>
 </div>
</div>
</div>


     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['video'] . ' </label>
        <input data-title name="video_link" type="text" class="form-control">
     </div>
     </div>
    </form>
     ';
    $content .= $this->modal_model->dialog($html, 'review_panel', 'lg', $string['save']);
    $html = '<form method="post" action="' . base_url() . 'admin/review/settings">
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
     </form>';
    $content .= $this->modal_model->dialog($html, 'review_settings', 'md', $string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }

  public function read()
  {
    $string = $this->home_model->string();
    $content = '';
    $n = 0;
    $ar = $this->database_model->read('review', array('num', 'DESC'));
    foreach ($ar as $a) {
      $n++;
      $content .= '<tr class="' . get_status($a['share']) . '" data-lang="' . $a['id'] . '">
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
          <td>';
      if ($a['image_url'] != null) {
        $content .= '<img 
                width="100" 
                height="100" 
                src="' . get_image($a['image_url']) . '"';
        $content .= 'class="img-rounded">
               ';
      } else {
        $content .= $string['no_added_image'];
      }
      $content .= '</td> <td>';
      if ($a['video_link'] != null) {
        $content .= ' <iframe
                      width="100" 
                      height="100"
                      src="//www.youtube.com/embed/' . $a['video_link'] . '"
                      frameborder="0"
                      gesture="media"
                      allow="encrypted-media"
                      allowfullscreen>
                      </iframe> </td>';
      } else {
        $content .= $string['no_added_video'];
      }
      $content .= '
        <td>' .  $a['num'] . '</td>
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
      $result = $this->database_model->read_row('review', $id);
      $result['image'] = get_image($result['image_url']);
      echo json_encode($result);
    }
  }


  public function add()
  {

    $ch_id          = $this->input->post('ch_id');
    $user_id          = $this->input->post("user_id");
    $video_link     = $this->input->post('video_link');
    $content        = $this->input->post("content");

    if (!empty($content) and !empty($user_id)) {
      $ar = array(
        'user_id'         => $user_id,
        'video_link'    => $video_link,
        'review'       => $content
      );

      if (!empty($_FILES['image']['name'])) {
        $this->load->model("admin/upload_model");
        $ar = array_merge($ar, array('image_url' => $this->upload_model->image("image", 500)));
      }
      if (empty($ch_id)) {
        $this->database_model->insert('review', $ar);
      } else {
        $this->database_model->update('review', $ar, $ch_id);
      }

      echo 'ok';
    } else {
      echo "Bütün Xanalar Doldurlmalıdır!";
    }
  }

  //get_image($result['image']);
  public function delete()
  {
    $id = $this->input->post('id');

    if (!empty($id) and $id != 0) {
      $this->database_model->delete('review', $id);
      echo json_encode(array('msg' => 'Silindi'));
    }
  }

  public function settings()
  {
    $ch_id = $this->input->post('ch_id');
    $share = $this->input->post('share');
    $num = $this->input->post('num');
    $ar = array('share' => false, 'num' => $num);
    if (isset($share) and $share == 1) {
      $ar['share'] = true;
    }
    $this->database_model->update('review', $ar, $ch_id);

    echo 'ok';
  }
}

<?php
class promo extends CI_Controller
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
    $string = $this->home_model->string();
    $content = '
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title col-md-4">' . $string['promo'] . '</h4>
                  ' . $this->admin_model->get_page_button('promo', false, true, true) . '
                  <p class="card-category">' . $string['promo_list'] . '</p>
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
                            Type
                        </th>
                        <th>
                        ' . $string['promo_url'] . '
                        </th>
                        <th>
                        </th>
                      </thead>
                      <tbody id="promo">
                        
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
    <form method="post" action="' . base_url() . 'admin/promo/add">
     <input type="hidden" name="ch_id" value="0"/>

     <div class="col-12">
     <div class="form-group ">
     <label class="bmd-label-static">' . $string['choose_promo_place'] . '</label>
     <select name="type" type="text" class="form-control">
     <option value="0">--' . $string['choosed'] . '--</option>
     <option value="reklam_1">' . $string['promo_organizer'] . '</option>
     <option value="reklam_2">' . $string['promo_jobs'] . '</option>
     <option value="reklam_3">' . $string['promo_media'] . '</option>
     </select>
     </div>
     </div>
     
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['choose_promo_url'] . '</label>
        <input data-title name="url_tag" type="text" class="form-control">
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
    $content .= $this->modal_model->dialog($html, 'promo_panel', 'md', $string['save']);
    $html = '<form method="post" action="' . base_url() . 'admin/promo/settings" enctype="multipart/form-data">
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
    $content .= $this->modal_model->dialog($html, 'promo_settings', 'md', $string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }


  public function read()
  {
    $string = $this->home_model->string();
    $content = '';
    $n = 0;
    $ar = $this->database_model->read('promo');
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
    </td>
        <td><img src="' . get_image($a['image']) . '" class="table-image"/></td>';
      $content .= '
        <td>';
      if ($a['type'] == 'reklam_1') {
        $content .= $string['promo_organizer'];
      }
      if ($a['type'] == 'reklam_2') {
        $content .= $string['promo_jobs'];
      }
      if ($a['type'] == 'reklam_3') {
        $content .= $string['promo_media'];
      }
      $content .= '</td>
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

  public function read_row()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $result = $this->database_model->read_row('promo', $id);
      $result['image'] = get_image($result['image']);
      echo json_encode($result);
    }
  }


  public function add()
  {
    $ch_id = $this->input->post('ch_id');
    $type = $this->input->post("type");
    $url_tag = set_link($this->input->post("url_tag"));
    $result = $this->front_database_model->front_read('promo', array('type' => $type));
    $sayi = count($result);


    if (!empty($type) and !empty($url_tag)) {
      $ar = array(
        'type' => $type,
        'url_tag' => $url_tag,
        'share' => false
      );
      if (!empty($_FILES['image']['name'])) {
        $this->load->model("admin/upload_model");
        $ar = array_merge($ar, array('image' => $this->upload_model->image("image", 500, 200)));
      }
      $ar1 = array(
        'url_tag' => $url_tag
      );
      if (!empty($_FILES['image']['name'])) {
        $this->load->model("admin/upload_model");
        $ar1 = array_merge($ar1, array('image' => $this->upload_model->image("image", 500, 200)));
      }

      if (empty($ch_id) and empty($result)) {
        $this->database_model->insert('promo', $ar);
        echo 'ok';
      } else {
        if (!empty($ch_id) and !empty($result[0]['type'])) {
          // echo $result[0]['type'];
          // die;
          // echo $sayi;
          // die;
          if ($sayi == 2 and $result[0]['type'] != 'reklam_1') {
            if ($sayi == 2 and $result[0]['type'] == 'reklam_2') {

              $this->database_model->update('promo', $ar1, $ch_id);
              echo 'ok';
            }
            if ($sayi == 2 and $result[0]['type'] == 'reklam_3') {

              $this->database_model->update('promo', $ar1, $ch_id);
              echo 'ok';
            }
          } else {
            // echo $result[0]['type'];
            // die;
            if ($result[0]['type'] == 'reklam_1' and $sayi == 1) {
              $this->database_model->update('promo', $ar1, $ch_id);
              echo 'ok';
            } else {

              if ($sayi == 2 and $result[0]['type'] == 'reklam_2') {
                $this->database_model->update('promo', $ar1, $ch_id);
                echo 'ok';
              } else {
                if ($sayi == 2 and $result[0]['type'] == 'reklam_3') {
                  $this->database_model->update('promo', $ar1, $ch_id);
                  echo 'ok';
                } else {

                  $this->database_model->update('promo', $ar, $ch_id);
                  echo 'ok';
                }
              }
            }
          }
        } else {
          if (!empty($result[0]['type'])) {

            if ($result[0]['type'] != 'reklam_1' and $sayi == 2) {
              echo "Organizerdən Başqa Digər Reklamlar 2-dən Çox Olmamalıdı !!";
            } else {
              if ($result[0]['type'] == 'reklam_1') {

                $this->database_model->update('promo', $ar, $result[0]['id']);
                echo 'ok';
              } else {

                $this->database_model->insert('promo', $ar);
                echo 'ok';
              }
            }
          } else {

            $result1 = $this->front_database_model->front_read('promo', array('id' => $ch_id));
            $sayi1 = count($result1);
            if ($result1[0]['type'] == 'reklam_1') {

              $this->database_model->update('promo', $ar, $result1[0]['id']);
              echo 'ok';
            } else {
              if ($sayi != 2) {

                $this->database_model->update('promo', $ar, $ch_id);
                echo 'ok';
              } else {
                echo "Organizerdən Başqa Digər Reklamlar 2-dən Çox Olmamalıdı !!";
              }
            }
          }
        }
      }
      //Xanalar Bosdusa Duseceyi sert
    } else {
      echo "Reklam Yerini ve  Url-ni Yazın!";
    }
  }


  public function delete()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $this->database_model->delete('promo', $id);
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
    $this->database_model->update('promo', $ar, $ch_id);

    echo 'ok';
  }
}

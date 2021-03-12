<?php
class countries extends CI_Controller
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
                  <h4 class="card-title col-md-4">' . $string['countries'] . '</h4>
                  ' . $this->admin_model->get_page_header() . $this->admin_model->get_page_button('countries', true, true, true) . '
                 
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
                        ' . $string['name'] . '
                        </th>
                        <th>
                        ' . $string['rank'] . '
                        </th>                        
                        <th>
                        ' . $string['cv_language'] . '
                        </th>
                        <th>
                        </th>
                      </thead>
                      <tbody id="countries">
                        
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
    <form method="post" action="' . base_url() . 'admin/countries/add" enctype="multipart/form-data">
     <input type="hidden" name="ch_id" value="0"/>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['name'] . '</label>
        <input name="title" type="text" class="form-control">
     </div>
     </div>
    
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['cities'] . '</label>
        <textarea name="cityes" style="height:400px !important;" placeholder="example,example2,example3" class="form-control"></textarea>
     </div>
     </div>

    </form>
     ';
    $content .= $this->modal_model->dialog($html, 'countries_panel', 'md', $string['save']);


    $html = '<form method="post" action="' . base_url() . 'admin/countries/settings" enctype="multipart/form-data">
     <input type="hidden" value="0" name="ch_id"/>

     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label>' . $string['ranking'] . '</label>
        <select name="num" type="text" class="form-control">
        <option value="0">--' . $string['choosed'] . '--</option>
        ';
    for ($n = 1; $n < 200; $n++) {
      $html .= '<option value="' . $n . '">' . $n . '</option>';
    }
    $html .= '
        </select>
     </div>
     </div>
 

      <div class="col-4" style="margin-top:20px;">
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
    $content .= $this->modal_model->dialog($html, 'countries_settings', 'md', $string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }


  public function read()
  {
    $content = '';
    $n = 0;
    $ar = $this->database_model->read('countries');

    foreach ($ar as $a) {
      $lang      = $this->admin_model->get_lang($a['l_id']);
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
        <td>' . $a['title'] . '</td>
        <td>' . $a['num'] . '</td>
        <td>' . $lang['url_tag'] . '</td>
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
      $result = $this->database_model->read_row('countries', $id);
      $cityes = $this->database_model->read_array('cityes', array('country_id' => $result['country_id']));
      $result['cityes'] = '';
      foreach ($cityes as $city) {
        $result['cityes'] .= $city['title'] . ',';
      }
      echo json_encode($result);
    }
  }
  public function add()
  {
    $ch_id              = $this->input->post('ch_id');
    $title              = $this->input->post("title");
    $cityes             = $this->input->post('cityes');
    $country_id        = time();

    if (!empty($title)) {
      $ar = array(
        'title'       => $title,
      );


      if (empty($ch_id)) {
        $ar = array_merge($ar, array('country_id' => $country_id));
        $this->database_model->insert('countries', $ar);
      } else {
        $country_id = $this->database_model->read_row('countries', $ch_id)['country_id'];
        $this->database_model->update('countries', $ar, $ch_id);
      }

      if (!empty($country_id)) {
        $cityes = explode(',', $cityes);
        $i = 0;
        $this->database_model->delete_array('cityes', array('country_id' => $country_id));
        foreach ($cityes as $c) {
          $i++;
          $br = array(
            'title'       => $c,
            'country_id'  => $country_id,
            'city_id'     => $country_id + $i
          );
          $this->database_model->insert('cityes', $br);
        }
      }

      echo 'ok';
    } else {
      echo "Sənaye adını və linkini daxil edin!";
    }
  }


  public function delete()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $this->database_model->delete('countries', $id);
      echo json_encode(array('msg' => 'Silindi'));
    }
  }
  public function copy_row()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $column = array('share', 'country_id', 'l_id', 'title', 'num');
      $this->database_model->copy_row('countries', $column, $id);
      echo json_encode(array('msg' => 'Sənaye kopyalandı'));
    }
  }
  public function settings()
  {
    $ch_id                = $this->input->post('ch_id');
    $num                  = $this->input->post('num');
    $share                = $this->input->post('share');

    $ar = array(
      'num'                   => $num,
    );
    if (isset($share) and $share == 1) {
      $ar['share'] = true;
    }

    $this->database_model->update('countries', $ar, $ch_id);
    echo 'ok';
  }
}

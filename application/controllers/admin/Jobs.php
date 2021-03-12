<?php
class jobs extends CI_Controller
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
                  <h4 class="card-title col-md-4">' . $string['jobs'] . '</h4>
                  ' . $this->admin_model->get_page_header() . $this->admin_model->get_page_button('jobs', false, true, true) . '
                  
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
                        ' . $string['job_graphic'] . '
                        </th>
                        <th>
                        ' . $string['name'] . '
                        </th>
                        <th>
                        ' . $string['email'] . '
                        </th>
                        <th>
                        ' . $string['ranking'] . '
                        </th>
                        
                        <th>
                        </th>
                      </thead>
                      <tbody id="jobs">
                        
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
    <form method="post" action="' . base_url() . 'admin/jobs/add">
    <input type="hidden" value="0" name="ch_id"/>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['vacancy_name'] . '</label>
        <input data-title name="vacancy_name" type="text" class="form-control">
     </div>
     </div>
     

     <div class="col-12" style="padding:10px 0px 10px 0px;">
     <div class="form-group">
        <textarea  class="word" name="content"></textarea>
     </div>
     </div>
     

     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="bmd-label-static">' . $string['country_title'] . '</label>
        <select name="country_id" id="country" type="text" class="form-control">
        <option value="0">--' . $string['choosed'] . '--</option>
        ';
    foreach ($this->home_model->countries() as $o) {
      $html .= "<option value='" . $o['country_id'] . "'>" . $o['title'] . "</option>";
    }
    $html .= '
        </select>
        <div data-error="country_id"></div>
      </div>
      </div>
 
      <div class="col-6">
      <div class="form-group ">
         <label class="bmd-label-static">' . $string['city_title'] . ' </label>
         <select id="city" name="city_id" type="text" class="form-control">
         <option value="0">--' . $string['choosed'] . '--</option>
         </select>
         <div data-error="city_id"></div>
      </div>
      </div>


      <div class="col-12">
      <div class="form-group ">
      <label class="bmd-label-static">' . $string['enter_job_graphic'] . '</label>
      <select name="work_graphic" type="text" class="form-control">
      <option value="0">--' . $string['choosed'] . '--</option>
      <option value="full_time">' . $string['full_time'] . '</option>
      <option value="part_time">' . $string['part_time'] . '</option>
      <option value="freelancer">' . $string['freelancer'] . '</option>
      <option value="intern">' . $string['intern'] . '</option>
      </select>
      </div>
      </div>



      <div class="col-12">
      <div class="form-group bmd-form-group">
         <label class="bmd-label-static">' . $string['organizer'] . '</label>
         <select name="organizer_email" type="text" class="form-control">
         <option value="0">--' . $string['choosed'] . '--</option>
         ';
    foreach ($this->front_database_model->front_read('users', array('type' => 'company')) as $o) {
      if ($o['status'] == 'true') {
        $html .= "<option value='" . $o['id'] . "'>" . $o['company'] . "</option>";
      }
    }
    $html .= '
         </select>
      </div>
      </div>

    </form>
     ';
    $content .= $this->modal_model->dialog($html, 'jobs_panel', 'lg', $string['save']);


    $html = '<form method="post" action="' . base_url() . 'admin/jobs/settings">
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
    $content .= $this->modal_model->dialog($html, 'jobs_settings', 'md', $string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }

  public function read()
  {
    $string = $this->home_model->string();
    $content = '';
    $n = 0;
    $ar = $this->database_model->read('jobs', array('num', 'DESC'));
    foreach ($ar as $a) {
      $data = $this->database_model->read_row('users', $a['user_id']);
      $say = count($data);
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
        </td>';
      $content .= '
        <td>';
      if ($a['work_graphic'] == 'full_time') {
        $content .= $string['full_time'];
      }
      if ($a['work_graphic'] == 'part_time') {
        $content .= $string['part_time'];
      }
      if ($a['work_graphic'] == 'freelancer') {
        $content .= $string['freelancer'];
      }
      if ($a['work_graphic'] == 'intern') {
        $content .= $string['intern'];
      }
      $content .= '</td>
        <td>' .  $a['vacancy_name'] . '</td>
        <td>';
      if ($say != 0) {
        $content .=  $data['email'];
      }
      $content .= '</td>
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
      $result = $this->database_model->read_row('jobs', $id);
      echo json_encode($result);
    }
  }
  public function add()
  {


    $ch_id          = $this->input->post('ch_id');
    $id          = $this->input->post('organizer_email');
    $city_id        = $this->input->post('city_id');
    $country_id     = $this->input->post('country_id');
    $content        = $this->input->post("content");
    $work_graphic   = $this->input->post("work_graphic");
    $vacancy_name   = $this->input->post('vacancy_name');
    if (empty($city_id)) {
      echo "Şəhər Boş Buraxılmamalıdır!";
      die;
    }
    if (!empty($vacancy_name) and !empty($content) and !empty($id)) {
      $ar = array(
        'city_id'          => $city_id,
        'country_id'       => $country_id,
        'description'      => $content,
        'work_graphic'     => $work_graphic,
        'vacancy_name'     => $vacancy_name,
        'user_id'          => $id
      );
      if (empty($ch_id)) {
        $this->database_model->insert('jobs', $ar);
      } else {
        $this->database_model->update('jobs', $ar, $ch_id);
      }

      echo 'ok';
    } else {
      echo "Xanalar Boş Buraxılmamalıdır!";
    }
  }

  //get_image($result['image']);
  public function delete()
  {
    $id = $this->input->post('id');

    if (!empty($id) and $id != 0) {
      $this->database_model->delete('jobs', $id);
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
    $this->database_model->update('jobs', $ar, $ch_id);

    echo 'ok';
  }



  public function read_events()
  {
    $id = $this->input->post('country_id');
    if (!empty($id)) {
      $result = $this->database_model->read_array('cityes', array('country_id' => $id));
      $html = '<option value="0">--Seçin--</option>';
      foreach ($result as $r) {
        $html .= '<option value="' . $r['city_id'] . '">' . $r['title'] . '</option>';
      }
      echo $html;
    }
  }
}

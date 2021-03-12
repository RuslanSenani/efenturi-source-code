<?php
class users extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
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
                  <h4 class="card-title col-md-4">' . $string['users'] . '</h4>
                  ' . $this->admin_model->get_page_button('users', false, true, true) . '
                  <p class="card-category">' . $string['user_list'] . '</p>
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
                        ' . $string['surname'] . '
                        </th>
                        <th>
                        ' . $string['email_title'] . '
                        </th>
                        <th>
                        ' . $string['company'] . '
                        </th>
                        <th>
                        ' . $string['ranking'] . '
                        </th>
                        <th>
                        </th>
                      </thead>
                      <tbody id="users">
                        
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
    <form method="post" action="' . base_url() . 'admin/users/add">
     <input type="hidden" name="ch_id" value="0"/>

     
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['name'] . '</label>
        <input name="firstname" type="text" class="form-control">
     </div>
     </div>

     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['surname'] . '</label>
        <input name="lastname" type="text" class="form-control">
     </div>
     </div>
     
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['email_title'] . '</label>
        <input name="email" type="text" class="form-control">
     </div>
     </div>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['location'] . '</label>
        <input name="location" type="text" class="form-control">
     </div>
     </div>

     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['company'] . '</label>
        <input name="company" type="text" class="form-control">
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
    $content .= $this->modal_model->dialog($html, 'users_panel', 'md', $string['save']);


    $html = '<form method="post" action="' . base_url() . 'admin/users/settings" enctype="multipart/form-data">
     <input type="hidden" value="0" name="ch_id"/>
    
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label>' . $string['status'] . '</label>
        <select name="status" type="text" class="form-control">
            <option value="true">' . $string['status_option_1'] . '</option>
            <option value="false">' . $string['status_option_4'] . '</option>
        </select>
      </div>
      </div>   

      <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="bmd-label-static">' . $string['ranking'] . '</label>
        <select name="num" type="text" class="form-control">
        <option value="0">--seçim--</option>
        ';
    for ($n = 1; $n < 51; $n++) {
      $html .= '<option value="' . $n . '">' . $n . '</option>';
    }
    $html .= '
        </select>
     </div>
     </div>

     </form>';
    $content .= $this->modal_model->dialog($html, 'users_settings', 'md', $string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }


  public function read()
  {

    $content = '';
    $n = 0;
    $ar = $this->database_model->read('users', array('num', 'DESC'));

    foreach ($ar as $a) {
      $n++;
      $content .= '<tr class="' . get_status($a['status']) . '">
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
        <td>' . $a['firstname'] . '</td>
        <td>' . $a['lastname'] . '</td>
        <td>' . $a['email'] . '</td>
        <td>' . $a['company'] . '</td>
        <td>' . $a['num'] . '</td>
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
      $result = $this->database_model->read_row('users', $id);
      $result['image'] = get_image($result['image']);
      echo json_encode($result);
    }
  }



  public function add()
  {
    $ch_id              = $this->input->post('ch_id');
    $firstname          = $this->input->post("firstname");
    $lastname           = $this->input->post("lastname");
    $email              = $this->input->post("email");
    $location           = $this->input->post('location');
    $company            = $this->input->post('company');

    if (!empty($firstname) and !empty($lastname) and !empty($email)) {
      $ar = array(
        'firstname'         => $firstname,
        'lastname'          => $lastname,
        'company'           => $company,
        'email'             => $email,
        'location'          => $location,
        'type'              => 'company',
        'date'              => date('Y-m-d H:i:s')

      );
      if (!empty($_FILES['image']['name'])) {
        $this->load->model("admin/upload_model");
        $ar = array_merge($ar, array('image' => $this->upload_model->image("image", 300)));
      }

      if (empty($ch_id)) {
        $this->database_model->insert('users', $ar);
      } else {
        $this->database_model->update('users', $ar, $ch_id);
      }
      echo 'ok';
    } else {
      echo "Məlumatları daxil edin!";
    }
  }








  public function delete()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $this->database_model->delete('users', $id);
      echo json_encode(array('msg' => 'Silindi'));
    }
  }

  public function settings()
  {
    $status                 = $this->input->post('status');
    $ch_id                  = $this->input->post('ch_id');
    $num                    = $this->input->post('num');
    $ar = array(
      'status'      => $status,
      'num'         => $num
    );
    $this->database_model->update('users', $ar, $ch_id);
    echo 'ok';
  }
}

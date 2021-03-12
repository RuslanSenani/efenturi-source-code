<?php
class mails extends CI_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model('admin/cpanel_model');        
        $this->admin_model->get_page_permission();
    }
    public function index(){
        $content= '
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title col-md-4">E-Mail</h4>
                  <p></p>
                  '.$this->admin_model->get_page_button('mails').'
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                        #
                        </th>
                        <th>
                            Email Hesabı
                        </th>
                        <th>
                            Yaddaş
                        </th>
                        <th>
                            İstifadə olunub
                        </th>
                        
                        <th>
                        </th>
                      </thead>
                      <tbody id="mails">
                        
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
     $html='
    <form method="post" action="'.base_url().'admin/mails/add" enctype="multipart/form-data">
     <input type="hidden" name="ch_id" value="0"/>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label>Mail</label>
        <input name="mail" type="text" class="form-control">
     </div>
     </div>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label>Şifrə</label>
        <input name="password" type="text" class="form-control">
     </div>
     </div>
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label>Yaddaş</label>
        <select name="quota" type="text" class="form-control">
        ';
        for($i=200;$i<10240;$i+=100){
            $html.='<option value="'.$i.'">'.$i.' MB</option>';
        }
    $html.='
        <option value="unlimited">Limitsiz</option>
        </select>
     </div>
     </div>
     
    </form>
     ';
     $content.=$this->modal_model->dialog($html,'mails_panel','md');
     
     $content.=$this->modal_model->delete();
     $this->admin_model->show($content);
    }


    public function read(){
      $content='';
      $n=0;
      $ar=$this->cpanel_model->list_mails();
      foreach($ar as $a)
      {
      
        $n++;
        $content.='<tr>
        <td class="number-rel">
        '.$n.'
        </td>
        <td>
        '.$a->email.'
        </td>
        <td>
        '.$a->txtdiskquota.($a->txtdiskquota=='unlimited'?'':' MB').'
        </td>
        <td>
        '.$a->diskused.' MB
        </td>
        <td class="text-right">
        <div class="btn-group">
          <a class="btn-link btn btn-sm " target="_balnk" href="http://'.$this->config->item('cpanel_domain').'/webmail">
            <i class="material-icons">link</i>
          </a>
          <button id="'.$a->email.'" class="btn-link btn btn-sm btn-danger"><i class="material-icons">delete_forever</i></button>
        </div>
        </td>
        </tr>';
      }
      echo json_encode(array('content'=>$content));
    }



    public function add(){
        $mail       =$this->input->post('mail');
        $password   =$this->input->post('password');
        $quota      =$this->input->post('quota');
        
        if(!empty($mail) and !empty($password)){
            $result=$this->cpanel_model->add_mails($mail,$password,$quota);
            if($result){
                echo 'ok';
            }
            else {
                echo 'Mail yaratmaq mümkün olmadı';
            }
        }
        else{
            echo 'Mail və şifrə xanasını doldurun!';
        }
    }


    public function delete(){
      $id=$this->input->post('id');
      if(!empty($id))
      {
        $this->cpanel_model->delete_mails($id);
        echo json_encode(array('msg'=>'Silindi'));
      }
    }


}

?>
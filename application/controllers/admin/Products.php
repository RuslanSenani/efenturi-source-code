<?php
class products extends CI_Controller
{
    public function index(){
       
        $content= '
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title col-md-4">Məhsullar</h4>
                  '.$this->admin_model->get_page_header().$this->admin_model->get_page_button('products',true,true,true).'
                 
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
                            Şəkil
                        </th>
                        <th>
                            Ad
                        </th>
                        <th>
                            Marka / Model
                        </th>
                        <th>
                            Qiymət
                        </th>
                        
                        <th>
                            Dil
                        </th>
                        <th>
                        </th>
                      </thead>
                      <tbody id="products">
                        
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
    <form method="post" action="'.base_url().'admin/products/add" enctype="multipart/form-data">
     <input type="hidden" name="ch_id" value="0"/>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">Ad</label>
        <input name="title" type="text" class="form-control">
     </div>
     </div>
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">Link</label>
        <input name="url_tag" type="text" class="form-control">
     </div>
     </div>

     <div class="col-4">
     <div class="form-group">
        <label class="">Kateqorya</label>
        <select name="category_id" class="form-control">';
        foreach($this->database_model->read('categories',array('id','desc'),'category_id') as $category){
          $html.='<option value="'.$category['category_id'].'">'.$category['title'].'</option>';
        }
    $html.='</select>
     </div>
     </div>

     <div class="col-4">
     <div class="form-group bmd-form-group">
        <label class="">Marka</label>
        <input name="brand" type="text" class="form-control">
     </div>
     </div>
     <div class="col-4">
     <div class="form-group bmd-form-group">
        <label class="">Model</label>
        <input name="model" type="text" class="form-control">
     </div>
     </div>
     <div class="col-4">
     <div class="form-group bmd-form-group">
        <label class="">Qiymət</label>
        <input name="price" type="number" step="0.1" class="form-control">
     </div>
     </div>
     <div class="col-4">
     <div class="form-group bmd-form-group">
        <label class="">Endirim</label>
        <input name="discount" type="number" step="0.1" class="form-control">
     </div>
     </div>

    
     <div class="col-4">
     <div class="form-group bmd-form-group">
        <label class="">Status</label>
        <select name="status" class="form-control">
          <option value="">--seçim--</option>
          <option value="sale">Endirim</option>
          <option value="new">Yeni</option>
        </select>
     </div>
     </div>
     
     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">Ölçü</label>
        <textarea name="size" class="form-control"></textarea>
     </div>
     </div>

     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">Rəng</label>
        <textarea name="color" class="form-control"></textarea>
     </div>
     </div>
     
     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">Açıqlama  <b id="page_description"></b></label>
        <input data-description name="description" type="text" class="form-control"/>
     </div>
     </div>

     <div class="col-12" style="padding:10px 0px 10px 0px;">
     <div class="form-group">
        <textarea  class="word" name="content"></textarea>
     </div>
     </div>
     
      <div class="form-check">
      <label class="form-check-label">
         <input class="form-check-input" name="add_logo"  type="checkbox" value="1">
         Loqo Əlavə Et
         <span class="form-check-sign">
             <span class="check"></span>
         </span>
      </label>
      </div>

     <div class="col-12">
     <div class="form-image"></div>
     <div class="input-group">
      <div class="custom-file">
        <input multiple type="file" name="image[]" class="custom-file-input" id="image" aria-describedby="inputGroupFileAddon01">
        <label class="custom-file-label" for="image">Choose file</label>
      </div>
    </div>
    </div>
    </form>
     ';
     $content.=$this->modal_model->dialog($html,'products_panel','lg');

     
     $html='<form method="post" action="'.base_url().'admin/products/settings" enctype="multipart/form-data">
     <input type="hidden" value="0" name="ch_id"/>
     

     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label>Dil</label>
        <select name="l_id" type="text" class="form-control">
        <option value="0">--bütün dillər--</option>
        ';
      $lang=$this->database_model->read("language");
      foreach($lang as $l)
      {
        $html.="<option value='".$l['id']."'>".$l['title']." (".$l['url_tag'].")</option>";
      }
      $html.='
        </select>
      </div>
      </div>

      <div class="col-12">
     <div class="form-group bmd-form-group">
        <label>Sıralama</label>
        <select name="num" type="text" class="form-control">
        <option value="0">--seçim--</option>
        ';
        for($n=1;$n<200;$n++)
        {
          $html.='<option value="'.$n.'">'.$n.'</option>';
        }
        $html.='
        </select>
     </div>
     </div>

      <div class="col-4" style="margin-top:20px;">
      <div class="form-check">
      <label class="form-check-label">
         <input class="form-check-input" name="share"  type="checkbox" value="1">
         Paylaş
         <span class="form-check-sign">
             <span class="check"></span>
         </span>
      </label>
      </div>
      </div>

      <div class="col-4" style="margin-top:20px;">
      <div class="form-check">
      <label class="form-check-label">
         <input class="form-check-input" name="home"  type="checkbox" value="1">
         Ana Səhifə
         <span class="form-check-sign">
             <span class="check"></span>
         </span>
      </label>
      </div>
      </div>
    
     </form>';
     $content.=$this->modal_model->dialog($html,'products_settings','md');
     $content.=$this->modal_model->delete();
     $this->admin_model->show($content);
    }


    public function read(){
      $content='';
      $n=0;
      $ar       =$this->database_model->read('products');
      
      foreach($ar as $a)
      {
        $image   =$this->database_model->read_row('products_image',array('product_id'=>$a['product_id']));
        $lang      =$this->admin_model->get_lang($a['l_id']);
        $n++;
        $content.='<tr class="'.get_status($a['share']).'" data-lang="'.$a['l_id'].'">
        <td>
        <div class="number">'.$n.'</div>
        <div class="form-check">
        <label class="form-check-label">
          <input id="'.$a['id'].'" class="form-check-input" name="seo_index"  type="checkbox" value="1">
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
        </label>
        </div>
        </td>
        <td><img class="table-image" src="'.get_image($image['image']).'"/></td>
        <td>'.$a['title'].'</td>
        <td>'.$a['brand'].' / '.$a['model'].' </td>
        <td>'.$a['price'].' AZN  <b class="text-success"> ('.$a['discount'].' AZN)</b></td>
        <td>'.$lang['url_tag'].'</td>
        <td class="text-right">
        <div class="btn-group">
        <button id="'.$a['id'].'" class="btn btn-link btn-sm btn-primary"><i class="material-icons">settings</i></button>
        <button id="'.$a['id'].'" class="btn btn-link btn-sm btn-info"><i class="material-icons">file_copy</i></button>
        <button id="'.$a['id'].'" class="btn btn-link btn-sm btn-warning"><i class="material-icons">edit</i></button>
        <button id="'.$a['id'].'" class="btn btn-link btn-sm btn-danger"><i class="material-icons">delete_forever</i></button>
        </div>
          </td>
        </tr>';
      }
      echo json_encode(array('content'=>$content));
    }


    
    public function read_row(){
      $id=$this->input->post('id');
      if(!empty($id) and $id!=0)
      {
        $result   =$this->database_model->read_row('products',$id);
        $images   =$this->database_model->read_array('products_image',array('product_id'=>$result['product_id']),array('num','asc'));
        $content='';

        $option='';
        
        
        foreach($images as $img){
          $content.='<div class="form-image-thumb">
          <img src="'.get_image($img['image']).'"/>
          <span id="'.$img['id'].'" class="material-icons">delete_forever</span>
          <select id="'.$img['id'].'">';

          for($i=1;$i<=count($images);$i++){
            $content.='<option '.($i==$img['num']?'selected':'').' value="'.$i.'">'.$i.'</option>';
          }

          $content.='</select>
          </div>';
        }
        $result['image']=$content;
        echo json_encode($result);
      }
    }


    public function add(){
        $ch_id              =$this->input->post('ch_id');
        $title              =$this->input->post("title");
        $category_id        =$this->input->post('category_id');
        $brand              =$this->input->post('brand');
        $model              =$this->input->post('model');
        $price              =$this->input->post('price');
        $discount           =$this->input->post('discount');
        $url_tag            =set_link($this->input->post("url_tag"));
        $description        =$this->input->post("description");
        $content            =$this->input->post("content");
        $status             =$this->input->post('status');
        $color              =$this->input->post('color');
        $size               =$this->input->post('size');
        $add_logo           =$this->input->post('add_logo');
        $product_id         =time();

        if(!empty($title) and !empty($url_tag) and !empty($category_id))
        {
            $ar=array(
                'title'           =>$title,
                'category_id'     =>$category_id,
                'url_tag'         =>$url_tag,
                'model'           =>$model,
                'brand'           =>$brand,
                'price'           =>$price,
                'discount'        =>$discount,
                'content'         =>$content,
                'description'     =>$description,
                'status'          =>$status,
                'color'           =>$color,
                'size'            =>$size
            );

            if(empty($ch_id))
            {
              $ar=array_merge($ar,array('product_id'=>$product_id));
              $this->database_model->insert('products',$ar);
            }
            else
            {
                $this->database_model->update('products',$ar,$ch_id);
            }


          //  fayl upload
          if(!empty($_FILES['image']['name'])){
            $this->load->model('admin/upload_model');
            $file       =$_FILES['image'];
            $length     =count($file['name']);

            if(!empty($ch_id)){
              $product_id =$this->database_model->read_row('products',$ch_id)['product_id'];
            }
          

            for($n=0;$n<$length;$n++)
            {

              $_FILES['fayl']['name']       =$file['name'][$n];
              $_FILES['fayl']['tmp_name']   =$file['tmp_name'][$n];
              $_FILES['fayl']['size']       =$file['size'][$n];
              $_FILES['fayl']['type']       =$file['type'][$n];
              $_FILES['fayl']['error']      =$file['error'][$n]; 
                      
            if(isset($add_logo) and $add_logo==1){
                $url=$this->upload_model->image('fayl',800,344,100,true);
            }
            else{
                $url=$this->upload_model->image('fayl',800,344,100,false);
            }
              
              $ar=array(
                    'image'       =>$url,
                    'product_id'  =>$product_id
                  );
              
              $this->database_model->insert('products_image',$ar);
              
              
            }
          }
       
            echo 'ok';
        }
        else
        {
            echo "Kateqorya adını və linkini daxil edin!";
        }
    }


    public function delete(){
      $id=$this->input->post('id');
      if(!empty($id) and $id!=0)
      {
        $result=$this->database_model->read_row('products',$id);
        //$this->database_model->delete_array('products_image',array('product_id'=>$result['product_id']));
        $this->database_model->delete('products',$id);
        echo json_encode(array('msg'=>'Silindi'));
      }
    }
    public function copy_row(){
      $id=$this->input->post('id');
      if(!empty($id) and $id!=0)
      {
          $column=array('share','product_id','category_id','l_id','title','url_tag','content','description','model','brand','price','discount','num');
          $this->database_model->copy_row('products',$column,$id);
          echo json_encode(array('msg'=>'Məhsul kopyalandı'));
      }
    }
    public function settings(){
      $l_id                 =$this->input->post('l_id');
      $ch_id                =$this->input->post('ch_id');
      $share                =$this->input->post('share');
      $home                 =$this->input->post('home');
      $num                  =$this->input->post('num');
      $ar=array(
        'l_id'                  =>$l_id,
        'num'                   =>$num,
        'share'                 =>false,
        'home'                  =>false
        );
      if(isset($share) and $share==1)
      {
        $ar['share']=true;
      }
      if(isset($home) and $home==1)
      {
        $ar['home']=true;
      }
      $this->database_model->update('products',$ar,$ch_id);
      echo 'ok';
    }

    ///image delete function 
    public function delete_image(){
      $id=$this->input->post('id');
      if(!empty($id) and is_numeric($id)){
        $this->database_model->delete('products_image',$id);
        echo 'ok';
      }
    }

    public function image_num(){
      $image_id =$this->input->post('image_id');
      $val=$this->input->post('val');
      if(!empty($image_id) and !empty($val)){
        $this->database_model->update('products_image',array('num'=>$val),$image_id);
        echo 'Redaktə edildi.';
      }
    }
    
}
?>
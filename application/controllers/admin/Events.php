<?php
class Events extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->admin_model->get_page_permission();
    $this->load->model('front/home_model');
    $this->load->model('front/front_database_model');
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
              <h4 class="card-title col-md-4">' . $string['event'] . '</h4>
              <p class="card-category">' . $string['events_list'] . '</p>
                ' . $this->admin_model->get_page_button('events', false, true, true) . '
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
                        ' . $string['event_name'] . '
                      </th>
                      <th>
                      ' . $string['order'] . '
                      </th>
                      <th>
                      ' . $string['send_request'] . '
                      </th>
                      <th>
                      </th>
                    </thead>
                    <tbody id="events">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>';
    $this->load->model('admin/modal_model');
    // $this->home_model->
    $html = '
   <form method="post" action="' . base_url() . 'admin/events/add" enctype="multipart/form-data">
    <input type="hidden" name="ch_id" value="0"/>
    <div class="col-12">
    <div class="form-group bmd-form-group">
       <label class="bmd-label-static">' . $string['organizer'] . '</label>
       <select name="user_id"type="text" class="form-control">
       <option value="0">--' . $string['choosed'] . '--</option>
       ';
    foreach ($this->front_database_model->front_read('users', array('type' => 'company')) as $o) {
      if ($o['status'] == 'true') {
        $html .= "<option value='" . $o['id'] . "'>" . $o['company'] . "</option>";
      }
    }
    $html .= '
       </select>
       <div data-error="country_id"></div>
     </div>
     </div>

    <div class="col-6">
    <div class="form-group bmd-form-group">
       <label class="bmd-label-static">' . $string['country_title'] . '</label>
       <select name="country_id" id="country" type="text" class="form-control">
       <option value="0">--' . $string['choosed'] . '--</option>
       ';
    foreach ($this->home_model->countries() as $o) {
      if ($o['share'] == 'true') {
        $html .= "<option value='" . $o['country_id'] . "'>" . $o['title'] . "</option>";
      }
    }
    $html .= '
       </select>
       <div data-error="country_id"></div>
     </div>
     </div>

     <div class="col-6">
     <div class="form-group ">
        <label class="bmd-label-static">' . $string['city_title'] . '</label>
        <select id="city" name="city_id" type="text" class="form-control">
        <option value="0">--' . $string['choosed'] . '--</option>
        </select>
        <div data-error="city_id"></div>
     </div>
     </div>



    <div class="col-12">
    <div class="form-group bmd-form-group">
       <label class="">' . $string['event_name'] . '</label>
       <input data-title name="title" type="text" class="form-control">
       <div data-error="title"></div>
    </div>
    </div>

    <div class="col-6">
    <div class="form-group bmd-form-group">
       <label class="">' . $string['date_title'] . '</label>
       <input name="date" id="txtDate1" type="date" class="form-control">
       <div data-error="date"></div>
    </div>
    </div>

    <div class="col-6">
    <div class="form-group bmd-form-group">
       <label class="">' . $string['oclock_title'] . '</label>
       <input name="time" type="time" class="form-control">
       <div data-error="time"></div>
    </div>
    </div> 



    <div class="col-6">
    <div class="form-group bmd-form-group">
       <label class="">' . $string['enddate_title'] . '</label>
       <input name="enddate" id="txtDate" type="date" class="form-control">
       <div data-error="enddate"></div>
    </div>
    </div>

    <div class="col-6">
    <div class="form-group bmd-form-group">
       <label class="">' . $string['endoclock_title'] . '</label>
       <input name="endtime" type="time" class="form-control">
       <div data-error="endtime"></div>
    </div>
    </div> 




<div class="col-6">
<div class="form-group bmd-form-group">
   <label class="bmd-label-static">' . $string['status_title'] . '</label>
   <select name="status_id"  type="text" class="form-control">
   <option value="active">' . $string['status_option_1'] . '</option>
   <option value="cancelled">' . $string['status_option_2'] . '</option>
   <option value="postponed">' . $string['status_option_3'] . '</option>
   </select>
   <div data-error="status_id"></div>
 </div>
 </div>

 	
 <div class="col-6">
 <div class="form-group bmd-form-group">
    <label class="bmd-label-static">' . $string['type_title'] . '</label>
    <select name="type_id"  type="text" class="form-control">
    ';
    foreach ($this->home_model->types() as $o) {
      if ($o['share'] == 'true') {
        $html .= "<option value='" . $o['type_id'] . "'>" . $o['title'] . "</option>";
      }
    }
    $html .= '
    </select>
    <div data-error="type_id"></div>
  </div>
  </div>



  <div class="col-6">
  <div class="form-group bmd-form-group">
     <label class="bmd-label-static">' . $string['entry_title'] . '</label>
     <select name="entry_id"  type="text" class="form-control">
     <option value="free">' . $string['entry_option_1'] . '</option>
     <option value="paid">' . $string['entry_option_2'] . '</option>
     </select>
     <div data-error="entry_id"></div>
   </div>
   </div>

   <div class="col-6">
   <div class="form-group bmd-form-group">
      <label class="bmd-label-static">' . $string['stream_title'] . '</label>
      <select name="stream_id"  type="text" class="form-control">
      ';
    foreach ($this->home_model->streams() as $o) {
      if ($o['share'] == 'true') {
        $html .= "<option value='" . $o['stream_id'] . "'>" . $o['title'] . "</option>";
      }
    }
    $html .= '
      </select>
      <div data-error="stream_id"></div>
    </div>
    </div>

    <div class="col-12">
    <div class="form-group bmd-form-group">
       <label class="bmd-label-static">' . $string['industry_title'] . '</label>
       <select name="industry_id"  type="text" class="form-control">
       
       ';
    foreach ($this->home_model->industry() as $o) {
      if ($o['share'] == 'true') {
        $html .= "<option value='" . $o['industry_id'] . "'>" . $o['title'] . "</option>";
      }
    }
    $html .= '
       </select>
       <div data-error="industry_id"></div>
     </div>
     </div>

     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['email_title'] . '</label>
        <input name="mail" type="email" class="form-control">
        <div data-error="mail"></div>
     </div>

     </div> 


     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['phone_title'] . '</label>
        <input name="phone" type="tel" class="form-control">
        <div data-error="phone"></div>
     </div>
     </div> 


     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['website_title'] . '</label>
        <input name="website" type="url" class="form-control">
        <div data-error="website"></div>
     </div>
     </div> 

     <div class="col-12" style="padding:10px 0px 10px 0px;">
     <div class="form-group">
        <textarea  class="word" name="content"></textarea>
        <div data-error="content"></div>
     </div>
     </div>

     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['facebook_title'] . '</label>
        <input name="facebook" type="url" class="form-control">
        <div data-error="facebook"></div>
     </div>
     </div> 


     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['twitter-title'] . '</label>
        <input name="twitter" type="url" class="form-control">
        <div data-error="twitter"></div>
     </div>
     </div> 


     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['linkedin_title'] . '</label>
        <input name="linkedin" type="url" class="form-control">
        <div data-error="linkedin"></div>
     </div>
     </div> 


     <div class="col-6">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['map_title'] . '</label>
        <input name="map" type="url" class="form-control">
        <div data-error="map"></div>
     </div>
     </div> 


     <div class="col-12">
     <div class="form-group bmd-form-group">
        <label class="">' . $string['event_video_title'] . '</label>
        <input name="video_link" type="url" class="form-control">
        <div data-error="video_link"></div>
     </div>
     </div> 
     <div class="col-12">
     <img class="form-image"/>
     <div class="input-group">
      <div class="custom-file">
        <input type="file" name="image[]" class="custom-file-input" id="image" aria-describedby="inputGroupFileAddon01">
        <label class="custom-file-label" for="image">Choose file</label>
        <div data-error="image"></div>
      </div>
    </div>
    </div>
    <div class="from-group for-chechbox row">
                        <div col-2>
                            <label id="att1">
                                <input type="checkbox" id="sndrqst1" name="send_request[]" value="attendee" />
                                <img src="' . get_img('1.png') . '">
                                <span></span>
                            </label>
                        </div>
                        <div col-2>
                            <label id="att2">
                                <input type="checkbox" id="sndrqst2" name="send_request[]" value="participant_booth" />
                                <img src="' . get_img('2.png') . '">
                                <span></span>
                            </label>
                        </div>
                        <div col-2>
                            <label id="att3">
                                <input type="checkbox" id="sndrqst3" name="send_request[]" value="speaker_pass" />
                                <img src="' . get_img('3.png') . '">
                                <span></span>
                            </label>
                        </div>
                        <div col-2>
                            <label id="att4">
                                <input type="checkbox"  id="sndrqst4" name="send_request[]" value="sponsorship_partner">
                                <img src="' . get_img('4.png') . '">
                                <span></span>
                            </label>
                        </div>
                        <div col-2>
                            <label id="att5">
                                <input type="checkbox" id="sndrqst5" name="send_request[]" value="media_partner">
                                <img src="' . get_img('5.png') . '">
                                <span></span>
                            </label>
                        </div>
                        <div col-2>
                            <label id="att6">
                                <input type="checkbox" id="sndrqst6" name="send_request[]" value="entry_ticket">
                                <img src="' . get_img('6.png') . '">
                                <span></span>
                            </label>
                        </div>
      </div>
   </form>
    ';
    $content .= $this->modal_model->dialog($html, 'events_panel', 'lg', $string['save']);


    $html = '<form method="post" action="' . base_url() . 'admin/events/settings">
   <input type="hidden" value="0" name="ch_id"/>
   <div class="col-12">
   <div class="form-group bmd-form-group">
      <label class="bmd-label-static">' . $string['ranking'] . '</label>
      <select name="num" type="text" class="form-control">
      <option value="0">--seçim--</option>
      ';
    for ($n = 1; $n < 21; $n++) {
      $html .= "<option value='" . $n . "'>" . $n . "</option>";
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
    $content .= $this->modal_model->dialog($html, 'events_settings', 'md', $string['save']);
    $content .= $this->modal_model->delete();
    $this->admin_model->show($content);
  }

  public function read()
  {
    $string = $this->home_model->string();
    $content = '';
    $n = 0;
    $ar = $this->database_model->read('events');
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
        <td><a target="_blank" class="nav-link" href="' . get_base_url($a['url_tag']) . '">' . $a['title'] . '</a></td>
        <td>' . $a['num'] . '</td>

        <td>
        <div class="col-12">
        <div class="form-group bmd-form-group">
           <select type="text" class="form-control">';
      $sorgu = $a['send_request'];
      $expodeversion = explode('"', $sorgu);
      $len = count($expodeversion);
      if ($sorgu != 'null') {
        foreach ($expodeversion as $key => $value) {
          if ($key == 0) {
            continue;
          } elseif ($key == $len - 1) {
            continue;
          } else {
            if ($value == ',') {
              continue;
            } else {
              if ($value == 'attendee') {
                $content .= "<option>" . $string['send_request_1']  . "</option>";
              }
              if ($value == 'participant_booth') {
                $content .= "<option>" . $string['send_request_2']  . "</option>";
              }
              if ($value == 'speaker_pass') {
                $content .= "<option>" . $string['send_request_3']  . "</option>";
              }
              if ($value == 'sponsorship_partner') {
                $content .= "<option>" . $string['send_request_4']  . "</option>";
              }
              if ($value == 'media_partner') {
                $content .= "<option>" . $string['send_request_5'] . "</option>";
              }
              if ($value == 'entry_ticket') {
                $content .= "<option>" . $string['send_request_6']  . "</option>";
              }
            }
          }
        }
      } else {
        $content .= "<option>" . $string['empty'] . "</option>";
      }



      $content .= '</select>
           <div data-error="status_id"></div>
         </div>
         </div>
         
         </td>

        <td class="text-right">
        <div class="btn-group">
        <button id="' . $a['id'] . '" class="btn-link btn btn-sm btn-primary"><i class="material-icons">settings</i></button>
        <button id="' . $a['id'] . '" class="btn btn-link btn-sm btn-info"><i class="material-icons">file_copy</i></button>
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
      echo json_encode($this->database_model->read_row('events', $id));
    }
  }

  public function copy_row()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $column = array('event_id', 'user_id', 'title', 'url_tag', 'date', 'time', 'enddate', 'endtime', 'country_id', 'city_id', 'status_id', 'type_id', 'entry_id', 'stream_id', 'industry_id', 'mail', 'phone', 'website', 'content', 'facebook', 'twitter', 'linkedin', 'map', 'video_link', 'send_request', 'share', 'num');
      $this->database_model->copy_row('events', $column, $id);
      echo json_encode(array('msg' => 'events kopyalandı'));
    }
  }


  public function delete()
  {
    $id = $this->input->post('id');
    if (!empty($id) and $id != 0) {
      $this->database_model->delete('events', $id);
      echo json_encode(array('msg' => 'Silindi'));
    }
  }


  public function settings()
  {
    $ch_id = $this->input->post('ch_id');
    $share = $this->input->post('share');
    $num = $this->input->post('num');
    $ar = array('share' => 'false', 'num' => $num);
    if (isset($share) and $share == 1) {
      $ar['share'] = 'true';
    }
    $this->database_model->update('events', $ar, $ch_id);

    echo 'ok';
  }

  public function read_events()
  {
    $id = $this->input->post('country_id');

    if (!empty($id)) {
      $result = $this->database_model->read_array('cityes', array('country_id' => $id));
      $html = '<option value="0">--seçim--</option>';
      foreach ($result as $r) {
        $html .= '<option id="choose" value="' . $r['city_id'] . '">' . $r['title'] . '</option>';
      }
      echo $html;
    }
  }

  public function Add()
  {
    // $ar = $this->database_model->read('events', array('num', 'desc'), 'id', array('id' => 7));
    // $rrrt = $ar[0]['send_request'];
    // $trrtrt = explode('"', $rrrt);
    // $len = count($trrtrt);
    // if ($rrrt != 'null') {
    //   foreach ($trrtrt as $key => $value) {
    //     if ($key == 0) {
    //       continue;
    //     } elseif ($key == $len - 1) {
    //       continue;
    //     } else {
    //       if ($value == ',') {
    //         continue;
    //       } else {
    //         echo $value;
    //         // if ($value != 'null') {
    //         //   echo $value;
    //         // } else {
    //         //   echo "Bosdu";
    //         // }
    //       }
    //     }
    //   }
    // } else {
    //   echo "Bosdu";
    // }
    // die;

    $ch_id        = $this->input->post('ch_id');
    $enddate      = $this->input->post('enddate');
    $endtime      = $this->input->post('endtime');
    $country_id   = $this->input->post('country_id');
    $city_id      = $this->input->post('city_id');
    $title        = $this->input->post('title');
    $date         = $this->input->post('date');
    $time         = $this->input->post('time');
    $status_id    = $this->input->post('status_id');
    $type_id      = $this->input->post('type_id');
    $entry_id     = $this->input->post('entry_id');
    $stream_id    = $this->input->post('stream_id');
    $industry_id  = $this->input->post('industry_id');
    $mail         = $this->input->post('mail');
    $phone        = $this->input->post('phone');
    $website      = $this->input->post('website');
    $content      = $this->input->post('content');
    $facebook     = $this->input->post('facebook');
    $twitter      = $this->input->post('twitter');
    $linkedin     = $this->input->post('linkedin');
    $map          = $this->input->post('map');
    $video_link   = $this->input->post('video_link');
    $send_request = $this->input->post('send_request');
    $user_id      = $this->input->post('user_id');
    // print_r($send_request);
    // die;
    if (!empty($user_id) and !empty($title)) {

      $result = array(
        'country_id'  => $country_id,
        'city_id'     => $city_id,
        'title'       => $title,
        'date'        => $date,
        'time'        => $time,
        'enddate'     => $enddate,
        'endtime'     => $endtime,
        'status_id'   => $status_id,
        'type_id'     => $type_id,
        'entry_id'    => $entry_id,
        'stream_id'   => $stream_id,
        'industry_id' => $industry_id,
        'mail'        => $mail,
        'phone'       => $phone,
        'website'     => $website,
        'content'     => $content,
        'facebook'    => $facebook,
        'twitter'     => $twitter,
        'linkedin'    => $linkedin,
        'map'         => $map,
        'video_link'  => $video_link

      );

      if (!empty($send_request)) {
        foreach ($send_request as $s) {
          if (!check_event_send_request($s)) {
            die;
          }
        }
      }

      if (empty($ch_id)) {

        $result['event_id']     = time();
        $result['url_tag']      = set_link($result['title']);
        $result['user_id']      = $user_id;
      } else {
        $result['event_id']     = $this->database_model->read_row('events', $ch_id)['event_id'];
        $result['url_tag']      = set_link($result['title']);
        $result['user_id']      = $user_id;
      }
      if (empty($ch_id)) {
        if (empty($_FILES['image']['name'])) {
          echo "Zehmət Olmasa Hadisənin Şəklin Əlavə Edin";
          die;
        }
      }


      if (!empty($_FILES['image']['name'])) {
        $this->load->model('admin/upload_model');
        $file       = $_FILES['image'];
        $length     = count($file['name']);
        if (!empty($ch_id)) {

          $result['event_id'] = $this->database_model->read_row('events', $ch_id)['event_id'];
        }
        for ($n = 0; $n < $length; $n++) {
          $_FILES['fayl']['name']       = $file['name'][$n];
          $_FILES['fayl']['tmp_name']   = $file['tmp_name'][$n];
          $_FILES['fayl']['size']       = $file['size'][$n];
          $_FILES['fayl']['type']       = $file['type'][$n];
          $_FILES['fayl']['error']      = $file['error'][$n];
          $url = $this->upload_model->image('fayl', 800, 200);
          $ar = array(
            'image'       => $url,
            'event_id'    => $result['event_id']
          );
        }
        if (empty($ch_id)) {
          $this->database_model->insert("events_image", $ar);
        } else {

          $this->database_model->update_image("events_image", $ar, $ar['event_id']);
        }
      }
      $result['send_request'] = json_encode($this->input->post('send_request'));
      if (empty($ch_id) and $ch_id == 0) {
        $result['share'] = 'false';
        $this->database_model->insert("events", $result);
      } else {
        $this->database_model->update("events", $result, $ch_id);
      }

      echo 'ok';
    } else {
      echo "Event Adi Ve Teskilat Secili Deyil";
    }
  }
}

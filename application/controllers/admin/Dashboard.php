<?php
class dashboard extends CI_Controller
{
  function __construct() {
    parent::__construct();
    $this->admin_model->get_page_permission();
  }

  /* public function all_change(){

    $this->load->model("admin/upload_model");

    $table_name ='portfolio';
    $height     =350;
    $pages=$this->database_model->front_read($table_name,array('share'=>1));
    foreach($pages as $p){
      if(!empty($p['image'])){
        $file_name=get_json($p['image'])->link;
        $url=$this->upload_model->resize_image($file_name,'webp',$height);

        $response = new StdClass;
        $response->thumb    = false;
        $response->webp     = true;
        $response->webp_url = $url;
        $response->link     = $file_name;
        $img=stripslashes(json_encode($response));
        $this->database_model->update($table_name,array('image'=>$img),$p['id']);

      }
    }
  } */


  public function index(){
    $this->get_data();
    //$this->admin_model->show();
  }
  public function read(){
    $start=$this->input->post('start');
    $end=$this->input->post('end');
    echo $start;
    $this->get_data($start,$end);
  }
  private function get_data($start='',$end=''){
    
    $s=date('Y-m-01');
    $e=date('Y-m-d');
    if(!empty($start)){
      $s=$start;
    }
    if(!empty($end)){
      $e=$end;
    }

    $this->load->config('gapi');
		$params = [ 'client_email' => $this->config->item('account_email'), 'key_file' => $this->config->item('p12_key') ];
		$this->load->library('gapi', $params);
		
		$ar=$this->gapi->requestReportData($this->config->item('ga_profile_id'), array('day'), array('sessions','users','pageviews','organicSearches','bounceRate','timeOnPage','pageValue'), 'day', '',$s,$e, 1, 500);
		$data['totalSessions']	  = $this->gapi->getSessions();
		$data['totalUsers']		    = $this->gapi->getUsers();
		$data['totalPageViews']	  = $this->gapi->getPageviews();
		$data['totalOrganik']	    = $this->gapi->getOrganicSearches();
		$data['totalBounce']	    = $this->gapi->getBounceRate();
    $data['metrics']		      = $ar;
    $data['pagename']         = $this->gapi->getResults();

/* */
    /* echo '<pre>';
    print_r($data['metrics']);
    die; */

    $high1=50;
    $high2=50;
    $high3=50;
    $m=25;
    $day='';
    $sessions='';
    $users='';
    $pageviews='';
    foreach($ar as $b){
      $day.=$b->dimensions['day'].' , ';
      $sessions.=$b->metrics['sessions'].' , ';
      $users.=$b->metrics['users'].' , ';
      $pageviews.=$b->metrics['pageviews'].' , ';

      if($b->metrics['sessions']>$high1){
        $high1=$b->metrics['sessions']+$m;
      }
      if($b->metrics['users']>$high2){
        $high2=$b->metrics['users']+$m;
      }
      if($b->metrics['pageviews']>$high3){
        $high3=$b->metrics['pageviews']+$m;
      } 
    }
    $day=rtrim($day,' , ');
    $sessions=rtrim($sessions,' , ');
    $users=rtrim($users,' , ');
    $pageviews=rtrim($pageviews,' , ');
    $content='
      <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">remove_red_eye</i>
              </div>
              <p class="card-category">Baxış sayı</p>
              <h3 class="card-title">'.$data['totalSessions'].'
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Son bir ay
              </div>
            </div>
            
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">person</i>
              </div>
              <p class="card-category">İstifadəçi sayı</p>
              <h3 class="card-title">'.$data['totalSessions'].'</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Son bir ay
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">pages</i>
              </div>
              <p class="card-category">Baxılan səhifə sayı sayı</p>
              <h3 class="card-title">'.$data['totalPageViews'].'</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Son bir ay
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="row">

      <div class="col-md-6">
      <div class="card card-chart">
        <div class="card-header card-header-info">
          <div class="ct-chart" id="dailySalesChart">
          </div>
        </div>
        <div class="card-body">
          <h4 class="card-title">Baxış sayı</h4>
        </div>
        <div class="card-footer">
        <div class="stats">
          <i class="material-icons">remove_red_eye</i> Maksimum '.($high1-$m).'
        </div>
        </div>

      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-chart">
        <div class="card-header card-header-warning">
          <div class="ct-chart" id="completedTasksChart">
          </div>
        </div>
        <div class="card-body">
          <h4 class="card-title">İstifadəçi sayı</h4>
        </div>
        <div class="card-footer">
        <div class="stats">
          <i class="material-icons">remove_red_eye</i> Maksimum '.($high2-$m).'
        </div>
        </div>

      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-chart">
        <div class="card-header card-header-success">
          <div class="ct-chart" id="websiteViewsChart">
         </div>
        </div>
        <div class="card-body">
          <h4 class="card-title">Gündəlik səhifə baxışı</h4>
        </div>
        <div class="card-footer">
        <div class="stats">
          <i class="material-icons">remove_red_eye</i> Maksimum '.($high3-$m).'
        </div>
        </div>

      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-chart">
        <div class="card-header card-header-primary">
          Tarix
        </div>
        <div class="card-body">
          <form action="'.base_url().'admin/dashboard/read" method="post" data-stop="true">
            <div class="col-6">
              <label>Start</label>
              <input type="date" name="start" value="'.date('Y-m-d').'" class="form-control"/>
            </div>
            <div class="col-6">
              <label>End</label>
              <input type="date" name="end" value="'.date('Y-m-d').'" class="form-control"/>
            </div>
            <input type="submit" value="Axtar" class="btn btn-primary" style="margin-top:30px;"/>
          </form>
        </div>

      </div>
    </div>
    

      </div>
    </div>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title col-md-4">Metrics</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Day
                        </th>
                        <th>
                            İstifadəçi sayı
                        </th>
                        <th>
                            Səhifə sayı
                        </th>
                        <th>
                          Organik axtarış
                        </th>
                      </thead>
                      <tbody id="pages">';
                        foreach($data['metrics'] as $metrics){
                            $content.='<tr><td>'.$metrics->dimensions['day'].'</td>
                            <td>'.$metrics->metrics['users'].'</td>
                            <td>'.$metrics->metrics['pageviews'].'</td>
                            <td>'.$metrics->metrics['organicSearches'].'</td>
                            </tr>';
                        }
                      $content.='</tbody>
                    </table>
                  </div>
                </div>
              
          </div>
        </div>
      ';
      $content.="
      <script>
      $(document).ready(function() {
      
        function initDashboardPageCharts() {
          if ($('#dailySalesChart').length != 0 || $('#completedTasksChart').length != 0 || $('#websiteViewsChart').length != 0) {
            /* ----------==========     Daily Sales Chart initialization    ==========---------- */
      
            dataDailySalesChart = {
              labels: [".$day."],
              series: [
                [".$sessions."]
              ]
            };
      
            optionsDailySalesChart = {
              lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
              }),
              low: 0,
              high:".$high1.", 
              chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
              },
            }
      
            var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);
      
            md.startAnimationForLineChart(dailySalesChart);
      
      
      
            /* ----------==========     Completed Tasks Chart initialization    ==========---------- */
      
            dataCompletedTasksChart = {
              labels: [".$day."],
              series: [
                [".$users."]
              ]
            };
      
            optionsCompletedTasksChart = {
              lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
              }),
              low: 0,
              high: ".$high2.", 
              chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
              }
            }
      
            var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);
      
            // start animation for the Completed Tasks Chart - Line Chart
            md.startAnimationForLineChart(completedTasksChart);
      
      
            /* ----------==========     Emails Subscription Chart initialization    ==========---------- */
      
            var dataWebsiteViewsChart = {
              labels: [".$day."],
              series: [
                [". $pageviews."]
      
              ]
            };
            var optionsWebsiteViewsChart = {
              axisX: {
                showGrid: false
              },
              low: 0,
              high: ".$high3.",
              chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
              }
            };
            var responsiveOptions = [
              ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                  labelInterpolationFnc: function(value) {
                    return value[0];
                  }
                }
              }]
            ];
            var websiteViewsChart = Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart, optionsWebsiteViewsChart, responsiveOptions);
      
            //start animation for the Emails Subscription Chart
            md.startAnimationForBarChart(websiteViewsChart);
          }
        }
      
      initDashboardPageCharts();

    });
      </script>
      ";
      $this->admin_model->show($content);

  }
}
?>
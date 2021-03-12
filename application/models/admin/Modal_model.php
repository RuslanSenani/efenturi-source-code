<?php
class modal_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('front/home_model');
  }
  public function dialog($content, $id, $size, $btn1 = 'Saxla')
  {
    $string = $this->home_model->string();
    $html = '
    <div class="modal fade" id="' . $id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-' . $size . '" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="col-6">
              <h5 class="modal-title"><b>' . $string['website_name'] . '</b></h5>
            </div>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ' . $content . '
          </div>
          <div class="modal-footer">
            <div class="col-4">
              <div class="progress" id="modal_progress">
                <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
              </div>
            </div>
            <div class="col-8 text-right">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">' . $string['close'] . '</button>
              <button type="button" data-id="' . $id . '" data-modal="ok" class="btn btn-success">' . $btn1 . '</button>
            </div>
          </div>
        </div>
      </div>
    </div>
        ';

    return $html;
  }





  public function delete()
  {
    $string = $this->home_model->string();
    $html = '
<div class="modal fade" id="delete_panel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">' . $string['website_name'] . '</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>' . $string['are_you_sure_to_delete'] . '</b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">' . $string['no'] . '</button>
        <button type="button" data-modal="ok" class="btn btn-danger">' . $string['yes'] . '</button>
      </div>
    </div>
  </div>
</div>
        ';
    return $html;
  }





  public function info($content, $id, $size = 'md')
  {
    $string = $this->home_model->string();
    $html = '
<div class="modal fade" id="' . $id . '"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-' . $size . '" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">' . $string['website_name'] . '</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ' . $content . '
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">' . $string['close'] . '</button>
      </div>
    </div>
  </div>
</div>
        ';
    return $html;
  }
}

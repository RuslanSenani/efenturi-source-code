<div class="modal fade" id="message_modal" tabindex="-1" role="dialog" aria-labelledby="message_modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Bildirişlər</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <?php foreach($message as $m):?>
          <div class="all-message">
          <div class="text-right">
          <button id="<?=$m['id'];?>" class="btn btn-sm btn-danger message-btn"><i class="material-icons">delete_forever</i></button>
          </div>
          <table class="table table-bordered table-striped table-sm">
            <tr>
              <th>Ad</th>
              <td><?=$m['name'];?></td>
            </tr>
            <tr>
              <th>Mail</th>
              <td><?=$m['mail'];?></td>
            </tr>
            <tr>
              <th>Mesaj</th>
              <td><?=$m['msg'];?></td>
            </tr>
            <tr>
              <th>Tarix</th>
              <td><?=$m['date'];?></td>
            </tr>
          </table>
          </div>
          <?php endforeach;?>

          <?php if(count($message)<=0):?>
            <div class="panel panel-info text-primary text-center">
              <h4>Bildirişiniz yoxdur.</h4>
            </div>
          <?php endif;?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
      </div>
    </div>
  </div>
</div>
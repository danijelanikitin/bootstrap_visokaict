<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLogin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Приступ</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <?php print $name; ?>
        </div>
        <div class="form-group">
            <?php print $pass;?>
        </div>
        <?php print $remember_me; ?>
        <div class="form-group hide">
            <?php print $rendered; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php print $btn_close; ?></button>
        <?php print $submit; ?>
      </div>
    </div>
  </div>
</div>



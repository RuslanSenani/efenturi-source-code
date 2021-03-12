



<footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, 
            powered by <a href="https://www.correcttechno.com">Correct Technology</a>
          </div>
        </div>
      </footer>
    </div>
  </div>
 
  <!--   Core JS Files   -->
  
  <script src="<?=base_url();?>assets/admin_js/core/jquery.form.js"></script>
  <script src="<?=base_url();?>assets/admin_js/core/popper.min.js"></script>
  <script src="<?=base_url();?>assets/admin_js/core/bootstrap-material-design.min.js?ver=1.1"></script>
  <script src="<?=base_url();?>assets/admin_js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="<?=base_url();?>assets/admin_js/plugins/moment.min.js"></script>
  <script src="<?=base_url();?>assets/admin_js/plugins/sweetalert2.js"></script>
  <script src="<?=base_url();?>assets/admin_js/plugins/jquery.validate.min.js"></script>-->
  <script src="<?=base_url();?>assets/admin_js/plugins/jquery.bootstrap-wizard.js"></script>
  <script src="<?=base_url();?>assets/admin_js/plugins/bootstrap-selectpicker.js"></script>
  <script src="<?=base_url();?>assets/admin_js/plugins/bootstrap-datetimepicker.min.js"></script>
  <script src="<?=base_url();?>assets/admin_js/plugins/bootstrap-tagsinput.js"></script>
  <script src="<?=base_url();?>assets/admin_js/plugins/jasny-bootstrap.min.js"></script>
  <script src="<?=base_url();?>assets/admin_js/plugins/arrive.min.js"></script>
  <script src="<?=base_url();?>assets/admin_js/plugins/bootstrap-notify.js"></script>
  <script src="<?=base_url();?>assets/admin_js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/admin_js/plugins/jquery.dataTables.min.js"></script>
  <script src="<?=get_script('admin_js/my_script.js');?>"></script>
  
 
  <?php echo $script;?>
  <!--editor js-->
  
<script type="text/javascript" src="<?=base_url();?>assets/word/js/froala_editor.min.js" ></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/align.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/char_counter.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/code_beautifier.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/code_view.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/colors.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/draggable.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/emoticons.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/entities.min.js"></script>
<!--<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/file.min.js"></script>-->
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/font_size.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/font_family.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/fullscreen.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/image.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/image_manager.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/line_breaker.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/inline_style.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/link.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/lists.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/paragraph_format.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/paragraph_style.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/quick_insert.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/quote.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/table.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/save.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/url.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/video.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/help.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/third_party/spell_checker.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/special_characters.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/word/js/plugins/word_paste.min.js"></script>
<script>
    $(function(){
      $(".word").froalaEditor({
        language: "tr",
        heightMin:300,
        // Set the image upload parameter.
        imageUploadParam: "image_file",
        videoUploadParam: "video_file",
        // Set the image upload URL.
        imageUploadURL: "<?=base_url();?>admin/file/upload_image",
        videoUploadURL: "<?=base_url();?>admin/file/upload_video",
        // Additional upload params.
        imageUploadParams: {id: "word"},
        videoUploadParams: {id: "word"},
        // Set request type.
        imageUploadMethod: "POST",
        videoUploadMethod: "POST",
        // Set max image size to 5MB.
        imageMaxSize: 5 * 1024 * 1024,
        videoMaxSize: 50 * 1024 * 1024,
        // Allow to upload PNG and JPG,
        imageAllowedTypes: ["jpeg", "jpg", "png"],
        videoAllowedTypes: ["3gp", "mp4", "ogg"]
      })
      
    });
  </script>

  
</body>

</html>

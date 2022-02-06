        <footer id="footer">
          <div class="pull-right">
            &copy; copyright <?php echo date('Y');?> Developed  by <a href="https://farjan.dev/" target="_blank">Dev Farjan</a>
          </div>
          <div class="clearfix"></div>
        </footer>
      </div>
    </div>

    <script src="js/flipclock.js"></script>
    <script src="../build/js/bootstrap.min.js"></script>
    <script src="../build/js/jquery.dataTables.min.js"></script>
    <script src="../build/js/dataTables.bootstrap.min.js"></script>
    <script src="../build/js/dataTables.buttons.min.js"></script>
    <script src="../build/js/buttons.bootstrap.min.js"></script>
    <script src="../build/js/buttons.flash.min.js"></script>
    <script src="../build/js/buttons.html5.min.js"></script>
    <script src="../build/js/buttons.print.min.js"></script>
    <script src="../build/js/dataTables.fixedHeader.min.js"></script>
    <script src="../build/js/dataTables.keyTable.min.js"></script>
    <script src="../build/js/dataTables.responsive.min.js"></script>
    <script src="../build/js/responsive.bootstrap.js"></script>
    <script src="../build/js/dataTables.scroller.min.js"></script>
    <script src="../build/js/fastclick.js"></script>
    <script src="../build/js/nprogress.js"></script>
    <script src="../build/js/Chart.min.js"></script>
    <script src="../build/js/bootstrap-progressbar.min.js"></script>
    <script src="../build/js/icheck.min.js"></script>
    <script src="../build/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../build/js/jquery.hotkeys.js"></script>
    <script src="../build/js/prettify.js"></script>
    <script src="../build/js/moment.min.js"></script>
    <script src="../build/js/daterangepicker.js"></script>   
    <script src="../build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../build/js/bootstrap-colorpicker.min.js"></script>
    <script src="../build/js/jquery.tagsinput.js"></script>
    <script src="../build/js/switchery.min.js"></script>
    <script src="../build/js/pnotify.js"></script>
    <script src="../build/js/pnotify.buttons.js"></script>
    <script src="../build/js/pnotify.nonblock.js"></script>
    <script src="../build/js/jquery.easypiechart.min.js"></script>
    <script src="../build/js/jquery.sparkline.min.js"></script>
    <script src="../build/js/select2.full.min.js"></script>
    <script src="../build/js/parsley.min.js"></script>
    <script src="../build/js/autosize.min.js"></script>
    <script src="js/cal.js"></script>
    <script src="../build/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../build/js/jquery.autocomplete.min.js"></script>
    <script src="../build/js/starrr.js"></script>
    <script src="../build/js/raphael.min.js"></script>
    <script src="../build/js/morris.min.js"></script>
    <script src="js/fakeLoader.min.js"></script>
    <script src="../build/js/chosen.jquery.min.js"></script>

    <?php if($farjan->animate != "Off"){?>
    <script>
        $(document).ready(function(){
            var ani = '<?php 
            if ($farjan->animate == 'Random') {
                $arr = array('spinner1','spinner2','spinner3','spinner4','spinner5','spinner6');
                shuffle($arr);
                echo $arr[0];
            }else{
                echo strtolower($farjan->animate);
            }
            ?>';
            $(".fakeloader").fakeLoader({
                timeToHide:800,
                bgColor:"#34495e",
                spinner:ani
            });
        });
    </script>

    <?php } ?>
    <script src="../build/js/custom.min.js"></script>

    <script type="text/javascript">
      $(function(){
        $(".chosen-select").chosen();
        $('#message123').fadeOut(4000);
        $("#togglecal").click(function(){
            $(".cal123").slideToggle(1000);
            $(".cal456").hide(1000);
        });
        $("#togglecon").click(function(){
            $(".cal456").slideToggle(1000);
            $(".cal123").hide(1000);
        });
        $(window).scroll(function(){
            if($(this).scrollTop() > 180){
                $(".cal123").fadeOut(1000);
                $(".cal456").fadeOut(1000);
            }
        });
        $(".cm_sq").keyup(function(){
            var cm_sq = $(this).val();
            var result125 = cm_sq*0.00107639;
            $(".ft_sq").val(result125);
        });
        $(".ft_sq").keyup(function(){
            var ft_sq = $(this).val();
            var result125 = ft_sq/0.00107639;
            $(".cm_sq").val(result125);
        });
      });
      function toggleFullScreen() {
      if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
       (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {  
          document.documentElement.requestFullScreen();  
        } else if (document.documentElement.mozRequestFullScreen) {  
          document.documentElement.mozRequestFullScreen();  
        } else if (document.documentElement.webkitRequestFullScreen) {  
          document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
        }  
      } else {  
        if (document.cancelFullScreen) {  
          document.cancelFullScreen();  
        } else if (document.mozCancelFullScreen) {  
          document.mozCancelFullScreen();  
        } else if (document.webkitCancelFullScreen) {  
          document.webkitCancelFullScreen();  
        }  
      }  
    }
    </script>

    <script>
        $('#myDatepicker').datetimepicker();
        
        $('#myDatepicker2').datetimepicker({
            format: 'DD.MM.YYYY'
        });
        
        $('#myDatepicker3').datetimepicker({
            format: 'hh:mm A'
        });
        
        $('#myDatepicker4').datetimepicker({
            ignoreReadonly: true,
            allowInputToggle: true
        });

        $('#datetimepicker6').datetimepicker();
        
        $('#datetimepicker7').datetimepicker({
            useCurrent: false
        });
        
        $("#datetimepicker6").on("dp.change", function(e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        
        $("#datetimepicker7").on("dp.change", function(e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
        function goBack() {
            window.history.back();
        }
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
          }
        }
        function selected(element){
            element.select();
        }
        function doChosen() {
            $(".chzn-select").chosen({width: "100%"});
            $(".chzn-select-deselect").chosen({allow_single_deselect:true});
        }
        doChosen();
    </script>
    
    <div style="text-align:center;">
    
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4815321847306589"
     crossorigin="anonymous"></script>
<!-- footer_patients -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-4815321847306589"
     data-ad-slot="5095780632"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    
</div>
    
  </body>
</html>

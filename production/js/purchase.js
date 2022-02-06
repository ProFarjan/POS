  
    $(function(){
      $("#EmployeeDetails").hide();
      $("#quantitydiv").hide();
      $("#resultshow").hide();
      $('#currentdiv').hide();
      $('#ratediv').hide();
      $('#mobileshowval').hide();

      $("#result").click(function(){
        $('#entrydata').slideUp(1000,function(){
          $('#resultshow').slideDown(1000);
          $("#result").hide(1000);
        });
      });

      $('#paid').change(function(){
        var paid = $(this).val();
        if (paid == '') {
          $('#currentdiv').hide();
        }else{
          var totalval = $('#totalval').html();
          var currentdue = parseFloat(totalval)-paid;
          $('#currentval').html(currentdue);
          $('#currentdiv').show(1000);
        }
      });

      $(".emplyeeval").keyup(function(){
        var value = $(this).val();
        if (value == '') {
          $('#mobileshowval').slideUp(1000);
          $(".autocoma").empty();
        }else{
          $.ajax({
            url:"autocompletecustomer.php",
            method:"POST",
            data:{value:value},
            dataType:"text",
            success: function(data){
              $(".autocoma").empty();
              $(".autocoma").append(data);
              $('#mobileshowval').slideDown(1000);
            }
          });
        }
      });

      $(".emplyeeval").blur(function(){
        var emplyeeval = $(this).val();

        if (emplyeeval == '') {
          $("#employeeform").removeClass('tanimat col-md-8 col-sm-8 col-xs-8');
          $("#employeeform").addClass('tanimat col-md-12 col-sm-12 col-xs-12');
          $("#EmployeeDetails").hide();
        }else{
          $.ajax({
            url:"selectemployee.php",
            method:"POST",
            data:{Emplyeeval:emplyeeval},
            success:function(data){
              $("#useralldata").empty();
              $("#useralldata").append(data);
            }
          });
          $.ajax({
            url:"selectemployeeid.php",
            method:"POST",
            data:{Emplyeeval:emplyeeval},
            success:function(data){
              $("#employeefa").val(0);
              $("#employeefa").val(data);
            }
          });
          $("#employeeform").removeClass('tanimat col-md-12 col-sm-12 col-xs-12');
          $("#employeeform").addClass('tanimat col-md-8 col-sm-8 col-xs-8');
          $("#EmployeeDetails").show();
        }

      });

      $(".productcode").blur(function(){
        var productcode = $(this).val();

        if (productcode == '') {
          $("#quantitydiv").slideUp(1000);
          $("#ratediv").slideUp(1000);
          $("#productid").val(0);
        }else{
          $.ajax({
            url:"selectproductid.php",
            method:"POST",
            data:{ProductVal:productcode},
            success:function(data){
              if (data == 'Product Not Found') {
                new PNotify({
                  title: 'Product Details',
                  text: data,
                  type: 'error',
                  styling: 'bootstrap3'
                });
              }else{
                new PNotify({
                  title: 'Product Details',
                  text: data,
                  type: 'success',
                  styling: 'bootstrap3'
                });
              }
            }
          });
          $.ajax({
            url:"selectpurchasedata.php",
            method:"POST",
            data:{ProductVal:productcode},
            success:function(data){
              $("#quantitydiv").empty(1000);
              $("#quantitydiv").append(data);
              $("#quantitydiv").slideDown(1000);
              $("#ratediv").slideDown(1000);
            }
          });
          $.ajax({
            url:"selectproductidno.php",
            method:"POST",
            data:{ProductVal:productcode},
            success:function(data){
              $("#productid").val(data);
            }
          });
        }

      });

      <?php if ($incomeval1) { ?>

      $('#other').change(function(){
        $('#discount').val(0);
        var other = $(this).val();
        var subtotal = <?php echo $subtotal;?>;
        var predue = <?php echo $predue;?>;
        var changeval = parseFloat(subtotal) + parseFloat(other) + parseFloat(predue);
        $('#totalval').html(changeval);
      });

      $('#discount').change(function(){
        var discount = $(this).val();
        var other = $('#other').val();
        var subtotal = <?php echo $subtotal;?>;
        var predue = <?php echo $predue;?>;
        var disamount = (discount/100)*subtotal;
        var changeval = parseFloat(subtotal) + parseFloat(other) + parseFloat(predue);
        var changeval02 = changeval-disamount;
        $('#totalval').html(changeval02);
      });

      <?php } ?>

    });

    $(document).on('click','.autocom ul li',function(){
      $(".emplyeeval").val($(this).text());
      $('#mobileshowval').slideUp(1000);
    });
<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $cu = new Inden();

 if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['personcash'])) {
   $addcustomer = $cu->Person_Cash_Out_List($_POST);
 }

 $emplayee = $cu->Tbl_Col_Id_2("customer","typeval","status","2","0");

?>

<style type="text/css">
#dataval ul{
  list-style: none;
}
#dataval ul li{
  cursor: pointer;
}
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Pay Loan</h3>
      </div>

      <div class="title_right">
        <div class="col-md-3 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="bypersonlist.php" class="btn btn-info">Pay Loan Statement</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Loan Pay</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
         <span id="message123"><?php
            if (isset($addcustomer)) {
              echo $addcustomer;
            }elseif (isset($update_customer)) {
              echo $update_customer;
            }
         ?></span>
              

<form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">

   <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" class="form-control has-feedback-left" id="single_cal2" aria-describedby="inputSuccess2Status2" name="date">
    </div>
  </div>

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Staff Name <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="name" class="form-control col-md-7 col-xs-12" name="name" required="required" type="text" autocomplete="off" list="employeelist" >
      <datalist id="employeelist">
        <?php
          while ($emlist = $emplayee->fetch(PDO::FETCH_OBJ)) {
        ?>
        <option><?php echo $emlist->name;?></option>
        <?php } ?>
      </datalist>
    </div>
  </div>

  <div class="item form-group" id="showdata" style="display: none;">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12" id="dataval">
      
    </div>
  </div>

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Mobile Number <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="mobile" name="mobile"  class="form-control col-md-7 col-xs-12" >
    </div>
  </div>

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Destination <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="destination" name="destination"  class="form-control col-md-7 col-xs-12" >
    </div>
  </div>

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Amount <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="email" name="amount"  class="form-control col-md-7 col-xs-12" >
    </div>
  </div>

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Note <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="email" name="note"  class="form-control col-md-7 col-xs-12" >
    </div>
  </div>

  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-md-offset-3">
      <button id="send" type="submit" class="btn btn-success" name="personcash" >Submit</button>
      <button type="submit" class="btn btn-primary">Cancel</button>
    </div>
  </div>
</form>




          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php include "inc/footer.php";?>

<script type="text/javascript">
$(function(){
  $("#name").keyup(function(){
    var val12 = $(this).val();
    if (val12 == '') {
      $("#showdata").slideUp(1000);
      $("#mobile").val("")
      $("#destination").val("")
    }else{
      $.ajax({
        url: "selectbypersonin.php",
        method: "POST",
        data: {val12:val12},
        success: function(data){
          if (data == '111') {
            $("#showdata").hide();
          }else{
            $("#dataval").empty();
            $("#dataval").append(data);
            $("#showdata").slideDown(1000);
          }
        }
      });
    }
  });
});

$(document).on('click','#dataval ul li',function(){
  var ulval = $(this).text();
  $.ajax({
        url: "selectbypersoninset.php",
        method: "POST",
        data: {ulval:ulval},
        success: function(data){
          var obj = $.parseJSON(data);
          $("#mobile").val(obj.phone);
          $("#destination").val(obj.destination);
        }
      });
    $("#name").val(ulval);
    $("#showdata").slideUp(1000);
});
</script>
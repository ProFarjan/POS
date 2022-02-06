<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$po = new Income();
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['duepay555'])) {
  $duepay = $po->Due_Paid_Amount658($_POST);
 }
?>
<style type="text/css">
input[type="text"]{
  padding: 0 5px;
  color: green;
  font-weight: bolder;
  border-radius: 5px;
}
#submit{border-radius: 5px;margin:0 auto;width: 50px;}
</style>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title" style="margin:0px;">
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="search">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Due/Receive Pay</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <span id="message123"><?php if(isset($addproduct)){echo $addproduct;}elseif(isset($Up_product)){echo $Up_product;}?><?php if(isset($duepay)){echo $duepay;}?></span>
            <br />
            <div style="width: 30%;text-align: center;font-size: 25px;margin: 0 auto;">
            <form action="" method="post">
              <table>
                <tr>
                  <th style="padding-bottom: 15px;text-align: center;font-weight: bolder;font-size: 15px;">Select Customer OR Supplier Name :</th>
                </tr>
                <tr>
                  <td style="padding-bottom: 15px;">

                    <select id="idinty" data-placeholder="Choose Customer OR Supplier Name ..." class="form-control chosen-select">
                      <option value=""></option>
                      <?php
                        $customer = $po->tbl_sql("SELECT id,name,phone FROM customer WHERE typeval IN(1,3) ORDER BY typeval ASC;");
                        if ($customer) {
                          while ($custData = $customer->fetch(PDO::FETCH_OBJ)) {
                      ?>
                        <option value="<?php echo $custData->id;?>"><?php echo $custData->name." (".$custData->phone.")";?></option>
                      <?php } } ?>
                    </select>

                  </td>
                </tr>
                <tr>
                  <td><input type="button" id="idintyval" class="btn btn-primary" value="Search"></td>
                </tr>
              </table>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="details">
      </div>
      </div>
      </div>
</div>
<!-- /page content -->

<?php include "inc/footer.php";?>

<script type="text/javascript">
$(function(){
  $(".details").hide();

  $("#idintyval").click(function(){
    var val = $("#idinty").val();
    var userid = '<?php echo $_SESSION['UserId'];?>';
    var real = val.trim();
    if (real == "") {
      $(".details").slideUp(1000);
    }else{
      $.ajax({
        url:"selectduedetails.php",
        method:"POST",
        data:{Indinty:real,userid:userid},
        success:function(scdata){
          $(".details").empty();
          $(".details").append(scdata);
          $("#paydue_imo").focus();
          $("#print").show();
          $("html, body").animate({ scrollTop: ($(document).height()-50)-$(window).height() });
        }
      });
      $(".search").slideUp(1000);
      $(".details").slideDown(1000);
    }
  });

});
</script>

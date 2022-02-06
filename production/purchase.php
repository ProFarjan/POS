<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $ex = new Purchase();
?>
<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['addincome'])) {
   $addincome = $ex->Purchase_Add($_POST);
 }
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['updaterate'])) {
   $quantity = $ex->Update_Rate_254($_POST);
 }
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['quansub'])) {
   $quantity = $ex->Update_Quantity_Per($_POST);
 }
 if (isset($_GET['delete']) AND isset($_GET['purchase'])) {
    $id = $_GET['delete'];
    $purchase = $_GET['purchase'];
    $ex->Delete_Store($purchase,$id);
    $product_Del = $ex->Delete('purchase',$id);
    header('Location: '.$_SERVER['PHP_SELF']);
  }
 $incomeval = $ex->Tbl_Col_Id('purchase','status','0');
 $incomeval_all = $ex->Tbl_Col_Id('purchase','status','0');
 $incomeval1 = $incomeval->fetch(PDO::FETCH_OBJ);

?>
<style type="text/css">
  #spcail{
    color: red;
  }
  .autocom {
    background: #b4eaf8;
    padding: 5px 20px;
  }
  .autocom ul {
      list-style: none;
      color: #5a738e;
  }
  .autocom ul li {
      font-size: 16px;
      padding: 5px 0;
      border-bottom: 1px solid #fff;
      cursor: pointer;
  }
  .shotadd{}
  .shotadd tr{}
  .shotadd tr td{padding-bottom: 10px;}
  .shotadd tr td input[type='text'] {
    text-align: center;
    font-size: 19px;
    padding: 6px 0;
    color: #067906;
    border-radius: 10px;
    border: 1px solid #6ca061;
    background: #f4f3f3;
  }
  .shotadd tr td input[type='button'] {
    font-size: 18px;
    color: #3899e6;
    width: 34%;
    padding: 5px;
    margin: 1px 75px;
  }
  .modal-header,.modal-footer {
    background: #347bed;
    color: #ffffff;
    font-weight: bolder;
  }
  .modal-footer {
    padding: 6px;
  }
  .modal-body {
    padding: 0px;
  }
</style>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title" style="margin-top: 0px;">
    </div>

    <div class="clearfix"></div>
<?php
  if ($incomeval1) {
    $cusdata = $ex->SelectAll_By_ID('customer',$incomeval1->supplierid);
?>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <span style="text-align: center;width: 80%;">Purchase No. <?php echo $incomeval1->purchaseno;?> </span>
        <span class="pull-right">Date: <?php echo $ex->hl->formatDate01($incomeval1->date);?></span>
        <div class="x_title">
          <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12">
              <table class="table table-striped table-bordered" style="margin-top: 10px;">
              <tr class="info">
                <td>ID</td>
                <td><?php echo $cusdata->customerid;?></td>
              </tr>
              <tr>
                <td>Name</td>
                <td><?php echo $cusdata->name;?></td>
              </tr>
              <tr>
                <td>Phone</td>
                <td><?php echo $cusdata->phone;?></td>
              </tr>
              <?php if($cusdata->company != "1"){ ?>
              <tr>
                <td>Company</td>
                <td><?php echo $cusdata->company;?></td>
              </tr>
              <?php } ?>
              <?php if(!empty($cusdata->address)){ ?>
              <tr>
                <td>Address</td>
                <td><?php echo $cusdata->address;?></td>
              </tr>
              <?php } ?>
            </table>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <table class="table table-bordered" style="margin-top: 10px;">
              <tr class="bg-primary">
                <th>SL</th>
                <th>P.Code</th>
                <th>P.Name</th>
                <th data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>">Rate</th>
                <th>Quantity</th>
                <th data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>">Amount</th>
                <th>Action</th>
              </tr>
            <?php
              $i = 0;
              $subtotal = 0;
              $qty_pro = 0;
              if ($incomeval_all) {
                while ($data = $incomeval_all->fetch(PDO::FETCH_OBJ)) { $i++;
                  $data1 = $ex->SelectAll_By_ID('product',$data->productid);
            ?>
              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $data1->code;?></td>
                <td><?php echo $data1->name;?></td>
                <td>
                  <form action="" method="post">
                    <input type="text" name="rate501" autocomplete="off" value="<?php echo $data->rate;?>" class="text-center" style="width: 90px;border-radius: 30%;padding: 6px;">
                    <input type="hidden" name="purchaseid" value="<?php echo $data->id;?>">
                    <input type="hidden" name="purchaseno" value="<?php echo $incomeval1->purchaseno;?>">
                    <input type="submit" name="updaterate" value="Up" class="btn btn-info btn-xs">
                  </form>
                </td>
                <td>
                  <?php $qty_pro += $data->quantity;?>
                  <form action="" method="post">
                    <input type="text" name="quanval" autocomplete="off" value="<?php echo $data->quantity;?>" class="text-center" style="width: 90px;border-radius: 30%;padding: 6px;" data-toggle="tooltip" data-placement="top" title="<?php if($data->unit == '0'){echo 'sq/ft';}else{echo $data->unit;}?>">
                    <input type="hidden" name="incomeid" value="<?php echo $data->id;?>">
                    <input type="hidden" name="purchaseno" value="<?php echo $incomeval1->purchaseno;?>">
                    <input type="submit" name="quansub" value="Up" class="btn btn-info btn-xs">
                  </form>
                </td>
                <td>
                  <?php
                    echo $amount = ($data->quantity)*($data->rate);
                    $subtotal = $subtotal+$amount;
                  ?>
                </td>
                <td><a href="?delete=<?php echo $data->id;?>&purchase=<?php echo $incomeval1->purchaseno;?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
              </tr>
            <?php } } ?>
            <tr>
              <td colspan="4" style="text-align: right;">Total</td>
              <td style="text-align: center;"><?php echo $qty_pro;?></td>
              <td style="text-align: center;"><?php echo $subtotal;?></td>
              <td style="text-align: center;"></td>
            </tr>
            </table>
            <center><button id="result" class="btn btn-info">Payment Slip</button></center>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="resultshow" style="display: none;">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <h2 style="text-align: center;font-weight: bold;margin: 0px;font-size: 25px;color: #000000;font-style: italic;">Supplier Payment Slip</h2>
        <div class="x_title">
          <div class="x_content">
          <div class="col-md-1 col-sm-1 col-xs-1"></div>
          <div class="col-md-9 col-sm-9 col-xs-9">
          <form action="<?php echo $purchase;?>.php?invoice=<?php echo $incomeval1->purchaseno;?>" method="post" id="myformfr">

            <input type="hidden" name="date" value="<?php echo $incomeval1->date;?>">
            <input type="hidden" name="subtotal" value="<?php echo $subtotal;?>">
            <input type="hidden" name="invoice" value="<?php echo $incomeval1->purchaseno;?>">
            <input type="hidden" name="customerid" value="<?php echo $cusdata->id;?>">

            <table class="table table-striped table-bordered" style="margin-top: 10px;">
              <tr>
                <td width="30%">Sub Total</td>
                <td style="text-align: center;font-size: 18px;width: 50%;" data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>"><?php echo $subtotal;?></td>
              </tr>
              <tr>
                <td>Shifting/Other Cost</td>
                <td style="text-align: center;">
                  <input type="text" name="other"  id="other" value="0" autocomplete="off" class="form-control myinput" style="width: 50%;text-align: center;margin: 0 auto;" data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>">
                </td>
              </tr>
              <tr>
                <td>Discount</td>
                <td style="text-align: center;">
                  <input type="text" name="discount" id="discount" value="0" autocomplete="off" class="form-control myinput" style="width: 50%;text-align: center;margin: 0 auto;" data-toggle="tooltip" data-placement="right" title="If You Pay discount Amount to Presence. Plesae add This Symbol (%) end of the Discount Amount. Ex. 25%">
                </td>
              </tr>
              <tr>
                <td>Grand Total</td>
                <td style="text-align: center;font-size: 18px;"><p id="totalval" data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>"><?php echo ($subtotal);?></p></td>
              </tr>
              <tr>
                <td>
                  Paid
                  (
                  <input type="radio" name="amtype" id="mycash" value="casht" checked="checked"/> Cash
                  <input type="radio" name="amtype" value="bankt" id="mybank"/> Bank
                  )
                </td>
                <td style="text-align: center;">
                  <input type="text" name="payment" value="0.0" autocomplete="off" class="form-control myinput" id="paid" style="width: 50%;text-align: center;margin: 0 auto;" data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>">
                </td>
              </tr>
              <tr id="currentdiv">
                <td id="returnamount">Current Due</td>
                <td style="text-align: center;font-size: 18px;"><p id="currentval"><?php echo ($subtotal);?></p></td>
              </tr>
              <tr id="duepaiddatetr">
                <td>Due Paid Date</td>
                <td>
                  <input type="text" class="form-control has-feedback-left" id="single_cal2" aria-describedby="inputSuccess2Status2" name="duepaiddate" style="width: 50%;text-align: center;margin: 0 auto;">
                </td>
              </tr>
            </table>
            <center><button type="submit" class="btn btn-success btn-lg" name="paymentamount">Paid</button></center>
            </form>
          </div>
          <div class="col-md-1 col-sm-1 col-xs-1"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php } ?>


    <div class="row" id="entrydata">
      <div class="col-md-12 col-sm-12 col-xs-12" id="employeeform" >
        <div class="x_panel" style="margin-bottom: 100px;">
          <div class="x_title">
            <h2>Add New Purchase Product</h2>
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
            <span id="message123"><?php if(isset($addincome)){echo $addincome;}?></span>
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">
            <?php if (!$incomeval1) { ?>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control has-feedback-left" id="single_cal2" aria-describedby="inputSuccess2Status2" name="date">
                </div>
              </div>
              <div class="form-group employee" id="chalanno">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="chalanno">Chalan No <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="chalanno" autocomplete="off" autofocus class="form-control col-md-7 col-xs-12" value="<?php echo rand(0,999999);?>" required="required">
                </div>
              </div>
              <div class="form-group employee" id="employeeid">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Supplier Name</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="customerid" data-placeholder="Choose Customer..." id="customerid25" class="form-control chosen-select">
                    <option value=""></option>
                    <?php
                      $customer = $ex->tbl_sql("SELECT id,name FROM customer WHERE typeval = '3' ORDER BY name ASC;");
                      if ($customer) {
                        while ($custData = $customer->fetch(PDO::FETCH_OBJ)) {
                    ?>
                      <option value="<?php echo $custData->id;?>"><?php echo $custData->name;?></option>
                    <?php } } ?>
                  </select>
                </div>
              </div>
              <div class="form-group" id="mobileshowval" style="display: none;">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="autocoma" style="max-height: 350px;overflow-y: scroll;position: absolute;z-index: 999;width: 95%;">
                  </div>
                </div>
              </div>
            <?php } ?>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Code <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  
                  <select name="productid" data-placeholder="Choose Product..." id="productid" class="form-control chosen-select">
                    <option></option>
                    <?php
                      $product = $ex->tbl_sql("SELECT * FROM product ORDER BY type,subtype,name ASC;");
                      if ($product) {
                        while ($allproduct = $product->fetch(PDO::FETCH_OBJ)) {
                    ?>
                      <option value="<?php echo $allproduct->id;?>"><?php echo $allproduct->code." (".$allproduct->type." | ".$allproduct->subtype." | ".$allproduct->name.")";?></option>
                    <?php } } ?>
                  </select>

                </div>
              </div>

              <div class="form-group employee" id="ratediv" style="display: none;">
                <label class="col-xs-3" for="last-name" style="text-align: right;">Rate <span class="required">*</span>
                </label>
                <div class="col-xs-3">
                  <input type="text" name="rate" autocomplete="off" placeholder="Purcahse Rate" class="rateval form-control col-md-7 col-xs-12" required="required">
                </div>
                <div class="col-xs-3">
                  <input type="text" name="individual" autocomplete="off" class="rateval form-control col-xs-4 " placeholder="Individual Rate" required="required" />
                </div>
                <div class="col-xs-3">
                  <input type="text" name="hole_sales" autocomplete="off" class="rateval form-control col-xs-4 " placeholder="Hole Sales Rate" required="required" />
                </div>
              </div>

              <div class="form-group employee" id="quantitydiv" style="display: none;">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantity <span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="quantity" autocomplete="off" class="quantityval form-control col-md-7 col-xs-12" required="required">
                </div>
                <div class="col-md-2 col-sm-2 col-xs-4">
                  <input type="text" id="last-name"  class="quantityval form-control col-md-7 col-xs-12" required="required" name="unit">
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success" name="addincome">Submit</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                </div>
              </div>

            </form>
          </div>
        </div>

        <div class="x_panel" id="customerinvoice" style="display: none;">
        </div>

      </div>
      <div class="col-md-4 col-sm-4 col-xs-4" id="EmployeeDetails" style="display: none;">
        <div class="x_panel">
          <div class="x_title">
            <h2>Supplier Details</h2>
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
            <br />
            <div id="useralldata">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->




<?php include "inc/footer.php";?>


<!-- Small modal -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Add New Supplier</h4>
      </div>
      <div class="modal-body">
        <h4>Supplier Details</h4>
        <form>
          <table class="shotadd">
            <tr>
              <td><input type="text" id="code2" value="<?php $custcode = $ex->Tbl_Col_Id_LIMITE_0('customer','typeval','3');if($custcode){echo $custcode->customerid+1;}else{echo $farjan->suppcode;}?>"></td>
            </tr>
            <tr>
              <td><input type="text" id="name2" placeholder="Supplier Name..."></td>
            </tr>
            <tr>
              <td><input type="text" id="phone2" placeholder="Supplier Phone..."></td>
            </tr>
            <tr>
              <td><input type="button" id="addsub2" value="Add" data-dismiss="modal"></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /modals -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Bank Statement Check Info</h4>
      </div>
      <div class="modal-body">

        <div class="row" style="padding: 6px;">

          <div class="col-md-12">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank Name :<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 7px;">
                <input class="form-control col-md-7 col-xs-12" name="bankname" form="myformfr" id="bankname" type="text" autocomplete="off" list="acname">
                <datalist id="acname">
                  <?php
                    $allbank = $ex->tbl_sql("SELECT bankname FROM tbl_account GROUP BY bankname ORDER BY bankname,acnumber ASC;");
                    if ($allbank) {
                      while ($data = $allbank->fetch(PDO::FETCH_OBJ)) {
                  ?>
                  <option><?php echo $data->bankname;?></option>
                  <?php }} ?>
                </datalist>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">A/C No :<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 7px;">
                <input class="form-control col-md-7 col-xs-12" name="acno" form="myformfr" id="acno" type="text" autocomplete="off" list="bankaclist">
                <datalist id="bankaclist">
                  
                </datalist>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Deposit Slip No :<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 7px;">
                <input class="form-control col-md-7 col-xs-12" name="slipno" form="myformfr" id="slipno" type="text" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Amount :<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" name="amountbank" form="myformfr" id="amountbank" type="text" autocomplete="off">
              </div>
            </div>
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" id="depositbank">Bank Deposit</button>
        <button type="button" class="btn btn-warning" id="closebank">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
    $(function(){
      $("#mybank").click(function(){
        $('#myModal').modal();
      });

      $("#closebank").click(function(){
        $("#mycash").prop("checked", true);
        $('#myModal').modal('hide');
      });

      $("#depositbank").click(function(){
        var acno = $("#acno").val();
        var bankname = $("#bankname").val();
        var slipno = $("#slipno").val();
        var amountbank = $("#amountbank").val();
        if (acno != "" && bankname != "" && slipno != "" && amountbank != "") {
          $('#myModal').modal('hide');
        }else{
          alert("All Fields Must be Required!!");
        }
      });

      $("#bankname").blur(function(){
        var bankac = $(this).val();
        var bankac = bankac.trim();
        var value44 = "acno";
        if (bankac == '') {
          $("#bankname").val('');
        }else{
          $.ajax({
            url: "selectbankac1.php",
            method: "POST",
            data: {bankac:bankac,value44:value44},
            success: function(data){
              $("#bankaclist").empty();
              $("#bankaclist").append(data);
              $("#acno").val(document.getElementById("bankaclist").options.item(0).value);
            }
          });
        }
      });

      $("#amountbank").keyup(function(){
        var amountbank = $(this).val();
        $("#paid").val(amountbank);
        paidkeyup(amountbank);
      });

      $("#result").click(function(){
        $('#entrydata').slideUp(1000,function(){
          $('#resultshow').slideDown(1000);
          $('html, body').animate({scrollTop:250},'50');
          $("#result").hide(1000);
        });
      });

      $('#paid').keyup(function(){
        var paid = $(this).val();
        paidkeyup(paid);
      });

      $("#customerid25").change(function(){
        var emplyeeval = $(this).val();

        if (emplyeeval == '') {
          $("#employeeform").removeClass('tanimat col-md-8 col-sm-8 col-xs-8');
          $("#employeeform").addClass('tanimat col-md-12 col-sm-12 col-xs-12');
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
            url:"selectcustomerinvoice.php",
            method:"POST",
            data:{Emplyeeval:emplyeeval,status:'2'},
            success:function(data){
              $("#customerinvoice").empty();
              $("#customerinvoice").append(data);
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
          $("#customerinvoice").show();
        }

      });

      $("#productid").change(function(){
        var productcode = $(this).val();

        if (productcode == '') {
          $("#quantitydiv").slideUp(1000);
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

        }

      });

      <?php if ($incomeval1) { ?>

      $('#other').keyup(function(){
        $('#discount').val(0);
        var other = $(this).val();
        var subtotal = <?php echo $subtotal;?>;
        var paid = $("#paid").val();
        var currentval = parseFloat($("#currentval").text());
        var changeval = parseFloat(subtotal) + parseFloat(other);
        $('#totalval').html(changeval);

        var due_amount = (changeval-paid);
        var first_letter = due_amount.toString()[0];
        if (first_letter == "-") {
          $("#returnamount").empty();
          $("#returnamount").html("<span style='color:green;font-weight:bold;'>Change Amount</span>");
          var due_amount = due_amount.toString();
          var due_amount = due_amount.substring(1);
          $("#currentval").text(due_amount);
        }else{
          $("#returnamount").empty();
          $("#returnamount").html("Current Due");
          $("#currentval").text(due_amount);
        }
      });

       $('#discount').keyup(function(){
        var discount = $(this).val();
        var subtotal = <?php echo $subtotal;?>;

        var last_dis = discount.slice(-1);
        if (last_dis == '%') {
          var discount = discount.substring(0, discount.length-1);
          var disamount = (discount/100)*subtotal;
        }else{
          var disamount = discount;
        }

        var other = $('#other').val();
        var changeval = parseFloat(subtotal) + parseFloat(other);
        var due_amount = changeval-disamount;
        $('#totalval').html(due_amount);
        var paid = $("#paid").val();

        var due_amount = (due_amount-paid);
        var first_letter = due_amount.toString()[0];
        if (first_letter == "-") {
          $("#returnamount").empty();
          $("#returnamount").html("<span style='color:green;font-weight:bold;'>Change Amount</span>");
          var due_amount = due_amount.toString();
          var due_amount = due_amount.substring(1);
          $("#currentval").text(due_amount);
        }else{
          $("#returnamount").empty();
          $("#returnamount").html("Current Due");
          $("#currentval").text(due_amount);
        }
      });

      <?php } ?>

      $("#addsub2").click(function(){
        var code2 = $("#code2").val();
        var name2 = $("#name2").val();
        var phone2 = $("#phone2").val();
        $.ajax({
          url: "insertCustomers.php",
          method: "POST",
          data: {code2:code2,name2:name2,phone2:phone2,val:'3'},
          success: function(data){
            if (data == '1') {
              new PNotify({
                title: 'This Number is Alreay Exits.Supplier Not Added.',
                text: "Not Success",
                type: 'error',
                styling: 'bootstrap3'
              });
            }else{
              new PNotify({
                title: 'Supplier Add Successfully.',
                text: "Successfully",
                type: 'success',
                styling: 'bootstrap3'
              });
            }
          }
        });
        $(".emplyeeval").val(phone2).blur();
        $("#code2").val(<?php echo rand(00000,99999);?>);
        $("#name2").val("");
        $("#phone2").val("");
      });

    });

    $(document).on('click','.autocom ul li a',function(){
      $(".emplyeeval").val($(this).text()).blur();
      $('#mobileshowval').slideUp(1000);
    });

    function paidkeyup(paidAmount){
      var paid = paidAmount;
      var totalval = $('#totalval').html();
      if (paid == '') {
        $("#duepaiddatetr").hide();
        $("#single_cal2").val("0");
        $("#returnamount").empty();
        $("#returnamount").html("Current Due");
        $("#currentval").text(totalval);
      }else{
        var due_amount = parseFloat(totalval)-paid;

        var first_letter = due_amount.toString()[0];
        if (first_letter == "-") {
          $("#duepaiddatetr").hide();
          $("#single_cal2").val("0");
          $("#returnamount").empty();
          $("#returnamount").html("<span style='color:green;font-weight:bold;'>Change Amount</span>");
          var due_amount = due_amount.toString();
          var due_amount = due_amount.substring(1);
          $("#currentval").text(due_amount);
        }else{
          $("#returnamount").empty();
          $("#returnamount").html("Current Due");
          $("#currentval").text(due_amount);
          if (due_amount == 0) {
            $("#duepaiddatetr").hide();
            $("#single_cal2").val("0");
          }else{
            $("#duepaiddatetr").show();
          }
        }

      }
    }
  
</script>

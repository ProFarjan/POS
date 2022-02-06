<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $in = new Purchase();
 $invoice_page = $purchase;

 if (isset($_GET['edit'])) {
  $invoice = $in->hl->validation($_GET['edit']);

  if (strlen($invoice) == 14) {
    $payment = $in->Tbl_Col_Id_LIMITE_0('payment','invoice',$invoice);
    $income = $in->Tbl_Col_Id_2("purchase","purchaseno","status",$invoice,"1");
    $customer = $in->Tbl_Col_Id_LIMITE_0('customer','id',$payment->customerid);

     if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['quansub'])) {
       $up_quan = $in->Update_Quantity_Per($_POST);
       if ($up_quan) {
         echo "<meta http-equiv='refresh' content='0'>";
       }
     }
     if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['rateupdate'])) {
       $up_rate = $in->Update_Rate_254($_POST);
       if ($up_rate) {
         echo "<meta http-equiv='refresh' content='0'>";
       }
     }
     if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['deleteval'])) {
        $id = $_POST['incomeid'];
        $product_Del = $in->Delete('purchase',$id);
        $product_Del = $in->Delete_01('store','purchaseid',$id);
        if ($product_Del) {
          echo "<meta http-equiv='refresh' content='0'>";
        }
     }
     if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['addproductbyedit'])) {
       $edit_new_product = $in->edit_Purchase_Add($_POST);
     }
     if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['editvalue225'])) {
       $edit_old_invoice = $in->edit_old_invoice($_POST);
       if ($edit_old_invoice) {
         $edit_old = "<p class='alert alert-success'><strong>Success !</strong> This Purchase Successfully Updated.</p>";
         Session::set('Update_invoice', $edit_old);
         echo "<meta http-equiv='refresh' content='2'>";
       }
     }

?>

<style type="text/css">
  .customerdetails ul li a{
    cursor: pointer;
  }
</style>
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Edit Purchase</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="<?php echo $invoice_page;?>.php?invoice=<?php echo $invoice;?>" class="btn btn-info">Return Purchase</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <?php 
      echo Session::get('Update_invoice');
      unset($_SESSION['Update_invoice']);
    ?>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Purchase No. <span style="color: skyblue;"><?php echo $invoice;?></span></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                Date. <?php echo $in->hl->formatDate01($payment->date);?>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="" method="post">
            
            <div class="col-sm-12">

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="email">Supplier ID</label>
                  <input type="text" class="form-control" id="customerid" value="<?php echo $customer->customerid;?>" disabled>
                  <input type="hidden" name="realid" id="realid" value="<?php echo $customer->id;?>">
                  <input type="hidden" name="invoice225" value="<?php echo $invoice;?>">
                </div>
                <div class="form-group">
                  <label for="pwd">Supplier Name</label>
                  <input type="text" class="form-control" value="<?php echo $customer->name;?>" id="customername" disabled>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="email">Phone</label>
                  <input type="text" class="form-control" value="<?php echo $customer->phone;?>" id="phone">
                  <div class="customerdetails">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label for="pwd">Address</label>
                  <input type="text" class="form-control" value="<?php echo $customer->address;?>" id="address" disabled>
                </div>
              </div>

            </div>

            <div class="col-sm-12">
              <?php if(isset($edit_new_product)){echo $edit_new_product;}?>
              <table class="table table-bordered">
                <caption class="text-center glyphicon-font bg-info">All Product List</caption>
                <thead>
                  <tr class="bg-primary">
                    <th>SL</th>
                    <th>P.code</th>
                    <th>P.Name</th>
                    <th>Rate</th>
                    <th>Qnt</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                $all = 0;
                  while ($product_s = $income->fetch(PDO::FETCH_OBJ)) { $i++;
                    $data1 = $in->SelectAll_By_ID('product',$product_s->productid);
                ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><p data-toggle="tooltip" title="<?php echo $data1->type.' || '.$data1->subtype;?>"><?php echo $data1->code;?></p></td>
                    <td><?php echo $data1->name;?></td>
                    <td>
                      <form action="" method="post">
                        <input type="text" name="rate501" value="<?php echo $product_s->rate;?>" class="text-center" style="width: 90px;border-radius: 30%;padding: 6px;" data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>">
                        <input type="hidden" name="purchaseid" value="<?php echo $product_s->id;?>">
                        <input type="submit" name="rateupdate" value="Up" class="btn btn-info btn-xs">
                      </form>
                    </td>
                    <td>
                      <form action="" method="post">
                        <input type="text" name="quanval" autocomplete="off" value="<?php echo $product_s->quantity;?>" class="text-center" style="width: 90px;border-radius: 30%;padding: 6px;" data-toggle="tooltip" data-placement="top" title="<?php if($data->unit == '0'){echo 'sq/ft';}else{echo $data->unit;}?>">
                        <input type="hidden" name="incomeid" value="<?php echo $product_s->id;?>">
                        <input type="hidden" name="purchaseno" value="<?php echo $product_s->purchaseno;?>">
                        <input type="submit" name="quansub" value="Up" class="btn btn-info btn-xs">
                      </form>
                    </td>
                    <td><p data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>" id="totalrate<?php echo $i;?>"><?php echo $sum = $product_s->rate*$product_s->quantity;?></p></td>
                    <td>
                      <form action="" method="post">
                        <input type="hidden" name="incomeid" value="<?php echo $product_s->id;?>">
                        <button type="submit" class="btn btn-danger btn-sm" name="deleteval"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                      </form>
                    </td>
                  </tr>

                <?php $all = $all+$sum;} ?>
                <form action="" method="post">
                    <tr>
                      <td>
                        <?php echo $i+1;?>
                      </td>
                      <td>
                        <input type="text" id="productcode" class="form-control" data-toggle="modal" data-target=".bs-example-modal-lg">
                        <input type="hidden" name="productid" id="productidnewadd">
                        <input type="hidden" name="customeridnewadd" id="customeridnewadd" value="<?php echo $customer->id;?>">
                        <input type="hidden" name="invoicenewadd" value="<?php echo $invoice;?>">
                        <input type="hidden" name="dateinvoice" value="<?php echo $payment->date;?>">
                      </td>
                      <td>
                        <input type="text" class="form-control" id="productaddname" disabled>
                      </td>
                      <td>
                        <input type="text" name="rate" id="rateadd" class="form-control" data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>">
                      </td>
                      <td>
                        <input type="text" name="totalcarton" id="qntadd" class="form-control totalcarton" placeholder="Total Carton sq/ft" value="1" style="display: none;">
                        <input type="text" name="percarton" class="percarton form-control" placeholder="Per Carton sq/ft" style="display: none;">

                        <input type="text" name="qntadd" id="qntadd" class="form-control qntadd" value="1" style="display: none;">
                        <input type="text" name="unit" class="form-control unit" placeholder="Enter Unit" style="display: none;">

                        <input type="text" name="totalcarton" id="qntadd" class="form-control totalcarton01" placeholder="Total Carton sq/ft" style="display: none;">

                        <input type="text" name="qntadd" id="qntadd" class="form-control storeval" data-toggle="tooltip" style="display: none;">


                        <input type="text" name="qntadd" id="qntadd" class="form-control defaultval" data-toggle="tooltip">
                      </td>
                      <td>
                        <input type="text" id="totalrate" class="form-control" data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>">
                      </td>
                      <td>
                        <input type="submit" name="addproductbyedit" class="btn btn-primary" value="Add">
                      </td>
                    </tr>
                  </form>
                </tbody>
              </table>
            </div>

            <div class="col-sm-8">
              <table class="table table-bordered">
                <caption class="text-center glyphicon-font bg-success">Payment Slip</caption>
                <tr>
                  <th style="width: 30%;">Sub Total</th>
                  <td>
                    <p data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>"><?php echo $all;?></p>
                    <input type="hidden" name="subtotal" value="<?php echo $all;?>">
                  </td>
                </tr>
                <tr>
                  <th style="width: 30%;">Other</th>
                  <td><input type="text" id="other" name="other" class="form-control" data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>" value="<?php echo $payment->other;?>"></td>
                </tr>
                <tr>
                  <th style="width: 30%;">Discount</th>
                  <td><input type="text" id="discount" name="discount" class="form-control" value="<?php echo $payment->disamount;?>" data-toggle="tooltip" title="If You Pay discount Amount to Presence. Plesae add This Symbol (%) end of the Discount Amount. Ex. 25%"></td>
                </tr>
                <tr>
                  <th style="width: 30%;">Previous Due</th>
                  <td><p data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>"><?php echo $payment->predue." P.Inv (".$payment->predueinvoice.")";?></p></td>
                </tr>
                <tr>
                  <th style="width: 30%;">Grand Total</th>
                  <td><p data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>" id="totalval"><?php echo ($all+$payment->other+$payment->predue-$payment->disamount);?></p></td>
                </tr>
                <tr>
                  <th style="width: 30%;">Payment</th>
                  <td><input type="text" id="paid" name="payment" class="form-control" data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>" value="<?php echo $payment->payment;?>"></td>
                </tr>
                <tr>
                  <?php $predueval = ($all+$payment->other+$payment->predue-$payment->disamount-$payment->payment);?>
                  <th style="width: 30%;"><p id="returnamount"><?php
                    if (substr($predueval, 0,1) == '-') {
                      echo "<span style='color:green;'>Change Amount</span>";
                    }else{
                      echo "Current Due";
                    }
                  ?></p></th>
                  <td><p id="currentval" data-toggle="tooltip" title="<?php echo $farjan->amountsymbol;?>"><?php echo trim($predueval,'-');?></p></td>
                </tr>
                <tr>
                  <th style="width: 30%;"></th>
                  <td><input type="submit" name="editvalue225" class="form-control btn btn-primary" value="Update"></td>
                </tr>
              </table>
            </div>
            
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<!-- all Product By Modul -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="myModalLabel">All Product List</h4>
    </div>
    <div class="modal-body">
      
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_content">

<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>SL</th>
      <th>Code</th>
      <th>Name</th>
      <th>Rate</th>
      <th>Catagory</th>
      <th>Sub Catagory</th>
      <th width="10%">Action</th>
    </tr>
  </thead>


  <tbody>
  <?php
    $niceproduct = $in->SelectAll('product');
    $i = 0;
    if ($niceproduct) {
      while ($data = $niceproduct->fetch(PDO::FETCH_OBJ)) { $i++;
  ?>
    <tr>
      <td><?php echo $i;?></td>
      <td id="<?php echo $data->code;?>"><?php echo $data->code;?></td>
      <td><?php echo $data->name;?></td>
      <td><?php echo $data->rate;?></td>
      <td><?php echo $data->type;?></td>
      <td><?php echo $data->subtype;?></td>
      <td width="10%"><button class="<?php echo $i;?> btn btn-info" data-dismiss="modal">Sale</button></td>
    </tr>
    <script type="text/javascript">
      $(document).on('click','.<?php echo $i;?>',function(){
        var code = $("#<?php echo $data->code;?>").text();
        $("#productcode").val(code).blur();
      });
    </script>
  <?php }} ?>
  </tbody>
</table>


    </div>
  </div>
</div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>

  </div>
</div>
</div>
<!-- all Product By Modul -->


<?php include "inc/footer.php";?>

<script type="text/javascript">
  $(function(){
    $("#phone").keyup(function(){
      var phone = $(this).val();
      var phone = phone.trim();
      if (phone == '') {
        alert("Phone Number Must not be Empty!!");
        $(this).val("<?php echo $customer->phone;?>");
      }else{

        $.ajax({
          url: "SelectCustomerval.php",
          method:"POST",
          data: {Phone:phone,typeval:'3'},
          success: function(data){
            $(".customerdetails").html(data);
          },
          error: function(data){
            alert("Somthing Error!!");
          }
        });

      }

    });

    $("#phone").change(function(){
      var phone = $(this).val();
      var phone = phone.trim();
      if (phone == '') {
        alert("Phone Number Must not be Empty!!");
        $(this).val("<?php echo $customer->phone;?>");
      }else{

        $.ajax({
          url: "SelectCustomerval.php",
          method:"POST",
          data: {myphone:phone,typeval:'3'},
          success: function(data){
            var obj = $.parseJSON(data);
            $("#realid").val(obj.id);
            $("#customerid").val(obj.customerid);
            $("#customername").val(obj.name);
            $("#address").val(obj.address);

            $("#customeridnewadd").val(obj.id);
          },
          error: function(data){
            alert("Somthing Error!!");
          }
        });

      }

    });

    $('#other').keyup(function(){
      $('#discount').val(0);
      var other = $(this).val();
      var subtotal = "<?php echo $all;?>";
      var predue = "<?php echo $payment->predue;?>";
      var paid = parseFloat($("#paid").val());
      var currentval = parseFloat($("#currentval").text());
      var changeval = parseFloat(subtotal) + parseFloat(other) + parseFloat(predue);
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
      var subtotal = <?php echo $all;?>;

      var last_dis = discount.slice(-1);
      if (last_dis == '%') {
        var discount = discount.substring(0, discount.length-1);
        var disamount = (discount/100)*subtotal;
      }else{
        var disamount = discount;
      }

      var other = $('#other').val();
      var predue = <?php echo $payment->predue;?>;
      var changeval = parseFloat(subtotal) + parseFloat(other) + parseFloat(predue);
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

    $('#paid').keyup(function(){
      var paid = $(this).val();
      var totalval = $('#totalval').html();
      if (paid == '' || paid == '0') {
        $("#returnamount").empty();
        $("#returnamount").html("Current Due");
        $("#currentval").text(totalval);
      } else {
        var due_amount = parseFloat(totalval)-paid;
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


      }
    });

    $("#productcode").blur(function(){
      var productcode = $(this).val();
      var productcode = productcode.trim();
      $.ajax({
        url: "selectproductbyedit.php",
        method:"POST",
        data: {productcode:productcode},
        success: function(data){
          var obj = $.parseJSON(data);
          $("#productidnewadd").val(obj.id);
          $("#productaddname").val(obj.name);
          $("#rateadd").val(obj.rate);
        },
        error: function(data){
          alert("Somthing Error!!");
        }
      });

      $.ajax({
        url:"selectproductindentifier.php",
        method:"POST",
        data:{ProductVal:productcode},
        success:function(data){
          if(data == "untiles"){
            $(".defaultval").hide();
            $(".totalcarton").show();
            $(".percarton").show();
            $(".qntadd").hide();
            $(".unit").hide();
            $(".totalcarton01").hide();
            $(".storeval").hide();
          } else if(data == "unstore"){
            $(".defaultval").hide();
            $(".totalcarton").hide();
            $(".percarton").hide();
            $(".qntadd").show();
            $(".unit").show();
            $(".totalcarton01").hide();
            $(".storeval").hide();
          } else if(data == "tiles"){
            $(".defaultval").hide();
            $(".totalcarton").hide();
            $(".percarton").hide();
            $(".qntadd").hide();
            $(".unit").hide();
            $(".totalcarton01").show();
          } else if(data == "store"){
            $(".defaultval").hide();
            $(".totalcarton").hide();
            $(".percarton").hide();
            $(".qntadd").hide();
            $(".unit").hide();
            $(".totalcarton01").hide();
            $(".storeval").show();
          }
        }
      });
      rateqnt();
    });

    $("#qntadd").keyup(function(){
      var qntadd = $(this).val();
      var rateadd = $("#rateadd").val();
      var totalrate = rateadd*qntadd;
      $("#totalrate").val(totalrate);
    });

    $("#rateadd").keyup(function(){
      var qntadd = $("#qntadd").val();
      var rateadd = $(this).val();
      var totalrate = rateadd*qntadd;
      $("#totalrate").val(totalrate);
    });

    $("#totalrate").click(function(){
      var qntadd = $("#qntadd").val();
      var rateadd = $("#rateadd").val();
      var totalrate = rateadd*qntadd;
      $(this).val(totalrate);
    });

    function rateqnt(){
      var qntadd = $("#qntadd").val();
      var rateadd = $("#rateadd").val();
      var totalrate = rateadd*qntadd;
      $("#totalrate").val(totalrate);
    }

  });

  $(document).on('click','.customerdetails ul li a',function(){
    $("#phone").val($(this).text()).change();
    $(".customerdetails").hide(200);
  });

</script>

<?php } }else{ echo "<script>window.location = 'addstore.php';</script>";}?>
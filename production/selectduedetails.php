<?php
 include_once "../classes/Employee.php";
 $em = new Employee();

 if (isset($_POST["Indinty"])) {
  $Indinty = $_POST["Indinty"];
  $userid = $_POST["userid"];

  $cust = (array) $em->SelectAll_By_ID("customer",$Indinty);
  $pay_status = $cust["typeval"];
  if ($cust["typeval"] == 3) {
    $pay_status = 2;
  }
  $due_invoice = $em->tbl_select_any("payment",array("customerid"=>$Indinty,"status"=>$pay_status,"duestatus"=>"0"),"*","id","asc");

?>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><?php if($cust["typeval"] == 1){echo "Receive";}else{echo "Pay";}?> Due Payment</h2>
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
      
      <div class="row">
        <div class="col-sm-12">
          <p style="text-align: center;font-size: 18px;font-weight: bolder;margin: 0;border-bottom: 1px solid;background: lightgreen;"><?php if($cust["typeval"] == 1){echo "Customer";}else{echo "Supplier";}?> Information</p>
          <table class="table table-bordered">
            <tr>
              <td>Name</td>
              <td width="2%">:</td>
              <td colspan="4"><?php echo $cust["name"];?></td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>:</td>
              <td><?php echo $cust["phone"];?></td>

              <td>Address</td>
              <td>:</td>
              <td><?php echo $cust["address"];?></td>
            </tr>
            <tr>
              <td>Company Name</td>
              <td>:</td>
              <td><?php echo $cust["company"];?></td>

              <td>Telephone</td>
              <td>:</td>
              <td><?php echo $cust["telephone"];?></td>
            </tr>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <p style="text-align: left;font-size: 18px;font-weight: bolder;margin: 0;border-bottom: 1px solid;">All Due Invoice List</p>
          <table class="table table-bordered">
            <thead>
              <tr class="bg-info">
                <th width="5%">SL</th>
                <th>Inv No</th>
                <th>Inv.Date</th>
                <th>Sub Total</th>
                <th>Other Cost</th>
                <th>Discount</th>
                <th>Grand Total</th>
                <th>Payment</th>
                <th>Due</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = $due_amt = $payment = $gndt = 0;
                while ($my_data = $due_invoice->fetch(PDO::FETCH_ASSOC)) {$i++;
                  $inv = $my_data["invoice"];

                  $received_by_payment = $my_data["received_by"];
                  $received_by_name = $em->SelectAll_By_ID("user",$received_by_payment,"name");
                  $my_data["received_by"] = $received_by_name->name;

                  $store_info = json_encode($my_data);
              ?>
              <tr>
                <td>
                  <textarea hidden="hidden" id="myinfo<?php echo $inv;?>"><?php echo $store_info;?></textarea>
                  <?php echo $i;?>
                </td>
                <td><?php echo $my_data["invoice"];?></td>
                <td><?php echo $my_data["date"];?></td>
                <td>
                  <?php
                    echo $subtotal = ($my_data["payment"]+$my_data["currentdue"]+$my_data["disamount"]-$my_data["other"]);
                  ?>
                </td>
                <td>
                  <?php
                    echo $my_data["other"];
                  ?>
                </td>
                <td>
                  <?php echo $my_data["disamount"];?>
                </td>
                <td>
                  <?php
                    echo $grandtotal = ($my_data["payment"]+$my_data["currentdue"]);$gndt += $grandtotal;
                  ?>
                </td>
                <td id="pay_amt<?php echo $inv;?>">
                  <?php
                    echo $my_data["payment"];$payment += $my_data["payment"];
                  ?>
                </td>
                <td id="cdue<?php echo $inv;?>">
                  <?php
                    echo $my_data["currentdue"];$due_amt += $my_data["currentdue"];
                  ?>
                </td>
                <td style="text-align: center;" id="inv_status<?php echo $inv;?>">
                  <button type="button" data-pro="<?php echo $inv;?>" onclick="javascript:modalOpen(this);" class="btn btn-success btn-sm">Pay</button>
                </td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right;font-weight:900;">Total</th>
                    <th style="font-weight:900;"></th>
                    <th style="font-weight:900;"></th>
                    <th style="font-weight:900;"></th>
                    <th style="font-weight:900;"><?=$gndt;?></th>
                    <th style="font-weight:900;"><?=$payment;?></th>
                    <th style="font-weight:900;"><?=$due_amt;?></th>
                    <th style="font-weight:900;"></th>
                </tr>
            </tfoot>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <input type="hidden" id="invoice_modal">
        <h4 class="modal-title" id="exampleModalLabel">Due Payment Slip</h4>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-sm-12">
            <table class="table table-bordered">
              <tr>
                <th width="15%">Billed By</th>
                <th width="2%">:</th>
                <th colspan="4" id="billed_by"></th>
              </tr>
              <tr>
                <th>Invoice ID</th>
                <th>:</th>
                <th id="inv_id"></th>

                <th width="15%">Invoice Date</th>
                <th width="2%">:</th>
                <th id="inv_date"></th>
              </tr>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <p style="margin:0px;font-weight: bold;font-size: 18px;border-bottom: 1px solid;">Items Info</p>
            <table class="table table-bordered">
              <thead>
                <tr class="bg-info">
                  <th width="2%">SL</th>
                  <th>Items</th>
                  <th width="15%" style="text-align: center;">Unit Price</th>
                  <th width="15%" style="text-align: center;">Qty</th>
                  <th width="15%" style="text-align: right;">Total (BDT)</th>
                </tr>
              </thead>
              <tbody id="my_items"></tbody>
              <tfoot>
                <tr>
                  <td colspan="4" style="text-align: right;">Sub Total</td>
                  <td colspan="4" id="sub_total"></td>
                </tr>
                <tr style="display: none;" id="other_tr">
                  <td colspan="4" style="text-align: right;">Other Cost</td>
                  <td colspan="4" id="other_cost">0</td>
                </tr>
                <tr style="display: none;" id="less_tr">
                  <td colspan="4" style="text-align: right;">Less</td>
                  <td colspan="4" id="less">0</td>
                </tr>
                <tr style="display: none;" id="grand_tr">
                  <td colspan="4" style="text-align: right;">Grand Total</td>
                  <td colspan="4" id="grand_total">0</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <p style="margin:0px;font-weight: bold;font-size: 16px;border-bottom: 1px solid;">Payment Info</p>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Received By</th>
                </tr>
              </thead>
              <tbody id="payment_list"></tbody>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-5">
            <div class="form-group">
              <label class="control-label col-sm-4" for="due" style="padding: 6px;text-align: right;">Current Due :</label>
              <div class="col-sm-8">
                <input type="number" autocomplete="off" class="form-control" style="text-align: center;" required="required" id="due" />
              </div>
            </div>
          </div>
          <div class="col-sm-5">
            <div class="form-group">
              <label class="control-label col-sm-4" for="due" style="padding: 6px;text-align: right;">Payment Type:</label>
              <div class="col-sm-8">
                (
                <input type="radio" name="amtype" id="mycash" checked="checked"/> Cash
                <input type="radio" name="amtype" id="mybank"/> Bank
                )
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <input type="date" id="mdate" value="<?php echo date('Y-m-d');?>" />
          </div>
        </div>

        <div style="text-align: center;margin-top: 10px;">
          <button class="btn btn-success btn-sm" type="button" id="pay_due">Pay Due</button>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="bankstatement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel2">Bank Statement Check Info</h4>
      </div>
      <div class="modal-body">

        <div class="row" style="padding: 6px;">

          <div class="col-md-12">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank Name :</label>
              <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 7px;">
                <input class="form-control col-md-7 col-xs-12" form="myformfr" id="bankname" type="text" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">A/C No :</label>
              <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 7px;">
                <input class="form-control col-md-7 col-xs-12" name="acno" form="myformfr" id="acno" type="text" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Deposit Slip No :</label>
              <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 7px;">
                <input class="form-control col-md-7 col-xs-12" name="slipno" form="myformfr" id="slipno" type="text" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Amount :</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" name="amountbank" form="myformfr" id="amountbank" type="text" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <br>
                <button type="button" class="btn btn-info" id="depositbank">Bank Deposit</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $("#pay_due").click(function(){
    var inv = $("#invoice_modal").val();
    var due = $("#due").val();

    var mybank = $("#mybank").is(":checked");
    var mycash = $("#mycash").is(":checked");
    var bankname = $("#bankname").val();
    var acno = $("#acno").val();
    var slipno = $("#slipno").val();
    var amountbank = $("#amountbank").val();
    var mdate = $("#mdate").val();

    var payment = $("#myinfo"+inv).val();
    var payment_info = JSON.parse(payment);

    var obj = {
      "mybank":mybank,
      "mycash":mycash,
      "bankname":bankname,
      "acno":acno,
      "slipno":slipno,
      "amountbank":amountbank,
      "due":due,
      "inv":inv,
      "mdate":mdate,
      "userid":'<?php echo $userid;?>'
    }

    var allinfo = {
      "payment":payment_info,
      "allinfo":obj,
      "phone":'<?php echo $cust["phone"];?>',
      "total_due_amount":'<?php echo $due_amt;?>'
    };
    if (due > 0) {
      $.ajax({
        url:"submitDuePayment.php",
        method:"POST",
        data:{allinfo:allinfo},
        success:function(sc_data){
          var due_obj = JSON.parse(sc_data);
          if (due_obj.cdue == 0) {
            $("#inv_status"+inv).text("Full Paid Invoice");
            $("#inv_status"+inv).css("color","green");
          }
          $("#pay_amt"+inv).text(due_obj.payment);
          $("#cdue"+inv).text(due_obj.cdue);
          $('#myModal').modal('hide');
        },
        error: function (err_me){
          console.error(err_me);
          alert("System Error!! Please Call IT Pal Solutions.");
        }
      });
    }else{
      alert("Due Amount Not Empty!!");
    }
    
  });
  $("#mybank").click(function(){
    $('#bankstatement').modal();
  });

  $("#closebank").click(function(){
    $("#mycash").prop("checked", true);
    $('#bankstatement').modal('hide');
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
  
  function modalOpen(indexval){
    var inv = $(indexval).data("pro");
    $("#invoice_modal").val(inv);
    try{
      var payment = $("#myinfo"+inv).val();
      var payment_info = JSON.parse(payment);setPayment(payment_info);
      var payment_type = payment_info.status;
      $.ajax({
        url:"selectduedetails_inner.php",
        method:"POST",
        data:{inv:inv,payment_type:payment_type},
        success:function(sc_data){
          var obj = JSON.parse(sc_data);
          var subtotal = setItems(obj.items);
          setTotal_info(payment_info,subtotal);
          setPayment_info(obj.due,payment_info);
          $("#due").val(payment_info.currentdue);
        },
        error: function (err_me){
          console.error(err_me);
          alert("System Error!! Please Call IT Pal Solutions.");
        }
      });
      $('#myModal').modal();
    }catch(err){}
  }
  function setPayment(payment){
    $("#billed_by").text(payment.received_by);
    $("#inv_id").text(payment.invoice);
    $("#inv_date").text(payment.date);
  }
  function setItems(items){
    var string_items = "";
    var j = 0;
    var total_amt = 0;
    for (var i = 0; i < items.length; i++) { j++;
      var total = parseFloat(items[i].rate)*parseFloat(items[i].quantity);
      string_items += "<tr>";
      string_items += "<td>"+j+"</td>";
      string_items += "<td>"+items[i].productid+"</td>";
      string_items += "<td>"+items[i].rate+"</td>";
      string_items += "<td>"+items[i].quantity+"</td>";
      string_items += "<td>"+(total)+"</td>";
      string_items += "</tr>";
      total_amt += total;
    }
    $("#my_items").empty();
    $("#my_items").append(string_items);
    return total_amt;
  }

  function setTotal_info(payment,subtotal){
    $("#sub_total").text(subtotal);
    var status = false;
    if (parseInt(payment.other) > 0) {
      status = true;
      $("#other_tr").show();
      $("#other_cost").text(payment.other);
    }else{
      $("#other_tr").hide();
    }
    if (parseInt(payment.disamount) > 0) {
      status = true;
      $("#less_tr").show();
      $("#less").text(payment.disamount);
    }else{
      $("#less_tr").hide();
    }
    if (status) {
      var grand = parseFloat(payment.other)+subtotal-parseFloat(payment.disamount);
      $("#grand_tr").show();
      $("#grand_total").text(grand);
    }else{
      $("#grand_tr").hide();
    }
  }

  function setPayment_info(due_pay,payment_info){
    var string_items = "";
    if (due_pay == "") {
      if (parseInt(payment_info.payment) > 0) {
        string_items += "<tr>";
        string_items += "<td>1</td>";
        string_items += "<td>Inovice Date</td>";
        string_items += "<td>"+payment_info.payment+"</td>";
        string_items += "<td>Invoice Person</td>";
        string_items += "</tr>";
      }else{
        string_items += "<tr>";
        string_items += "<td colspan='4' style='color:red;text-align:center;'>Due Invoice Created</td>";
        string_items += "</tr>";
      }
    }else{
      var jj = 0;
      var subTotal = 0;
      var paid_amt = parseFloat(payment_info.payment);
      for (var i = 0; i < due_pay.length; i++) {jj++;
        var amt_pay = parseFloat(due_pay[i].amount);
        subTotal += amt_pay;
        string_items += "<tr>";
        string_items += "<td>"+jj+"</td>";
        string_items += "<td>"+due_pay[i].date+"</td>";
        string_items += "<td>"+amt_pay+"</td>";
        string_items += "<td>"+due_pay[i].received_by+"</td>";
        string_items += "</tr>";
      }
      if ((paid_amt-subTotal) > 0) {
        string_items += "<tr>";
        string_items += "<td>"+(jj+1)+"</td>";
        string_items += "<td>"+payment_info.date+"</td>";
        string_items += "<td>"+(paid_amt-subTotal)+"</td>";
        string_items += "<td>"+payment_info.received_by+"</td>";
        string_items += "</tr>";
      }
    }
    $("#payment_list").empty();
    $("#payment_list").append(string_items);
  }
</script>
<?php } ?>
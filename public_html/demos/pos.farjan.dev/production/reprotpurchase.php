<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $ind = new Inden();
  $datei = date('m/d/Y');
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Report Section</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
              <a href="reprotpurchase.php" class="btn btn-default">Refresh</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row" id="datasearch">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Purchase Report</h2>
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
            <form class="form-horizontal">
            <div style="width: 50%;margin: 0 auto;">
              <fieldset>
                <div class="control-group">
                  <div class="controls">
                    <div class="input-prepend input-group">
                      <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                      <input type="text" style="width: 300px" id="reservation" class="form-control" value="<?php echo date('m/d/Y');?> - <?php echo date('m/d/Y');?>"/>
                    </div>
                  </div>
                </div>
                <div class="control-group">
                  <div class="controls">
                    <div class="input-prepend input-group">
                    <select class="purpuse select2_multiple form-control" id="purpuse" style="width: 340px">
                      <option value="all">All Report</option>
                      <?php
                        $Sector = $ind->Tbl_Col_Id('customer','typeval','3');
                        if ($Sector) {
                          while ($data = $Sector->fetch(PDO::FETCH_OBJ)) {
                      ?>
                        <option value="<?php echo $data->id;?>"><?php echo $data->name." (".$data->phone.")";?></option>
                      <?php } } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <p id="ok" class="btn btn-info btn-lg">Search</p>
              </fieldset>
              </div>
            </form>
            </div>
          </div>
          </div>
          </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Purchase Report</h2>
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
            <div id="printTable">
            <div class="myreport">
            <h2 style="text-align: center;margin-top: 0;margin-bottom: 4px;">Purchase Report</h2>
            <p style="text-align: center;border-bottom: 2px solid;">Date : <?php echo $ind->hl->formatDate01(date('m/d/Y'));?></p>
              <table style="width: 100%;font-size: 16px;">
                <tr style="" class="bg-primary">
                  <th style="padding: 5px 4px;border: 1px solid;">SL.No</th>
                  <th style="padding: 5px 0px;border: 1px solid;">Date</th>
                  <th style="padding: 5px 0px;border: 1px solid;">Purchase No</th>
                  <th style="padding: 5px 0px;border: 1px solid;">Supplier Name</th>
                  <th style="padding: 5px 0px;border: 1px solid;">Supplier Phone</th>
                  <th style="padding: 5px 0px;border: 1px solid;">Amount(<?php echo $farjan->amountsymbol;?>)</th>
                </tr>
                <?php
                   $report = $ind->Tbl_Col_Id('payment','status','2');
                   $i = 0;
                   $sum = 0;
                   if ($report) {
                     while ($data = $report->fetch(PDO::FETCH_OBJ)) { $i++;
                ?>
                <tr>
                  <td style="padding: 5px 4px;border: 1px solid;"><?php echo $i;?></td>
                  <td style="padding: 5px 4px;border: 1px solid;"><?php echo $ind->hl->formatDate01($data->date);?></td>
                  <td style="padding: 5px 4px;border: 1px solid;"><a href="<?php echo $purchase;?>.php?invoice=<?php echo $data->invoice;?>"><?php echo $data->invoice;?></a></td>
                  <td style="padding: 5px 4px;border: 1px solid;"><?php $cust = $ind->SelectAll_By_ID('customer',$data->customerid);echo $cust->name;?></td>
                  <td style="padding: 5px 4px;border: 1px solid;"><?php echo $cust->phone;?></td>
                  <td style="padding: 5px 4px;border: 1px solid;"><?php echo $sumval = $data->payment;?></td>
                </tr>
                <?php
                  $sum = $sum + $sumval;
                ?>
              <?php }} ?>
              <tr style="height: 50px;">
                <td></td>
                <td colspan="3" style="text-align: center;">Total</td>
                <td><?php echo $sum;?></td>
              </tr>
              </table>
            </div>
            </div>
            <div style="width: 10%;margin: 0 auto;margin-top: 30px;">
              <button style="width: 100%;text-align: center;" class="btn btn-default" id="print">Print</button>
            </div>
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
  $("#ok").click(function(){
    var purpuse = $("#purpuse").val();
    var date = $("#reservation").val();
    var date1 = date.trim();
    if (date == '') {
      alert('Filds Must Not Be Empty!!');
    }else{
      $.ajax({
        url:"SelectIncomeReprot.php",
        method:"POST",
        data:{Dateval:date1,Status:2,purpuse:purpuse},
        success:function(data){
          $(".myreport").empty();
          $(".myreport").append(data);
          $("#datasearch").slideUp(1000);
        }
      });
    }
  });
});
</script>

<script type="text/javascript">
  $(function(){
    $("#print").click(function(){
      printData();
    });
  });


  function printData(){
     var divToPrint=document.getElementById("printTable");
     newWin= window.open("");
     newWin.document.write(divToPrint.outerHTML);
     newWin.print();
     //newWin.close();
  }
</script>
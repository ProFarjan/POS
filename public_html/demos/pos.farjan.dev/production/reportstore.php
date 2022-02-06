<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $po = new Store();
  $product = $po->SelectAll('product');
  $product1 = $po->SelectProduct_By_Type('product');
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Store Report</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
              <a href="reprotincome.php" class="btn btn-default">Refresh</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="x_content">
      <form class="form-horizontal">
      <div style="width: 50%;margin: 0 auto;">
        <fieldset>
          <div class="control-group">
            <div class="controls">
              <div class="input-prepend input-group">
              <select class="purpuse select2_multiple form-control" id="purpuse" style="width: 340px" multiple>
                <option value="">Select Product...</option>
                <?php
                  while ($data = $product1->fetch(PDO::FETCH_OBJ)) {
                ?>
                <option value="<?php echo $data->type;?>"><?php echo $data->type;?></option>
                <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <p id="ok" class="btn btn-info btn-lg">Search</p>
        </fieldset>
        </div>
      </form>
      </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Current Store Report</h2>
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
            <h2 style="text-align: center;margin-top: 0;margin-bottom: 4px;">Store Report</h2>
            <p style="text-align: center;border-bottom: 2px solid;">Date : <?php echo $po->hl->formatDate01(date('m/d/Y'));?></p>
              <table style="width: 100%;font-size: 16px;text-align: center;">
                <tr style="" class="bg-primary">
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">P.Code</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">P.Name</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Catagory</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Sub Catagory</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Store In QTY</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Destroy QTY</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Salling QTY</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Current QTY</th>
                </tr>
                <?php
                        $i = 0;
                        $pieceval = $po->Total_Piece(30);
                        if ($product) {
                          while ($data = $product->fetch(PDO::FETCH_OBJ)) { $i++;
                            $destroy = $po->TBL_VAL_52('destroy','productid',$data->id,'destroy');
                      ?>
                        <tr>
                          <td style="padding: 5px 0px;border: 1px solid;"><?php echo $data->code;?></td>
                          <td style="padding: 5px 0px;border: 1px solid;"><?php echo $data->name;?></td>
                          <td style="padding: 5px 0px;border: 1px solid;"><?php echo $data->type;?></td>
                          <td style="padding: 5px 0px;border: 1px solid;"><?php echo $data->subtype;?></td>
                          <td style="padding: 5px 0px;border: 1px solid;">
                          <?php 
                            $alldata = $po->All_Store_Status($data->id);
                            if ($alldata->unit == '0') {
                              $unit = "sq/ft";
                            }else{
                              $unit = $alldata->unit;
                            }
                            if ($data->type == 'Tiles') {
                               $car = $po->Tbl_Col_Id_LIMITE_0('store','productid',$data->id);
                                if ($car) {
                                  $perca = $car->percarton;
                                }else{
                                  $perca = "1";
                                }
                                $inch = $data->name;
                                $val = explode('*', $inch);
                                $insq = $val[0]*$val[1];
                                $ftsq = $insq*0.00694444;
                                $piecea = ($alldata->TOTALCARTON)/($ftsq);
                              echo $st_to =  $alldata->TOTALCARTON."sq/ft | ";
                              echo $st_cr = round(($alldata->TOTALCARTON/$perca),2)."C | ";
                              echo $st_pi = round($piecea,2)."P";
                            }else{
                              echo $alldata->QUANTITY." ".ucfirst($unit);
                            }
                          ?> 
                          </td>
                          <td style="padding: 5px 0px;border: 1px solid;">
                          <?php 
                            if ($alldata->unit == '0') {
                              $unit = "sq/ft";
                            }else{
                              $unit = $alldata->unit;
                            }
                            if ($data->type == 'Tiles') {
                               $car = $po->Tbl_Col_Id_LIMITE_0('store','productid',$data->id);
                                if ($car) {
                                  $perca = $car->percarton;
                                }else{
                                  $perca = "1";
                                }
                                $inch = $data->name;
                                $val = explode('*', $inch);
                                $insq = $val[0]*$val[1];
                                $ftsq = $insq*0.00694444;
                                $piecea = ($destroy)/($ftsq);
                              echo $de_to =  $destroy."sq/ft | ";
                              echo $de_cr = round(($destroy/$perca),2)."C | ";
                              echo $de_pi = round($piecea,2)."P";
                            } else {
                              echo $destroy." ".ucfirst($unit);
                            }
                          ?> 
                          </td>
                          <td style="padding: 5px 0px;border: 1px solid;">
                            <?php 
                              $incomeval = $po->Saleing_Product($data->id);
                              $incomedata = $incomeval->fetch(PDO::FETCH_OBJ);
                              if ($incomedata->QUANTITY == "" || empty($incomedata->QUANTITY)) {
                                echo "0";
                              }else{
                                if($incomedata->unit == 'sq/ft'){
                                  echo $se_to = $incomedata->QUANTITY."sq/ft | ";
                                  echo $se_cr = round($incomedata->QUANTITY/$perca,2)."C | ";
                                  echo $se_pi = round($incomedata->QUANTITY/$ftsq,2)."P";
                                }else{
                                  echo $incomedata->QUANTITY." ".$incomedata->unit;
                                }
                              }
                               
                            ?> 
                          </td>
                          <td style="padding: 5px 0px;border: 1px solid;">
                            <?php
                              if ($data->type == 'Tiles') {

                               if($incomedata->unit == 'sq/ft'){
                                echo $st_to-$se_to."sq/ft | ";
                                echo $st_cr-$se_cr."C | ";
                                echo $st_pi-$se_pi."P | ";
                               }else{
                                echo ($alldata->QUANTITY)-($incomedata->QUANTITY)-($destroy)." ".ucfirst($unit);
                               }
                              }else{
                                echo ($alldata->QUANTITY)-($incomedata->QUANTITY)-($destroy)." ".ucfirst($unit);
                              }
                            ?>
                          </td>
                        </tr>
                      <?php } } ?>
              </table>
            </div>
            </div>
            <div style="width: 10%;margin: 0 auto;margin-top: 30px;">
              <button style="width: 100%;text-align: center;" class="btn btn-info" id="print">Print</button>
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
    var product = $("#purpuse").val();
    if (product == "") {
      alert("Product must not be empty!!");
    } else {
      $.ajax({
        url:"selectstorereport.php",
        method:"POST",
        data:{product:product},
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
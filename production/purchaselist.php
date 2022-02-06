<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $in = new Purchase();
 if (isset($_GET['del']) AND !empty($_GET['del'])) {
   $del_invoice = $in->hl->validation($_GET['del']);
   if (strlen($del_invoice) == 14) {
    $deldata = $in->Delete_01('purchase','purchaseno',$del_invoice);
    $deldata = $in->Delete_01('payment','invoice',$del_invoice);
    $deldata = $in->Delete_01('store','purchaseno',$del_invoice);
   }
 }
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>All Invoice</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="purchase.php" class="btn btn-info">Add Purchase</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <?php if(isset($deldata)){ ?>
      <p class="alert alert-success"><strong>Success !</strong> This Purchase (<?php echo $del_invoice;?>) Delete Successfully.</p>
    <?php } ?>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Invoice List</h2>
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
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Date</th>
                    <th>Purchase No</th>
                    <th>Supplier ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Payment</th>
                    <th>Due</th>
                    <th>Status</th>
                  </tr>
                </thead>


                <tbody>
                <?php
                  $storedata = $in->Tbl_Col_Id("payment","status","2");
                  $i = 0;
                  if ($storedata) {
                    while ($data = $storedata->fetch(PDO::FETCH_OBJ)) { $i++;
                      $cust = $in->Tbl_Col_Id_LIMITE_0('customer','id',$data->customerid);
                ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $in->hl->formatDate01($data->date);?></td>
                    <td><a href="<?php echo $purchase;?>.php?invoice=<?php echo $data->invoice;?>"><?php echo $data->invoice;?></a></td>
                    <td><a href="customerone.php?id=<?php echo $data->customerid;?>" target="_blank"><?php echo $cust->customerid;?></a></td>
                    <td><a href="customerone.php?id=<?php echo $data->customerid;?>" target="_blank"><?php echo $cust->name;?></a></td>
                    <td><a href="customerone.php?id=<?php echo $data->customerid;?>" target="_blank"><?php echo $cust->phone;?></a></td>
                    <td><?php echo $data->payment;?></td>
                    <td>
                      <?php
                        if($data->currentdue == '0' || $data->duestatus == '1'){
                          echo "0";
                        }else{
                          echo $data->currentdue;
                        }
                      ?>
                    </td>
                    <td>
                      <?php if($data->currentdue == '0' || $data->duestatus == '1'){ ?>
                        <a href="<?php echo $purchase;?>.php?invoice=<?php echo $data->invoice;?>" class="btn btn-success btn-xs">Paid</a>
                      <?php } elseif($data->payment == "0.0" || $data->payment == "0") { ?>
                        <a href="<?php echo $purchase;?>.php?invoice=<?php echo $data->invoice;?>" class="btn btn-danger btn-xs">Unpaid</a>
                      <?php } else { 
                        $grandtotal = $data->payment+$data->currentdue;
                        $paid_parsen = ($data->payment*100)/$grandtotal;
                        $paid_parsen = round($paid_parsen);
                      ?>
                        <a href="<?php echo $purchase;?>.php?invoice=<?php echo $data->invoice;?>" class="btn btn-info btn-xs"><?php echo $paid_parsen."% Paid";?></a>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } } ?>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->



<?php include "inc/footer.php";?>
<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $in = new Income();
 if (isset($_GET['del']) AND !empty($_GET['del'])) {
   $del_invoice = $in->hl->validation($_GET['del']);
   if (strlen($del_invoice) == 14) {
    $deldata = $in->Delete_01('income','invoice',$del_invoice);
    $deldata1 = $in->Delete_01('payment','invoice',$del_invoice);
    try {
      $deldata1 = $in->Delete_01('due','invoiceid',$del_invoice);
    } catch (Exception $e) {}
   }
 }
?>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title" style="margin:0px;">
    </div>

    <div class="clearfix"></div>

    <?php
      if (isset($deldata1)) {
    ?>
    <p class="alert alert-success"><strong>Success !</strong> Successfully Delete This Inovice (<?php echo $del_invoice;?>).</p>
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
                  <tr class="bg-info">
                    <th>SL</th>
                    <th>Date</th>
                    <th>Invoice No</th>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Payment</th>
                    <th>Due</th>
                    <th>Status</th>
                    <th>Billed By</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $storedata = $in->Tbl_Col_Id("payment","status","1");
                  $i = 0;
                  if ($storedata) {
                    while ($data = $storedata->fetch(PDO::FETCH_OBJ)) { $i++;
                      $cust = $in->Tbl_Col_Id_LIMITE_0('customer','id',$data->customerid);
                ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $in->hl->formatDate01($data->date);?></td>
                    <td>
                      <a href="<?php echo $invoice;?>.php?invoice=<?php echo $data->invoice;?>"><?php echo $data->invoice;?></a>
                    </td>
                    <td><a href="customerone.php?id=<?php echo $data->customerid;?>" target="_blank"><?php echo $cust->customerid;?></a></td>
                    <td><?php echo $cust->name;?></a></td>
                    <td><?php echo $cust->phone;?></a></td>
                    <td><?php echo $data->payment;?></td>
                    <td><?php echo $data->currentdue;?></td>
                    <td>
                      <?php if($data->currentdue == '0'){ ?>
                        <a href="<?php echo $invoice;?>.php?invoice=<?php echo $data->invoice;?>" class="btn btn-success btn-xs">Paid</a>
                      <?php }elseif($data->payment == 0){ ?>
                        <a href="<?php echo $invoice;?>.php?invoice=<?php echo $data->invoice;?>" class="btn btn-danger btn-xs">Unpaid</a>
                      <?php }else{ 
                        $grandtotal = $data->payment+$data->currentdue;
                        $paid_parsen = ($data->payment*100)/$grandtotal;
                        $paid_parsen = round($paid_parsen);
                      ?>
                        <a href="<?php echo $invoice;?>.php?invoice=<?php echo $data->invoice;?>" class="btn btn-info btn-xs"><?php echo $paid_parsen."% Paid";?></a>
                      <?php } ?>
                    </td>
                    <td>
                      <?php
                          $received_by_payment = $data->received_by;
                          $received_by = Session::get('UserId');
                          if ($received_by_payment == $received_by) {
                            echo Session::get('UserName');
                          }else{
                            $received_by_name = $in->SelectAll_By_ID("user",$received_by_payment,"name");
                            echo $received_by_name->name;
                          }
                        ?>
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
<?php include "inc/footer.php";?>
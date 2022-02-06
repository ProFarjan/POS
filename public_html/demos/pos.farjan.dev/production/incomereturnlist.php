<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $in = new Income();
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Sales Product Return List</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="incomereturn.php" class="btn btn-info">Sales Return</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>All List</h2>
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
                  <tr class="bg-primary">
                    <th>SL</th>
                    <th>Date</th>
                    <th>Invoice No</th>
                    <th>Product Info</th>
                    <th>Return Amount</th>
                  </tr>
                </thead>


                <tbody>
                <?php
                  $storedata = $in->Tbl_Col_Id('returnval','status',1);
                  $i = 0;
                  if ($storedata) {
                    while ($data = $storedata->fetch(PDO::FETCH_OBJ)) { $i++;
                      $wel = $in->SelectAll_By_ID('payment',$data->invoiceid);
                ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $in->hl->formatDate01($data->date);?></td>
                    <td><a href="<?php echo $invoice;?>.php?invoice=<?php echo $wel->invoice;?>"><?php echo $wel->invoice;?></a></td>
                    <td>
                      <?php
                        $p_info = $in->Tbl_Col_Id_2_not("income","invoice","returninfo",$wel->invoice,"0");
                        while ($pdinfo = $p_info->fetch(PDO::FETCH_OBJ)) {
                          $product_in = $in->SelectAll_By_ID("product",$pdinfo->productid,'code');
                          echo $product_in->code."-".$pdinfo->returninfo," , ";
                        }
                      ?>
                    </td>
                    <td><?php echo $data->amount;?></td>
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
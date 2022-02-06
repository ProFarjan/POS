<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $po = new Product();
  if (isset($_GET['info']) AND !empty($_GET['info'])) {
  	$id = $_GET['info'];
  	$product = $po->SelectAll_By_ID('product',$id);
  	if ($product) {
?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Present Store Product Status</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <button onclick="goBack()" class="btn btn-primary large">Back</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Product Code : <?php echo $product->code;?></h2>
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
              <div class="col-md-4 tile">
                <span>Total Present This Product To Store</span>
                <h2 style="font-weight: bold;" id="totalsales"></h2>
                <span class="sparkline_two" style="height: 160px;">
                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                </span>
              </div>
              <div class="col-md-4 tile"></div>
              <div class="col-md-4 tile">
                <ul style="font-size: 17px;">
                  <li>Product Name: <?php echo $product->name;?></li>
                  <li>Product Catagroy: <?php echo $product->type;?></li>
                  <li>Product Sub Catagroy: <?php echo $product->subtype;?></li>
                  <li>Product Rate: <?php echo $product->rate;?></li>
                </ul>
              </div>
          </div>
          <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr class="bg-primary">
                          <th>SL</th>
                          <th>Date</th>
                          <th>Chalan No</th>
                          <th>Quantity</th>
                          <th>Purchase No</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $storedata = $po->Tbl_Col_Id_2('store','productid','available',$product->id,'0');
                        $i = $totalsalse = 0;
                        if ($storedata) {
                          while ($data = $storedata->fetch(PDO::FETCH_OBJ)) { $i++;
                      ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $po->hl->formatDate01($data->date);?></td>
                          <td>
                            <?php
                              echo $data->chalanno;
                            ?>
                          </td>
                          <td>
                            <?php
                              if ($data->salesinfo == "0") {
                                $qnt_store = $data->quantity;
                              }else{
                                $qnt_store_info = unserialize($data->salesinfo);
                                $qnt_store = $qnt_store_info['available'];
                              }
                              if ($product->type == "Tiles") {
                                $perca = $data->percarton;
                                $inch = $product->name;
                                $val = explode('*', $inch);
                                $insq = $val[0]*$val[1];
                                $ftsq = $insq*0.00694444;
                                echo $qnt_store."sq/ft | ";
                                echo round($qnt_store/$perca,2)."C | ";
                                echo round($qnt_store/$ftsq,2)."P";
                              }else{
                                echo $qnt_store." ".$data->unit;
                              }
                              $totalsalse += $qnt_store;
                            ?>
                          </td>
                          <td><a href="<?php echo $purchase;?>.php?invoice=<?php echo $data->purchaseno;?>"><?php echo $data->purchaseno;?></a></td>
                        </tr>
                      <?php }} ?>
                      </tbody>
                    </table>
                  </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php }}else{echo "<script>window.location = 'storestatus.php';</script>";}?>
<?php include "inc/footer.php";?>

<script type="text/javascript">
  $(function(){
    $("#totalsales").text("<?php echo $totalsalse;?>");
  });
</script>
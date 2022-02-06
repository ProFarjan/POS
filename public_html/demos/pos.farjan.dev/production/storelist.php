<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $po = new Store();
  $product = $po->SelectAll('store');
  if (isset($_GET['delete']) AND !empty($_GET['delete'])) {
    $id = $_GET['delete'];
    $product_Del = $po->Delete('store',$id);
    header('Location: '.$_SERVER['PHP_SELF']);
  }
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>All Store List</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <a href="addstore.php" class="btn btn-primary">Add Store</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Product List On Store</h2>
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
                  <span id="message123"><?php if(isset($product_Del)){echo $product_Del;}?></span>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr class="bg-primary">
                          <th>SL</th>
                          <th>Date</th>
                          <th>Code</th>
                          <th>Product Info</th>
                          <th>Product Name</th>
                          <th>Quantity</th>
                          <th>Chalan No</th>
                          <th>Purchase ID</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php
                        $i = 0;
                        if ($product) {
                          while ($data = $product->fetch(PDO::FETCH_OBJ)) { $i++;
                      ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $po->hl->formatDate01($data->date);?></td>
                          <td><?php $proid = $po->SelectAll_By_ID('product',$data->productid);echo $proid->code;?></td>
                          <td><?php echo $proid->type." || ".$proid->subtype;?></td>
                          <td><?php echo $proid->name;?></td>
                          <td>
                            <?php
                                if ($proid->type == 'Tiles') {
                                  $inch = $proid->name;
                                  $val = explode('*', $inch);
                                  $insq = $val[0]*$val[1];
                                  $ftsq = $insq*0.00694444;
                                  echo $data->totalcarton." sq/ft | ".round(($data->totalcarton/$data->percarton),2)."C | ".round(($data->totalcarton/$ftsq),2)."P";
                                }else{
                                  echo $data->quantity." ".$data->unit;
                                }
                            ?>
                          </td>
                          <td><?php echo $data->chalanno;?></td>
                          <td>
                            <?php
                              if ($data->purchaseid == "0") {
                            ?>
                              <a onclick="return confirm('Are Your Sure Delete Store Data!!');" href="?delete=<?php echo $data->id;?>" class="btn btn-danger btn-xs">Delete</a>
                            <?php }else{ ?>
                              <a href="<?php echo $purchase;?>.php?invoice=<?php echo $data->purchaseno;?>"><?php echo $data->purchaseno;?></a>
                            <?php } ?>
                          </td>
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
        </div>
        <!-- /page content -->



<?php include "inc/footer.php";?>
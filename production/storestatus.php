<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $po = new Store();
  $product = $po->SelectAll('product');
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>All Store List</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Product List</h2>
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
                          <th>Code</th>
                          <th>Product Info</th>
                          <th>Name</th>
                          <th>Quantity</th>
                          <th width="10%">Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php
                        $i = 0;
                        if ($product) {
                          while ($data = $product->fetch(PDO::FETCH_OBJ)) { $i++;
                            $alldata = $po->All_Store_Status($data->id);
                            if (empty($alldata->TOTALCARTON) AND empty($alldata->QUANTITY)) {
                             
                            }else{
                      ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><p><?php echo $data->code;?></p></td>
                          <td><?php echo $data->type." || ".$data->subtype;?></td>
                          <td><?php echo $data->name;?></td>
                          <td>
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
                              echo $alldata->TOTALCARTON."sq/ft | ";

                              echo round($alldata->TOTALCARTON/$perca,2)."C | ";
                              $inch = $data->name;
                              $val = explode('*', $inch);
                              $insq = $val[0]*$val[1];
                              $ftsq = $insq*0.00694444;
                              echo round(($alldata->TOTALCARTON/$ftsq),2)."P";

                            }else{
                              echo $alldata->QUANTITY." ".ucfirst($unit);
                            }
                          ?> 
                          </td>
                          <td width="10%"><a href="allstorestatus.php?info=<?php echo $data->id;?>" class="btn btn-info btn-xs">View</a></td>
                        </tr>
                      <?php }}} ?>
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
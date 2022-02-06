<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $po = new Store();
  $product = $po->SelectAll('product');
?>
<style type="text/css">
#blue{color:blue;font-weight: bold;}
#green{color:green;font-weight: bold;}
#red{color:navy;font-weight: bold;}
</style>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Current Store List</h3>
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
                          <th>Store Quantity</th>
                          <th>Destroy Quantity</th>
                          <th>Saling Quantity</th>
                          <th>Current Quantity</th>
                          <!-- <th width="10%">Action</th> -->
                        </tr>
                      </thead>


                      <tbody>
                      <?php
                        $i = 0;
                        //echo $pieceval = $po->Total_Piece(30);
                        if ($product) {
                          while ($data = $product->fetch(PDO::FETCH_OBJ)) { $i++;
                            $alldata = $po->All_Store_Status($data->id);
                            $destroy = $po->TBL_VAL_52('destroy','productid',$data->id,'destroy');
                            if(empty($alldata->TOTALCARTON) AND empty($alldata->QUANTITY)){

                            }else{
                      ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $data->code;?></td>
                          <td><?php echo $data->type.' || '.$data->subtype;?></td>
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
                                $inch = $data->name;
                                $val = explode('*', $inch);
                                $insq = $val[0]*$val[1];
                                $ftsq = $insq*0.00694444;
                                $piecea = ($alldata->TOTALCARTON)/($ftsq);
                              echo $st_to =  $alldata->TOTALCARTON."sq/ft | ";
                              echo $st_cr = round(($alldata->TOTALCARTON/$perca),2)."C | ";
                              echo $st_pi = round($piecea,2)."P";
                            }else{
                              if ($alldata->QUANTITY != 0) {
                                echo $alldata->QUANTITY." ".ucfirst($unit);
                              }
                            }
                          ?> 
                          </td>
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
                                $inch = $data->name;
                                $val = explode('*', $inch);
                                $insq = $val[0]*$val[1];
                                $ftsq = $insq*0.00694444;
                                $piecea = ($destroy)/($ftsq);
                              echo $de_to =  $destroy."sq/ft | ";
                              echo $de_cr = round(($destroy/$perca),2)."C | ";
                              echo $de_pi = round($piecea,2)."P";
                            } else {
                              if ($destroy != 0) {
                                echo $destroy." ".ucfirst($unit);
                              }
                            }
                          ?> 
                          </td>
                          <td>
                            <a href="incomestatus.php?info=<?php echo $data->id;?>">
                            <?php 
                              $incomeval = $po->Saleing_Product($data->id);
                              $incomedata = $incomeval->fetch(PDO::FETCH_OBJ);
                              if ($incomedata->QUANTITY == "" || empty($incomedata->QUANTITY)) {
                                //echo "0";
                              }else{
                                if($incomedata->unit == 'sq/ft'){
                                  echo $se_to = $incomedata->QUANTITY."sq/ft | ";
                                  echo $se_cr = round($incomedata->QUANTITY/$perca,2)."C | ";
                                  echo $se_pi = round($incomedata->QUANTITY/$ftsq,2)."P";
                                }else{
                                  if ($incomedata->QUANTITY != 0) {
                                    echo $incomedata->QUANTITY." ".$incomedata->unit;
                                  }
                                }
                              }
                            ?>
                            </a>
                          </td>
                          <td>
                            <a href="currentstatusin.php?info=<?php echo $data->id;?>">
                            <?php
                              if ($data->type == 'Tiles') {

                               if($incomedata->unit == 'sq/ft'){
                                echo $st_to-$se_to-$de_to."sq/ft | ";
                                echo $st_cr-$se_cr-$de_cr."C | ";
                                echo $st_pi-$se_pi-$de_pi."P";
                               }else{
                                echo ($alldata->QUANTITY)-($incomedata->QUANTITY)-($destroy)." ".ucfirst($unit);
                               }
                              }else{
                                if ($alldata->QUANTITY != 0) {
                                  echo ($alldata->QUANTITY)-($incomedata->QUANTITY)-($destroy)." ".ucfirst($unit);
                                }
                              }
                            ?>
                            </a>
                          </td>
                          <!-- <td width="10%"><a href="incomestatus.php?info=<?php echo $data->id;?>" class="btn btn-info btn-xs">View</a></td> -->
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
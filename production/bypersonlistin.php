<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $po = new Expense();
  $product = $po->Tbl_Col_Id('cashin','status','1');
  if (isset($_GET['delete']) AND !empty($_GET['delete'])) {
    $id = $_GET['delete'];
    $product_Del = $po->Delete('cashin',$id);
  }
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Loan Receive List</h3>
              </div>

              <div class="title_right">
                <div class="col-md-2 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <button onclick="goBack();" class="btn btn-info">Back</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
                    Loan Receive Statement</h2>
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
                          <th>Person Name</th>
                          <th>Person Mobile</th>
                          <th>Destination</th>
                          <th>Amount</th>
                          <th>Note</th>
                          <th>Action</th>
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
                          <td><?php echo $data->person;?></td>
                          <td><?php echo $data->mobile;?></td>
                          <td><?php echo $data->destination;?></td>
                          <td><?php echo $data->amount;?></td>
                          <td><?php echo $data->note;?></td>
                          <td width="10%"><a onclick="return confirm('Are Your Sure Delete This Data!!');" href="?delete=<?php echo $data->id;?>" class="btn btn-danger btn-xs">Delete</a></td>
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
<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $po = new Product();
  $product = $po->SelectAll('product');
  if (isset($_GET['delete']) AND !empty($_GET['delete'])) {
    $id = $_GET['delete'];
    $product_Del = $po->Delete('product',$id);
  }
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>All Product List</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                     <a href="productadd.php"><button class="btn btn-primary">Add Product</button></a>
                    </span>
                  </div>
                </div>
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
                    <table id="datatable" class="table table-bordered">
                      <thead>
                        <tr class="bg-primary">
                          <th>SL</th>
                          <th>Code</th>
                          <th>Name</th>
                          <th>Rate</th>
                          <th>Catagory</th>
                          <th>Sub Catagory</th>
                          <th width="20%">Action</th>
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
                          <td><?php echo $data->code;?></td>
                          <td><?php echo $data->name;?></td>
                          <td><?php echo $data->rate;?></td>
                          <td><?php echo $data->type;?></td>
                          <td><?php echo $data->subtype;?></td>
                          <td width="20%"><a href="productadd.php?update=<?php echo $data->id;?>" class="btn btn-primary">Update</a><a onclick="return confirm('Are Your Sure Delete This Product!!');" href="?delete=<?php echo $data->id;?>" class="btn btn-danger">Delete</a></td>
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
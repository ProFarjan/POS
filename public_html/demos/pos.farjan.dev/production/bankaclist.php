<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $po = new Expense();
  $acinfo = $po->SelectAll_Val('tbl_account','bankname');
  if (isset($_GET['delete']) AND !empty($_GET['delete'])) {
    $id = $_GET['delete'];
    $product_Del = $po->Delete('tbl_account',$id);
  }
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>All Bank A/C List</h3>
              </div>

              <div class="title_right">
                <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
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
                    <h2> Account Infomartion</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php if(isset($product_Del)){ ?><p id="message123" style="text-align: center;border: dashed;padding: 6px;color: green;"> This Bank Account Deleted Successfully !!</p><?php } ?>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr class="bg-primary">
                          <th>SL</th>
                          <th>A/C Number</th>
                          <th>Bank Name</th>
                          <th>Initail Balance</th>
                          <th>Note</th>
                          <th>Reg. Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php
                        $i = 0;
                        if ($acinfo) {
                          while ($data = $acinfo->fetch(PDO::FETCH_OBJ)) { $i++;
                      ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $data->acnumber;?></td>
                          <td><?php echo $data->bankname;?></td>
                          <td><?php echo $data->initbalance;?></td>
                          <td><?php echo $data->note;?></td>
                          <td><?php echo date("d M Y",strtotime($data->reg_date));?></td>
                          <td width="10%"><a onclick="return confirm('Are Your Sure Delete This Account!!');" href="?delete=<?php echo $data->id;?>" class="btn btn-danger btn-xs">Delete</a></td>
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
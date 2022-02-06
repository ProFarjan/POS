<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$st = new Employee();
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['holyday'])) {
  $holyday = $st->holyday_insert($_POST);
}
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3 style="text-align: center;">Employee Attendance Form</h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <a href="attendancelist.php" class="btn btn-primary">Attendance List</a>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Start Today's == <?php echo $st->hl->formatDate01(date('m/d/Y'));?> <small></small></h2>
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
            <br />
            <table class="table table-striped table-bordered">
              <tr>
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Desgination</th>
                <th>Action</th>
              </tr>
              <?php
                $emplo = $st->Tbl_Col_Id('customer','typeval','2');
                $i = 0;
                if ($emplo) {
                  while ($data = $emplo->fetch(PDO::FETCH_OBJ)) { $i++;
                    $netval = $st->Tbl_Col_Id_2('attendance','employeeid','date',$data->id,$date_c);
                    $netval = $netval->fetch(PDO::FETCH_OBJ);
                    if (!$netval) {
              ?>
              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $data->customerid;?></td>
                <td><?php echo $data->name;?></td>
                <td><?php echo $data->phone;?></td>
                <td><?php echo $data->destination;?></td>
                <td width="20%">
                <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST[$i])) {
                    $val = $st->attendance_Insert($_POST);
                    echo "<meta http-equiv='refresh' content='0'>";
                  }
                  if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST[$i.'a'])) {
                    $val = $st->attendance_Insert_Appsent($_POST);
                    echo "<meta http-equiv='refresh' content='0'>";
                  }
                ?>
                  <form action="" method="post">
                    <input type="hidden" name="customerid" value="<?php echo $data->id;?>">
                    <input type="submit" name="<?php echo $i;?>" value="Start" class="btn btn-info">
                  </form>
                  <form action="" method="post">
                    <input type="hidden" name="customerid" value="<?php echo $data->id;?>">
                    <input type="submit" name="<?php echo $i.'a';?>" value="Appsent" class="btn btn-danger">
                  </form>
                </td>
              </tr>
              <?php } } } ?>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Finished Today's == <?php echo $st->hl->formatDate01(date('m/d/Y'));?> <small></small></h2>
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
            <br />
            <table class="table table-striped table-bordered">
              <tr>
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Desgination</th>
                <th>Action</th>
              </tr>
              <?php
                $emplo = $st->Tbl_Col_Id('attendance','date',$date_c);
                $i = 0;
                if ($emplo) {
                  while ($data = $emplo->fetch(PDO::FETCH_OBJ)) { $i++;
                    $data1 = $st->Tbl_Col_Id_LIMITE_0('customer','id',$data->employeeid);
                    if (empty($data->finish) OR $data->finish == ''){
              ?>
              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $data1->customerid;?></td>
                <td><?php echo $data1->name;?></td>
                <td><?php echo $data1->phone;?></td>
                <td><?php echo $data1->destination;?></td>
                <td width="20%">
                <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST[$i.'f'])) {
                    $val = $st->attendance_Insert_finished($_POST);
                    echo "<meta http-equiv='refresh' content='0'>";
                  }
                ?>
                  <form action="" method="post">
                    <input type="hidden" name="customerid" value="<?php echo $data->id;?>">
                    <input type="submit" name="<?php echo $i.'f';?>" value="Finished" class="btn btn-info">
                  </form>
                </td>
              </tr>
              <?php } } } ?>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Holi Day Or Public Day Insert <small></small></h2>
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
            <br />
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control has-feedback-left" id="single_cal2" aria-describedby="inputSuccess2Status2" name="date">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Employee <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="purpuse select2_multiple form-control" name="employeeid" style="width: 100%;">
                    <option value="all">All Employee</option>
                    <?php
                      $Sector = $st->Tbl_Col_Id('customer','typeval','2');
                      if ($Sector) {
                        while ($data = $Sector->fetch(PDO::FETCH_OBJ)) {
                    ?>
                      <option value="<?php echo $data->id;?>"><?php echo ucfirst($data->name)." (".$data->phone.")";?></option>
                    <?php } } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Note <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="birthday" name="note" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" >
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" style="margin-bottom: 30px;">
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" class="btn btn-success" name="holyday"> Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>


</div>
</div>
</div>
</div>
<!-- /page content -->
<script type="text/javascript">
$(function(){
  $(".btn").click(function(){
    alert("Welllcome");
  });
});
</script>

<?php include "inc/footer.php";?>


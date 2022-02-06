<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$cu = new Inden();

?>

<style type="text/css">
#showac {
  padding: 3px 25px;
}
#showac ul{list-style: none;color: #000;font-weight: bold;}
#showac ul li {
  padding: 2px 0;
  cursor: pointer;
}
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Bank Acccount Statement</h3>
      </div>

      <div class="title_right">
        <div class="col-md-3 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <button onclick="javascript:goBack();" class="btn btn-info">Back</button>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Balance Information</h2>
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

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr class="bg-primary">
                    <th>SL</th>
                    <th>Cash Widthdraw Amount</th>
                    <th>Date</th>
                    <th>Note</th>
                  </tr>
                </thead>

                <tbody>
                <?php
                  $i = 0;
                  $storedata = $cu->SelectAll('cash');
                  $i = 0;
                  if ($storedata) {
                    while ($data = $storedata->fetch(PDO::FETCH_OBJ)) { $i++;
                      if ($data->cash < 0) {
                ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo substr($data->cash, 1);?></td>
                    <td><?php echo date("d M y",strtotime($data->date));?></td>
                    <td><?php echo $data->note;?></td>
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
<!-- /page content -->
<?php include "inc/footer.php";?>
<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $ind = new Inden();

  if (isset($_POST['search'])) {
    $selector = $_POST['dateselector'];
    $to = substr($selector, 0,10);
    $form = substr($selector, 13,10);

    $sql_con = "";

    if (isset($_POST['customer']) && count($_POST['customer']) > 0) {
      $customer = $_POST['customer'];
      if (!in_array("all", $customer)) {
        $sql_con .= "customerid IN (".implode(',', $customer).") AND ";
      }
    }

    if (isset($_POST['itemname']) && count($_POST['itemname']) > 0) {
      $itemname = $_POST['itemname'];
      if (!in_array("all", $itemname)) {
        $sql_con .= "productid IN (".implode(',', $itemname).") AND ";
      }
    }

    $sql_con .= "date BETWEEN '$to' AND '$form' ";
    $sql = "SELECT * FROM income WHERE ".$sql_con." AND status = '1' ORDER BY id ASC;";
    $result = $ind->tbl_sql($sql);

  }
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title" style="height: 0;">
    </div>

    <div class="clearfix"></div>

<div class="row" id="datasearch" style="width: 50%;margin: 0 auto;">
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
  <div class="x_content">
    <p style="text-align: center;font-size: 20px;font-weight: bold;font-style: italic;">Profit Wise Sales Report's</p>
    <form class="form-horizontal" action="" method="post" style="width: 70%;margin: 0 auto;">

      <div class="control-group">
        <div class="controls">
          <div class="input-prepend input-group">
            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
            <input type="text" style="width: 300px" name="dateselector" id="reservation" class="form-control" value="<?php echo date('m/d/Y');?> - <?php echo date('m/d/Y');?>"/>
          </div>
        </div>
      </div>

      <div class="control-group">
        <div class="controls">
          <div class="input-prepend input-group">
          <select name="customer[]" data-placeholder="Choose Customer's..." multiple class="chosen-select" style="width: 338px;">
            <option value="all">All Customer's</option>
            <?php
              $customer = $ind->tbl_sql("SELECT id,name FROM customer WHERE typeval = '1' ORDER BY name ASC;");
              if ($customer) {
                while ($custData = $customer->fetch(PDO::FETCH_OBJ)) {
            ?>
              <option value="<?php echo $custData->id;?>"><?php echo $custData->name;?></option>
            <?php } } ?>
            </select>
          </div>
        </div>
      </div>

      <div class="control-group">
        <div class="controls">
          <div class="input-prepend input-group">
          <select name="itemname[]" data-placeholder="Choose Item's..." multiple class="chosen-select" style="width: 338px;">
            <option value="all">All Item's</option>
            <?php
              $product = $ind->SelectAll_Val('product','type,subtype,name');
              if ($product) {
                while ($data = $product->fetch(PDO::FETCH_OBJ)) {
            ?>
              <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
            <?php } } ?>
            </select>
          </div>
        </div>
      </div>

      <button type="submit" name="search" class="btn btn-info btn-lg" style="width: 100%;">Search</button>

    </form>
    </div>
  </div>
  </div>
</div>

<?php
  if (isset($sql)) {
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">

        <table id="example" class="display" style="width:100%">
          <thead>
              <tr>
                  <th style="text-align: left;">SL</th>
                  <th style="text-align: left;">Date</th>
                  <th style="text-align: left;">Invoice</th>
                  <th style="text-align: left;">Customer</th>
                  <th style="text-align: left;">Product Name</th>
                  <th style="text-align: left;">Product Cost</th>
                  <th style="text-align: left;">Sales Amt.</th>
                  <th style="text-align: left;">Profit</th>
              </tr>
          </thead>
          <tbody>
            <?php
              if ($result) {
                $j = 0;
                $total_qty = 0;
                while ($mypro = $result->fetch(PDO::FETCH_OBJ)) { $j++;
                  $to_t = strtotime($to);
                  $form_t = strtotime($form);
                  $get_t = strtotime($mypro->date);
                  if (($get_t >= $to_t) && ($get_t <= $form_t)) {
                    $proInfo = $ind->Tbl_Col_Id_LIMITE_0("product","id",$mypro->productid,"name");
                    $customer = $ind->Tbl_Col_Id_LIMITE_0("customer","id",$mypro->customerid,"name");
            ?>
              <tr>
                  <td style="text-align: left;"><?php echo $j;?></td>
                  <td style="text-align: left;"><?php echo date("d M Y",strtotime($mypro->date));?></td>
                  <td style="text-align: left;"><?php echo $mypro->invoice;?></td>
                  <td style="text-align: left;"><?php echo $customer->name;?></td>
                  <td style="text-align: left;"><?php echo $proInfo->name;?></td>
                  <td style="text-align: left;"><?php echo $mypro->rate;?></td>
                  <td style="text-align: left;"><?php echo "Pending";?></td>
                  <td style="text-align: left;"><?php echo "Pending";;?></td>
              </tr>
            <?php } } } ?>
          <tfoot>
              <tr>
                <th style="text-align: left;">SL</th>
                <th style="text-align: left;">Date</th>
                <th style="text-align: left;">Invoice</th>
                <th style="text-align: left;">Customer</th>
                <th style="text-align: left;">Product Name</th>
                <th style="text-align: left;">Product Cost</th>
                <th style="text-align: left;">Sales Amt.</th>
                <th style="text-align: left;">Profit</th>
            </tr>
          </tfoot>
      </table>

      </div>
    </div>
  </div>
</div>
<?php } ?>

</div>
</div>
<!-- /page content -->

<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


<?php include "inc/footer.php";?>

<script type="text/javascript">
  $(function(){
    $('title').text("Invoice Wise Sales Report's");
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    });

  });
</script>
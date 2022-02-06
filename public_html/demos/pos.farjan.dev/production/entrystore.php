<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$po = new Store();
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['serachproduct'])) {
   $productcode = $po->Product_Code($_POST);
   if ($productcode) {

?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add Product To Store</h3>
      </div>
      <?php
        if ($productcode->type == 'Tiles') {
          $inch = $productcode->name;
          $val = explode('*', $inch);
          $insq = $val[0]*$val[1];
          $ftsq = $insq*0.00694444;
        }
      ?>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Store Entry <small></small></h2>
            <ul class="nav navbar-right panel_toolbox" style="font-style: 22px;font-weight: bold;text-align: center;">
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
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="addstore.php" method="post">
               <!-- price element -->
               <div style="margin: 0 auto;width: 80%;">
                <div class="col-md-10 col-sm-6 col-xs-12">
                  <div class="pricing">
                    <div class="title">
                      <h2>Product Code</h2>
                      <h1><?php echo $productcode->code;?></h1>
                    </div>
                    <div class="x_content">
                      <div class="">
                        <div class="pricing_features">
                          <ul class="list-unstyled text-left">
                            <li><i class="fa fa-check text-success"></i> Product Name <strong> <?php echo $productcode->name; ?></strong></li>
                            <li><i class="fa fa-check text-success"></i> Product Type <strong> <?php echo $productcode->type; ?></strong></li>
                            <li><i class="fa fa-check text-success"></i> Product Sub-Type <strong> <?php echo $productcode->subtype; ?></strong></li>
                            
                            <li><i class="fa fa-check text-success"></i> Product Rate <strong> <?php echo $productcode->rate; ?></strong></li>
                          </ul>
                        </div>
                      </div>
                <div class="pricing_footer">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control has-feedback-left" id="single_cal2" aria-describedby="inputSuccess2Status2" name="date">
                  <input type="hidden" name="productid" value="<?php echo $productcode->id; ?>">
                  <input type="hidden" name="quantity" value="0">
                  <input type="hidden" name="unit" value="0">
                  <input type="hidden" name="percarton" value="0">
                  <input type="hidden" name="totalcarton" value="0">
                </div>
              </div>
              <?php
                $typeval = $productcode->type;
                if ($typeval == 'Tiles') { ?>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Cartoon sq/ft<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="birthday" name="totalcarton" class="totalcarton form-control col-md-7 col-xs-12" required="required" type="text" <?php if(isset($product_Up)){echo "value='".$product_Up->code."'";echo "disabled";}?> value="0" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Per Cartoon sq/ft<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="birthday" name="percarton" class="percarton form-control col-md-7 col-xs-12" required="required" type="text" <?php if(isset($product_Up)){echo "value='".$product_Up->code."'";echo "disabled";}?> value="0" >
                  </div>
                </div>
                <div class="Farjandiv form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Carton<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="birthday" class="Farjan form-control col-md-7 col-xs-12" disabled >
                  </div>
                </div>
                <div class="Hasandiv form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Piece<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="birthday" class="Hasan form-control col-md-7 col-xs-12" type="text" disabled>
                  </div>
                </div>
               <?php } else { ?>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity <span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-6">
                  <input id="birthday" name="quantity" autocomplete="off" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" <?php if(isset($product_Up)){echo "value='".$product_Up->code."'";echo "disabled";}?> >
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6">
                <?php
                  $storedata = $po->Tbl_Col_Id_LIMITE_0('store','productid',$productcode->id);
                  if ($storedata) {
                ?>
                  <input class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $storedata->unit;?>" disabled >
                  <input class="form-control col-md-7 col-xs-12" type="hidden" name="unit" value="<?php echo $storedata->unit;?>">
                <?php } else { ?>
                  <select id="heard" class="form-control" name="unit" required>
                    <option value="<?php if (isset($product_Up)) {echo $product_Up->type;}?>">Choose..</option>
                    <?php
                      $unit = $po->SelectAll('unit');
                      if ($unit) {
                        while ($data = $unit->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <option value="<?php echo $data->name;?>"><?php echo ucfirst($data->name);?></option>
                    <?php }} ?>
                  </select>
                <?php } ?>
                </div>
              </div>
              <div class="Farjandiv form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Cost<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="unitprice" name="unitprice" class="Farjan form-control col-md-7 col-xs-12" autocomplete="off">
                </div>
              </div>
              <?php } ?>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success" name="addstoreproduct">Add</button>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- price element -->
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
<?php }else{echo "<script>window.location = 'addstore.php';</script>";}} else { echo "<script>window.location = 'addstore.php';</script>"; } ?>

<?php include "inc/footer.php";?>

<script type="text/javascript">
$(function(){
  $('.Farjandiv').hide();
  $('.Hasandiv').hide();

  $('.totalcarton').change(function(){
    var totalcarton = $(this).val();
    var percarton = $('.percarton').val();
    var persqft = <?php echo $ftsq;?>;
    var totalcat = totalcarton/percarton;
    var totalpicec = totalcarton*persqft;
    $('.Farjan').val(totalcat);
    $('.Hasan').val(totalpicec);

    $('.Farjandiv').slideDown(1000);
    $('.Hasandiv').slideDown(1000);
  });
  $('.percarton').change(function(){
    var percarton = $(this).val();
    var totalcarton = $('.totalcarton').val();
    var persqft = <?php echo $ftsq;?>;
    var totalcat = totalcarton/percarton;
    var totalpicec = totalcarton*persqft;
    $('.Farjan').val(totalcat);
    $('.Hasan').val(totalpicec);

    $('.Farjandiv').slideDown(1000);
    $('.Hasandiv').slideDown(1000);
  });

});
</script>
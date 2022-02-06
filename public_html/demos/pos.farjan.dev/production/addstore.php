<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$st = new Store();
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['addstoreproduct'])) {
    $storeproductadd = $st->Store_Product_add($_POST);
  }
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add Product To Store</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <a href="storelist.php" class="btn btn-primary">Store List</a>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Store Entry <small></small></h2>
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
          <span id="message123"><?php if(isset($storeproductadd)){echo $storeproductadd;}?></span>
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="entrystore.php" method="post">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Enter Product Code <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <select name="code" data-placeholder="Choose Product..." id="productid" class="form-control chosen-select">
                    <option></option>
                    <?php
                      $product = $st->tbl_sql("SELECT code,type,subtype,name FROM product ORDER BY type,subtype,name ASC;");
                      if ($product) {
                        while ($allproduct = $product->fetch(PDO::FETCH_OBJ)) {
                    ?>
                      <option value="<?php echo $allproduct->code;?>"><?php echo $allproduct->name;?></option>
                    <?php } } ?>
                  </select>

                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success" name="serachproduct" >Search</button>
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

<?php include "inc/footer.php";?>

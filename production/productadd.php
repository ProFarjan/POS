<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$po = new Product();
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['addproduct'])) {
   $addproduct = $po->addproduct($_POST);
 }
 if (isset($_GET['update']) AND !empty($_GET['update'])) {
    $id = $_GET['update'];
    $product_Up = $po->SelectAll_By_ID('product',$id);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['upproduct'])) {
      $Up_product = $po->Update_product($id,$_POST);
    }
  }
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>New Product Add</h3>
      </div>

      <div class="title_right">
        <div class="col-md-2 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="productlist.php"><button class="btn btn-primary">Product List</button></a>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add Product <small></small></h2>
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
          <span id="message123"><?php if(isset($addproduct)){echo $addproduct;}elseif(isset($Up_product)){echo $Up_product;}?></span>
            <br />
            <form id="addproductform" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Code <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="code" autofocus onfocus="selected(this);" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" <?php if(isset($product_Up)){echo "value='".$product_Up->code."'";}else{ ?> value="<?php $codeval = $po->last_id_select('product');if($codeval){echo $codeval+1;}else{echo $farjan->procode;}?>" <?php }?> >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Catagory <span class="required">*</span>
                </label>
                <div class="col-md-5 col-sm-5 col-xs-10">
                  <select id="heard" class="type form-control chosen-select" name="type" required>
                    <option value="<?php if (isset($product_Up)) {echo $product_Up->type;}?>">Choose..</option>
                  <?php
                    $catagoryval = $po->SelectProduct_By_Type('catagory');
                    if ($catagoryval) {
                      while ($data = $catagoryval->fetch(PDO::FETCH_OBJ)) {
                  ?>
                    <option value="<?php echo $data->type?>"><?php echo $data->type?></option>
                  <?php } } ?>

                  </select>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-2">
                  <a href="catagorytype.php" target="_blank" style="font-size:22px;"><i class="fa fa-eyedropper"></i></a>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Sub-Catagory <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="subtype form-control" name="subtype" required>
                    <option value="<?php if (isset($product_Up)) {echo $product_Up->subtype;}?>">Choose..</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" required="required" name="name" class="form-control col-md-7 col-xs-12" <?php if(isset($product_Up)){echo "value='".$product_Up->name."'";}?> >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Rate <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="rate" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" <?php if(isset($product_Up)){echo "value='".$product_Up->rate."'";}?> >
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success" <?php if(isset($product_Up)){?> name="upproduct" <?php } else { ?> name="addproduct" <?php }?> >Submit</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
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
<script type="text/javascript">
  $(function(){
    $('.type').change(function(){
      var type = $(this).val();
      if (type == '') {
        $(".subtype").children().remove();
      }else{
        $.ajax({
            url:"selectsubcatagory.php",
            method:"POST",
            data:{Type:type},
            success:function(data){
              $(".subtype").children().remove();
              $(".subtype").append(data);
            }
          });
      }
    });
  });
</script>
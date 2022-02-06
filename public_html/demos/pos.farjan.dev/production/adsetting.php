<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $nias = new Inden();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['codeupdate'])) {
  $codeupdate = $nias->Code_Update($_POST);
}
?>
<style type="text/css">
#unitid{width: 100px;margin: 0;background: #ededed;padding: 12px;text-align: center;border-radius: 7px;box-shadow: 2px 2px 2px 0px #ddd;cursor: pointer;float: left;margin-left: 10px;margin-bottom: 8px;}
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Advance Software Setting</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <?php if(isset($codeupdate)){echo $codeupdate;}?>
            <a href="setting.php" class="btn btn-info">Setting</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Code Or ID Info</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Code<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="procode" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $farjan->procode;?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Customer ID<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="last-name" name="cuscode" required="required" value="<?php echo $farjan->cuscode;?>" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Supplier ID<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="last-name" name="suppcode" required="required" value="<?php echo $farjan->suppcode;?>" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Employee ID<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="last-name" name="emcode" required="required" value="<?php echo $farjan->emcode;?>" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success" name="codeupdate">Update</button>
              </div>
            </div>
          </form>
          </div>
          </div>
          </div>
        </div>    

    </div>
</div>
<!-- /page content -->


<?php include "inc/footer.php";?>

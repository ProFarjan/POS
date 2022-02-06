<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $ex = new Expense();
?>
<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['addexpense'])) {
   $addexpense = $ex->AddExpense($_POST);
 }
 $exployee_list = $ex->Tbl_Col_Id("customer","typeval","2");
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Expense Page</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12" id="employeeform">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add Your Expense </h2>
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
            <span id="message123"><?php if(isset($addexpense)){echo $addexpense;}?></span>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Purpuse <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control chosen-select" name="purpuse" autofocus >
                  <option value="salary">Salary</option>
                  <?php
                    $Sector = $ex->SelectAll('sector');
                    if ($Sector) {
                      while ($data = $Sector->fetch(PDO::FETCH_OBJ)) {
                  ?>
                    <option value="<?php echo $data->sector;?>"><?php echo ucfirst($data->sector);?></option>
                  <?php } } ?>
                  </select>
                </div>
              </div>
              <div class="form-group employee" id="employeeid">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Employee ID
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" autocomplete="off" class="emplyeeval form-control col-md-7 col-xs-12" list="myemployee">
                  <input type="hidden" name="emplyee" id="employeefa">
                  <datalist id="myemployee">
                    <?php
                      while ($emlist = $exployee_list->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <option value="<?php echo $emlist->customerid;?>"><?php echo $emlist->name;?></option>
                  <?php } ?>
                  </datalist>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Amount <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="amount" autocomplete="off" required="required" class="form-control col-md-7 col-xs-12" name="amount">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Note <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="message" class="form-control" name="note" data-parsley-trigger="keyup" data-parsley-minlength="5" data-parsley-maxlength="250" data-parsley-minlength-message="Come on! You need to enter at least a 250 caracters long comment.."
                    data-parsley-validation-threshold="10"></textarea>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success" name="addexpense">Submit</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4" id="EmployeeDetails">
        <div class="x_panel">
          <div class="x_title">
            <h2>Employee Details</h2>
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
            <div id="useralldata">
              <img src="images/user.png" style="width: 50%;border-radius: 50%;margin-bottom: 10px;">
              <table class="table table-striped table-bordered">
                <tr>
                  <td>ID</td>
                  <td>FA0002</td>
                </tr>
                <tr>
                  <td>Name</td>
                  <td>FArjan Hasan</td>
                </tr>
                <tr>
                  <td>Phone</td>
                  <td>01966885733</td>
                </tr>
                <tr>
                  <td>Telephone</td>
                  <td>0125255</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>farjanhasan@gmail.com</td>
                </tr>
                <tr>
                  <td>Company</td>
                  <td>FArjan Hasan</td>
                </tr>
                <tr>
                  <td>Address</td>
                  <td>FArjan Hasan</td>
                </tr>
                <tr>
                  <td>City</td>
                  <td>Mymeinsing</td>
                </tr>
                <tr>
                  <td>Website</td>
                  <td>www.google.com</td>
                </tr>
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

<script type="text/javascript">
  
    $(function(){
      $("#EmployeeDetails").hide();

      $(".purpuse").change(function(){
        var purpuse = $(this).val();
        $("#employeeid").slideDown(1000);
      });

      $(".emplyeeval").change(function(){
        var emplyeeval = $(this).val();
        var purpuse = $(".purpuse").val();

        if (emplyeeval == '') {
          $("#employeeform").removeClass('tanimat col-md-8 col-sm-8 col-xs-8');
          $("#employeeform").addClass('tanimat col-md-12 col-sm-12 col-xs-12');
          $("#EmployeeDetails").hide();
        }else{
          $.ajax({
            url:"selectemployee.php",
            method:"POST",
            data:{Emplyeeval:emplyeeval,purpuse:purpuse},
            success:function(data){
              $("#useralldata").empty();
              $("#useralldata").append(data);
            }
          });
          $.ajax({
            url:"selectemployeeid.php",
            method:"POST",
            data:{Emplyeeval:emplyeeval},
            success:function(data){
              $("#employeefa").val(0);
              $("#employeefa").val(data);
            }
          });

          if (purpuse == "salary") {
            $.ajax({
              url:"selectemployeesalary.php",
              method:"POST",
              data:{salary:emplyeeval},
              success:function(data){
                $("#amount").val(0);
                $("#amount").val(data);
              }
            });
          }

          $("#employeeform").removeClass('tanimat col-md-12 col-sm-12 col-xs-12');
          $("#employeeform").addClass('tanimat col-md-8 col-sm-8 col-xs-8');
          $("#EmployeeDetails").show();
        }

      });



    });
  
</script>
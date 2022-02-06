<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $cu = new Customers();
 
 if (isset($_GET['userid']) AND !empty($_GET['userid'])) {
   $userid = $_GET['userid'];
   $userinfo = $cu->SelectAll_By_ID('customer',$userid);
   if ($userinfo) {
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>
        <?php
          if($userinfo->typeval == '1'){
            echo "Customer";
          }elseif ($userinfo->typeval == '2') {
            echo "Emplyee/Staff";
          }else{
            echo "Supplier";
          }
        ?>
        Profile</h3>
      </div>

      <div class="title_right">
        <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <button onclick="goBack();" class="btn btn-info btn-md">Back</button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>
            <?php if($userinfo->typeval == '1'){
                echo "Customer";
              }elseif ($userinfo->typeval == '2') {
                echo "Emplyee/Staff";
              }else{
                echo "Supplier";
              }
              ?> Report <small>All Data</small></h2>
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
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                <?php if($userinfo->image == 1){ ?>
                  <!-- Current avatar -->
                  <img class="img-responsive avatar-view" src="images/user.png" alt="Avatar" title="Change the avatar">
                <?php } else { ?>
                  <img class="img-responsive avatar-view" src="<?php echo $userinfo->image;?>" alt="Avatar" title="Change the avatar">
                <?php } ?>
                </div>
              </div>
              <h3><?php echo $userinfo->name;?></h3>

              <ul class="list-unstyled user_data">
                <li><i class="fa fa-phone"></i> Phone : <?php echo $userinfo->phone;?></li>
                <?php
                  if (!empty($userinfo->city)) {
                ?>
                <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $userinfo->address;?> <?php echo $userinfo->city;?>
                </li>
              <?php } ?>
              <?php
                if ($userinfo->company != "1") {
              ?>
                <li>
                  <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $userinfo->company;?>
                </li>
              <?php } ?>
              <?php
                if ($userinfo->website != "1") {
              ?>
                <li class="m-top-xs">
                  <i class="fa fa-external-link user-profile-icon"></i>
                  <a href="<?php echo $userinfo->website;?>" target="_blank"><?php echo $userinfo->website;?></a>
                </li>
              <?php } ?>

              </ul>

              <a class="btn btn-success" href="addcustomer.php?custid=<?php echo $userinfo->id;?>"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
              <a class="btn btn-danger" href="customerlist.php?customer=customer&custid=<?php echo $userinfo->id;?>"><i class="fa fa-delete m-right-xs"></i>Delete</a>
              <br />

            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                    <?php if($userinfo->typeval == '2'){echo "Attendance Report's";}else{echo "Total Report's";}?>
                  </a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                  <?php
                    if($userinfo->typeval == '1'){
                      echo "Invoice";
                    }elseif ($userinfo->typeval == '2') {
                      echo "Salary";
                    }else{
                      echo "Purchase";
                    }
                  ?> List
                  </a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Profile</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <!-- start recent activity -->
                  <?php if($userinfo->typeval != '2'){ ?>
                    <ul class="messages">
                      <li>
                        <div class="message_wrapper">
                          <h4 class="heading">Total Cost</h4>
                          <blockquote class="message">
                          <?php if($userinfo->typeval == '1'){ ?>
                            <?php echo $totala = $cu->F_Total_Income_Amount('income','customerid',$userinfo->id);?>
                          <?php }else{ ?>
                            <?php echo $totala = $cu->F_Total_Purchase_Amount('purchase','supplierid',$userinfo->id);?>
                          <?php } ?>
                          </blockquote>
                          <br />
                        </div>
                      </li>
                      <li>
                        <div class="message_wrapper">
                          <h4 class="heading">Total Other</h4>
                          <blockquote class="message">
                            <?php echo $other = $cu->TBL_VAL_52('payment','customerid',$userinfo->id,'other');?>
                          </blockquote>
                          <br />
                        </div>
                      </li>
                      <li>
                        <div class="message_wrapper">
                          <h4 class="heading">Total Discount Amount</h4>
                          <blockquote class="message">
                            <?php echo $discount = $cu->TBL_VAL_52('payment','customerid',$userinfo->id,'disamount');?>
                          </blockquote>
                          <br />
                        </div>
                      </li>
                      <li>
                        <div class="message_wrapper">
                          <h4 class="heading">Total Grand-Total</h4>
                          <blockquote class="message">
                            <?php
                              echo $grand = ($totala+$other)-$discount;
                            ?>
                          </blockquote>
                          <br />
                        </div>
                      </li>
                      <li>
                        <div class="message_wrapper">
                          <h4 class="heading">Total Payment</h4>
                          <blockquote class="message">
                            <?php echo $payment = $cu->TBL_VAL_52('payment','customerid',$userinfo->id,'payment');?>
                          </blockquote>
                          <br />
                        </div>
                      </li>
                      <li>
                        <div class="message_wrapper">
                          <h4 class="heading">Current Due</h4>
                          <blockquote class="message">
                            <?php
                              echo $current_due = $grand-$payment;
                            ?>
                          </blockquote>
                          <br />
                        </div>
                      </li>
                    </ul>
                    <!-- end recent activity -->
                    <?php }else{ ?>
                    <!-- start user projects -->
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Date</th>
                          <th>Start</th>
                          <th>Finished</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $allpayment = $cu->Tbl_Col_Id('attendance','employeeid',$userinfo->id);
                        $i = 0;
                        if ($allpayment) {
                          while ($data = $allpayment->fetch(PDO::FETCH_OBJ)) { $i++;
                      ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $cu->hl->formatDate01($data->date);?></td>
                          <td><?php echo $data->start;?></td>
                          <td><?php if($data->finish != '1'){echo $cu->hl->formatDate02($data->finish);}?></td>
                          <td><?php if($data->appsent == '1'){echo "Appsent";}elseif(empty($data->appsent) OR $data->appsent == ''){echo "GD";}else{echo $data->appsent;}?></td>
                        </tr>
                      <?php } } ?>
                      </tbody>
                    </table>
                    <!-- end user projects -->
                    <?php } ?>

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                  <?php if($userinfo->typeval != '2'){ ?>
                    <!-- start user projects -->
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>SL.No</th>
                          <th>
                          <?php
                            if($userinfo->typeval == '1'){
                              echo "Invoice";
                            }elseif ($userinfo->typeval == '2') {
                              echo "";
                            }else{
                              echo "Supplier";
                            }
                          ?>
                          </th>
                          <th>Payment(Tk)</th>
                          <th>Current Due(Tk)</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $allpayment = $cu->Tbl_Col_Id('payment','customerid',$userinfo->id);
                        $i = 0;
                        if ($allpayment) {
                          while ($data = $allpayment->fetch(PDO::FETCH_OBJ)) { $i++;
                      ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <?php if($userinfo->typeval == '1'){?>
                          <td><a href="<?php echo $invoice;?>.php?invoice=<?php echo $data->invoice;?>"><?php echo $data->invoice;?></a></td>
                          <?php }else{?>
                          <td><a href="<?php echo $purchase;?>.php?invoice=<?php echo $data->invoice;?>"><?php echo $data->invoice;?></a></td>
                          <?php }?>
                          <td><?php echo $data->payment;?></td>
                          <td><?php echo $data->currentdue;?></td>
                        </tr>
                      <?php }} ?>
                      </tbody>
                    </table>
                    <!-- end user projects -->
                    <?php }else{ ?>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Date</th>
                          <th>Amount(TK)</th>
                          <th>Note</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $allpayment = $cu->Tbl_Col_Id('expense','employeeid',$userinfo->id);
                        $i = 0;
                        if ($allpayment) {
                          while ($data = $allpayment->fetch(PDO::FETCH_OBJ)) { $i++;
                      ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $cu->hl->formatDate01($data->date);?></td>
                          <td><?php echo $data->amount;?></td>
                          <td><?php echo $data->note;?></td>
                        </tr>
                      <?php }} ?>
                      </tbody>
                    </table>
                    <?php } ?>

                  </div>

                  <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">

                    <!-- start user projects -->
                    <table class="data table table-striped no-margin">
                      <tr>
                        <td width="25%">Full Name</td>
                        <td width="5%">:</td>
                        <td><?php echo $userinfo->name;?></td>
                      </tr>
                      <tr>
                        <td>E-mail</td>
                        <td>:</td>
                        <td><?php if($userinfo->email != "1"){echo $userinfo->email;}?></td>
                      </tr>
                      <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><?php echo $userinfo->phone;?></td>
                      </tr>
                      <?php if($userinfo->typeval == '2'){ ?>
                      <tr>
                        <td>Destination</td>
                        <td>:</td>
                        <td><?php echo $userinfo->destination;?></td>
                      </tr>
                      <tr>
                        <td>Salary</td>
                        <td>:</td>
                        <td><?php echo $userinfo->salary;?></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td>Web-Site</td>
                        <td>:</td>
                        <td><?php if($userinfo->website != "1"){echo $userinfo->website;}?></td>
                      </tr>
                      <tr>
                        <td>Company Name</td>
                        <td>:</td>
                        <td><?php if($userinfo->company != "1"){echo $userinfo->company;}?></td>
                      </tr>
                      <tr>
                        <td>Telephone</td>
                        <td>:</td>
                        <td><?php if($userinfo->telephone != "1"){echo $userinfo->telephone;}?></td>
                      </tr>
                      <tr>
                        <td>Full Address</td>
                        <td>:</td>
                        <td><?php echo $userinfo->address;?></td>
                      </tr>
                      <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><?php echo $userinfo->city;?></td>
                      </tr>
                    </table>
                    <!-- end user projects -->

                  </div>

                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php }} ?>

<?php include "inc/footer.php";?>
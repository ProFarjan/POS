            <?php $access_url =  Session::get('access'); ?>
            <br />
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <?php if ($access_url == "admin") { ?>
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php">Dashboard</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if (in_array($access_url,["admin","user"])) { ?>
                  <li><a><i class="fa fa-th-list"></i> Income <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="income.php">New Seles</a></li>
                      <li><a href="invoicelist.php">All Invoice</a></li>
                      <!-- <li><a href="invoicelist.php">Invoice Quotation</a></li> -->
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($access_url == "admin") { ?>
                  <li><a><i class="fa fa-shopping-cart"></i> Expense <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="sector.php">Add Sector</a></li>
                      <li><a href="addexpense.php">Add Expense</a></li>
                      <li><a href="expenselist.php">Expenses List</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if (in_array($access_url,["admin","purchase_manager"])) { ?>
                  <li><a><i class="fa fa-suitcase"></i> Purchase <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="purchase.php">Add Purchase</a></li>
                      <li><a href="purchaselist.php">Purchases List</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if (in_array($access_url,["admin","purchase_manager"])) { ?>
                  <li><a><i class="fa fa-recycle"></i> Product <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="catagorytype.php">Add Catagory/Sub-catagory</a></li>
                      <li><a href="productadd.php">Add Product</a></li>
                      <li><a href="productlist.php">Products List</a></li>
                      <li><a href="barcode.php">Get Barcode</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if (in_array($access_url,["admin","purchase_manager"])) { ?>
                  <li><a><i class="fa fa-th"></i> Store <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addstore.php">Add Store</a></li>
                      <li><a href="storelist.php">Store List</a></li>
                      <li><a href="currentstatus.php">Current Store Status</a></li>
                      <li><a href="storestatus.php">All Store Status</a></li>
                      <li><a href="destroy.php">Product Destroy</a></li>
                      <li><a href="destroylist.php">Product Destroy List</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($access_url == "admin") { ?>
                  <li><a><i class="fa fa-tachometer"></i> Return <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="incomereturn.php">Sale's Return</a></li>
                      <li><a href="incomereturnlist.php">Sale's Return List</a></li>
                      <li><a href="purchasereturn.php">Purchase's Return</a></li>
                      <li><a href="purchasereturnlist.php">Purchase's Return List</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($access_url == "admin") { ?>
                  <li><a><i class="fa fa-fighter-jet"></i> Bank Statement <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addbankac.php">Add Bank Account</a></li>
                      <li><a href="bankaclist.php">Bank Account List</a></li>
                      <li><a href="transferbankin.php">Bank Deposit</a></li>
                      <li><a href="banktransferlistin.php">Bank Deposit List</a></li>
                      <li><a href="transferbank.php">Bank Withdrawal</a></li>
                      <li><a href="banktransferlist.php">Bank Withdrawal List</a></li>
                      <li><a href="banktransfermoney.php">Transfer Money</a></li>
                      <li><a href="banktranferhistory.php">Money Transfer History</a></li>
                      <li><a href="bankstatement.php">Account Statement</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($access_url == "admin") { ?>
                  <li><a><i class="fa fa-fire"></i> Loan Statement <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="byperson.php">Loan Pay</a></li>
                      <li><a href="bypersonlist.php">Loan Pay List</a></li>
                      <li><a href="bypersonin.php">Loan Receive</a></li>
                      <li><a href="bypersonlistin.php">Loan Receive List</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($access_url == "admin") { ?>
                  <li><a><i class="fa fa-university"></i> Pay & Receive <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="duepay.php">Income/Purchase Due</a></li>
                      <li><a href="duelist.php">Income/Purchase Due List</a></li>
                      <li><a href="loanreceive.php">Loan Receive</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                    <?php if (in_array($access_url,["admin","purchase_manager"])) { ?>
                  <li><a><i class="fa fa-pie-chart"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!-- <li><a href="sarindareports.php">Sarinda Report's</a></li>
                      <li><a> Income Report's <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="salesitemwise.php">Sales Report's (Item Wise)</a></li>
                          <li><a href="#">Sales Details Report's (Invoice Wise)</a></li>
                          <li><a href="salesprofitwise.php">Sales Report's (Profit Wise)</a></li>
                          <li><a href="#">Due Receiable Report's(Date Wise)</a></li>
                          <li><a href="#">Sales Details Report's (All)</a></li>
                        </ul>
                      </li>

                      <li><a> Expense Report's <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="#">Expense Report's</a></li>
                          <li><a href="#">Cancel Expense Report's</a></li>
                        </ul>
                      </li>

                      <li><a> Purchase Report's <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="#">Purchase Report's (Item Wise)</a></li>
                          <li><a href="#">Purchase Details Report's (Invoice Wise)</a></li>
                          <li><a href="#">Purchase Payable Date Report's</a></li>
                          <li><a href="#">Purchase Details Report's (All)</a></li>
                        </ul>
                      </li>

                      <li><a> Store Report's <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="#">Current Store Report's</a></li>
                          <li><a href="#">Store Report's (Date Wise)</a></li>
                          <li><a href="#">Store Report's (Qty Wise)</a></li>
                        </ul>
                      </li>

                      <li><a> Payable & Receiable <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="#">Payable Report's</a></li>
                          <li><a href="#">Receiable Report's</a></li>
                          <li><a href="#">Payable & Receiable Report's</a></li>
                        </ul>
                      </li>

                      <li><a> Bank Statement<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="#">Bank Deposit</a></li>
                          <li><a href="#">Bank Withdraw</a></li>
                          <li><a href="#">Bank Deposit & Withdraw Statement</a></li>
                        </ul>
                      </li>

                      <li><a> Loan Statement<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="#">Loan Payable Report's</a></li>
                          <li><a href="#">Loan Receiable Report's</a></li>
                          <li><a href="#">Loan Payable & Receiable Report's</a></li>
                        </ul>
                      </li> -->
                      <?php if (in_array($access_url,["admin"])): ?>
                      <li><a href="todaysreport.php">Today's Report</a></li>
                      <li><a href="reprotincome.php">Sale's Report</a></li>
                      <li><a href="reportexpense.php">Expense's Report</a></li>
                      <?php endif;?>
                      <li><a href="reprotpurchase.php">Purchase's Report</a></li>
                      <li><a href="reportstore.php">Store Report</a></li>
                      <?php if (in_array($access_url,["admin"])): ?>
                      <li><a href="reportproduct.php">Product's Report</a></li>
                      <li><a href="reportpayable.php">Payable Report</a></li>
                      <li><a href="reportreceive.php">Receable Report</a></li>
                      <li><a href="reportload.php">Loan Statement</a></li>
                      <?php endif;?>
                      
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($access_url == "admin") { ?>
                  <li><a><i class="fa fa-user"></i> Customer <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addcustomer.php?customer=customer">Add Customer</a></li>
                      <li><a href="customerlist.php?customer=customer">Customer List</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($access_url == "admin") { ?>
                  <li><a><i class="fa fa-user"></i> Director/Employee <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addcustomer.php?dir_em=dir_em">Add New</a></li>
                      <li><a href="customerlist.php?dir_em=dir_em">Director/Employee List</a></li>
                      <li><a href="attendance.php">Attendance</a></li>
                      <li><a href="attendancelist.php">Attendance Info</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($access_url == "admin") { ?>
                  <li><a><i class="fa fa-user"></i> Supplier <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addcustomer.php?suplier=suplier">Add Supplier</a></li>
                      <li><a href="customerlist.php?suplier=suplier">Supplier List</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($access_url == "admin") { ?>
                  <li><a><i class="fa fa-info-circle"></i> Software Info <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="setting.php">Setting</a></li>
                      <li><a href="reset.php">Factory Reset</a></li>
                      <li><a href="newuser.php">Add New User</a></li>
                      <li><a href="sentsms.php">Sent SMS</a></li>
                    </ul>
                  </li>
                  <?php } ?>

                </ul>
              </div>
            </div>
            <div class="sidebar-footer hidden-small">
              <a href="setting.php" data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen" onclick="toggleFullScreen()">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="?action=logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php $image = Session::get('UserImg');
                    if (!empty($image) || $image != '') { ?>
                    <img src="<?php echo $image;?>" alt="...">
                    <?php } else { ?>
                    <img src="images/img.jpg" alt="..." >
                    <?php } ?>
                    <?php echo Session::get('User'); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="userprofile.php"> Profile</a></li>
                    <?php if ($access_url == "admin") { ?>
                    <li>
                      <a href="setting.php">
                        <span class="badge bg-red pull-right">100%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <?php } ?>
                    <li><a href="?action=logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <?php if ($access_url == "admin") { ?>
                <li role="presentation" class="dropdown" style="background: skyblue;">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    Shortcut
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a href="income.php">
                        New Sale
                      </a>
                    </li>
                    <li>
                      <a href="addexpense.php">
                        New Expense
                      </a>
                    </li>
                    <li>
                      <a href="purchase.php">
                      New Purchase
                      </a>
                    </li>
                    <li>
                      <a href="productadd.php">
                        Add Product
                      </a>
                    </li>
                  </ul>
                </li>
                <?php } ?>
                  <?php if (in_array($access_url,["admin","user"])) { ?>
                <li>
                  <a href="income.php">
                    New Sale
                  </a>
                </li>
                  <?php } ?>
                <li>
                  <a id="togglecal">
                    Calculator
                  </a>
                </li>
                <li>
              </li>
              </ul>
            </nav>
          </div>
        </div>

        <div id="calculator" class="cal123" style="display: none;">
          <div class="top">
            <span class="clear">C</span>
            <div class="screen"></div>
          </div>
          <div class="keys">
            <span>7</span>
            <span>8</span>
            <span>9</span>
            <span class="operator">+</span>
            <span>4</span>
            <span>5</span>
            <span>6</span>
            <span class="operator">-</span>
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span class="operator">÷</span>
            <span>0</span>
            <span>.</span>
            <span class="eval">=</span>
            <span class="operator">x</span>
          </div>
        </div>
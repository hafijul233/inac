<?php $usertype = isset($usertype) ? $usertype : 0; ?>
<ul>
  <li><a href="index.php?e=<?php echo $encptid ?>">Home</a>
    <ul>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=home&&sub=party">Party Search</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=home&&sub=product">Product Search</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=home&&sub=staff">Staff Search</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=home&&sub=sell">Sell Search</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=home&&sub=purchase">Purchase Search</a></li>
    </ul>
  </li>
  <li><a href="index.php?e=<?php echo $encptid ?>&&page=sells">Sells</a>
    <ul>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=sells&&sub=new">New Sell</a></li>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=sells&&sub=return'>Sell Return</a></li>" ?>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=sells&&sub=report">Sell Report</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=sells&&sub=daily_report">Daily Sell</a></li>
    </ul>
  </li>
  <li><a href="index.php?e=<?php echo $encptid ?>&&page=purchase">Purchase</a>
    <ul>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=purchase&&sub=new">New Purchase</a></li>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=purchase&&sub=return'>Purchase Return</a></li>" ?>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=purchase&&sub=report">Purchase Report</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=purchase&&sub=daily_report">Daily Purchase</a></li>
    </ul>
  </li>
  <li><a href="index.php?e=<?php echo $encptid ?>&&page=product">Product</a>
    <ul>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=product&&sub=particular_product">Product Report</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=product&&sub=raw_material">Raw Material</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=product&&sub=finished_product">Finished Product</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=home&&sub=product">Product Search</a></li>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=product&&sub=edit_product'>Edit Product</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=product&&sub=add_product'>Add Product</a></li>" ?>
    </ul>
  </li>
  <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock">Stock</a>
    <ul>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=all">All Products</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=raw">All Raw Matarials</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=finished">All Finished Product</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=godown_all">Godown All Products</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=godown_raw">Godown Raw Matarials</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=godown_finished">Godown Finished</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=factory_all">Factory All Products</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=factory_raw">Factory Raw Matarials</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=factory_finished">Factory Finished</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=daily_report">Daily Stock</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=date_report">Datewise Report</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=daily_report_godown">Daily Godown Stock</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=date_report_godown">Datewise Godown</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=daily_report_factory">Daily Factory Stock</a>
      </li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=date_report_factory">Datewise Factory Report</a>
      </li>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=stock&&sub=transfer_to_factory'>Tansfer to Factory</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=stock&&sub=transfer_to_stock'>Tansfer to Godown</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=stock&&sub=update_fac'>Update Factroy Stock</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=stock&&sub=update'>Update Godown Stock</a></li>" ?>
    </ul>
  </li>
  <li><a href="index.php?e=<?php echo $encptid ?>&&page=godown">Godown</a>
    <ul>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=daily_report_godown">Daily Godown Stock</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=date_report_godown">Datewise Godown</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=godown_all">Godown All Products</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=godown_raw">Godown Raw Matarials</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=godown_finished">Godown Finished</a></li>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=stock&&sub=transfer_to_stock'>Tansfer to Godown</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=stock&&sub=update'>Update Godown Stock</a></li>" ?>
    </ul>
  </li>
  <li><a href="index.php?e=<?php echo $encptid ?>&&page=factory">Factory</a>
    <ul>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=daily_report_factory">Daily Factory Stock</a>
      </li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=date_report_factory">Datewise Factory Report</a>
      </li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=factory_all">Factory All Products</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=factory_raw">Factory Raw Matarials</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=stock&&sub=factory_finished">Factory Finished</a></li>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=stock&&sub=transfer_to_factory'>Tansfer to Factory</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=stock&&sub=update_fac'>Update Factroy Stock</a></li>" ?>
    </ul>
  </li>
  <li><a href="index.php?e=<?php echo $encptid ?>&&page=accounts">Accounts</a>
    <ul>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=accounts&&sub=payment'>Payments</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=accounts&&sub=invest_draw'>Invest/Draw</a></li>" ?>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=accounts&&sub=report">Accounts Report</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=accounts&&sub=daily_report">Daily Accounts</a></li>
    </ul>
  </li>
  <li><a href="index.php?e=<?php echo $encptid ?>&&page=staff">Staff</a>
    <ul>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=staff&&sub=view_all">View All</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=home&&sub=staff">Staff Search</a></li>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=staff&&sub=salary_update'>Salary Update</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=staff&&sub=attendance_update'>Attendance Update</a></li>" ?>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=staff&&sub=report">Staff Report</a></li>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=staff&&sub=edit_staff'>Edit Staff Info</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=staff&&sub=add_staff'>Add Staff</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=staff&&sub=change_status'>Change Status</a></li>" ?>
    </ul>
  </li>
  <li><a href="index.php?e=<?php echo $encptid ?>&&page=party">Party</a>
    <ul>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=party&&sub=all_party">View All</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=party&&sub=clients">View Clients</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=party&&sub=suppliers">View Suppliers</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=party&&sub=partner">View Partners</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=party&&sub=view_particular">View Particular</a></li>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=home&&sub=party">Party Search</a></li>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=party&&sub=edit_party'>Edit Party Info</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=party&&sub=add_party'>Add New Party</a></li>" ?>
    </ul>
  </li>
</ul>

<ul class="isolated">
  <li><a href="index.php?e=<?php echo $encptid ?>&&page=userinfo">User</a>
    <ul>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=add_user'>Add User</a></li>" ?>
        <?php if ($usertype == ADMIN) echo "<li><a href='index.php?e=" . $encptid . "&&page=delete_user'>Delete User</a></li>" ?>
      <li><a href="index.php?e=<?php echo $encptid ?>&&page=settings">Settings <img src="images/gear.gif" align="middle"
                                                                                    alt="*"/></a></li>
      <li><a href="logout.php?e=<?php echo $encptid ?>">Logout <img src="images/cross.gif" align="middle" alt="X"/></a>
      </li>
    </ul>
  </li>
</ul>
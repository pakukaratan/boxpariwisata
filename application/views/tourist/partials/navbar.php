<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?= base_url() ?>">Box Pariwisata</a>
    </div>
    <ul class="nav navbar-nav">
      <li <?php if($active == 'home') echo 'class=active'; ?>><a href="<?= base_url() ?>">Home</a></li>
      <li <?php if($active == 'spot') echo 'class=active'; ?>><a href="<?= base_url('tourist/spot') ?>">Spot</a></li>
      <li <?php if($active == 'restaurant') echo 'class=active'; ?>><a href="<?= base_url('tourist/restaurant') ?>">Restaurant</a></li>
      <!--<li <?php if($active == 'hotel') echo 'class=active'; ?>><a href="<?= base_url('tourist/hotel') ?>">Hotel Booking</a></li>-->
      <li <?php if($active == 'daytrips') echo 'class=active'; ?>><a href="<?= base_url('tourist/daytrips') ?>">DayTrips</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if($tourist):?>
        <li <?php if($active == 'tourist') echo 'class=active'; ?>><a href="<?= base_url('tourist/account') ?>"><i class="fa fa-user"></i> Account</a></li>
        <li <?php if($active == 'tourist_spot_booking_history') echo 'class=active'; ?>><a href="<?= base_url('tourist/spot/booking/history') ?>"><i class="fa fa-history"></i> Spot Booking History</a></li>
        <li <?php if($active == 'tourist_restaurant_booking_history') echo 'class=active'; ?>><a href="<?= base_url('tourist/restaurant/booking/history') ?>"><i class="fa fa-history"></i> Restaurant Booking History</a></li>
        <li><a href="<?= base_url('tourist/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
      <?php else:?>
        <li><a href="<?= base_url('tourist/signup') ?>"><i class="fa fa-sign-out"></i> Register as Tourist</a></li>
        <li><a href="<?= base_url('tourist/login') ?>"><i class="fa fa-user"></i> Tourist Login</a></li>
        <li><a href="<?= base_url('admin/login') ?>"><i class="fa fa-sign-in"></i> Admin Login</a></li>
      <?php endif ?>
    </ul>
  </div>
</nav>

<div class="logo d-flex" style="height: 75px;">
  <a href="#">
    <img style="height: 75px;" src="images/logo-150.png" alt="Cool Admin" />
  </a>
  <span style="font-size: 22px;" class="ml-3">Cake Shop</span>
</div>
<div class="menu-sidebar__content js-scrollbar1">
  <nav class="navbar-sidebar">
    <ul class="list-unstyled navbar__list">

      <!-- overview -->

      <li class="active has-sub">
        <a class="js-arrow" href="{{ url('overview/detail') }}">
          <i class="fa-solid fa-binoculars" style="font-size: 25px"></i>Overview</a>

      </li>
      <!-- user management -->

      <li class="active has-sub">
        <a class="js-arrow" href="{{ url('user/index') }}">
          <i class="fa-solid fa-user" style="font-size: 25px"></i>Users Management</a>

      </li>



      <!-- dish nanagement -->
      <li class="active has-sub">
        <a class="js-arrow" href="#">
          <i class="fa-solid fa-cookie" style="font-size: 25px"></i>
          Dish Management</a>
        <ul class="list-unstyled navbar__sub-list js-sub-list">

          <li>
            <a href="{{ url('product/index') }}">List Dishes</a>
          </li>
          <li>
            <a href="{{ url('product/create')}}">Add Dish</a>
            <a href="{{ url('product/old-dishes')}}">Hide Dishes</a>
          </li>

        </ul>
      </li>
      <!-- discount management -->
      <li class="active has-sub">
        <a class="js-arrow" href="#">

          <i class="fas fa-tag" style="font-size: 25px"></i>Discount management</a>
        <ul class="list-unstyled navbar__sub-list js-sub-list">
          <li>
            <a href="{{ url('discount/index') }}">Discount list</a>
          </li>

          <li>
            <a href="{{ url('discount/create') }}">Create Discount</a>
          </li>

        </ul>
      </li>

      <!-- warehouse management -->
      <li class="active has-sub">
        <a class="js-arrow" href="#">
          <i class="fa-sharp fa-regular fa-warehouse" style="font-size: 25px"></i>Warehouse </a>
        <ul class="list-unstyled navbar__sub-list js-sub-list">
          <li>
            <a href="{{ url('/warehouse/index') }}">Material list</a>
          </li>
          <li>
            <a href="{{ url('/warehouse/create') }}">Create material</a>
          </li>
          <li>
            <a href="{{ url('/warehouse/history') }}">History</a>
          </li>
        </ul>
      </li>

      <!-- banner management page -->

      <li class="active has-sub">
        <a class="js-arrow" href="#">
          <i class="fa-regular fa-image" style="font-size: 25px"></i>Banner</a>




        <ul class="list-unstyled navbar__sub-list js-sub-list">
          <li>
            <a href="{{ url('/banner/index') }}">Banner list</a>
          </li>
          <li>
            <a href="{{ url('/banner/create') }}">Create Banner</a>
          </li>
        </ul>

        <!-- bill management -->
      </li>
      <li class="active has-sub">
        <a class="js-arrow" href="{{ url('bill/index') }}">
          <i class="fa-solid fa-money-bill-wave" style="font-size: 25px"></i>Bill</a>


      </li>


    </ul>
  </nav>
</div>
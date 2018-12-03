<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('dist/img/user9-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>ข้อมูลหลัก</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> เพิ่มข้อมูลหลัก
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('location.index') }}"><i class="fa fa-circle-o"></i> สถานที</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> ปัญหา</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> ช่วงเวลา</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> ผู้รับเรื่อง</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> ผู้รับผิดชอบ</a></li>
              </ul>
            </li>
        </ul>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-share"></i> <span>รายงาน</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('PetControl.index') }}"><i class="fa fa-circle-o"></i> PetControl</a></li>
          <li><a href="{{ route('temperature.index') }}"><i class="fa fa-circle-o"></i> Import เครื่องอุณหภูมิ</a></li>
          <li>
            <a href="#"><i class="fa fa-circle-o"></i> Level One
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
              <li>
                <a href="#"><i class="fa fa-circle-o"></i> Level Two
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

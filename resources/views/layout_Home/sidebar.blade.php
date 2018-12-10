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
                <li><a href="{{ route('location.index') }}"><i class="fa fa-bookmark"></i> สถานที</a></li>
                <li><a href="#"><i class="fa fa-bookmark"></i> ปัญหา</a></li>
                <li><a href="#"><i class="fa fa-bookmark"></i> ช่วงเวลา</a></li>
                <li><a href="#"><i class="fa fa-bookmark"></i> ผู้รับเรื่อง</a></li>
                <li><a href="#"><i class="fa fa-bookmark"></i> ผู้รับผิดชอบ</a></li>
              </ul>
            </li>
        </ul>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-share-alt"></i> <span>เครื่องอุณหภูมิ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li>
                  <a href="{{ route('temperature.index') }}"><i class="fa fa-steam"></i> Import เครื่องอุณหภูมิ</a>
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
          <li><a href="{{ route('listcapa',1) }}"><i class="fa fa-book"></i> คู่มือ SOP</i></a></li>
          <li><a href="{{ route('listcapa',2) }}"><i class="fa fa-book"></i> Pest Control</a></li>
          <li><a href="{{ route('listcapa',3) }}"><i class="fa fa-book"></i> Product Recipt and Release</a></li>
          <li><a href="{{ route('listcapa',4) }}"><i class="fa fa-book"></i> Product return</a></li>
          <li><a href="{{ route('listcapa',5) }}"><i class="fa fa-book"></i> Warehouse</a></li>
          <li><a href="{{ route('listcapa',6) }}"><i class="fa fa-book"></i> Product Complaint</a></li>
          <li><a href="{{ route('listcapa',7) }}"><i class="fa fa-book"></i> Deviation</a></li>
          <li><a href="{{ route('listcapa',8) }}"><i class="fa fa-book"></i> CAPA</a></li>
          <li><a href="{{ route('listcapa',9) }}"><i class="fa fa-book"></i> Supplier</a></li>
          <li><a href="{{ route('listcapa',10) }}"><i class="fa fa-book"></i> Dispatch and transportation</a></li>
          <li><a href="{{ route('listcapa',11) }}"><i class="fa fa-book"></i> Maintenance</a></li>
          <li><a href="{{ route('listcapa',12) }}"><i class="fa fa-book"></i> Change</a></li>
          <li><a href="{{ route('listcapa',13) }}"><i class="fa fa-book"></i> Temperature monitoring</a></li>
          <li><a href="{{ route('listcapa',14) }}"><i class="fa fa-book"></i> Stock and Storang</a></li>
          <li><a href="{{ route('listcapa',15) }}"><i class="fa fa-book"></i> Calibration</a></li>
          <li><a href="{{ route('listcapa',16) }}"><i class="fa fa-book"></i> Product recall</a></li>
          <li><a href="{{ route('listcapa',17) }}"><i class="fa fa-book"></i> cleaning</a></li>
          <li><a href="{{ route('listcapa',18) }}"><i class="fa fa-book"></i> Security system</a></li>
          <li><a href="{{ route('listcapa',19) }}"><i class="fa fa-book"></i> Product return</a></li>
          <li><a href="{{ route('listcapa',20) }}"><i class="fa fa-book"></i> คู่มือ SOP</a></li>
          <li><a href="{{ route('listcapa',21) }}"><i class="fa fa-book"></i> คู่มือ Self Inspection(SI)</a></li>
          <li><a href="{{ route('listcapa',22) }}"><i class="fa fa-book"></i> Training Record</a></li>
          <li><a href="{{ route('listcapa',23) }}"><i class="fa fa-book"></i> ตรวจสอบและกำจัดแมลง</a></li>
          <li><a href="{{ route('listcapa',24) }}"><i class="fa fa-book"></i> แจ้งรายละเอียด Shipment</a></li>
          <li><a href="{{ route('listcapa',25) }}"><i class="fa fa-book"></i> เอกสารวิธีการ/การขนส่ง</a></li>
          <li><a href="{{ route('listcapa',26) }}"><i class="fa fa-book"></i> ใบส่งสินค้าชั่วคราว</a></li>
          <li><a href="{{ route('listcapa',27) }}"><i class="fa fa-book"></i> ใบ Certificate</a></li>
          <li><a href="{{ route('listcapa',28) }}"><i class="fa fa-book"></i> สต๊อกสินค้า</a></li>
          <li><a href="{{ route('listcapa',29) }}"><i class="fa fa-book"></i> ใบ Batch Release</a></li>
          <li><a href="{{ route('listcapa',30) }}"><i class="fa fa-book"></i> สินค้าเข้าทาง Email</a></li>
          <li><a href="{{ route('listcapa',31) }}"><i class="fa fa-book"></i> ใบส่งสินค้า BLAH Thailand</a></li>
          <li><a href="{{ route('listcapa',32) }}"><i class="fa fa-book"></i> ใบรายงานรับของ</a></li>
          <li><a href="{{ route('listcapa',33) }}"><i class="fa fa-book"></i> ใบ PO</a></li>
          <li><a href="{{ route('listcapa',34) }}"><i class="fa fa-book"></i> ใบสต๊อกสินค้า</a></li>
          <li><a href="{{ route('listcapa',35) }}"><i class="fa fa-book"></i> ใบชี้บ่งสินค้า</a></li>
          <li><a href="{{ route('listcapa',36) }}"><i class="fa fa-book"></i> ใบเบิกสินค้า</a></li>
          <li><a href="{{ route('listcapa',37) }}"><i class="fa fa-book"></i> สติกเกอร์</a></li>
          <li><a href="{{ route('listcapa',38) }}"><i class="fa fa-book"></i> เอกสารรับสินค้า</a></li>
          <li><a href="{{ route('listcapa',39) }}"><i class="fa fa-book"></i> ใบแจ้งการตรวจยาและวัคซีน...</a></li>
          <li><a href="{{ route('listcapa',40) }}"><i class="fa fa-book"></i> เอกสารคืนสินค้า</a></li>
          <li><a href="{{ route('listcapa',41) }}"><i class="fa fa-book"></i> บันทึกบุคคลเข้า-ออก</a></li>
          <li><a href="{{ route('listcapa',42) }}"><i class="fa fa-book"></i> บันทึกสถานการณ์ประจำวัน</a></li>
          <li><a href="{{ route('listcapa',43) }}"><i class="fa fa-book"></i> ตาราางทำความสะอาด</a></li>
          <li><a href="{{ route('listcapa',44) }}"><i class="fa fa-book"></i> CAPA FORM</a></li>
          <li><a href="{{ route('listcapa',45) }}"><i class="fa fa-book"></i> NCR CAPA log Sheet</a></li>
          <li><a href="{{ route('listcapa',46) }}"><i class="fa fa-book"></i> ใบประวัติการสอบเทียบ</a></li>
          <li><a href="{{ route('listcapa',47) }}"><i class="fa fa-book"></i> ใบทะเบียนรายชื่อผู้ขาย/ผู้รับจ้าง</a></li>
          <li><a href="{{ route('listcapa',48) }}"><i class="fa fa-book"></i> ใบขอซื้อ,ขอซ่อม (PR)</a></li>
          <li><a href="{{ route('listcapa',49) }}"><i class="fa fa-book"></i> รายงานการใช้เชื้อเพลิง</a></li>
          <li><a href="{{ route('listcapa',50) }}"><i class="fa fa-book"></i> รายงาน Audit จุดจอด</a></li>
          <li><a href="{{ route('listcapa',51) }}"><i class="fa fa-book"></i> รายงาน Audit จุดส่งสินค้า</a></li>
          <li><a href="{{ route('listcapa',52) }}"><i class="fa fa-book"></i> รายงานสถานการณ์จัดส่ง</a></li>
          <li><a href="{{ route('listcapa',53) }}"><i class="fa fa-book"></i> Training Record</a></li>
          <li><a href="{{ route('listcapa',54) }}"><i class="fa fa-book"></i> บำรุงตู้แช่วัคซีน/เครื่องกำเนิดไฟ</a></li>
          <li><a href="{{ route('listcapa',55) }}"><i class="fa fa-book"></i> ใบแจ้งซ่อม</a></li>
          <li><a href="{{ route('listcapa',56) }}"><i class="fa fa-book"></i> ใบตรวจเช็คเครื่องจักร</a></li>
          <li><a href="{{ route('listcapa',57) }}"><i class="fa fa-book"></i> บันทึกเฝ้าระวังอุณหภูมิ/ความชื้น</a></li>
          <li><a href="{{ route('listcapa',58) }}"><i class="fa fa-book"></i> รายงานตรวจเช็ค/บำรุงรักษา</a></li>

          {{-- <li>
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
          </li> --}}
        </ul>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

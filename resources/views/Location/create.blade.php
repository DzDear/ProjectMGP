@extends('layout_home.master')
@section('title','ข้อมูลหลัก')
@section('PetControl')

    <section class="content-header">
      <h1>
        ข้อมูลหลัก
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <h3 align="center"><b>เพิ่มข้อมูลสถานที</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">

          {{-- <div class="container"> --}}
            <div class="row">
              <div class="col-md-12"> <br />

                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>คำเตือน!</strong> {{ session()->get('error') }}
                </div>
                @endif

                {{-- เช็คการกรอกข้อมูล --}}
                @if (count($errors) > 0)
                  <div class="alert alert-danger">
                  <ul>
                      @foreach($errors->all() as $error)
                      <li>กรุณากรอกข้อมูลให้ครบช่อง ({{$error}}) </li>
                      @endforeach
                  </ul>
                  </div>
                @endif

                <form method="post" action="{{ route('location.store') }}">
                  @csrf
                  <div class="form-group">
                    <label>รหัส</label>
                    <input type="text" name="master_code" class="form-control" placeholder="ป้อนรหัส" />
                  </div>

                  <div class="form-group">
                    <label>ชื่อ</label>
                    <input type="text" name="master_name" class="form-control" placeholder="ป้อนชื่อ" />
                  </div>

                  <div class="form-group">
                    <input type="hidden" readonly name="master_type" value="1" class="form-control" placeholder="ป้อนประเภท" />
                  </div>

                  <br />
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="บันทึก" />
                  </div>
                </form>
              </div>
            </div>
          {{-- </div> --}}

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
      </div>

    </section>

@endsection

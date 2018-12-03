@extends('layout_home.master')
@section('title','PetControl')
@section('PetControl')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

    <section class="content-header">
      <h1>
        ข้อมูลหลัก
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <h3 align="center"><b>แก้ไขข้อมูลสถานที</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">

          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                <li>กรุณากรอกข้อมูลให้ครบช่อง {{$error}}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {{-- <div class="container"> --}}
            <div class="row">
              <div class="col-md-12"> <br />
                <form method="post" action="{{ action('MasterMainController@update',$id) }}">
                  @csrf
                  <div class="form-group">
                    <label>รหัส</label>
                    <input type="text" name="master_code" class="form-control" value="{{$user->master_code}}" />
                  </div>

                  <div class="form-group">
                    <label>ชื่อ</label>
                    <input type="text" name="master_name" class="form-control" value="{{$user->master_name}}" />
                  </div>

                  <div class="form-group">
                    <input type="hidden" readonly name="master_type" value="1" class="form-control" />
                  </div>

                  <br>
                  <div class="form-group">
                    <button type="submit" class="delete-modal btn btn-success">
                      <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                    </button>
                  </div>
                  <input type="hidden" name="_method" value="PATCH"/>
                </form>

              </div>
            </div>
          {{-- </div> --}}

        </div>

        <!-- /.box-body -->
        <div class="box-footer">
        </div>
      </div>

    </section>

@endsection

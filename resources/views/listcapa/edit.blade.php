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
        รายงาน
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <h3 align="center"><b>แก้ไขข้อมูล {{$title}}</b></h3>
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
                <form method="post" action="{{ action('CapaController@update',$id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <div class="form-group">
                    <label>วันที่</label>
                    <input type="date" name="date" class="form-control" value="{{$user->date}}" />
                  </div>

                  <div class="form-group">
                    <label>ชื่อ</label>
                    <input type="text" name="capa_name" class="form-control" placeholder="ป้อนชื่อ" value="{{$user->capa_name}}" />
                  </div>

                  <div class="form-group">
                    <label>เลือกไฟล์</label>
                    <input type="file" name="file_name" value="{{$user->file_name}}">
                  </div>

                  <div class="form-group">
                    <input type="hidden" readonly name="capa_type" value="{{$user->capa_type}}" class="form-control" />
                  </div>

                  {{-- <div class="form-group">
                    <label>เลือกไฟล์</label>
                    <input type="file" name="image_name" accept="image/*" data-min-file-count="1" value="{{$user->image_name}}">
                  </div> --}}

                  <br>
                  <div class="form-group">
                    {{-- <input type="submit" class="btn btn-primary" value="อัพเดท" /> --}}
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

    <script type="text/javascript">
      $(function(){
        $("#image-file").fileinput({
          theme:'fa',
        })
      })
    </script>

@endsection

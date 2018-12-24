@extends('layout_home.master')
{{-- @section('title','PetControl') --}}
@section('PetControl')

    <section class="content-header">
      <h1>
        รายงาน
        <small>it all starts here</small>
      </h1>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-header with-border">

          <h3 align="center"><b>เพิ่มข้อมูล {{$title}}</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">

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

            <div class="row">
              <div class="col-md-12"> <br />
                <form action="{{ route('listcapa.store') }}" method="post" id="formimage" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label>วันที่</label>
                    <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control" />
                  </div>

                  <div class="form-group">
                    <label>ชื่อ</label>
                    <input type="text" name="capa_name" class="form-control" placeholder="ป้อนชื่อ" />
                  </div>

                  <input type="hidden" name="_token" value="{{csrf_token()}}" />

                  {{-- <div class="form-group">
                    <label>เลือกไฟล์</label>
                    <input type="file" name="image_name" accept="image/*" data-min-file-count="1">
                  </div> --}}

                  <div class="form-group">
                    <label>เลือกไฟล์</label>
                    <input type="file" name="file_name" id="file">
                  </div>

                  <div class="form-group">
                    <input type="hidden" readonly name="capa_type" value="{{ $type }}" class="form-control" />
                  </div>

                  <br>
                  <div class="form-group">
                    {{-- <input type="submit" class="btn btn-primary" value="บันทึก" /> --}}
                    <button type="submit" class="delete-modal btn btn-success">
                      <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                    </button>
                  </div>
                </form>

              </div>
            </div>

        </div>

        <div class="box-footer">

        </div>
      </div>

    </section>

@endsection

{{-- <script type="text/javascript">
  $(function(){
    $("#image-file").fileinput({
      theme:'fa',
    })
  })
</script> --}}

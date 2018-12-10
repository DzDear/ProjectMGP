@extends('layout_home.master')
@section('title','รายงาน')
@section('PetControl')

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

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
          <h3 align="center"><b>{{ $title }}</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">
          <div align="right">
            <a href="{{ route('listcapa.create',$type) }}" class="btn btn-success">
            <span class="glyphicon glyphicon-plus"></span> เพิ่มข้อมูล
            </a>
          </div>

          <div class="row">
            <div class="col-md-12">

              @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>สำเร็จ!</strong> {{ session()->get('success') }}
                </div>
              @endif

              <table class="table table-bordered" id="table">
                <thead class="thead-dark">
                  <br>
                  <tr>
                    <th class="text-center">Date</th>
                    <th class="text-center">Name</th>
                    {{-- <th class="text-center">Image</th> --}}
                    <th class="text-center">PDF</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($data as $row)
                    <tr>
                      <td class="text-center">{{ date('d-m-Y',strtotime($row->date)) }}</td>
                      <td width='40%'>{{$row->capa_name}}</td>
                      {{-- <td class="text-center">
                         <img src="{{ asset('upload-image/'.$row->image_name) }}" alt="" style="max-width:100px">
                      </td> --}}
                      <td class="text-center">
                        {{-- <a href="{{ action('PetController@downloadPDF',$row['id']) }}" class="btn btn-primary"> --}}
                        <a href="{{ url('upload-image')."/".$row->file_name }}" target="_blank" class="btn btn-primary">
                        <span class="glyphicon glyphicon-download-alt"></span> PDF
                        </a>
                      </td>
                      <td class="text-center">
                        <a href="{{ action('CapaController@edit',[$row['id'],$row->capa_type]) }}" class="btn btn-warning">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                        </a>
                      </td>
                      <td class="text-center">
                        <form method="post" class="delete_form" action="{{ action('CapaController@destroy',$row['id']) }}">
                        {{csrf_field()}}
                          <input type="hidden" name="_method" value="DELETE" />
                          <button type="submit" class="delete-modal btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>

            </div>
          </div>

          <script type="text/javascript">
            $(function() {
               $('#table').DataTable();
            });
          </script>

          <script type="text/javascript">
          $(document).ready(function(){
            $('.delete_form').on('submit',function(){
              if (confirm("คุณต้องการลบข้อมูลหรือไม่")) {
                return true;
              }
              else {
                return false;
              }
              });
            });
          </script>

        </div>

        <div class="box-footer">
        </div>

      </div>
    </section>

@endsection

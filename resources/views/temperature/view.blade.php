@extends('layout_home.master')
@section('title','เครื่องอุณหภูมิ')
@section('PetControl')

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      <h1>
        เครื่องอุณหภูมิ
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 align="center"><b>Import เครื่องอุณหภูมิ</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">

          @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <strong>สำเร็จ!</strong> {{ session()->get('success') }}
            </div>
          @endif

          <div class="row">
            <div class="col-md-12">
            <form method="get" action="{{ url('temperature') }}">
              <div align="right" class="form-inline form-group">
                <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-search"></span> Search
                </button>
                <a href="{{ action('TempController@ReportPDF') }}?id={{$id}}&censer={{$censer}}&Fromdate={{$fdate}}&Todate={{$tdate}}&radioname={{$radioname}}" class="btn btn-warning">
                <span class="glyphicon glyphicon-print"></span> Print Report
                </a>
                <a href="{{ route('temperature.create') }}" class="btn btn-success">
                <span class="glyphicon glyphicon-download-alt"></span> Import Data
                </a>
              </div>

              <div align="right" class="form-inline form-group">
                <input type="radio" name="radioname" id="" value="0" {{ ($radioname == 0) ? 'checked' : '' }}>
                <label> All</label>
                <input type="radio" name="radioname" id="" value="2" {{ ($radioname == 2) ? 'checked' : '' }}>
                <label> Lower</label>
                <input type="radio" name="radioname" id="" value="7" {{ ($radioname == 7) ? 'checked' : '' }}>
                <label> Upper</label>
              </div>

              <div align="right" class="form-inline form-group">
                <label>Location : </label>
                <select name="id" class="form-control" style="width: 170px;">
                {{-- <select class="form-control" style="width: 170px;" onchange="window.location='{{ url('temperature?id=') }}'+this.value + '&censer={{ $censer }}'"> --}}
                  <option selected disabled value="">Select container</option>
                  <option value="1" {{ ($id == 1) ? 'selected' : '' }}>Location 1</option>
                  <option value="2" {{ ($id == 2) ? 'selected' : '' }}>Location 2</option>
                  <option value="3" {{ ($id == 3) ? 'selected' : '' }}>Location 3</option>
                  <option value="4" {{ ($id == 4) ? 'selected' : '' }}>Location 4</option>
                  <option value="5" {{ ($id == 5) ? 'selected' : '' }}>Location 5</option>
                  <option value="6" {{ ($id == 6) ? 'selected' : '' }}>Location 6</option>
                  <option value="7" {{ ($id == 7) ? 'selected' : '' }}>Location 7</option>
                  <option value="8" {{ ($id == 8) ? 'selected' : '' }}>Location 8</option>
                  <option value="9" {{ ($id == 9) ? 'selected' : '' }}>Location 9</option>
                  <option value="10" {{ ($id == 10) ? 'selected' : '' }}>Location 10</option>
                  <option value="11" {{ ($id == 11) ? 'selected' : '' }}>Location 11</option>
                </select>

                <label>censer : </label>
                <select name="censer" class="form-control" style="width: 170px;">
                {{-- <select class="form-control" style="width: 170px;" onchange="window.location='{{ url('temperature?id=').$id }}&censer='+this.value"> --}}
                  <option selected disabled value="" >Select censer</option>
                  <option value="1" {{ ($censer == 1) ? 'selected' : '' }}>censer C1</option>
                  <option value="2" {{ ($censer == 2) ? 'selected' : '' }}>censer C2</option>
                  <option value="3" {{ ($censer == 3) ? 'selected' : '' }}>censer C3</option>
                </select>
              </div>

              <div align="right" class="form-inline form-group">
                <label>จากวันที่ : </label>
                <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: date('Y-m-d') }}" class="form-control" />

                <label>ถึงวันที่ : </label>
                <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: date('Y-m-d') }}" class="form-control" />
              </div>
            </form>

              <table class="table table-bordered" id="table">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center">Date</th>
                    <th class="text-center">time</th>
                    <th class="text-center">Location</th>
                    <th class="text-center">Censer</th>
                    <th class="text-center">Temp</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $row)
                    <tr>
                      <td class="text-center">{{ $row->date_log }}</td>
                      <td class="text-center">{{ $row->time_log }}</td>
                      <td class="text-center">{{ $row->Lc_log }}</td>
                      <td class="text-center">{{ $row->Sc_log }}</td>
                      <td class="text-center">{{ $row->temp_log }}</td>
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
        </div>

        <div class="box-footer">
        </div>

      </div>
    </section>

@endsection

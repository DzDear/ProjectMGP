@extends('layout_home.master')

@section('create')
{{-- <div class="container"> --}}
  <div class="row">
    <div class="col-md-12"> <br />
      <h3 align="center">เพิ่มข้อมูลระบบหลัก</h3> <br />
      <form method="post" action="{{url('user')}}"> {{csrf_field() }}
        <div class="form-group">
          <label>วันที่</label>
          <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control" />
        </div>
        <div class="form-group">
          <label>เวลา</label>
          <input type="time" name="timing" value="{{ date('h:i:s') }}" class="form-control" />
        </div>

        <label>สถานที</label>
        <select class="form-control" name="location_name">
          <option value="1">log 1</option>
          <option value="2">log 2</option>
          <option value="3">log 3</option>
          <option value="4">log 4</option>
        </select>

        <br />
        <div class="form-group">
          <input type="submit" name="lname" class="btn btn-primary" value="บันทึก" />
        </div>
      </form>
    </div>
  </div>
{{-- </div> --}}

@endsection

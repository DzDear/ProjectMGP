<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ระบบบันทึกข้อมูลหลัก</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>
    <div class="container">
      <h3 align="center">บันทึกหลัก</h3>
      <div class="row">
      <form method="post" action="{{url('product')}}">
        {{ csrf_field() }}
        <div class="form-group">
          <label>รหัส</label>
          <input type="text" name="master_code" class="form-control" />
        </div>
        <div class="form-group">
          <label>ชื่อ</label>
          <input type="text" name="master_name" class="form-control" />
        </div>
        <div class="form-group">
          <label>ประเภท</label>
          <input type="text" name="master_type" class="form-control" />
        </div>

        <br>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="บันทึก" />
        </div>
      </form>
    </div>
  </div>
  </body>
</html>

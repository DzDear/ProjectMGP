<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <div align="center">
        <h1><b>รายงาน</b></h1>
      </div>

      <table border="1">
        <thead>
          <tr align="center">
            <th class="text-center">Location</th>
            <th class="text-center">Censer</th>
            <th class="text-center">1</th>
            <th class="text-center">2</th>
            <th class="text-center">3</th>
            <th class="text-center">4</th>
            <th class="text-center">5</th>
            <th class="text-center">6</th>
            <th class="text-center">7</th>
            <th class="text-center">8</th>
            <th class="text-center">9</th>
            <th class="text-center">10</th>
            <th class="text-center">11</th>
            <th class="text-center">12</th>
            <th class="text-center">Sum</th>
          </tr>
        </thead>

        <tbody>
          @foreach($data['title'] as $key_title => $item)
              <tr align="center">
                <td>{{ $item['lc'] }}</td>
                <td>{{ $item['sc'] }}</td>

                @php $count = []; @endphp
                @foreach ($data['data'] as $key => $value)
                  @if ($value['lc'] == $item['lc'] && $value['sc'] == $item['sc'])
                    @php $count[$value['month']] = $value['count']; @endphp
                  @endif
                @endforeach

                @php $arr = array('01','02','03','04','05','06','07','08','09','10', '11','12') @endphp
                @php $sum = 0 @endphp
                @foreach($arr as $m)
                  @if (array_key_exists($m, $count))
                    @php $sum += $count[$m] @endphp
                    <td>{{ $count[$m] }}</td>
                  @else
                    <td></td>
                  @endif
                @endforeach
                <td>{{ $sum }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

  </body>
</html>

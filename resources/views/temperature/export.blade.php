<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <b align="center">
        <h2>รายงาน</h2>
        <h3>จากวันที่ {{ $fdate }} ถึงวันที่ {{ $tdate }}
          Location
          @if ($id == 0)
            N/A
          @else
            {{ $id }}
          @endif
          censer
          @if ($censer == 0)
            N/A
          @else
            {{ $censer }}
          @endif
          ประเภท
          @if ($radioname == 7)
            มากกว่า 7
          @elseif ($radioname == 2)
            น้อยกว่า 2
          @else
            ทั้งหมด
          @endif
        </h3>
      </b>

      <table border="1">
        <thead>
          <tr align="center">
            <th class="text-center"><b>Location</b></th>
            <th class="text-center"><b>Censer</b></th>
            <th class="text-center"><b>1</b></th>
            <th class="text-center"><b>2</b></th>
            <th class="text-center"><b>3</b></th>
            <th class="text-center"><b>4</b></th>
            <th class="text-center"><b>5</b></th>
            <th class="text-center"><b>6</b></th>
            <th class="text-center"><b>7</b></th>
            <th class="text-center"><b>8</b></th>
            <th class="text-center"><b>9</b></th>
            <th class="text-center"><b>10</b></th>
            <th class="text-center"><b>11</b></th>
            <th class="text-center"><b>12</b></th>
            <th class="text-center"><b>Sum</b></th>
          </tr>
        </thead>

        <tbody>

            @php $Sumarr = array('01' => 0,'02'=>0,'03'=>0,'04'=>0,'05'=>0,'06'=>0,'07'=>0,'08'=>0,'09'=>0,'10'=>0, '11'=>0,'12'=>0) @endphp

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
                    @php $Sumarr[$m] += $count[$m] @endphp

                    <td>{{ $count[$m] }}</td>
                  @else
                    <td></td>
                  @endif
                @endforeach
                <td>{{ $sum }}</td>
              </tr>
            @endforeach

            <tr align="center">
              <th class="text-center" colspan="2"><b>รวม</b></th>
              @foreach($arr as $m)
                @if ($Sumarr[$m] == 0)
                  <th></th>
                @else
                  <th class="text-center">{{ $Sumarr[$m] }}</th>
                @endif
              @endforeach
              <th>{{ array_sum($Sumarr) }}</th>
            </tr>

          </tbody>
        </table>

  </body>
</html>

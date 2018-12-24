<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\temperature;
use Excel;
use PDF;
use Carbon\Carbon;

class TempController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $id = '';
      $censer = '';
      $fdate = '';
      $tdate = '';
      $radioname = '';

      if ($request->has('id')) {
        $id = $request->get('id');
      }
      if ($request->has('censer')) {
        $censer = $request->get('censer');
      }
      if ($request->has('Fromdate')) {
        $fdate = $request->get('Fromdate');
      }
      if ($request->has('Todate')) {
        $tdate = $request->get('Todate');
      }
      if ($request->has('radioname')) {
        $radioname = $request->get('radioname');
      }

      // dd($fdate,$tdate);

      $data = temperature::when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                              return $q->whereBetween('date_log',[$fdate,$tdate]);
                          })
                          ->when(!empty($id), function($q) use($id){
                            return $q->where('Lc_log',$id);
                          })
                          ->when(!empty($censer), function($q) use($censer){
                            return $q->where('Sc_log',$censer);
                          });

                          if ($radioname == 2) {
                            $data = $data->where('temp_log','<',2);
                          }if ($radioname == 7) {
                            $data = $data->where('temp_log','>',7);
                          }
                        $data = $data->get();

      // $data = temperature::where('Lc_log','like',$id)->where('Sc_log','like',$censer)
      //                     ->where('date_log','>=',$fdate)
      //                     ->where('date_log','<=',$tdate)
      //                     ->get();

      // dd($data);

      return view('temperature.view', compact(['data', 'id','censer' ,'fdate' ,'tdate','radioname']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('temperature.import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ReportPDF(Request $request)
    {
        $id = '';
        $censer = '';
        $fdate = '';
        $tdate = '';
        $radioname = '';

        if ($request->has('id')) {
          $id = $request->get('id');
        }
        if ($request->has('censer')) {
          $censer = $request->get('censer');
        }
        if ($request->has('Fromdate')) {
          $fdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
        }
        if ($request->has('radioname')) {
          $radioname = $request->get('radioname');
        }

        $data = temperature::when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                              return $q->whereBetween('date_log',[$fdate,$tdate]);
                            })
                            ->when(!empty($id), function($q) use($id){
                              return $q->where('Lc_log',$id);
                            })
                            ->when(!empty($censer), function($q) use($censer){
                              return $q->where('Sc_log',$censer);
                            });

                            if ($radioname == 2) {
                              $data = $data->where('temp_log','<',2);
                            }if ($radioname == 7) {
                              $data = $data->where('temp_log','>',7);
                            }

                            $data = $data->get()

                            ->groupBy('Lc_log')
                            ->sortKeys()
                            ->map( function($data) {
                              return $data->groupBy('Sc_log')->sortKeys()->map(function($mount) {
                                return $mount->groupBy( function($date) {
                                  return Carbon::parse($date->date_log)->format('m');
                                });
                              });
                            });

        // dd($data);

        $item = [];
        foreach($data as $key_lc => $sc) {
          foreach($sc as $key_sc => $m) {

            $item['title'][] = [
              'lc' => $key_lc,
              'sc' => $key_sc
            ];
            $lc_title = $key_lc;
            $sc_title = $key_sc;
            foreach($m as $key_month => $value) {
              $item['data'][] = [
                      'lc' => $lc_title,
                      'sc' => $sc_title,
                      'month' => $key_month,
                      'count' => $value->count()
              ];
            }
          }

        }

        $data = $item;

        $view = \View::make('temperature.export' ,compact(['data', 'id','censer' ,'fdate' ,'tdate','radioname']));
        $html = $view->render();

        $pdf = new PDF();
        $pdf::SetTitle('รายงานออก Report');
        $pdf::AddPage('L', 'A4');
        $pdf::SetFont('freeserif');

        $pdf::WriteHTML($html,true,false,true,false);
        $pdf::Output('report.pdf');

    }

    public function contactImport(Request $request)
    {
        $this->validate($request,['file' => 'required']);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            config (['excel.import.startRow' => 2]);
            $data = Excel::load($path, function($reader){})->get();
            $arr = [];

            if (!empty($data) && $data->count()) {
              foreach ($data as $value) {

                if($value->date != 'Process variable data' && $value->date != 'Date  : ' && $value->date != '')
                {

                  $date  = $value->date->format('Y')-543 .'-'. $value->date->format('m') .'-'. $value->date->format('d');

                  $exits = temperature::where('date_log', '=', (!empty($value->date)) ? $date : '')
                                      ->where('time_log', '=', (!empty($value->time)) ? $value->time->format('H:i:s') : '')
                                      ->exists();

                  $date_log = (!empty($value->date)) ? $value->date->format('Y')-543 .'-'. $value->date->format('m') .'-'. $value->date->format('d') : '';
                  $time_log = (!empty($value->time)) ? $value->time->format('H:i:s') : '';
                  $yyyymm = (!empty($value->date)) ? $value->date->format('Y')-543 . $value->date->format('m') : '';

                  if (!$exits)
                  {
                    if($value->c_1_1 < 2 || $value->c_1_1 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 1;
                      $contact->Sc_log = 1;
                      $contact->temp_log = $value->c_1_1;
                      $contact->save();
                    }
                    if($value->c_1_2 < 2 || $value->c_1_2 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 1;
                      $contact->Sc_log = 2;
                      $contact->temp_log = $value->c_1_2;
                      $contact->save();
                    }
                    if($value->c_1_3 < 2 || $value->c_1_3 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 1;
                      $contact->Sc_log = 3;
                      $contact->temp_log = $value->c_1_3;
                      $contact->save();
                    }
                    if($value->c_2_1 < 2 || $value->c_2_1 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 2;
                      $contact->Sc_log = 1;
                      $contact->temp_log = $value->c_2_1;
                      $contact->save();
                    }
                    if($value->c_2_2 < 2 || $value->c_2_2 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 2;
                      $contact->Sc_log = 2;
                      $contact->temp_log = $value->c_2_2;
                      $contact->save();

                    }
                    if($value->c_2_3 < 2 || $value->c_2_3 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 2;
                      $contact->Sc_log = 3;
                      $contact->temp_log = $value->c_2_3;
                      $contact->save();
                    }
                    if($value->c_3_1 < 2 || $value->c_3_1 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 3;
                      $contact->Sc_log = 1;
                      $contact->temp_log = $value->c_3_1;
                      $contact->save();
                    }
                    if($value->c_3_2 < 2 || $value->c_3_2 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 3;
                      $contact->Sc_log = 2;
                      $contact->temp_log = $value->c_3_2;
                      $contact->save();

                    }
                    if($value->c_3_3 < 2 || $value->c_3_3 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 3;
                      $contact->Sc_log = 3;
                      $contact->temp_log = $value->c_3_3;
                      $contact->save();
                    }

                    if($value->c_4_1 < 2 || $value->c_4_1 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 4;
                      $contact->Sc_log = 1;
                      $contact->temp_log = $value->c_4_1;
                      $contact->save();
                    }
                    if($value->c_4_2 < 2 || $value->c_4_2 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 4;
                      $contact->Sc_log = 2;
                      $contact->temp_log = $value->c_4_2;
                      $contact->save();
                    }
                    if($value->c_4_3 < 2 || $value->c_4_3 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 4;
                      $contact->Sc_log = 3;
                      $contact->temp_log = $value->c_4_3;
                      $contact->save();
                    }
                    if($value->c_5_1 < 2 || $value->c_5_1 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 5;
                      $contact->Sc_log = 1;
                      $contact->temp_log = $value->c_5_1;
                      $contact->save();
                    }
                    if($value->c_5_2 < 2 || $value->c_5_2 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 5;
                      $contact->Sc_log = 2;
                      $contact->temp_log = $value->c_5_2;
                      $contact->save();

                    }
                    if($value->c_5_3 < 2 || $value->c_5_3 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 5;
                      $contact->Sc_log = 3;
                      $contact->temp_log = $value->c_5_3;
                      $contact->save();
                    }
                    if($value->c_6_1 < 2 || $value->c_6_1 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 6;
                      $contact->Sc_log = 1;
                      $contact->temp_log = $value->c_6_1;
                      $contact->save();
                    }
                    if($value->c_6_2 < 2 || $value->c_6_2 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 6;
                      $contact->Sc_log = 2;
                      $contact->temp_log = $value->c_6_2;
                      $contact->save();
                    }
                    if($value->c_6_3 < 2 || $value->c_6_3 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 6;
                      $contact->Sc_log = 3;
                      $contact->temp_log = $value->c_6_3;
                      $contact->save();
                    }
                    if($value->c_7_1 < 2 || $value->c_7_1 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 7;
                      $contact->Sc_log = 1;
                      $contact->temp_log = $value->c_7_1;
                      $contact->save();
                    }
                    if($value->c_7_2 < 2 || $value->c_7_2 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 7;
                      $contact->Sc_log = 2;
                      $contact->temp_log = $value->c_7_2;
                      $contact->save();
                    }
                    if($value->c_7_3 < 2 || $value->c_7_3 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 7;
                      $contact->Sc_log = 3;
                      $contact->temp_log = $value->c_7_3;
                      $contact->save();
                    }
                    if($value->c_8_1 < 2 || $value->c_8_1 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 8;
                      $contact->Sc_log = 1;
                      $contact->temp_log = $value->c_8_1;
                      $contact->save();
                    }
                    if($value->c_8_2 < 2 || $value->c_8_2 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 8;
                      $contact->Sc_log = 2;
                      $contact->temp_log = $value->c_8_2;
                      $contact->save();
                    }
                    if($value->c_8_3 < 2 || $value->c_8_3 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 8;
                      $contact->Sc_log = 3;
                      $contact->temp_log = $value->c_8_3;
                      $contact->save();
                    }
                    if($value->c_9_1 < 2 || $value->c_9_1 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 9;
                      $contact->Sc_log = 1;
                      $contact->temp_log = $value->c_9_1;
                      $contact->save();
                    }
                    if($value->c_9_2 < 2 || $value->c_9_2 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 9;
                      $contact->Sc_log = 2;
                      $contact->temp_log = $value->c_9_2;
                      $contact->save();
                    }
                    if($value->c_9_3 < 2 || $value->c_9_3 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 9;
                      $contact->Sc_log = 3;
                      $contact->temp_log = $value->c_9_3;
                      $contact->save();
                    }
                    if($value->c_10_1 < 2 || $value->c_10_1 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 10;
                      $contact->Sc_log = 1;
                      $contact->temp_log = $value->c_10_1;
                      $contact->save();
                    }
                    if($value->c_10_2 < 2 || $value->c_10_2 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 10;
                      $contact->Sc_log = 2;
                      $contact->temp_log = $value->c_10_2;
                      $contact->save();
                    }
                    if($value->c_10_3 < 2 || $value->c_10_3 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 10;
                      $contact->Sc_log = 3;
                      $contact->temp_log = $value->c_10_3;
                      $contact->save();
                    }
                    if($value->c_11_1 < 2 || $value->c_11_1 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 11;
                      $contact->Sc_log = 1;
                      $contact->temp_log = $value->c_11_1;
                      $contact->save();
                    }
                    if($value->c_11_2 < 2 || $value->c_11_2 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 11;
                      $contact->Sc_log = 2;
                      $contact->temp_log = $value->c_11_2;
                      $contact->save();
                    }
                    if($value->c_11_3 < 2 || $value->c_11_3 > 7){
                      $contact = new temperature();
                      $contact->date_log = $date_log;
                      $contact->time_log = $time_log;
                      $contact->yyyymm = $yyyymm;

                      $contact->Lc_log = 11;
                      $contact->Sc_log = 3;
                      $contact->temp_log = $value->c_11_3;
                      $contact->save();
                    }
                  }
                }
              }
            }

        }
        return redirect()->Route('temperature.index')->with('success','อัพเดตข้อมูลเรียบร้อย');
    }
}

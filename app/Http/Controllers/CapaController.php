<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listcapa;
use Storage;
use DataTables;
use PDF;
use Helper;

class CapaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data = Listcapa::where('capa_type',$request->type)->get();
      $title = Helper::Gettitle();
      $title = $title[$request->type -1];
      $type = $request->type;
      return view('listcapa.view', compact('data','title','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $title = Helper::Gettitle();
      $title = $title[$request->type -1];
      $type = $request->type;
      return view('listcapa.create', compact('title','type'));
    }


    public function downloadPDF($id)
    {
      $user = Listcapa::find($id);
      return Storage::download($user->file_name);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,['date' => 'required','capa_name' => 'required','file_name' => 'required']);

      $filename  = "";

      if ($request->hasFile('file_name')) {
        $image = $request->file('file_name');
        $filename = str_random(50).time(). '.' .$image->getClientOriginalExtension();
        $path = public_path('/upload-image');

        $image->move($path, $filename);
      }

      $Listcapa = new Listcapa([
        'date' => $request->get('date'),
        'capa_name' => $request->get('capa_name'),
        'file_name' => $filename,
        'capa_type' => $request->get('capa_type')
      ]);
      $Listcapa->save();

      $type = $request->capa_type;
      return redirect()->Route('listcapa',$type)->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
      $user = Listcapa::find($id);

      $title = Helper::Gettitle();
      $title = $title[$request->type -1];

      return view('listcapa.edit',compact('user','id','title'));
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
      // dd($request);
      $this->validate($request,['date' => 'required','capa_name' => 'required','file_name' => 'required']);  /**required =ตรวจสอบ,จำเป็นต้องป้อนข้อมูล */

      $user = Listcapa::find($id);
      $filename  = "";

      if ($request->hasFile('file_name')) {

        Storage::delete($user->file_name);

        $image = $request->file('file_name');
        $filename = str_random(50).time(). '.' .$image->getClientOriginalExtension();
        $path = public_path('/upload-image');

        $image->move($path, $filename);

      }

      $user->date = $request->get('date');
      $user->capa_name = $request->get('capa_name');
      $user->file_name = $filename;
      $user->save();

      $type = $request->capa_type;
      // dd($request);
      return redirect()->Route('listcapa',$type)->with('success','อัพเดตข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = Listcapa::find($id);

      Storage::delete($item->file_name);

      $item->Delete();
      return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }
}

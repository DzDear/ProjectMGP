<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PetControl;
use Storage;
use DataTables;
use PDF;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PetControl::all();
        return view('petControl.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petControl.create');
    }

    public function downloadPDF($id)
    {
      $user = PetControl::find($id);
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

      $this->validate($request,['date' => 'required','name' => 'required','file_name' => 'required']);

      $filename  = "";

      if ($request->hasFile('file_name')) {
        $image = $request->file('file_name');
        $filename = str_random(50).time(). '.' .$image->getClientOriginalExtension();
        $path = public_path('/upload-image');

        $image->move($path, $filename);
      }

      $PetControl = new PetControl([
        'date' => $request->get('date'),
        'name' => $request->get('name'),
        'file_name' => $filename
      ]);

      $PetControl->save();
      return redirect()->route('PetControl.index')->with('success','บันทึกข้อมูลเรียบร้อย');
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
      $user = PetControl::find($id);
      return view('petControl.edit',compact('user','id'));
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
      $this->validate($request,['date' => 'required','name' => 'required','file_name' => 'required']);  /**required =ตรวจสอบ,จำเป็นต้องป้อนข้อมูล */

      $user = PetControl::find($id);
      $filename  = "";

      if ($request->hasFile('file_name')) {

        Storage::delete($user->file_name);

        $image = $request->file('file_name');
        $filename = str_random(50).time(). '.' .$image->getClientOriginalExtension();
        $path = public_path('/upload-image');

        $image->move($path, $filename);

      }

      $user->date = $request->get('date');
      $user->name = $request->get('name');
      $user->file_name = $filename;
      $user->save();
      return redirect()->Route('PetControl.index')->with('success','อัพเดตข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = PetControl::find($id);

      Storage::delete($item->file_name);

      $item->Delete();
      return redirect()->Route('PetControl.index')->with('success','ลบข้อมูลเรียบร้อย');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master_mains;

class MasterMainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Master_mains::all();
      return view('location.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->input());
        $this->validate($request,['master_code' => 'required','master_name' => 'required']);

        if(Master_mains::where('master_code', $request->master_code)->exists())
        {
          return redirect()->route('location.create')->with('error','มีข้อมูลในระบบแล้ว');
        }
        $Master_mains = new Master_mains([
          'master_code' => $request->get('master_code'),
          'master_name' => $request->get('master_name'),
          'master_type' => $request->get('master_type')
        ]);

        $Master_mains->save();
        // return view('Location.view');
        return redirect()->route('location.index')->with('success','บันทึกข้อมูลเรียบร้อย');
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
      $user = Master_mains::find($id);
      return view('location.edit',compact('user','id'));
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
      $this->validate($request,['master_code' => 'required','master_name' => 'required']);  /**required =ตรวจสอบ,จำเป็นต้องป้อนข้อมูล */

      $user = Master_mains::find($id);
      $filename  = "";

      $user->master_code = $request->get('master_code');
      $user->master_name = $request->get('master_name');
      $user->save();
      return redirect()->Route('location.index')->with('success','อัพเดตข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = Master_mains::find($id);
      $item->Delete();
      return redirect()->Route('location.index')->with('success','ลบข้อมูลเรียบร้อย');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //$data = Department::all();
       //$data = Department::where('name','like','%ช%')->get();
       //$data = Department::select('id','name')->orderBy('id','desc')->get();
       $data = DB::select('select * from departments order by id desc');
       $total = Department::count();
       return response()->json([
           'total' => $total,
           'data' => $data
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Department();
        $data->name = $request->name;
        $data->save();

        return response()->json([
            'message' => 'เพิ่มข้อมูลสำเร็จ',
            'data' => $data
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Department::find($id);
        if($data == null){
            return response()->json([
               'error' => [
                   'status_code' => 404,
                   'message' => 'ไม่พบข้อมูล'
               ]
            ],404);
        }
        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id != $request->id){
            return response()->json([
                'error' => [
                    'status_code' => 400,
                    'message' => 'รหัสแผนกไม่ตรงกัน'
                ]
            ],400);
        }
       
        $data = Department::find($id);
        $data->name = $request->name;
        $data->save();

        return response()->json([
            'message' => 'แก้ไขข้อมูลเรียบร้อย',
            'data' => $data
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Department::find($id);
        if($data == null){
            return response()->json([
               'error' => [
                   'status_code' => 404,
                   'message' => 'ไม่พบข้อมูล'
               ]
            ],404);
        }

        $data->delete();
        
        return response()->json([
            'message' => 'ลบข้อมูล ID: '.$id.' '.$data->name.' เรียบร้อย'
        ],200);
    }
}

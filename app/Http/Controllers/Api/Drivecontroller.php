<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\drives;
use Illuminate\Http\Request;


class Drivecontroller extends Controller
{

    public function index()
    {
      $drives=drives::all();
      $massage=[
           "data"=>$drives,
           "massage"=>"all data done",
           "status"=>200
      ];
      return response($massage,200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'tittle'=>'required|string|min:3',
            'description'=>'required|string|min:3',
            'inputfile'=>'required|file|mimes:png,jpg,pdf,jif'
          ]);

          $drive_data=$request->file('inputfile');

          if($request->hasFile('inputfile')){
            $drive_nam=time().$drive_data->getClientOriginalName();
            $location=public_path("./drives/");
            $drive_data->move($location,$drive_nam);
          }

          $drive=new drives;
          $drive->tittle=$request->tittle;
          $drive->description=$request->description;
          $drive->file=public_path("drives").$drive_nam;
          $drive->status='private';
          $drive->userid=1;

          $massage=[
            "data"=>$drive,
            "massage"=>"Create done",
            "status"=>201
       ];
       return response($massage,201);
     }


    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tittle'=>'required|string|min:3',
            'description'=>'required|string|min:3',
            'inputfile'=>'file|mimes:png,jpg,pdf,jif'
          ]);

          $drive=drives::find($id);
          $drive->tittle=$request->tittle;
          $drive->description=$request->description;
          //file code or photo
          $drive_data=$request->file("inputfile");
          if($drive_data != null){
          $drive_name=time().$drive_data->getClientOriginalName();
          $location=public_path("./drives/");
          $drive_data->move($location,$drive_name);
          // to delete old file or photo
          $oldfile=$drive->file;
          $filePathName=public_path()."/drives/". $oldfile;
          unlink($filePathName);
      }else{
          $drive_name=$drive->file;
      }
          $drive->file=$drive_name;
          $drive->save();

          $massage=[
            "data"=>$drive,
            "massage"=>"updated done",
            "status"=>201
       ];
       return response($massage,201);
      }



    public function destroy($id)
    {
        $drive=drives::find($id);
        $oldfile=$drive->file;
        $filePathName=public_path()."/drives/". $oldfile;
        unlink($filePathName);
        $drive->delete();
        $massage=[
            "data"=>$drive,
            "massage"=>"deleted done",
            "status"=>201
       ];
       return response($massage,201);
    }
}

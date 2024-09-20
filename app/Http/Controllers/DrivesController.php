<?php

namespace App\Http\Controllers;

use App\Models\drives;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

class DrivesController extends Controller
{
    // to closs pages
    public function __construct()
    {
      $this->middleware('auth');
    }
    // to change status
    public function status($id){
       $drive=drives::find($id);
       if($drive->status == "private"){
          $drive->status = "public";
          $drive->save();
          return redirect()->route("drive.index")->with("done","the file is public");
       }else{
         $drive->status = "private";
         $drive->save();
         return redirect()->route("drive.index")->with("done","the file is private");
       }

    }

    public function allDrives()
    {

        // to show public files  //use db without you do model for joindrivewithuserinpublic view this is sacound way
        $drive=DB::table('drives')->get();
      return view('drives.allDrives')->with("drive",$drive);
}

    public function public()
    {

     // to show public files  //use db without you do model for joindrivewithuserinpublic view this is sacound way
      $drive=DB::table('joindrivewithuserinpublic')->get();
      return view('drives.public')->with("drive",$drive);
    }

    public function index()
    {
        // to show to the user that do sign in only private files
        $userId=auth()->user()->id;
      $drive=drives::where("userid","=",$userId)->get();
      return view('drives.index')->with("drive",$drive);
    }

    public function create()
    {
        return view('drives.create');
    }


    public function store(Request $request)
    {

          $request->validate([
            'tittle'=>'required|string|min:3',
            'description'=>'required|string|min:3',
            'inputfile'=>'required|file|mimes:png,jpg,pdf,jif'
          ]);


      $drive=new drives;
      $drive->tittle=$request->tittle;
      $drive->description=$request->description;
      //file code or photo
      $drive_data=$request->file("inputfile");
      //send name file
      $drive_nam=time().$drive_data->getClientOriginalName();
      $location=public_path("./drives/");
      $drive_data->move($location,$drive_nam);
    //   to show img that user uploaded
      $drive_name=public_path("drives").$drive_nam;
      $drive->file=$drive_name;

// to show to the user that do sign in only
      $userId=auth()->user()->id;
      $drive->userid=$userId;

      $drive->save();
      return redirect()->back()->with("done","uploaded file done");
    }

    public function show($id)
    {
        $drive=drives::find($id);
        return view('drives.show')->with("drive",$drive);
    }

    public function edit($id)
    {
        $drive=drives::find($id);
        return view('drives.edit')->with("drive",$drive);
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
        return redirect()->route('drive.index')->with("done","updated file done");
    }

    public function destroy($id)
    {
        $drive=drives::find($id);
        $oldfile=$drive->file;
        $filePathName=public_path()."/drives/". $oldfile;
        unlink($filePathName);
        $drive->delete();
        return redirect()->route('drive.index')->with("done","deleted file done");
    }

    public function download($id)
    {
        $drive=drives::find($id);
        $drive_name=$drive->file;
        $filePathName=public_path()."/drives/".$drive_name;
        return response()->download($filePathName);
    }
}

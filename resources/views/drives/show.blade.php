@extends('layouts.app')




@section("content")
<h1 class="text-center text-info">The File</h1>
<div class="container col-6">
    <div class="card">
        <div class="card-body">
         <table class="table table-dark">
            <tr>
                <th>Tittle</th>
                <th>description</th>
                <th>file name</th>
                <th>file img</th>
                <th>Action</th>
              </tr>
              <tr>
                <td>{{$drive->tittle}}</td>
                <td>{{$drive->description}}</td>
                <td>{{$drive->file}}</td>
                <td><img src="{{asset("$drive->file")}}" alt=""></td>
                <td><a class="btn btn-info" href="{{route('drive.download',$drive->id)}}"><i class="fa-solid fa-download"></i></a></td>
              </tr>
         </table>
        </div>
    </div>
</div>
@endsection

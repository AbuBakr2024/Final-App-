@extends('layouts.app')




@section("content")
<h1 class="text-center text-info">Edit File</h1>
<div class="container col-6">
     {{-- find in in laravel ->larave-> displaying vlidation errors --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card">
        <div class="card-body">
            <form action="{{route('drive.update',$drive->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
           <label for="">File Title</label>
           <input class="form-control" value="{{$drive->tittle}}" name="tittle" type="text" >
            </div>
            <div class="form-group">
                <label for="">File description</label>
                <input class="form-control" value="{{$drive->description}}" name="description" type="text" >
                 </div>
                 <div class="form-group">
                    <label for="">Your Drive {{$drive->file}}</label>
                    <input class="form-control" name="inputfile" type="file" >
                     </div>
                     <button class="btn btn-warning">update</button>
            </form>
        </div>
    </div>
</div>





@endsection

@extends('layouts.app')




@section("content")
<h1 class="text-center text-info">Up Load File</h1>
<div class="container col-6">
    @if (Session::has("done"))
        <div class="alert alert-success text-center">
           {{Session::get("done")}}
        </div>


    @endif
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
            <form action="{{route('drive.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
           <label for="">File Title</label>
                                    {{-- value= if exit error in data donot delete old data --}}
           <input class="form-control" value="{{old('tittle')}}" name="tittle" type="text" >
            </div>
            <div class="form-group">
                <label for="">File description</label>
                <input class="form-control" value="{{old('discription')}}" name="description" type="text" >
                 </div>
                 <div class="form-group">
                    <label for="">Your Drive</label>
                    {{-- in file you cannot set value old --}}
                    <input class="form-control" name="inputfile" type="file" >
                     </div>
                     <button class="btn btn-info">send</button>
            </form>
        </div>
    </div>
</div>





@endsection

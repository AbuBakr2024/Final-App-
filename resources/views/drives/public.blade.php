@extends('layouts.app')




@section("content")
<h1 class="text-center text-info">public File</h1>
<div class="container col-6">
    @if (Session::has("done"))
        <div class="alert alert-success text-center">
           {{Session::get("done")}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
         <table class="table table-dark">
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>email</th>
                <th>Tittle</th>
                <th>discription</th>
                <th>file</th>
              </tr>
              @forelse ( $drive as $item)

              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->tittle}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->file}}</td>
              </tr>
              @empty
              <h1 class="text-center text-info">no piblic data</h1>
              @endforelse
         </table>
        </div>
    </div>
</div>





@endsection

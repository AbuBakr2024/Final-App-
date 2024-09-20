@extends('layouts.app')




@section("content")
<h1 class="text-center text-info">list of users</h1>
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
                <th>emali</th>
              </tr>
              @forelse ($user as $item)

              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
            </tr>
              @empty
              <h1 class="text-center text-info">not foud data</h1>
              @endforelse
         </table>
        </div>
    </div>
</div>





@endsection

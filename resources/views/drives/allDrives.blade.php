@extends('layouts.app')




@section("content")
<h1 class="text-center text-info">All Files</h1>
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
                <th>tittle</th>
                <th colspan="4">Action</th>
              </tr>
              @forelse ( $drive as $item)

              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->tittle}}</td>
                <td><a class="btn btn-info" href="{{route('drive.show',$item->id)}}"><i class="fa-solid fa-eye"></i></a></td>
                <td><a class="btn btn-info" href="{{route('drive.edit',$item->id)}}"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a class="btn btn-info" href="{{route('drive.destroy',$item->id)}}"><i class="fa-solid fa-trash-can"></i></a></td>
                <td>
                    <a class="btn btn-info" href="{{route('drive.status',$item->id)}}">
                        @if ($item->status =='public')
                        <i class="fa-solid fa-lock-open"></i>
                        @else
                        <i class="fa-solid fa-lock"></i>
                        @endif
                </a>
            </td>
              </tr>
              @empty
              <h1 class="text-center text-info">no files</h1>
              @endforelse
         </table>
        </div>
    </div>
</div>





@endsection

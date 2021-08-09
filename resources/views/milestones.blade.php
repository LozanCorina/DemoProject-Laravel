@extends('layouts.header')

@section('content')
@if ($errors->any())
        <div class="col-3 mx-auto my-2">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        </div>
            @endif
        @if($message=Session::get('success_message'))
            <div class="col-3 mx-auto my-2">
                <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{$message}}</strong>
                </div>
            </div>
            @endif
      <div class="container p-3">
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Project Id</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Due date</th>
            <th scope="col">Completed date</th>
            <th scope="col">Created at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mile as $p)
            <tr>
            <th scope="row">{{$p->id}}</th>
            <td>{{$p->project_id}}</td>
            <td>{{$p->name}}</td>
            <td>{{$p->description}}</td>
            <td>{{$p->due_date}}</td>
            <td>{{$p->completed_date}}</td>
            <td>{{$p->created_at}}</td>
            <td>
                <form method="POST" action="{{route('mile.destroy',$p->id)}}">
                @csrf
                <button type="submit" onclick="return confirm('Are you sure to delete this item?')" class="btn btn-outline-danger" data-original-title="Delete item" data-toggle="tooltip" style="width:112px;"> × Delete</button>
                </form>
            </td>
            <td>
                <form method="POST" action="{{route('update',['model'=>'Milestone'])}}">
                @csrf
                <input type="hidden"  name="id" value="{{$p->id}}">
                <button type="submit" class="btn btn-outline-success" data-original-title="Update item" data-toggle="tooltip" style="width:112px;"> ! Update</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
        </table>
        <a href="{{route('home')}}" type="button" class="btn btn-primary btn-block"> Back</a>
    </div>
@endsection

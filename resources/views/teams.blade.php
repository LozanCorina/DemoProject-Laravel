@extends('layouts.header')

@section('content')  
@if ($errors->any())
        <div class=" col-3 mx-auto my-2">
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
            <div class="col-3  mx-auto my-2">
                <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{$message}}</strong>
                </div>  
            </div>         
            @endif  
    <div class="container m-3 mx-auto ">
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Userame</th>
            <th scope="col">Full name</th>
            <th scope="col">Email</th>
            <th scope="col">Profile</th>          
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $p)
            <tr>
            <th scope="row">{{$p->id}}</th>
            <td>{{$p->username}}</td>
            <td>{{$p->full_name}}</td>
            <td>{{$p->email}}</td>
            <td>{{$p->profile}}</td>
            <td> 
                <form method="POST" action="{{route('team.destroy',$p->id)}}"> 
                @csrf                              
                <button type="submit" onclick="return confirm('Are you sure to delete this item?')" class="btn btn-outline-danger" data-original-title="Delete item" data-toggle="tooltip" style="width:112px;"> × Delete</button>
                </form>
            </td>
            <td> 
                <form method="POST" action="{{route('update',['model'=>'Team'])}}"> 
                @csrf   
                <input type="hidden"  name="id" value="{{$p->id}}">                           
                <button type="submit" class="btn btn-outline-success" data-original-title="Update item" data-toggle="tooltip" style="width:112px;"> ! Update</button>
                </form>
            </td>
            </tr>
            @endforeach   
        </tbody>
        </table>
        <a href="{{route('home')}}" type="button" class="btn btn-primary btn-block my-3"> Back</a>
    </div>
@endsection
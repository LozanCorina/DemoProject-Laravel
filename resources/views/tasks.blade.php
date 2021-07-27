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
            <div class="col-3  mx-auto my-2">
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
            <th scope="col">Asignee</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Project</th>
            <th scope="col">Milestone</th>
            <th scope="col">Is complete (Y/N)</th>
            <th scope="col">Date start</th>
            <th scope="col">Date End</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $p)
            <tr>
            <th scope="row">{{$p->id}}</th>
            <td>{{$p->asignee}}</td>
            <td>{{$p->name}}</td>
            <td>{{$p->description}}</td>
            <td>{{$p->project_id}}</td>
            <td>{{$p->milestone_id}}</td>
            <td>{{$p->is_complete_yn}}</td>
            <td>{{$p->start_date}}</td>
            <td>{{$p->end_date}}</td>
            <td> 
                <form method="POST" action="{{route('task.destroy',$p->id)}}"> 
                @csrf                              
                <button type="submit" onclick="return confirm('Are you sure to delete this item?')" class="btn btn-outline-danger" data-original-title="Delete item" data-toggle="tooltip" style="width:112px;"> × Delete</button>
                </form>
            </td>
            <td> 
                <form method="POST" action="{{route('update',['model'=>'Task'])}}"> 
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
@extends('layouts.headerMySql')

@section('content')
<section class="section-content my-3 ">
    <div class="d-flex justify-content-center ">
        <div class="row">
            <div class="card col-xl-12">
                <article class="card-body">
                <form id="f_p" method="POST" action="{{route('project.update')}}" >
                        @csrf
                        <input type="hidden" name="id" value="{{$d->id}}">
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" class="form-control" type="text" value="{{$d->name}}">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Description</label>
                        <input name="description" class="form-control" type="text" value="{{$d->description}}">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Project Lead</label>
                        <select name="project_lead" class="form-control" type="text" >
                            <option value="{{$d->project_lead}}" class="text-info" selected>{{$d->project_lead}}</option>
                            @foreach(\App\Models\Team::get(['id', 'username']) as $team)
                                <option value="{{$team->id}}" class="text-info">{{$team->username}}</option>
                            @endforeach
                        </select>
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Completed date</label>
                        @php
                            $date=date_format(date_create($d->completed_date),'Y-m-d');
                        @endphp
                        <input name="completed_date" class="form-control" type="date" value="{{$date}}">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" type="text" >
                            <option value="{{$d->status}}" class="text-info" selected>{{$d->status}}</option>
                            <option value="Completed" class="text-info">Completed</option>
                            <option value="Assigned" class="text-info">Assigned</option>
                            <option value=" In-Progress" class="text-info"> In-Progress</option>
                        </select>
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block my-1"> Update  </button>
            </div> <!-- form-group// -->
        </form>
                </article> <!--card body-->
            </div> <!--end card-->
        </div> <!--end row-->
    </div> <!--container-->
</section>
@endsection

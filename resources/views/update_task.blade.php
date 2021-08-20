@extends('layouts.headerMySql')

@section('content')
<section class="section-content my-3 ">
    <div class="d-flex justify-content-center ">
        <div class="row">
            <div class="card col-xl-12">
                <article class="card-body">
                <form id="f_ta" method="POST" action="{{route('update.task')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$d->id}}">
                <div class="form-group">
                    <label>Assignee </label>
                    <select name="assignee" class="form-control" type="text">
                    <option value="{{$d->assignee}}" class="text-info" selected>{{$d->assignee}}</option>
                    @foreach(\App\Models\Team::get(['id', 'username']) as $team)
                            <option value="{{$team->id}}" class="text-info">{{$team->username}}</option>
                        @endforeach
                    </select>
                </div> <!-- form-group// -->
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" class="form-control" type="text" value="{{$d->name}}">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" class="form-control" type="text" value="{{$d->description}}">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <label>Project</label>
                    <select name="project_id" class="form-control" type="text">
                    <option value="{{$d->project_id}}" class="text-info" selected>{{$d->project_id}}</option>
                @foreach(\App\Models\Project::get(['id', 'name']) as $p)
                            <option value="{{$p->id}}" class="text-info">{{$p->name}}</option>
                        @endforeach
                    </select>
                </div> <!-- form-group// -->
                <div class="form-group">
                    <label>Milestone</label>
                    <select name="milestone_id" class="form-control" type="text">
                    <option value="{{$d->milestone_id}}" class="text-info" selected>{{$d->milestone_id}}</option>
                @foreach(\App\Models\Milestone::get(['id', 'name']) as $p)
                            <option value="{{$p->id}}" class="text-info">{{$p->name}}</option>
                        @endforeach
                    </select>
                </div> <!-- form-group// -->
                <div class="form-group">
                    <label>Is complete</label>
                    <select name="is_complete_yn" class="form-control" type="text">
                    <option value="{{$d->is_complete_yn}}" class="text-info" selected>{{$d->is_complete_yn}}</option>
                        <option value="Y" class="text-info">YES</option>
                        <option value="N" class="text-info">NO</option>
                    </select>
                </div> <!-- form-group// -->
                <div class="form-group">
                    <label>Start date</label>
                        @php
                            $date=date_format(date_create($d->start_date),'Y-m-d');
                        @endphp
                    <input name="start_date" class="form-control" type="date" value="{{$date}}">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <label>End date</label>
                        @php
                            $date=date_format(date_create($d->end_date),'Y-m-d');
                        @endphp
                    <input name="end_date" class="form-control" type="date" value="{{$date}}">
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

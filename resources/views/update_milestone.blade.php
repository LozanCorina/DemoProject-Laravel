@extends('layouts.headerMySql')

@section('content')
<section class="section-content my-3 ">
    <div class="d-flex justify-content-center ">
        <div class="row">
            <div class="card col-xl-12">
                <article class="card-body">
                <form id="f_m" method="POST" action="{{route('update.mile')}}">
                @csrf
                <input type="hidden" name="id" value="{{$d->id}}">
                <div class="form-group">
                    <label>Project </label>
                    <select name="project_id" class="form-control" type="text">
                    <option value="{{$d->project_id}}" class="text-info">{{$d->project_id}}</option>
                    @foreach(\App\Models\Project::get(['id', 'name']) as $p)
                            <option value="{{$p->id}}" class="text-info">{{$p->name}}</option>
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
                    <label>Due date</label>
                        @php
                            $date=date_format(date_create($d->due_date),'Y-m-d');
                        @endphp
                    <input name="due_date" class="form-control" type="date" value="{{$date}}">
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

@extends('layouts.headerMySql')

@section('content')
<section class="section-content my-3 ">
    <div class="d-flex justify-content-center ">
        <div class="row">
            <div class="card col-xl-12">
                <article class="card-body">
                    <form id="f_t" method="POST" action="{{route('team.update')}}">
                            @csrf
                         <input type="hidden" name="id" value="{{$d->id}}">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" class="form-control" value="{{$d->username}}" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <label>Full name</label>
                            <input name="full_name" class="form-control" value="{{$d->full_name}}" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control" value="{{$d->email}}" type="email">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <label>Profile</label>
                            <input name="profile" class="form-control" value="{{$d->profile}}" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <label>Photo</label>
                                <input class="form-control" name="photo_filename" type="file" value="{{$d->photo_filename}}">
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

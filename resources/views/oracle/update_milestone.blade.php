@extends('layouts.headerOracle')

@section('content')
    <section class="section-content my-3 ">
        <div class="d-flex justify-content-center ">
            <div class="row">
                <div class="card col-xl-12">
                    <article class="card-body">
                        <form id="f_m" method="POST" action="{{route('data','Milestone')}}">
                            @csrf
                            @while(($d = oci_fetch_object($stid)) != false)
                            <input type="hidden" name="id" value="{{$d->ID}}">
                            <div class="form-group">
                                <label>Project </label>
                                <select name="project_id" class="form-control" type="text">
                                    <option value="{{$d->PROJECT_ID}}" class="text-info">{{$d->PROJECT_ID}}</option>
                                    @php
                                        $st = oci_parse($conn, 'SELECT id,name FROM demo_projects ');
                                        oci_execute($st);
                                    @endphp
                                    @while(($p = oci_fetch_object($st)) != false)
                                        <option value="{{$p->ID}}" class="text-info">{{$p->NAME}}</option>
                                    @endwhile
                                </select>
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" class="form-control" type="text" value="{{$d->NAME}}">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Description</label>
                                <input name="description" class="form-control" type="text" value="{{$d->DESCRIPTION}}">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Due date</label>
                                @php
                                    $date=date_format(date_create($d->DUE_DATE),'Y-m-d');
                                @endphp
                                <input name="due_date" class="form-control" type="date" value="{{$date}}">
                            </div> <!-- form-group// -->
                            @endwhile
                            @php
                                oci_free_statement($stid);
                                oci_close($conn);
                            @endphp
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

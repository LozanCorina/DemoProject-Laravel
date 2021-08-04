@extends('layouts.headerOracle')

@section('content')
    <section class="section-content my-3 ">
        <div class="d-flex justify-content-center ">
            <div class="row">
                <div class="card col-xl-12">
                    <article class="card-body">
                        <form id="f_p" method="POST" action="{{route('data','Project')}}" >
                            @csrf
                            @while(($d = oci_fetch_object($stid)) != false)
                            <input type="hidden" name="id" value="{{$d->ID}}">
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" class="form-control" type="text" value="{{$d->NAME}}">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Description</label>
                                <input name="description" class="form-control" type="text" value="{{$d->DESCRIPTION}}">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Project Lead</label>
                                <select name="project_lead" class="form-control" type="text" >
                                    <option value="{{$d->PROJECT_LEAD}}" class="text-info" selected>{{$d->PROJECT_LEAD}}</option>
                                    @php
                                        $st = oci_parse($conn, 'SELECT id, username FROM demo_team_members ');
                                        oci_execute($st);
                                    @endphp
                                    @while(($team = oci_fetch_object($st)) != false)
                                        <option value="{{$team->ID}}" class="text-info">{{$team->USERNAME}}</option>
                                    @endwhile
                                </select>
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Completed date</label>
                                @php
                                    $date=date_format(date_create($d->COMPLETED_DATE),'Y-m-d');
                                @endphp
                                <input name="completed_date" class="form-control" type="date" value="{{$date}}">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" type="text" >
                                    <option value="{{$d->STATUS}}" class="text-info" selected>{{$d->STATUS}}</option>
                                    <option value="Completed" class="text-info">Completed</option>
                                    <option value="Assigned" class="text-info">Assigned</option>
                                    <option value=" In-Progress" class="text-info"> In-Progress</option>
                                </select>
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

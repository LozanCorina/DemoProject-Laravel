@extends('layouts.headerOracle')

@section('content')
    <section class="section-content my-3 ">
        <div class="d-flex justify-content-center ">
            <div class="row">
                <div class="card col-xl-12">
                    <article class="card-body">
                        <form id="f_ta" method="POST" action="{{route('data','Task')}}">
                            @csrf
                            @while(($d = oci_fetch_object($stid)) != false)
                            <input type="hidden" name="id" value="{{$d->ID}}">
                            <div class="form-group">
                                <label>Assignee </label>
                                <select name="assignee" class="form-control" type="text">
                                    <option value="{{$d->ASSIGNEE}}" class="text-info" selected>{{$d->ASSIGNEE}}</option>
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
                                <label>Name</label>
                                <input name="name" class="form-control" type="text" value="{{$d->NAME}}">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Description</label>
                                <input name="description" class="form-control" type="text" value="{{$d->DESCRIPTION}}">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Project</label>
                                <select name="project_id" class="form-control" type="text">
                                    <option value="{{$d->PROJECT_ID}}" class="text-info" selected>{{$d->PROJECT_ID}}</option>
                                    @php
                                        $st = oci_parse($conn, 'SELECT id, name FROM demo_projects ');
                                        oci_execute($st);
                                    @endphp
                                    @while(($p = oci_fetch_object($st)) != false)
                                        <option value="{{$p->ID}}" class="text-info">{{$p->NAME}}</option>
                                    @endwhile
                                </select>
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Milestone</label>
                                <select name="milestone_id" class="form-control" type="text">
                                    <option value="{{$d->MILESTONE_ID}}" class="text-info" selected>{{$d->MILESTONE_ID}}</option>
                                    @php
                                        $st = oci_parse($conn, 'SELECT id, name FROM demo_milestones ');
                                        oci_execute($st);
                                    @endphp
                                    @while(($p = oci_fetch_object($st)) != false)
                                        <option value="{{$p->ID}}" class="text-info">{{$p->NAME}}</option>
                                    @endwhile
                                </select>
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Is complete</label>
                                <select name="is_complete_yn" class="form-control" type="text">
                                    <option value="{{$d->IS_COMPLETE_YN}}" class="text-info" selected>{{$d->IS_COMPLETE_YN}}</option>
                                    <option value="Y" class="text-info">YES</option>
                                    <option value="N" class="text-info">NO</option>
                                </select>
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Start date</label>
                                @php
                                    $date=date_format(date_create($d->START_DATE),'Y-m-d');
                                @endphp
                                <input name="start_date" class="form-control" type="date" value="{{$date}}">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>End date</label>
                                @php
                                    $date=date_format(date_create($d->END_DATE),'Y-m-d');
                                @endphp
                                <input name="end_date" class="form-control" type="date" value="{{$date}}">
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

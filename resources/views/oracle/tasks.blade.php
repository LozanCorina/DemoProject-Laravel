@extends('layouts.headerOracle')

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
            @while(($p = oci_fetch_object($stid)) != false)
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>{{$p->NAME}}</td>
                    <td>{{$p->DESCRIPTION}}</td>
                    <td></td>
                    <td></td>
                    <td>{{$p->IS_COMPLETE_YN}}</td>
                    <td>{{$p->START_DATE}}</td>
                    <td>{{$p->END_DATE}}</td>
                    <td>
                        <form method="POST" action="{{route('task.o.destroy',$p->ID)}}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger" data-original-title="Delete item" data-toggle="tooltip" style="width:112px;"> × Delete</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{route('update_data','Task')}}">
                            @csrf
                            <input type="hidden"  name="id" value="{{$p->ID}}">
                            <button type="submit" class="btn btn-outline-success" data-original-title="Update item" data-toggle="tooltip" style="width:112px;"> ! Update</button>
                        </form>
                    </td>
                </tr>
            @endwhile
            @php
                oci_free_statement($stid);
                oci_close($conn);
            @endphp
            </tbody>
        </table>
        <a href="{{route('home')}}" type="button" class="btn btn-primary btn-block my-3"> Back</a>
    </div>
@endsection

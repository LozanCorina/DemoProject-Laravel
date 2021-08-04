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
        <div class="col-3 mx-auto my-2">
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{$message}}</strong>
            </div>
        </div>
    @endif
    <section class="section-content my-3 ">
        <div class="d-flex justify-content-center ">
            <div class="row">
                <div class="card col-xl-12">
                    <table class="table">
                        <thead>
                            <tr>
                                @php
                                for ($i = 1; $i <= $ncols; $i++) {
                                    $column_name  = oci_field_name($stid, $i);
                                    echo "<td>$column_name</td>";
                                    }
                                @endphp
                            </tr>
                        </thead>
                        <tbody>
                        @while(($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)))
                            <tr>
                                @foreach($row as $item)
                                   <td> {{$item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;"}}</td>
                                @endforeach
                                </tr>
                        @endwhile
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

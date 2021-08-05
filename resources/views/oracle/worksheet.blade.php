@extends('layouts.headerOracle')

@section('content')
    <script>
        function myF() {
            document.getElementById("code").innerHTML = "";
        }
    </script>
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
                <div class="card col-xl-10 col-sm-6 mx-auto">
                        <form action="{{route('worksheet')}}" method="post">
                        <div class="form-group my-1">
                            <button type="submit" class="btn btn-primary btn-block float-right">Run  </button>
                                <button type="button" onclick="myF()" class="btn btn-primary btn-block float-right">Erase </button>
                            </div> <!-- form-group// -->
                           @csrf
                        <div class="form-group my-1">
                            <label>Worksheet</label>
                            <textarea id="code" name="code" class="form-control"  rows="8" cols="150" type="text">{{$data}}</textarea>
                        </div> <!-- form-group// -->
                        </form>
                </div>
                <div class="card col-xl-10 my-1 mx-auto">
                    <div class="table-responsive">
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
                        @if($num_rows > 0)
                            <tr><td>{{$num_rows}} row have been executed</td></tr>
                        @endif
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

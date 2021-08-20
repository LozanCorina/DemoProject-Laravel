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
    <?php
    $conn = oci_connect(session('username'),session('password'),session('conn_string'));
    $stid = oci_parse($conn, 'SELECT table_name FROM USER_TABLES');
    oci_execute($stid);
    ?>
    <div class="container my-2">
        <div class="row justify-content-center">
            <div class="container mx-auto">
                <h2 align="center">Export Oracle Table Data to CSV/Oracle file</h2>
                <br />
                <form method="post" align="center">
                    @csrf
                    <div class="form-group">
                        <label>Select table for export </label>
                        <select name="table" class="form-control" type="text">
                            <option value="-" class="text-info">-</option>
                            @while(($p = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)))
                                @foreach($p as $item)
                                <option value="{{($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;")}}" class="text-info">{{($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;")}}</option>
                                @endforeach
                            @endwhile
                        </select>
                    </div> <!-- form-group// -->
                    <div class="form-group my-1">
                        <input type="submit" name="export" value="CSV Export" formaction="{{route('exportcsv.oracle.action')}}" class="btn btn-success" />
                        <input type="submit" name="export" value="Oracle Export" formaction="" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>
    </div>






@endsection

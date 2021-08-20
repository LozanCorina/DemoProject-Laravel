@extends('layouts.headerMySql')
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
        $data= DB::select(DB::raw('SHOW TABLES'));
    ?>
    <div class="container my-2">
        <div class="row justify-content-center">
            <div class="container mx-auto">
                <h2 align="center">Export MySql Table Data to CSV/SQL file</h2>
                <br />
                <form method="post" align="center">
                    @csrf
                    <div class="form-group">
                        <label>Select table for export </label>
                        <select name="table" class="form-control" type="text">
                            <option value="-" class="text-info">-</option>
                            @foreach ($data as $d)
                                @foreach ($d as $item)
                                    <option value="{{$item}}" class="text-info">{{$item}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div> <!-- form-group// -->
                    <div class="form-group my-1">
                        <input type="submit" name="export" value="CSV Export" formaction="{{route('exportcsv.mysql.action')}}"  class="btn btn-success" />
                        <input type="submit" name="export" value="SQL Export" formaction="{{route('export_sql.action')}}" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

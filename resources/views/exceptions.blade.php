@extends('layouts.headerMySql')
@section('content')
    @if($message=Session::get('error'))
        <div class="col-3 mx-auto my-5">
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{$message}}</strong>
            </div>
        </div>
    @endif
@endsection

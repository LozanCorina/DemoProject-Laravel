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
                    <table class="table table-striped">
                        <tbody>
                            <label>Result</label>
                            @while(($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)))
                                <textarea name="result" class="form-control"  rows="4" cols="50" type="text">
                                    @foreach($row as $item)
                                        {{$item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;"}}
                                    @endforeach
                                </textarea>
                            @endwhile
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

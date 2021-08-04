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
                    <article class="card-body">
                        <form action="{{route('worksheet.code')}}" method="post">
                           @csrf
                        <div class="form-group">
                            <label>Worksheet</label>
                            <textarea name="code" class="form-control"  rows="4" cols="50" type="text"></textarea>
                        </div> <!-- form-group// -->
                            <div class="form-group my-1">
                                <button type="submit" class="btn btn-primary btn-block">Run  </button>
                            </div> <!-- form-group// -->
                        </form>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection

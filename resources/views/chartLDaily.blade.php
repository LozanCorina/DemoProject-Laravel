@extends('layouts.headerMySql')
@section('javascript')
{!! $chart->renderChartJsLibrary() !!}
{!! $chart->renderJs() !!}
@endsection
@section('content')
<div class="container my-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chart</div>

                <div class="card-body">

                    <h1>{{ $chart->options['chart_title'] }}</h1>
                    {!! $chart->renderHtml() !!}

                </div>
            </div>
        </div>
        <div class="container p-3">
        <table class="table table-striped">
            <h2 clas="title"> My Outstading Tasks</h2>
            <thead>
                <tr>
                <th scope="col">Project</th>
                <th scope="col">Task</th>
                <th scope="col">End Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prj as $p)
                <tr>
                    <td>{{$p->name}}</td>
                    <td>
                    <ul>
                    @foreach(\App\Models\Task::where('project_id',$p->id)->get() as $n)
                        <li> {{$n->name}}</li>
                    @endforeach
                    </ul>
                    </td>
                    <td>
                        <ul>
                        @foreach(\App\Models\Task::where('project_id',$p->id)->get() as $n)
                        <li> {{$n->end_date}}</li>
                        @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
@endsection




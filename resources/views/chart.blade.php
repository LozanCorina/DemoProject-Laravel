@extends('layouts.header')
@section('content')
<!-- Chart's container -->
<div class="container my-2">
    <div class="row justify-content-center">
        <div id="chart" style="height: 300px;" class="col-10">
        </div>
    </div>
</div>
 <!-- Charting library -->
<script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <script>
      const chart = new Chartisan({
        el: '#chart',
        url: "@chart('sample_chart')",
        hooks: new ChartisanHooks()
        .colors(['#FFE666', '#150080','#E62600'])
        .responsive()
        .beginAtZero()
        .legend({ position: 'right' ,              
                font:  {size: 24}
                }),
        options: {
            indexAxis: 'y',
            elements: {
                bar: {
                    borderWidth: 2,
                }   
            }
            
        },
        responsive: true,
        scales: {
            x: {
                stacked: true,
            },
            y: {
                stacked: true
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Projects Task'
            }
        }

    });
</script>

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
@endsection
@extends('layouts.header')
@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <div class="container my-2">
        <div class="row justify-content-center">
            <canvas id="chart" style="height: 300px;" class="col-10">
            </canvas>
        </div>
    </div>
			<script>
				var ctx = document.getElementById("chart").getContext('2d');
    			var myChart = new Chart(ctx, {
        		type: 'bar',
		        data: {
		            labels: ["Configure APEX Environment","Train Developers on Application Express"],
                    //labels: [{{$projects}}],
                    datasets: 
		            [{
		                label: 'Completed',
		                data: [{{$data1}}],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(255,99,132)',
		                borderWidth: 3
		            },

		            {
		            	label: 'Incompleted',
		                data: [{{$data2}}],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(0,255,255)',
		                borderWidth: 3	
		            }]
		        },                   
		        options: {
		            scales: {scales:{yAxes: [{beginAtZero: true}], xAxes: [{beginAtZero: true, maxTicketsLimit: 20, stacked: true}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'right', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}},
                    title: {
                        display: true,
                        text: 'Projects Task',
                        position:'top',
                        fontSize: 24,
                        color:'rgba(0,255,255)',
                    },
                }
		    });
			</script>


<div class="container p-1">
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
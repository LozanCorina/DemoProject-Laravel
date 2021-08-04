@extends('layouts.headerOracle')
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
                labels: ["Configure APEX Environment","Develop Partner Portal POC","Develop Production Partner Portal", "Migrate .Net Applications","Train Developers on Application Express"],
                datasets:
                    [{
                        label: 'Completed',
                        data:  [<?php echo $data1; ?>],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(255,99,132)',
                        borderWidth: 3
                    },

                        {
                            label: 'Incompleted',
                            data:  [<?php echo $data2; ?>],
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
            @while(($p = oci_fetch_object($name)) != false)
                <tr>
                    <td>{{$p->NAME}}</td>
                    <td>
                        <ul>
                            @php
                                $st = oci_parse($conn, 'SELECT name FROM demo_tasks ');
                                oci_execute($st);
                            @endphp
                            @while(($n = oci_fetch_object($st)) != false)
                                <li> {{$n->NAME}}</li>
                            @endwhile
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @php
                                $st = oci_parse($conn, 'SELECT end_date FROM demo_tasks ');
                                oci_execute($st);
                            @endphp
                            @while(($n = oci_fetch_object($st)) != false)
                                <li> {{$n->END_DATE}}</li>
                            @endwhile
                        </ul>
                    </td>
                </tr>
            @endwhile
            @php
                oci_free_statement($name);
                oci_close($conn);
            @endphp
            </tbody>
        </table>
    </div>
@endsection

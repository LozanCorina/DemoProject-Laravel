@extends('layouts.headerMySql')

@section('content')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
      $(document).ready(function() {

            $('#tables').change(function(){
                var option = $('#tables option:selected').val();
                if(option =="Projects")	{
                $("#f_m").attr("style", "display:none");
                $("#f_ta").attr("style", "display:none");
                $('#f_t').attr("style", "display:none");
                $("#f_p").attr("style", "display:block");
                }
                else if(option =='Team')
                    {$("#f_m").attr("style", "display:none");
                    $("#f_ta").attr("style", "display:none");
                    $("#f_p").attr("style", "display:none");
                    $('#f_t').attr("style", "display:block");
                }
                else if(option =='Milestones')
                    { $("#f_t").attr("style", "display:none");
                    $("#f_ta").attr("style", "display:none");
                    $("#f_p").attr("style", "display:none");
                    $('#f_m').attr("style", "display:block");
                }
                else if(option =='Tasks')
                {   $("#f_m").attr("style", "display:none");
                    $("#f_t").attr("style", "display:none");
                    $("#f_p").attr("style", "display:none");
                    $('#f_ta').attr("style", "display:block");
                }
                else{
                    $("#f_m").attr("style", "display:none");
                    $("#f_t").attr("style", "display:none");
                    $("#f_p").attr("style", "display:none");
                    $('#f_ta').attr("style", "display:none");

                }

            });

        });
    </script>
    <script>
        //   open forms
        function create(){
            document.getElementById('f_table').style.display = "none";
            document.getElementById('f_c').style.display = "block";
        }
        function deletee(){
            document.getElementById('f_c').style.display = "none";
            document.getElementById('f_table').style.display = "block";
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
    <div class="card col-xl-12">
        <article class="card-body">
            <div class="float-right">
                <button  onclick="create()" class="btn btn-outline-primary">C</button>
                <button  class="btn btn-outline-primary">R</button>
                <button onclick="update()" class="btn btn-outline-primary">U</button>
                <button onclick="deletee()" class="btn btn-outline-primary">D</button>
            </div>
            <div id="f_c" style="display:none;">
                <div class="form-group">
                    <label>Table</label>
                    <select id="tables" name="tables" class="form-control" type="text">
                        <option class="text-info" value="">select</option>
                        <option class="text-info" value="Projects">Projects</option>
                        <option class="text-info" value="Tasks">Tasks</option>
                        <option class="text-info" value="Milestones">Milestones</option>
                        <option class="text-info" value="Team">Team members</option>
                    </select>
                </div> <!-- form-group// -->
            </div>

            <div id="f_table" style="display:none;">
                <div class="form-group">
                    <label>Select tables</label>
                    <ul class="list-unstyled">
                       <li> <a class="text-info"  href="{{route('projects')}}" >Projects</a></li>
                        <li> <a class="text-info" href="{{route('tasks')}}">Tasks</a></li>
                        <li> <a class="text-info" href="{{route('milestones')}}">Milestones</a></li>
                        <li> <a class="text-info" href="{{route('team')}}">Team members</a></li>
                    </ul>
                </div> <!-- form-group// -->
            </div>
            <form id="f_t" method="POST" action="{{route('store.team')}}" style="display:none;">
                @csrf
            <div class="form-group">
                <label>Username</label>
                <input name="username" class="form-control" type="text">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Full name</label>
                <input name="full_name" class="form-control" type="text">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Email</label>
                <input name="email" class="form-control" type="email">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Profile</label>
                <input name="profile" class="form-control" type="text">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Photo</label>
                    <input class="form-control" name="photo_filename"type="file" id="formFile">
            </div> <!-- form-group// -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block my-1"> Add  </button>
            </div> <!-- form-group// -->
        </form>
        <!-- add-project -->
        <form id="f_p" method="POST" action="{{route('store.project')}}" style="display:none;">
                @csrf
            <div class="form-group">
                <label>Name</label>
                <input name="name" class="form-control" type="text">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Description</label>
                <input name="description" class="form-control" type="text">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Project Lead</label>
                <select name="project_lead" class="form-control" type="text">
                    @foreach(\App\Models\Team::get(['id', 'username']) as $team)
                        <option value="{{$team->id}}" class="text-info">{{$team->username}}</option>
                    @endforeach
                </select>
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Completed date</label>
                <input name="completed_date" class="form-control" type="date">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" type="text">
                    <option value="Completed" class="text-info">Completed</option>
                    <option value="Assigned" class="text-info">Assigned</option>
                    <option value=" In-Progress" class="text-info"> In-Progress</option>
                </select>
            </div> <!-- form-group// -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block my-1"> Add  </button>
            </div> <!-- form-group// -->
        </form>
        <!-- add milestones  -->
        <form id="f_m" method="POST" action="{{route('store.milestone')}}" style="display:none;">
                @csrf
            <div class="form-group">
                <label>Project </label>
                <select name="project_id" class="form-control" type="text">
                @foreach(\App\Models\Project::get(['id', 'name']) as $p)
                        <option value="{{$p->id}}" class="text-info">{{$p->name}}</option>
                    @endforeach
                </select>
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Name</label>
                <input name="name" class="form-control" type="text">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Description</label>
                <input name="description" class="form-control" type="text">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Due date</label>
                <input name="due_date" class="form-control" type="date">
            </div> <!-- form-group// -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block my-1"> Add  </button>
            </div> <!-- form-group// -->
        </form>
        <!-- end milestones -->
        <!-- add tasks -->
        <form id="f_ta" method="POST" action="{{route('store.task')}}" style="display:none;">
                @csrf
            <div class="form-group">
                <label>Assignee </label>
                <select name="assignee" class="form-control" type="text">
                @foreach(\App\Models\Team::get(['id', 'username']) as $team)
                        <option value="{{$team->id}}" class="text-info">{{$team->username}}</option>
                    @endforeach
                </select>
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Name</label>
                <input name="name" class="form-control" type="text">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Description</label>
                <input name="description" class="form-control" type="text">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Project</label>
                <select name="project_id" class="form-control" type="text">
            @foreach(\App\Models\Project::get(['id', 'name']) as $p)
                        <option value="{{$p->id}}" class="text-info">{{$p->name}}</option>
                    @endforeach
                </select>
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Milestone</label>
                <select name="milestone_id" class="form-control" type="text">
            @foreach(\App\Models\Milestone::get(['id', 'name']) as $p)
                        <option value="{{$p->id}}" class="text-info">{{$p->name}}</option>
                    @endforeach
                </select>
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Is complete</label>
                <select name="is_complete_yn" class="form-control" type="text">
                    <option value="Y" class="text-info">YES</option>
                    <option value="N" class="text-info">NO</option>
                </select>
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>Start date</label>
                <input name="start_date" class="form-control" type="date">
            </div> <!-- form-group// -->
            <div class="form-group">
                <label>End date</label>
                <input name="end_date" class="form-control" type="date">
            </div> <!-- form-group// -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block my-1"> Add  </button>
            </div> <!-- form-group// -->
        </form>
        <!-- end tasks  -->
        </article> <!--card body-->
    </div> <!--end row-->
    </div> <!--container-->
</section>

@endsection

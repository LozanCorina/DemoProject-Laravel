@extends('layouts.main')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(function(){
            $('#conn_type').change(function(){
                var option = $('#conn_type option:selected').val();
                if(option == "wallet")
                {
                    $('#basic').attr("style", "display:none");
                    $("#wallet").attr("style", "display:block");
                }
                else {
                    $('#wallet').attr("style", "display:none");
                    $("#basic").attr("style", "display:block");
                }
            });

            $('#db_type').change(function(){
                var option = $('#db_type option:selected').val();
                if(option == "oracle")
                {
                    $('#oracle').attr("style", "display:block");
                    $("#mysql").attr("style", "display:none");
                }
                else {
                    $('#oracle').attr("style", "display:none");
                    $("#mysql").attr("style", "display:block");
                }

            });
        });
    </script>
    <script>
        //readonly labels
        function Open() {
            document.getElementById('service_name').readOnly = false;
            document.getElementById('sid_t').readOnly = true;
        }
        function Open1()
        {
            document.getElementById('sid_t').readOnly = false;
            document.getElementById('service_name').readOnly = true;
        }
    </script>

    @if ($errors->any())
        <div class=" col-3 mx-auto my-2">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="container my-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
        <article class="card-body">
            <h4 class="card-title text-center mb-4 mt-1">Connect to DataBase</h4>
            <hr>
            <p class="text-success text-center">Set your credentials for DB</p>
            <div class="form-group">
                <label>Type</label>
                <select id="db_type" type="select">
                    <option class="text-info" name="oracle" value="oracle">Oracle</option>
                    <option class="text-info" name="mysql" value="mysql">MySql</option>
                </select>
            </div> <!-- form-group// -->
            <form id="mysql" action="{{route('set.conn')}}"method="post" style="display:none;">
                @csrf
                <input type="hidden" name="db_type" value="mysql">
                <div class="form-group alert  my-1 alert-info">
                    <label>User Info</label>
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username" class="form-control" placeholder="Username" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="password" class="form-control" placeholder="******" type="password">
                        </div> <!-- input-group.// -->
                    </div> <!-- form-group// -->
                </div> <!-- form-user// -->
                <div class="form-group alert  my-1 alert-success">
                    <label>Connection data</label>
                    <div class="form-group">
                        <label>Server</label>
                        <input name="server" class="form-control" placeholder="localhost" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Port</label>
                        <input name="port" class="form-control" placeholder="3307" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Database</label>
                        <input name="db" class="form-control" placeholder="" type="text">
                    </div> <!-- form-group// -->
                </div> <!-- form-conn// -->
                <div class="form-group my-1">
                    <button type="submit" class="btn btn-primary btn-block"> Connect </button>
                </div> <!-- form-group// -->
            </form>
            <form id="oracle" method="post" action="{{route('set.conn')}}" style="display:block;">
                @csrf
                <input type="hidden" name="db_type" value="oracle">
                <div class="form-group alert  my-1 alert-info">
                    <label>User Info</label>
            <div class="form-group">
                    <label>Username</label>
                    <input name="username" class="form-control" placeholder="Username" type="text">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <label>Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name="password" class="form-control" placeholder="******" type="password">
                </div> <!-- input-group.// -->
                </div> <!-- form-group// -->
            </div> <!-- form-user// -->
            <div class="form-group alert  my-1 alert-success">
                <label>Connection Type</label>
                <select name="conn_type" id="conn_type" type="select">
                    <option name="wallet" value="wallet">Cloud Wallet</option>
                    <option name="basic" value="basic">Basic</option>
                </select>
                <div id="wallet" style="display:block;">
                    <div class="form-group">
                        <label for="formFile" class="form-label mt-4">Configuration File</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <div class="form-group">
                        <label>Host</label>
                        <input name="host1" class="form-control" placeholder="host" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Service</label>
                        <input name="service_name1" class="form-control" placeholder="Service name" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Port</label>
                        <input name="port1" class="form-control" placeholder="1521" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Wallet Path</label>
                        <input name="wallet" class="form-control" placeholder="C:/instantclient_19_11/network/admin" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Retry delay</label>
                        <input name="delay" class="form-control" min="1" max="3" placeholder="0" type="number">
                    </div> <!-- form-group// -->
                </div>
                <div id="basic" style="display:none;">
                    <div class="form-group">
                        <label>Hostname</label>
                        <input name="host" class="form-control" placeholder="localhost" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Port</label>
                        <input name="port" class="form-control" placeholder="1521" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group my-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  type="radio" name="typecheck" id="sid1" value="sid" onclick="Open()" checked >
                            <label class="form-check-label" for="sid1">
                                SID
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="typecheck" id="ser2"   onclick="Open1()" value="service">
                            <label class="form-check-label" for="ser2">
                                Service Name
                            </label>
                        </div>
                    </div>
                    <div class="form-group my-1">
                        <input name="sid" class="form-control" id="sid_t" placeholder="xe" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group my-1">
                        <input name="service_name2" class="form-control" id="serice_name" placeholder="" type="text">
                    </div> <!-- form-group// -->
                </div>
            </div> <!-- form-conn// -->
            <div class="form-group my-1">
                <button type="submit" class="btn btn-primary btn-block"> Connect </button>
            </div> <!-- form-group// -->
            </form>
        </article>
        </div> <!-- card.// -->
        </div>
    </div>
</div>
@endsection

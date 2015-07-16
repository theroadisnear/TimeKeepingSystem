<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Time Keeping System</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="/bootstrap/js/moment.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0">
                <div class="navbar-header">
                    <a href="#navCollapse" data-toggle="collapse"><h2>UP ITDC</h2></a>
                </div>
                <ul class="nav navbar-nav">
                </ul>
                {!!Form::open(array('action' => 'AttendanceController@show', 'class' => 'collapse navbar-form navbar-right', 'id' => 'navCollapse'))!!}
                    <div class="form-group">
                            <div class="col-md-3">
                                {!! Form::text('username', null, ['class'=>'form-control', 'placeholder' => 'username']) !!}
                            </div>
                            <!--@if ($errors->has('usernumber'))
                                <h5 class="col-md-3 text text-danger">
                                    {{$errors->first('usernumber')}}
                                </h5>
                            @endif-->
                    </div>
                    <div class="form-group">
                            <div class="col-md-3">
                                {!! Form::text('username', null, ['class'=>'form-control', 'placeholder' => 'password']) !!}
                            </div>
                            <!--@if ($errors->has('usernumber'))
                                <h5 class="col-md-3 text text-danger">
                                    {{$errors->first('usernumber')}}
                                </h5>
                            @endif-->
                    </div>
                    {!!Form::submit('Log In', ['class'=>'btn btn-primary'])!!}
                {!!Form::close()!!}
            </nav>
            <div class="">
                
                @yield('content')
            </div>
        </div>
    </body>
</html>

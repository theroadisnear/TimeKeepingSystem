@extends('attendance_layout')

@section('content')
<meta http-equiv="refresh" content="5;url=/attendance/index"/>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<img class="img-responsive img-circle" src="{{$image->idpicture}}">
		</div>
		<div class="col-md-6 col-md-offset-4">
			<h1>ID No. {{$user->usernumber}}</h1>
			<h1>{{$user->lastname}}, {{$user->firstname}}</h1>
		</div>
	</div>
</div>
@stop

@extends('attendance_layout')

@section('content')
<link rel="stylesheet" href="/FlipClock-master/compiled/flipclock.css">

<script src="/FlipClock-master/compiled/flipclock.js"></script>

<script type="text/javascript">
			var clock;
			
			$(document).ready(function() {
				clock = $('.clock').FlipClock({
					clockFace: 'TwelveHourClock'
				});
			});
</script>

<div class="container" >
	<!--<div>
		<button class="btn btn-primary" data-toggle="collapse" href="#startAttendance" aria-expanded="false" 
		aria-controls="startAttendance" onclick=display_ct();>Start</button>
			{!!Form::open(array('action' => 'AttendanceController@stop', 'class' => 'form-horizontal'))!!}
			{!!Form::submit('Stop', ['class' => 'btn btn-danger'])!!}
			{!!Form::close()!!}
		<span id='ct' ></span>
	</div>-->
	<div class="col-md-6 col-md-offset-3">
		<div class="clock" style="margin:2em;"></div>
	</div>
	<div class="col-md-6 col-md-offset-4">
		{!!Form::open(array('action' => 'AttendanceController@show', 'class' => 'form-horizontal'))!!}
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						{!! Form::text('usernumber', null, ['class'=>'form-control', 'placeholder'=>'ID Number']) !!}
					</div>
					{!!Form::submit('Submit', ['class'=>'btn btn-primary'])!!}
				</div>
				@if ($errors->has('usernumber'))
						<h5 class="col-md-6 text text-danger">
							{{$errors->first('usernumber')}}
						</h5>
				@endif
			</div>
		{!!Form::close()!!}
	</div>
	
</div>


@stop
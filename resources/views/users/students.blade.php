@extends('layout')

@section('content')
<div class="container">
	<div>
		<h2>Users Index</h2>
		<table class="table table-hover table-condensed table-responsive">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Middle Initial</th>
					<th>Birthday</th>
					<th>Department</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>	
			<tbody>
				@foreach($users as $user)
					<tr>	
						<th>{{$user->usernumber}}</th>
						<th>{{$user->lastname}}</th>
						<th>{{$user->firstname}}</th>
						<th>{{$user->middleinitial}}</th>
						<th>{{$user->birthday}}</th>
						<th>{{$user->department}}</th>
						<th><a href="{{action('UsersController@edit', [$user->id, $user->usernumber])}}">
							<button class="btn btn-info" type="button">Go</button>
						</a></th>
						<th>
							<button class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm">
								Delete
							</button>
						</th>
					</tr>
				@endforeach
			</tbody>
		</table>
		<a href="{{action('UsersController@create')}}">
			<button type="button" class="btn btn-primary" type="button">Create</button>
		</a>
	</div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="confirmDelete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-title">Delete Confirmation</h4>
			</div>
			<div class="modal-body">
				<div class="container">
				Are you sure to delete this user?<br>
			ID Number: {{$user->usernumber}}<br>
			Name: {{$user->lastname}}, {{$user->firstname}}
				</div>
			</div>
			<div class="modal-footer">
				{!!Form::open(array('action' => array('UsersController@delete', $user->id)))!!}
				{!!Form::hidden('id', $user->id)!!}
				{!!Form::submit('Yes',['class'=>'btn btn-primary'])!!}
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
@stop
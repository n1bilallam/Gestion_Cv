@extends('layouts.app')

@section('content')

<div class="container">
		<div class="row ">
			<div class="row ">
				<div class="col-md-12" style="padding-top: 10px;">
				<h2>la liste des utilisateurs</h2>
				<div class="float-right">
					<a class="btn btn-success" href="{{url('users/create')}}">Noveau User</a>
				</div>
				
				</div>
			<div class="col-md-12" style="padding-top: 10px;">
				<table class="table table-striped">
				  <thead>
				    <tr>
				      <th scope="col">Id</th>
				      <th scope="col">Name</th>
				      <th scope="col">Email</th>
				      <th scope="col">Permession</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($users as $user)
				    <tr>
				      <th scope="row">{{ $user->id }}</th>
				      <td>{{ $user->name }}</td>
				      <td>{{ $user->email }}</td>
				      <td>{{ $user->is_admin}}</td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>
			</div>
		</div>
</div>

@endsection
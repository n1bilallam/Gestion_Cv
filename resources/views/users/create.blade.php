@extends('layouts.app')

@section('content')

@if(count($errors))

<div class="alert alert-danger alert-dismissible fade show" role="alert">
	
  <strong>{{Auth::user()->name}} !</strong> 
 	
  <ul>
  	@foreach($errors->all() as $message)
  	<li>{{ $message }}</li>
  	@endforeach
  </ul>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@endif

<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<form action="{{ url('users') }} " method="post" >
				{{ csrf_field() }}
				{{ method_field('GET') }}
				<div class="form-group ">
					<label>Name</label>
					<input type="text" name="name" class="form-control @if($errors->get('titre')) is-invalid @endif" value="{{old('name')}} ">
					
				</div>

				<div class="form-group ">
					<label>Email</label>
					<input  type="text" name="email" class="form-control @if($errors->get('article')) is-invalid @endif " value="{{old('email')}}"> 
					
				</div>

				<div class="form-group ">
					<label>Mot de passe</label>
					<input name="password"  class="form-control" type="text" >
					
				</div>


				

				<div class="form-group ">
					<label>Permession </label>
					<input name="permession"  class="form-control" type="text" >
					
				</div>

				<div class="form-group">
					
					<input type="submit"  class="form-control btn btn-success" value="Enregistre">
					
				</div>


				
			</form>
		</div>	
	</div>
	
</div>


@endsection
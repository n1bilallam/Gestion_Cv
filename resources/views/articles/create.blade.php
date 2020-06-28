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
			<form action="{{ url('articles') }} " method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group ">
					<label>Titre d'article</label>
					<input type="text" name="titre" class="form-control @if($errors->get('titre')) is-invalid @endif" value="{{old('titre')}} ">
					
				</div>

				<div class="form-group ">
					<label>Article</label>
					<textarea  type="text" name="article" class="form-control @if($errors->get('article')) is-invalid @endif ">{{old('article')}}</textarea> 
					
				</div>

				<div class="form-group ">
					<label>Image</label>
					<input name="image"  class="form-control" type="file" >
					
				</div>


				

				<div class="form-group">
					
					<input type="submit"  class="form-control btn btn-success" value="Enregistre">
					
				</div>


				
			</form>
		</div>	
	</div>
	
</div>


@endsection
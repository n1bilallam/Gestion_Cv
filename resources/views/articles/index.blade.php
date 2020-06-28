@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row ">
			
			<div class="row ">
				<div class="col-md-12" style="padding-top: 10px;">
				<h2>la liste de mes articles</h2>
				<div class="float-right">
					<a class="btn btn-success" href="{{url('articles/create')}}">Noveau Article</a>
				</div>
				
			</div>
			<div class="col-md-12" style="padding-top: 10px;">
			</div>
				<div class="row equal-height">
				@foreach($articles as $article)
				<div class = "col-sm-4 col-md-6 col-lg-4">
				      <div class = "thumbnail card border-success mb-3 ">
				         <img style="height: 200px; width: 100%; display: block;" src = "{{ URL::to('/') }}/images/{{ $article->image }}" alt = "{{ $article->titre }}" class="img-thumbnail img-fullsize"   >
						      <div class = "caption " >
						      	<div class="card-body">
						         <h6 class="card-subtitle text-muted ">{{$article->titre}}</h6>
						         <small> Créer par : {{ $article->user->name }}</small>
						         <br><br>
						         <form method="post" action="{{url('articles/'.$article->id) }}" >
						            	{{ csrf_field() }}
						            	{{ method_field('DELETE') }}
						            	<a href="{{url('articles/'.$article->id)}}" class = "btn btn-primary btn-sm" role = "button">
						               Afficher
						            </a> 
						            
						            <a href = "{{url('articles/'.$article->id.'/edit') }}" class = "btn btn-warning btn-sm" role = "button">
						               Editer
						            </a>
						            	<button class = "btn btn-danger btn-sm" type="submit">Supprimer</button>  
						               
						            </a>
						            </form>
						         </div>

						      </div>
					  </div>
			   	</div>

			   	
			   	@endforeach
				</div>
			</div>
			
		</div>
		
	</div>

@endsection
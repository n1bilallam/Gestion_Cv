@extends ('layouts.app')

@section('content')

<div class="container" id="test">
	<div class="row" >
		<div class="col-md-12">
		
			<div class="card">
				  <div class="card-header">
				    Experiences
				    <div class="float-right">
  						<button class="btn btn-success" v-on:click="open.experience = true">Ajouter</button>
  					</div>
				  </div>
				  <div class="card-body">

				  	<div v-if="open.experience">
				  		
				  		<form @submit.prevent="validateForm(formExperience)" data-vv-scope="formExperience">
				  		
				  		<div :class="{ 'form-group':true , 'has-danger':errors.has('formExperience.titre')}">
				  			<div >
				  			<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="open.experience = false">
				  				<span aria-hidden="true" color="red">&times;</span>
				  			</button>
				  			</div>
				  			<br>
				  			<label for="">Titre</label>
				  			
				  			<input name="titre" type="text" v-validate="'required'"  placeholder="Titre" v-model="experience.titre" :class="{'form-control':true, 'is-invalid':errors.has('formExperience.titre')}" id="inputInvalid" bg-color="rgb(255, 255, 255)" style="transition: background 0.4s ease 0s; background-color: rgb(255, 255, 255);">
				  			
				  			<div class="invalid-feedback" v-show="errors.has('formExperience.titre')">@{{ errors.first('formExperience.titre') }}</div>
				  		</div>
				  		<div :class="{'form-group':true , ' has-danger':errors.has('formExperience.desc')}">
				  			<label for="">Déscription</label>
				  			<textarea name="desc" v-validate="'required|min:10|max:255'"  placeholder="Déscription" v-model="experience.body" :class="{'form-control':true, 'is-invalid':errors.has('formExperience.desc')}" id="inputInvalid" bg-color="rgb(255, 255, 255)" style="transition: background 0.4s ease 0s; background-color: rgb(255, 255, 255);"></textarea>
				  			<div class="invalid-feedback" v-show="errors.has('formExperience.desc')">@{{ errors.first('formExperience.desc')}}</div>
				  		</div>

				  		

				  		<div class="row">
				  			<div class="col-md-6">
				  				<div class="form-group">
				  					<label for="">Date début</label>
				  					<input type="date" class="form-control" placeholder="date début" v-model="experience.debut">
				  				</div>
				  			</div>
				  			<div class="col-md-6">
				  				<div class="form-group">
				  					<label for="">Date Fin</label>
				  					<input type="date" class="form-control" placeholder="date Fin" v-model="experience.fin">
				  				</div>
				  			</div>
				  		</div>
				  		
				  		<button  v-if="edit.experience"   @click="updateExperience "  class="btn btn-danger btn-block">Modifier</button>
				  		
				  		<button type="submit" v-else  class="btn btn-info btn-block" >Ajouter</button>
				  		
				  </div>

				</form>

				 
				   	<ul class="list-group list-group-flush">
  						<li class="list-group-item" v-for=" experience in experiences ">
  							<div class="float-right">
  								<button class="btn btn-warning btn-sm" v-on:click="editExperience(experience)" >Editer</button>
  								<button class="btn btn-danger btn-sm" v-on:click="deleteExperience(experience)">Supprimer</button>
  							</div>
  							<h3>@{{ experience.titre }}</h3>
  						<p>@{{ experience.body }}</p>
  						<footer class="blockquote-footer">@{{ experience.debut }} | @{{ experience.fin }} </footer>
  					</li>
  					
					</ul>
				   </div>   			    
				  
			</div>
		
		
<hr>
			<div class="card">
				  <div class="card-header">
				    Formations
				    <div class="float-right">
  								<button class="btn btn-success " v-on:click="open.formation = true">Ajouter</button>
  							</div>
				  </div>
				  <div class="card-body">
				  <div v-if="open.formation">
				  		<div class="form-group">
				  			<div >
				  			<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="open.formation = false">
				  				<span aria-hidden="true" color="red">&times;</span>
				  			</button>
				  			</div>
				  			<br>
				  			<label for="">Etablissement</label>
				  			<input type="text" class="form-control" placeholder="Nom de l'établissement" v-model="formation.etablissement">
				  			
				  		</div>
				  		<div class="form-group">

				  			<label for="">Diplome</label>
				  			<input type="text" class="form-control" placeholder="Option de Diplome" v-model="formation.deplome">
				  			
				  		</div>
				  		<div class="form-group">
				  			<label for="">Déscription</label>
				  			<textarea  class="form-control" placeholder="Déscription de diplome" v-model="formation.description"></textarea>
				  			
				  		</div>

				  		

				  		<div class="row">
				  			<div class="col-md-6">
				  				<div class="form-group">
				  					<label for="">Date début</label>
				  					<input type="date" class="form-control" placeholder="date début" v-model="formation.debut">
				  				</div>
				  			</div>
				  			<div class="col-md-6">
				  				<div class="form-group">
				  					<label for="">Date Fin</label>
				  					<input type="date" class="form-control" placeholder="date Fin" v-model="formation.fin">
				  				</div>
				  			</div>
				  		</div>
				  		<button v-if="edit.formation" class="btn btn-danger btn-block" v-on:click="updateFormation">Modifier</button>
				  		<button v-else class="btn btn-info btn-block" v-on:click="addFormation">Ajouter</button>

				  </div>
				  <div class="card-body">
				   	<ul class="list-group list-group-flush">
  						<li class="list-group-item" v-for=" formation in formations ">
  							<div class="float-right">
  								<button class="btn btn-warning btn-sm" v-on:click="editFormation(formation)">Editer</button>
  								<button class="btn btn-danger btn-sm" v-on:click="deleteFormation(formation)">Supprimer</button>
  							</div>
  							<h4>@{{ formation.etablissement }}</h4>
  							
  							<h6>@{{ formation.deplome}}</h6>
  						<p>@{{ formation.description }}</p>
  						<footer class="blockquote-footer">@{{ formation.debut }} | @{{ formation.fin }} </footer>
  					</li>
  					
					</ul>
				</div>
						
				  </div>
			</div>


<hr>

			<div class="card">
				  <div class="card-header">
				    Competences
				    <div class="float-right">
  								<button class="btn btn-success " v-on:click="open.competence = true">Ajouter</button>
  							</div>
				  </div>
				  <div class="card-body">
				  <div v-if="open.competence">
				  		<div class="form-group">
				  			<div >
				  			<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="open.competence = false">
				  				<span aria-hidden="true" color="red">&times;</span>
				  			</button>
				  			</div>
				  			<br>
				  			<label for="">Competence</label>
				  			<input type="text" class="form-control" placeholder="Competence ..." v-model="competence.titre">
				  			
				  		</div>
				  		<div class="form-group">

				  			<label for="">Déscription</label>
				  			<textarea type="text" class="form-control" placeholder="Déscription ..." v-model="competence.description"></textarea>
				  			
				  		</div>
				  		

				  		<button v-if="edit.competence" class="btn btn-danger btn-block" v-on:click="updateCompetence">Modifier</button>
				  		<button v-else class="btn btn-info btn-block" v-on:click="addCompetence">Ajouter</button>

				  </div>
				  <div class="card-body">
				   	<ul class="list-group list-group-flush">
  						<li class="list-group-item" v-for=" competence in competences ">
  							<div class="float-right">
  								<button class="btn btn-warning btn-sm" v-on:click="editCompetence(competence)">Editer</button>
  								<button class="btn btn-danger btn-sm" v-on:click="deleteCompetence(competence)">Supprimer</button>
  							</div>
  							<h3>@{{ competence.titre }}</h3>

  						<p>@{{ competence.description }}</p>
  						
  					</li>
  					
					</ul>
				</div>
						
				  </div>
			</div>

<hr>
			<div class="card">
				  <div class="card-header">
				    Projets
				    <div class="float-right">
  								<button class="btn btn-success " v-on:click="open.projet = true">Ajouter</button>
  							</div>
				  </div>
				 <div class="card-body">
				  <div v-if="open.projet">
				  		<div class="form-group">
				  			<div >
				  			<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="open.projet = false">
				  				<span aria-hidden="true" color="red">&times;</span>
				  			</button>
				  			</div>
				  			<br>
				  			<label for="">Titre de projet</label>
				  			<input type="text" class="form-control" placeholder="Titre de projet" v-model="projet.titre">
				  			
				  		</div>
				  		
				  		<div class="form-group">
				  			<label for="">Déscription</label>
				  			<textarea  class="form-control" placeholder="Déscription de diplome" v-model="projet.description"></textarea>
				  			
				  		</div>

				  		

				  		<div class="form-group">
				  			<label for="">Lien de projet</label>
				  			<input type="text" class="form-control" placeholder="lien de projet" v-model="projet.lien">
				  			
				  		</div>
				  		<button v-if="edit.projet" class="btn btn-danger btn-block" v-on:click="updateProjet">Modifier</button>
				  		<button v-else class="btn btn-info btn-block" v-on:click="addProjet">Ajouter</button>

				  </div>
				  <div class="card-body">
				   	<ul class="list-group list-group-flush">
  						<li class="list-group-item" v-for=" projet in projets ">
  							<div class="float-right">
  								<button class="btn btn-warning btn-sm" v-on:click="editProjet(projet)">Editer</button>
  								<button class="btn btn-danger btn-sm" v-on:click="deleteProjet(projet)">Supprimer</button>
  							</div>
  							<h3>@{{ projet.titre }}</h3>
  							
  						<p>@{{ projet.description }}</p>
  						<footer class="blockquote-footer">lien : @{{ projet.lien }} </footer>
  					</li>
  					
					</ul>
				</div>
						
				  </div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascript')
<script src="{{asset('js/vue.js')}}"></script>
<script src="{{asset('js/veevalidate.js')}}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script >
	Vue.use(VeeValidate);
	window.laravel ={!! json_encode([
		'csrfToken' => csrf_token(),
		'idExperience' => $id,
		'url' => url('/')
		]) !!};
	
</script>

<script src="{{ asset('js/script.js') }}">
	
</script>
@endsection
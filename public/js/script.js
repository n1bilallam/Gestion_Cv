var app = new Vue({
		el: '#test',
		data: {
			experiences: [],
			formations: [],
			competences: [],
			projets: [],
			open: {
				experience:false,
				formation: false,
				competence: false,
				projet: false
			},
			experience: {
				id: 0,
				article_id: window.laravel.idExperience,
				titre: '',
				body: '',
				debut: '',
				fin: ''
			},
			formation: {
				id: 0,
				article_id: window.laravel.idExperience,
				etablissement: '',
				deplome: '',
				description:'',
				debut: '',
				fin: ''
			},
			competence: {
				id: 0,
				article_id: window.laravel.idExperience,
				titre: '',
				description:''
				
			},
			projet: {
				id: 0,
				article_id: window.laravel.idExperience,
				titre: '',
				description:'',
				lien:''
				
			},

			edit: {
				experience: false,
				formation: false,
				ompetence: false,
				projet: false
			}

		},
		methods: {
			getData: function() {
				axios.get(window.laravel.url+'/getData/'+window.laravel.idExperience)
				.then(response => {
					console.log('success : ', response.data );
					this.experiences = response.data.experiences;
					this.formations = response.data.formations;
					this.competences = response.data.competences;
					this.projets = response.data.projets;
				})

				.catsh(error => {
					console.log('Errors : ', error );
				})
			},
			// Experience model
			addExperience: function() {
				axios.post(window.laravel.url+'/addExperience',this.experience)
					.then(response =>   {
						if (response.data.etat) {
						this.open.experience = false;
						this.experience.id = response.data.id;
						this.experiences.unshift(this.experience);

						this.experience = {
											id: 0,
											article_id: window.laravel.idExperience,
											titre: '',
											body: '',
											debut: '',
											fin: ''
										};
					}
				})

					.catsh( error =>  {
						console.log('Errors : ', error );
				})
			},

			editExperience: function(experience){
				this.open.experience = true;
				this.edit.experience = true;
				this.experience = experience;
			},
			updateExperience:function(){
				axios.put(window.laravel.url+'/updateExperience',this.experience)
					.then(response =>   {
						if (response.data.etat) {
						this.open.experience = false;

						

						this.experience = {
							id: 0,
							article_id: window.laravel.idExperience,
							titre: '',
							body: '',
							debut: '',
							fin: ''
						};
					}
					this.edit.experience = false;
				})

					.catsh( error =>  {
						console.log('Errors : ', error );
				})
			},

			deleteExperience:function(experience){
				const swalWithBootstrapButtons = Swal.mixin({
								  customClass: {
								    confirmButton: 'btn btn-success ',
								    cancelButton: 'btn btn-danger mr-2'
								  },
								  buttonsStyling: false,
								})

								swalWithBootstrapButtons.fire({
								  title: 'Etés vous sur ?',
								  text: "De supprimer cette expérience !",
								  type: 'warning',
								  showCancelButton: true,
								  confirmButtonText: 'Oui, supprime-le! ',
								  cancelButtonText: 'Non, Annuler! ',
								  reverseButtons: true
								})
								.then((result) => {
								  if (result.value) {
										  	axios.delete(window.laravel.url+'/deleteExperience/'+experience.id)
											.then(response =>   {
												if (response.data.etat) {
													var position = this.experiences.indexOf(experience);
													this.experiences.splice(position,1);

											}
											swalWithBootstrapButtons.fire(
												      'Supprimé!',
												      'Votre expérience a été supprimé.',
												      'success'
												    )
										})

											.catsh( error =>  {
												console.log('Errors : ', error );
										})
							    
							  } else if (result.dismiss === Swal.DismissReason.cancel) {
							    swalWithBootstrapButtons.fire(
							      'Annulé',
							      'vous avez annulé la suppression :)',
							      'error'
							    )
							  }
							})
				
				
			},
				//Formation model

			addFormation: function(){
				axios.post(window.laravel.url+'/addFormation',this.formation)
					.then(response =>   {
						if (response.data.etat) {
						this.open.formation = false;
						this.formation.id = response.data.id;
						this.formations.unshift(this.formation);

						this.formation = {
											id: 0,
											article_id: window.laravel.idExperience,
											etablissement: '',
											deplome: '',
											description:'',
											debut: '',
											fin: ''
										};
					}
				})

					.catsh( error =>  {
						console.log('Errors : ', error );
				})
			},
			editFormation: function(formation){
				this.open.formation = true;
				this.edit.formation = true;
				this.formation = formation;
			},
			updateFormation:function(){
				axios.put(window.laravel.url+'/updateFormation',this.formation)
					.then(response =>   {
						if (response.data.etat) {
						this.open.formation = false;

						

						this.formation = {
										id: 0,
										article_id: window.laravel.idExperience,
										etablissement: '',
										deplome: '',
										description:'',
										debut: '',
										fin: ''
						};
					}
					this.edit.formation = false;
				})

					.catsh( error =>  {
						console.log('Errors : ', error );
				})
			},
			
			deleteFormation:function(formation){
				const swalWithBootstrapButtons = Swal.mixin({
								  customClass: {
								    confirmButton: 'btn btn-success ',
								    cancelButton: 'btn btn-danger mr-2'
								  },
								  buttonsStyling: false,
								})

								swalWithBootstrapButtons.fire({
								  title: 'Etés vous sur ?',
								  text: "De supprimer cette formation !",
								  type: 'warning',
								  showCancelButton: true,
								  confirmButtonText: 'Oui, supprime-le! ',
								  cancelButtonText: 'Non, Annuler! ',
								  reverseButtons: true
								})
								.then((result) => {
								  if (result.value) {
										  	axios.delete(window.laravel.url+'/deleteFormation/'+formation.id)
											.then(response =>   {
												if (response.data.etat) {
													var position = this.formations.indexOf(formation);
													this.formations.splice(position,1);

											}
											swalWithBootstrapButtons.fire(
												      'Supprimé!',
												      'Votre formation a été supprimé.',
												      'success'
												    )
										})

											.catsh( error =>  {
												console.log('Errors : ', error );
										})
							    
							  } else if (result.dismiss === Swal.DismissReason.cancel) {
							    swalWithBootstrapButtons.fire(
							      'Annulé',
							      'vous avez annulé la suppression :)',
							      'error'
							    )
							  }
							})
				
				
			},
			//Competence model
			addCompetence: function(){
				axios.post(window.laravel.url+'/addCompetence', this.competence)
					.then(response =>   {
						if (response.data.etat) {
						this.open.competence = false;
						this.competence.id = response.data.id;
						this.competences.unshift(this.competence);

						this.competence = {
											id: 0,
											article_id: window.laravel.idExperience,
											titre: '',
											description: '',
										};
					}
				})

					.catsh( error =>  {
						console.log('Errors : ', error );
				})
			},

			editCompetence: function(competence){
				this.open.competence = true;
				this.edit.competence = true;
				this.competence = competence;
			},
			updateCompetence:function(){
				axios.put(window.laravel.url+'/updateCompetence',this.competence)
					.then(response =>   {
						if (response.data.etat) {
						this.open.competence = false;

						

						this.competence = {
							id: 0,
							article_id: window.laravel.idExperience,
							titre: '',
							description:''
						};
					}
					this.edit.competence = false;
				})

					.catsh( error =>  {
						console.log('Errors : ', error );
				})
			},
			deleteCompetence:function(competence){
				const swalWithBootstrapButtons = Swal.mixin({
								  customClass: {
								    confirmButton: 'btn btn-success ',
								    cancelButton: 'btn btn-danger mr-2'
								  },
								  buttonsStyling: false,
								})

								swalWithBootstrapButtons.fire({
								  title: 'Etés vous sur ?',
								  text: "De supprimer cette competence !",
								  type: 'warning',
								  showCancelButton: true,
								  confirmButtonText: 'Oui, supprime-le! ',
								  cancelButtonText: 'Non, Annuler! ',
								  reverseButtons: true
								})
								.then((result) => {
								  if (result.value) {
										  	axios.delete(window.laravel.url+'/deleteCompetence/'+competence.id)
											.then(response =>   {
												if (response.data.etat) {
													var position = this.competences.indexOf(competence);
													this.competences.splice(position,1);

											}
											swalWithBootstrapButtons.fire(
												      'Supprimé!',
												      'Votre competence a été supprimé.',
												      'success'
												    )
										})

											.catsh( error =>  {
												console.log('Errors : ', error );
										})
							    
							  } else if (result.dismiss === Swal.DismissReason.cancel) {
							    swalWithBootstrapButtons.fire(
							      'Annulé',
							      'vous avez annulé la suppression :)',
							      'error'
							    )
							  }
							})
				
				
			},

			//Projet model

			addProjet: function(){
				axios.post(window.laravel.url+'/addProjet',this.projet)
					.then(response =>   {
						if (response.data.etat) {
						this.open.projet = false;
						this.projet.id = response.data.id;
						this.projets.unshift(this.projet);

						this.projet = {
											id: 0,
											article_id: window.laravel.idExperience,
											titre: '',
											description:'',
											lien:''
										};
					}
				})

					.catsh( error =>  {
						console.log('Errors : ', error );
				})
			},
			editProjet: function(projet){
				this.open.projet = true;
				this.edit.projet = true;
				this.projet = projet;
			},
			updateProjet:function(){
				axios.put(window.laravel.url+'/updateProjet',this.projet)
					.then(response =>   {
						if (response.data.etat) {
						this.open.projet = false;

						

						this.projet = {
							id: 0,
							article_id: window.laravel.idExperience,
							titre: '',
							description:'',
							lien:''
						};
					}
					this.edit.projet= false;
				})

					.catsh( error =>  {
						console.log('Errors : ', error );
				})
			},
			deleteProjet:function(projet){
				const swalWithBootstrapButtons = Swal.mixin({
								  customClass: {
								    confirmButton: 'btn btn-success ',
								    cancelButton: 'btn btn-danger mr-2'
								  },
								  buttonsStyling: false,
								})

								swalWithBootstrapButtons.fire({
								  title: 'Etés vous sur ?',
								  text: "De supprimer cette projet !",
								  type: 'warning',
								  showCancelButton: true,
								  confirmButtonText: 'Oui, supprime-le! ',
								  cancelButtonText: 'Non, Annuler! ',
								  reverseButtons: true
								})
								.then((result) => {
								  if (result.value) {
										  	axios.delete(window.laravel.url+'/deleteProjet/'+projet.id)
											.then(response =>   {
												if (response.data.etat) {
													var position =this.projets.indexOf(projet);
													this.projets.splice(position,1);

											}
											swalWithBootstrapButtons.fire(
												      'Supprimé!',
												      'Votre projet a été supprimé.',
												      'success'
												    )
										})

											.catsh( error =>  {
												console.log('Errors : ', error );
										})
							    
							  } else if (result.dismiss === Swal.DismissReason.cancel) {
							    swalWithBootstrapButtons.fire(
							      'Annulé',
							      'vous avez annulé la suppression :)',
							      'error'
							    )
							  }
							})
				
				
			},

			

			

				validateForm(scope) {
	      			this.$validator.validateAll(scope).then((result) => {
	        			if (result ) {
	        				
	        					this.addExperience();
	        				
	                    }
	      });
	      			
	      			
	    }
     

		},
		created: function(){
			this.getData();

		}

});
	
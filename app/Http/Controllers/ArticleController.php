<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article , App\Experience , App\Formation , App\Competence , App\Projet;
use App\Http\Requests\articleRequest;
use Auth;
use Illuminate\Http\UploadedFile;

class ArticleController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if (Auth::user()->is_admin) {
            $listeArticles = Article::all();
        }else{
            $listeArticles =Auth::user()->articles;
        }
        
        return view('articles.index',['articles' =>$listeArticles]);

    }

    public function create(){
    	return view('articles.create');
    }

    public function store(articleRequest $request){
    	$article = new Article();

        $article->titre = $request->input('titre');
        $article->article = $request->input('article');
        $article->user_id = Auth::user()->id;

      
         $article->image = time().'.'.request()->image->getClientOriginalExtension();

  

        request()->image->move(public_path('images'), $article->image);

        
        $article->save();
        session()->flash('success',"l'article à été bien enregisttré !!");
        return redirect('articles');

    }

    public function edit($id){

        $article = Article::find($id);
        $this->authorize('update',$article);
        return view('articles.edit',['article'=>$article]);

    	
    }

    public function update(articleRequest $request ,$id){
        $article = Article::find($id);
        $article->titre=$request->input('titre');
        $article->article = $request->input('article');
        $article->image = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $article->image);

    	 $article->save(); 
         return redirect('articles');

    }

    public function show($id){
        return view('articles.show',['id'=> $id]);
    }


    public function destroy(Request $request ,$id){
    	
        $article = Article::find($id);
        $this->authorize('delete',$article);
        $article ->delete();
        return redirect('articles');
    }

    public function getData($id){

        $article = Article::find($id);
        $experiences = $article->experiences()->orderBy('debut', 'desc')->get();
        $formations= $article->formations()->orderBy('debut', 'desc')->get();
        $competences= $article->competences()->orderBy('updated_at', 'desc')->get();
        $projets = $article->projets()->orderBy('updated_at', 'desc')->get();

        return Response()->json([
            'experiences'=>$experiences,
            'formations' =>$formations,
            'competences' =>$competences,
            'projets' => $projets
        ]);

    }
//Model de Experiences
    public function addExperience(Request $request){
        $experience = new Experience;
        $experience->titre =$request->titre;
        $experience->body =$request->body;
        $experience->debut =$request->debut;
        $experience->fin =$request->fin;
        $experience->article_id = $request->article_id;


        $experience->save();

        return Response()->json(['etat' => true, 'id' => $experience->id]);

    }

    public function updateExperience(Request $request){
        $experience =  Experience::find($request->id);
        $experience->titre =$request->titre;
        $experience->body =$request->body;
        $experience->debut =$request->debut;
        $experience->fin =$request->fin;
        $experience->article_id = $request->article_id;


        $experience->save();

        return Response()->json(['etat' => true ]);

    }

    public function deleteExperience($id){
        $experience = Experience::find($id);
        $experience->delete();
        return Response()->json(['etat' => true ]);
    }

//Model de formations
        public function addFormation(Request $request){
        $formation = new Formation;
        $formation->etablissement =$request->etablissement;
        $formation->deplome =$request->deplome;
        $formation->description =$request->description;
        $formation->debut =$request->debut;
        $formation->fin =$request->fin;
        $formation->article_id = $request->article_id;


        $formation->save();

        return Response()->json(['etat' => true, 'id' => $formation->id]);

    }

    public function updateFormation(Request $request){
        $formation =  Formation::find($request->id);
        $formation->etablissement =$request->etablissement;
        $formation->deplome =$request->deplome;
        $formation->description =$request->description;
        $formation->debut =$request->debut;
        $formation->fin =$request->fin;
        $formation->article_id = $request->article_id;


        $formation->save();

        return Response()->json(['etat' => true ]);

    }

    public function deleteFormation($id){
        $formation = Formation::find($id);
        $formation->delete();
        return Response()->json(['etat' => true ]);
    }

//model de Competences
    public function addCompetence(Request $request){

        $competence = new Competence;
        
        $competence->titre =$request->titre;
        $competence->description =$request->description;
        $competence->article_id = $request->article_id;
        $competence->save();

        return Response()->json(['etat' => true, 'id' => $competence->id]);

    }

    public function updateCompetence(Request $request){
        $competence=  Competence::find($request->id);
        $competence->titre =$request->titre;
        $competence->description =$request->description;
        $competence->article_id = $request->article_id;


        $competence->save();

        return Response()->json(['etat' => true ]);

    }

    public function deleteCompetence($id){
        $competence = Formation::find($id);
        $competence->delete();
        return Response()->json(['etat' => true ]);
    } 
//model de Projets

     public function addProjet(Request $request){
        $projet = new Projet;
        
        $projet->titre =$request->titre;
        $projet->description =$request->description;
        $projet->lien =$request->lien;
        $projet->article_id = $request->article_id;


        $projet->save();

        return Response()->json(['etat' => true, 'id' => $projet->id]);

    }

    public function updateProjet(Request $request){
        $projet=  Projet::find($request->id);
        $projet->titre =$request->titre;
        $projet->description =$request->description;
        $projet->lien =$request->lien;
        $projet->article_id = $request->article_id;


        $projet->save();

        return Response()->json(['etat' => true ]);

    }

    public function deleteProjet($id){
        $projet = Projet::find($id);
        $projet->delete();
        return Response()->json(['etat' => true ]);
    } 

}

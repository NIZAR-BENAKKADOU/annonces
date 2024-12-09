<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Http\Requests\AnnonceRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*    public function index(Request $request)
    {
        $villes = Annonce::select("ville")->distinct()->get();
        $ville = $request->ville;
        $titre = $request->titre;
        if (!empty($ville)) {
            if (!empty($titre)) {
                $annonces = Annonce::where('ville', $ville)->where('titre', "like", "%" . $titre . "%")->get();
            } else {
                $annonces = Annonce::where('ville', $ville)->get();
            }
        } else {
            if (!empty($titre)) {
                $annonces = Annonce::where('titre', "like", "%" . $titre . "%")->get();
            } else {
                $annonces = Annonce::all();
            }
        }
        return view("annonces.index", compact("annonces", "villes"));
    }*/

    public function index(Request $request)
    {
        $villes = Annonce::select("ville")->distinct()->get();
        $query = Annonce::query(); //requete non executée
        if (!empty($request)) {
            //recherche
            $ville = $request->ville;
            $search = trim($request->search);
            if (!empty($ville)) {
                $query = $query->where("ville", $ville);
            }
            if (!empty($search)) {
                $query = $query->where(function (Builder $q) use ($search) {
                    $q->whereRaw('LOWER(titre) LIKE ?', ["%" . strtolower($search) . "%"])
                        ->orWhereRaw('LOWER(description) LIKE ?', ["%" . strtolower($search) . "%"]);
                });
            }
        }
        $annonces = $query->get();
        return view("annonces.index", compact("annonces", "villes"));
    }

    public function create()
    {
        return view("annonces.create");
    }

    public function store(AnnonceRequest $request)
    {
        // method1:ne pas les input image
        // Annonce::create($request->all());
        // return redirect()->route('annonce.index')->with('success', 'annonce ajouter')->withInput();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            //Il faut tout d'abord configurer, sous app/config/filesystems, le lien (link): photo_annonce
            $path = $file->store("photo_annonce");
            //Avec la méthode store, on laisse à laravel de nous générer un identifiant unique,
            //La méthode store retourne le chemin avec le nom du fichier généré; ex. : photo_annonce/ioCAfg6lgV6zFneg08F5OdxaStk20ezjsXE3g3f6.jpg
            //la valeur retournée est stockée par la suite dans la variable $path;
            //On va utiliser $path pour enregister ce chemin dans la base de données
            //Vous pouvez utiliser la méthode storeAs (voir exemple de cours) si vous voulez personnaliser le nom de vos fichiers
        } else {
            $path = 'photo_annonce/no-image.jpg';
        }

        Annonce::create(
            [
                "titre" => $request->titre,
                "description" => $request->description,
                "type" => $request->type,
                "neuf" => $request->neuf,
                "ville" => $request->ville,
                "superficie" => $request->superficie,
                "prix" => $request->prix,
                "photo" => $path
            ]
        );
        return redirect()->route("annonce.index")->with("ajouter", "la nouvelle annonce a été bien ajouté!");
    }

    public function show(Annonce $annonce)
    {
        return view("annonces.show", compact("annonce"));
    }

    public function edit(Annonce $annonce)
    {
        return view("annonces.edit", compact("annonce"));
    }

    public function update(AnnonceRequest $request, Annonce $annonce)
    {
        //Si on veut configurer les validations ici, on peut utiliser le code suivant pour définir la contarainte du titre unique:
        // $request->validate( [
        //  "titre"=> "required|unique:annonces,titre,".$annonce->id
        // ]);

        // method1:ne pas les input image
        // $annonce->update($request->all());
        // return redirect()->route('annonce.index')->with('success', 'annonce modifiée!');

        //Si on ne veut pas faire une affectation champ par champ on peut utiliser $request->all()
        $data = $request->all();

        $file = $request->photo;
        if (isset($file)) {
            $path = $file->store("photo_annonce");
            //avant d'exécuter la mise à jour, il faut modifier le champ "photo" pour qu'il reçoive le nouveau path 
            $data['photo'] = $path;
        } else {
            $data['photo'] = $annonce->photo;
        }
        $annonce->update($data);
        return redirect()->route("annonce.index")->with("modifier", "L'annonce a été mise à jour!");
    }

    public function destroy(Annonce $annonce)
    {
        $annonce->delete();
        return redirect()->route("annonce.index")->with("delete", "L'annonce a été supprimé!");
    }
}

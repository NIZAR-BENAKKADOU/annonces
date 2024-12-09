@extends("templates.master")
@isset($annonce)
@section("titre", "Détails de l'annonce |".$annonce->titre)
@endisset
@section("contenu")
@isset($annonce)
<h2 class="mt-3 mb-2">Détails de l'annonce numéro {{$annonce->id}} </h2>
<div class="card" style="width:28rem">
    @if(!empty($annonce->photo))
    <img src="{{asset($annonce->photo)}}" alt="photo" class="card-img-top"/> <br>
    @else
    <img src="{{asset('photo_annonce/no-image.jpg')}}" alt="no-image" class="card-img-top"/><br>
    @endif
    <div class="card-body">
        <h5 class="card-title"><b>Titre : </b> {{$annonce->titre}} </h5>
        <h5 class="card-title"><b>Description : </b> {{$annonce->description}}</h5>
        <h5 class="card-title"><b>Type : </b> {{$annonce->type}}</h5>
        <h5 class="card-title"><b>Etat : </b> {{$annonce->neuf? "Neuf" : "Ancien"}}</h5>
        <h5 class="card-title"><b>Superficie : </b> {{$annonce->superficie}}</h5>
        <h5 class="card-title"><b>Prix : </b> {{$annonce->prix}}</h5>
        <a href="{{ route('annonce.index') }}" class="btn btn-outline-primary">Go back <i class="bi bi-skip-backward"></i></a>
    </div>
</div>
@endisset

@endsection
@extends("templates.master")
@section("titre", "Liste des annonces")
@section("contenu")
<h2 class="mt-4 mb-5">Liste des annonces</h2>
<br>
@if(session()->has("ajouter"))
<div class="alert alert-primary">
    {{session("ajouter")}}
</div>
@endif
@if(session()->has("modifier"))
<div class="alert alert-success">
    {{session("modifier")}}
</div>
@endif
@if(session()->has("delete"))
<div class="alert alert-danger">
    {{session("delete")}}
</div>
@endif
<form action="{{ route("annonce.index") }}" method="get">
    <div class="d-flex mb-3">
        @isset($villes)
        <select class="form-select" name="ville">
            <option value="0">tous les villes</option>
            @foreach($villes as $obj)
            <option value="{{$obj->ville}}" {{request()->ville==$obj->ville?'selected':''}}>{{$obj->ville}}</option>
            @endforeach
        </select>
        <input type="text" placeholder="rechercher par titre et par description" name="search" class="form-control mx-3" value="{{request()->search}}">
        <button type="submit" class="btn btn-outline-primary btn-sm">Rechercher <i class="bi bi-search"></i></button>
        @endisset
    </div>
</form>
<a href="{{ route('annonce.create') }}" class="btn btn-outline-info mb-4">Nouvelle annonce <i class="bi bi-plus-circle"></i></a>
@isset($annonces)
<table class="table">
    <thead>
        <tr>
            <th>Photo</th>
            <th>#</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Type</th>
            <th>Ville</th>
            <th>Superficie (m<sup>2</sup>) </th>
            <th>Etat</th>
            <th>Prix</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($annonces as $annonce)
        <tr>
            <td>
                @if(!empty($annonce->photo))
                <img src="{{asset($annonce->photo)}}" alt="photo" width="60px" />
                @else
                <img src="{{asset('photo_annonce/no-image.jpg')}}" alt="no-image" width="60px" />
                @endif
            </td>
            <td>{{ $annonce->id }}</td>
            <td>{{ $annonce->titre }}</td>
            <td>{{ $annonce->description }}</td>
            <td>{{ $annonce->type}}</td>
            <td>{{ $annonce->ville}}</td>
            <td>{{ $annonce->superficie}}</td>
            <td>{{ $annonce->neuf? "Neuf":"Ancien" }}</td>
            <td>{{ $annonce->prix }}</td>
            <td>
                <form action="{{ route('annonce.destroy', $annonce->id )}}" method="post">
                    @csrf
                    @method("DELETE")
                    <a href="{{route('annonce.show', $annonce->id )}}"><i class="bi bi-eye" style='color:blue'></i></a>
                    <a href="{{route('annonce.edit', $annonce->id )}}"><i class="bi bi-pencil" style='color:green'></i></a>
                    <button type="submit" style="border:none; background-color:transparent" onclick="return confirm('Voulez vous supprimer l\'annonce :  {{ $annonce->titre }}?')"><i class="bi bi-trash" style='color:brown'></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="alert alert-denger">Aucune annonce n'est disponible</td>
        </tr>
        @endforelse
     </tbody>
</table>
@endisset
@endsection
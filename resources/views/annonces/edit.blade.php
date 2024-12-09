@extends("templates.master")
@section("titre", "Modifier annonce")
@section("contenu")
@isset($annonce)
<h1 class="mt-2 mb-2">Modifier l'annonce numéro {{ $annonce->id }} </h1>
<form method="post" action="{{ route('annonce.update', $annonce->id )}}" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="mb-3">
        <label class="form-label">Titre</label>
        <input type="text" class="form-control" name="titre" value="{{old('titre')?? $annonce->titre}}"">
    </div>
    @error('titre')
    <div class=" alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}
    </div>
    @enderror
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" rows="3" name="description">{{old('description') ?? $annonce->description}}</textarea>
    </div>
    @error('description')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror
    <div class="mb-3">
        <label class="form-label">Type</label>
        @php
        $type=old('type') ?? $annonce->type;
        @endphp
        <select class="form-select" name="type">
            <option value="Appartement" {{ $type=='Appartement' ?'selected':''}}>Appartement</option>
            <option value="Maison" {{$type=='Maison' ? 'selected' :''}}>Maison</option>
            <option value="Villa" {{$type=='Villa' ? 'selected' :''}}>Villa</option>
            <option value="Terrain" {{$type=='Terrain' ? 'selected' :''}}>Terrain</option>
            <option value="Magasin" {{$type=='Magasin' ? 'selected' :''}}>Magasin</option>
        </select>
    </div>
    @error('type')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror
    <div class="mb-3">
        <label class="form-label">Ville</label>
        <input type="text" class="form-control" name="ville" value="{{old('ville')??$annonce->ville}}">
    </div>
    @error('ville')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror
    <div class="mb-3">
        <label class="form-label d-block">Superficie</label>
        <div class="input-group">
            <input type="text" class="form-control" name="superficie" value="{{old('superficie')??$annonce->superficie}}">
            <span class="input-group-text">m<sup>2</sup></span>
        </div>
    </div>
    @error('superficie')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror
    <div class="mb-3">
        <label class="form-label d-block">Etat</label>
        @php
        $neuf= old('neuf') ?? $annonce->neuf;
        @endphp
        <div class="form-check">
            <input class="form-check-input" type="radio" name="neuf" value="1" {{$neuf? 'checked' :''}}>
            <label class="form-check-label">Neuf</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="neuf" value="0" {{$neuf? '' :'checked'}}>
            <label class="form-check-label">Ancien</label>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Prix</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="prix" value="{{old('prix')??$annonce->prix}}">
            <span class="input-group-text">dhs</span>
        </div>
    </div>
    @error('prix')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror
    <div class="mb-3">
        @if(!empty($annonce->photo))
        <img src="{{asset($annonce->photo)}}" alt="photo" width="40%" /> <br>
        @else
        <img src="{{asset('photo_annonce/no-image.jpg')}}" alt="no-image" width="40%" /><br>
        @endif
        <br>
        <input type="file" class="form-control" name="photo">
    </div>
    @error('photo')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror
    <button type="submit" class="btn btn-outline-primary">Modifier l'annonce <i class="bi bi-pencil-square"></i></button>
</form>
@endisset
@endsection
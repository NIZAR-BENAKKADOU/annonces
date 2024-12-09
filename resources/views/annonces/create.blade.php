@extends("templates.master")
@section("titre", "Nouvelle annonce")
@section("contenu")
<h1 class="mt-2 mb-2">Nouvelle annonce</h1>
<form action="{{ route('annonce.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Titre</label>
        <input type="text" class="form-control" name="titre" value="{{old('titre')}}">
    </div>
    @error('titre')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" rows="3" name="description">{{old('description')}}</textarea>
    </div>
    @error('description')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-select" name="type">
            <option value="0">Type de annonce</option>
            <option value="Appartement" {{ old('type') == 'Appartement' ? 'selected' : '' }}>Appartement</option>
            <option value="Maison" {{ old('type') == 'Maison' ? 'selected' : '' }}>Maison</option>
            <option value="Villa" {{ old('type') == 'Villa' ? 'selected' : '' }}>Villa</option>
            <option value="Terrain" {{ old('type') == 'Terrain' ? 'selected' : '' }}>Terrain</option>
            <option value="Magasin" {{ old('type') == 'Magasin' ? 'selected' : '' }}>Magasin</option>
        </select>
    </div>
    @error('type')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror


    <div class="mb-3">
        <label class="form-label">Ville</label>
        <input type="text" class="form-control" name="ville" value="{{old('ville')}}">
    </div>
    @error('ville')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label class="form-label d-block">Superficie</label>
        <div class="input-group">
            <input type="text" class="form-control" name="superficie" value="{{old('superficie')}}">
            <span class="input-group-text">m<sup>2</sup></span>
        </div>
    </div>
    @error('superficie')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label class="form-label d-block">Etat</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="neuf" value="1">
            <label class="form-check-label">Neuf</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="neuf" value="0" checked>
            <label class="form-check-label">
                Ancien
            </label>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Prix</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="prix" value="{{old('prix')}}">
            <span class="input-group-text">dhs</span>
        </div>
    </div>
    @error('prix')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label class="form-label">Photo</label>
        <input type="file" class="form-control" name="photo">
    </div>
    @error('photo')
    <div class="alert alert-danger mt-2"><i class="bi bi-x-circle-fill"></i>{{$message}}</div>
    @enderror
    <button type="submit" class="btn btn-outline-primary">Submit <i class="bi bi-plus-circle"></i></button>
</form>
@endsection
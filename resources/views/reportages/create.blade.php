@extends('layouts.app')

@section('title', 'Créer un reportage')

@section('content')
<div class="card">
    <div class="card-header primary-color white-text">
        <h4><i class="fas fa-plus-circle"></i> Créer un nouveau reportage</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('reportages.store') }}">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="md-form">
                        <input type="text" name="titre" class="form-control" value="{{ old('titre') }}">
                        <label>Titre du reportage</label>
                        @error('titre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="md-form">
                        <input type="number" name="duree" class="form-control" value="{{ old('duree') }}">
                        <label>Durée (minutes)</label>
                        @error('duree')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="md-form">
                        <input type="number" name="ordre_passage" class="form-control" value="{{ old('ordre_passage') }}">
                        <label>Ordre de passage</label>
                        @error('ordre_passage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="md-form">
                        <select name="categorie" class="browser-default custom-select">
                            <option value="">Choisir une catégorie</option>
                            <option value="Politique" {{ old('categorie') == 'Politique' ? 'selected' : '' }}>Politique</option>
                            <option value="Économie" {{ old('categorie') == 'Économie' ? 'selected' : '' }}>Économie</option>
                            <option value="International" {{ old('categorie') == 'International' ? 'selected' : '' }}>International</option>
                            <option value="Sport" {{ old('categorie') == 'Sport' ? 'selected' : '' }}>Sport</option>
                        </select>
                        @error('categorie')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                @if(Auth::user()->role === 'admin')
                    <div class="col-md-6">
                        <div class="md-form">
                            <select name="journaliste_id" class="browser-default custom-select">
                                <option value="">Choisir un journaliste</option>
                                @foreach($journalistes as $id => $name)
                                    <option value="{{ $id }}" {{ old('journaliste_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('journaliste_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>

            <div class="md-form">
                <textarea name="resume" class="form-control md-textarea" rows="3">{{ old('resume') }}</textarea>
                <label>Résumé (optionnel)</label>
                @error('resume')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-check">
                <input type="checkbox" name="est_publie" class="form-check-input" id="est_publie" {{ old('est_publie') ? 'checked' : '' }}>
                <label class="form-check-label" for="est_publie">Publier immédiatement</label>
            </div>

            <button type="submit" class="btn btn-success">Créer le reportage</button>
            <a href="{{ route('reportages.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
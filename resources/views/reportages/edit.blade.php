@extends('layouts.app')

@section('title', 'Modifier un reportage')

@section('content')
<div class="card">
    <div class="card-header" style="background: #FF8800; color: white;">
        <h4><i class="fas fa-edit"></i> Modifier le reportage</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('reportages.update', $reportage) }}">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="md-form">
                        <input type="text" name="titre" class="form-control" value="{{ old('titre', $reportage->titre) }}">
                        <label>Titre du reportage</label>
                        @error('titre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="md-form">
                        <input type="number" name="duree" class="form-control" value="{{ old('duree', $reportage->duree) }}">
                        <label>Durée (minutes)</label>
                        @error('duree')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="md-form">
                        <input type="number" name="ordre_passage" class="form-control" value="{{ old('ordre_passage', $reportage->ordre_passage) }}">
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
                        <select name="categorie" class="form-select">
                            <option value="">Choisir une catégorie</option>
                            <option value="Politique" {{ old('categorie', $reportage->categorie) == 'Politique' ? 'selected' : '' }}>Politique</option>
                            <option value="Économie" {{ old('categorie', $reportage->categorie) == 'Économie' ? 'selected' : '' }}>Économie</option>
                            <option value="International" {{ old('categorie', $reportage->categorie) == 'International' ? 'selected' : '' }}>International</option>
                            <option value="Sport" {{ old('categorie', $reportage->categorie) == 'Sport' ? 'selected' : '' }}>Sport</option>
                        </select>
                        @error('categorie')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                @if(Auth::user()->role === 'admin')
                    <div class="col-md-6">
                        <div class="md-form">
                            <select name="journaliste_id" class="form-select">
                                <option value="">Choisir un journaliste</option>
                                @foreach($journalistes as $id => $name)
                                    <option value="{{ $id }}" {{ old('journaliste_id', $reportage->user_id) == $id ? 'selected' : '' }}>
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
                <textarea name="resume" class="form-control" rows="3">{{ old('resume', $reportage->resume) }}</textarea>
                <label>Résumé (optionnel)</label>
                @error('resume')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="est_publie" class="form-check-input" id="est_publie" {{ old('est_publie', $reportage->est_publie) ? 'checked' : '' }}>
                <label class="form-check-label" for="est_publie">Publier immédiatement</label>
            </div>

            <button type="submit" class="btn btn-warning">Mettre à jour</button>
            <a href="{{ route('reportages.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Vitrine - JT Manager')

@section('content')
<div class="card">
    <div class="card-header primary-color white-text">
        <h4 class="mb-0"><i class="fas fa-tv"></i> Journal Télévisé - Vitrine Publique</h4>
    </div>
    <div class="card-body">
        @guest
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Vous consultez la vitrine publique. 
                <a href="{{ route('login') }}" class="alert-link">Connectez-vous</a> 
                pour gérer les reportages.
            </div>
        @endguest

        <form method="GET" action="{{ route('vitrine') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="md-form">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}">
                        <label>Rechercher un reportage...</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="categorie" class="browser-default custom-select">
                        <option value="all">Toutes catégories</option>
                        @foreach(['Politique', 'Économie', 'International', 'Sport'] as $cat)
                            <option value="{{ $cat }}" {{ request('categorie') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Filtrer</button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('vitrine') }}" class="btn btn-secondary btn-block">Réinitialiser</a>
                </div>
            </div>
        </form>

        <div class="row">
            @forelse($reportages as $reportage)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <span class="badge badge-info float-right">{{ $reportage->categorie }}</span>
                            <h5 class="card-title">{{ $reportage->titre }}</h5>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="fas fa-user"></i> {{ $reportage->journaliste }}
                                    <br>
                                    <i class="fas fa-clock"></i> {{ $reportage->duree }} min
                                    <br>
                                    <i class="fas fa-sort-numeric-up"></i> Ordre: #{{ $reportage->ordre_passage }}
                                </small>
                            </p>
                            @if($reportage->resume)
                                <p class="card-text">{{ Str::limit($reportage->resume, 100) }}</p>
                            @endif
                            <span class="badge {{ $reportage->est_publie ? 'badge-success' : 'badge-secondary' }}">
                                {{ $reportage->est_publie ? '✅ Publié' : '📝 Brouillon' }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning">Aucun reportage disponible.</div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            {{ $reportages->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4">
            <i class="fas fa-chart-pie text-primary"></i> Dashboard
            <small class="text-muted">Bienvenue, {{ Auth::user()->name }}</small>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-newspaper"></i> Total reportages</h5>
                <h2 class="card-text">{{ $stats['total_reportages'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-check-circle"></i> Publiés</h5>
                <h2 class="card-text">{{ $stats['reportages_publies'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-pencil-alt"></i> Brouillons</h5>
                <h2 class="card-text">{{ $stats['reportages_brouillons'] }}</h2>
            </div>
        </div>
    </div>
    @if(Auth::user()->role === 'journaliste')
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-edit"></i> Mes reportages</h5>
                    <h2 class="card-text">{{ $stats['mes_reportages'] }}</h2>
                </div>
            </div>
        </div>
    @endif
</div>

@if(Auth::user()->role === 'admin')
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Total utilisateurs</h5>
                    <h2 class="card-text">{{ $stats['total_utilisateurs'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-tie"></i> Journalistes</h5>
                    <h2 class="card-text">{{ $stats['journalistes'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-shield"></i> Admins</h5>
                    <h2 class="card-text">{{ $stats['admins'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user"></i> Visiteurs</h5>
                    <h2 class="card-text">{{ $stats['visiteurs'] }}</h2>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header primary-color white-text">
                <i class="fas fa-history"></i> Derniers reportages
            </div>
            <div class="card-body">
                @if(count($stats['derniers_reportages']) > 0)
                    <ul class="list-group">
                        @foreach($stats['derniers_reportages'] as $reportage)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge badge-info">{{ $reportage->categorie }}</span>
                                    <strong>{{ $reportage->titre }}</strong>
                                    <small class="text-muted">par {{ $reportage->journaliste }}</small>
                                </div>
                                <span class="badge {{ $reportage->est_publie ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $reportage->est_publie ? '✅ Publié' : '📝 Brouillon' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Aucun reportage pour le moment.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Détail du reportage')

@section('content')
<div class="card">
    <div class="card-header info-color white-text">
        <h4><i class="fas fa-info-circle"></i> Détail du reportage</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h3>{{ $reportage->titre }}</h3>
                <hr>
                <p><strong><i class="fas fa-tag"></i> Catégorie :</strong> 
                    <span class="badge badge-info">{{ $reportage->categorie }}</span>
                </p>
                <p><strong><i class="fas fa-clock"></i> Durée :</strong> {{ $reportage->duree }} minutes</p>
                <p><strong><i class="fas fa-user"></i> Journaliste :</strong> {{ $reportage->journaliste }}</p>
                <p><strong><i class="fas fa-sort-numeric-up"></i> Ordre de passage :</strong> #{{ $reportage->ordre_passage }}</p>
                <p><strong><i class="fas fa-calendar"></i> Créé le :</strong> {{ $reportage->created_at->format('d/m/Y à H:i') }}</p>
                <p><strong><i class="fas fa-edit"></i> Dernière modification :</strong> {{ $reportage->updated_at->format('d/m/Y à H:i') }}</p>
                <p><strong><i class="fas fa-check-circle"></i> Statut :</strong> 
                    <span class="badge {{ $reportage->est_publie ? 'badge-success' : 'badge-secondary' }}">
                        {{ $reportage->est_publie ? '✅ Publié' : '📝 Brouillon' }}
                    </span>
                </p>
                
                @if($reportage->resume)
                    <div class="mt-4">
                        <h5><i class="fas fa-align-left"></i> Résumé</h5>
                        <div class="card bg-light p-3">
                            {{ $reportage->resume }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('reportages.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
            <a href="{{ route('reportages.edit', $reportage) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                <i class="fas fa-trash"></i> Supprimer
            </button>
        </div>
    </div>
</div>

<!-- Modale de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer le reportage "{{ $reportage->titre }}" ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <form action="{{ route('reportages.destroy', $reportage) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
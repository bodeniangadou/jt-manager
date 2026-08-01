@extends('layouts.app')

@section('title', 'Gestion des reportages')

@section('content')
<div class="card">
    <div class="card-header" style="background: #1a2332; color: white;">
        <h4 class="mb-0"><i class="fas fa-newspaper"></i> Gestion des reportages</h4>
    </div>
    <div class="card-body">
        <!-- Formulaire de recherche et filtres -->
        <form method="GET" action="{{ route('reportages.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="md-form">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Rechercher...">
                        <label>Rechercher...</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="categorie" class="form-select">
                        <option value="all">Toutes catégories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('categorie') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="journaliste" class="form-select">
                        <option value="all">Tous journalistes</option>
                        @foreach($journalistes as $j)
                            <option value="{{ $j }}" {{ request('journaliste') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
                <div class="col-md-3 text-end">
                    <a href="{{ route('reportages.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Nouveau reportage
                    </a>
                </div>
            </div>
        </form>

        <!-- Tableau des reportages -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Ordre</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Durée</th>
                        <th>Journaliste</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reportages as $reportage)
                    <tr>
                        <td>{{ $reportage->ordre_passage }}</td>
                        <td>{{ $reportage->titre }}</td>
                        <td><span class="badge bg-info">{{ $reportage->categorie }}</span></td>
                        <td>{{ $reportage->duree }} min</td>
                        <td>{{ $reportage->journaliste }}</td>
                        <td>
                            <span class="badge {{ $reportage->est_publie ? 'bg-success' : 'bg-secondary' }}">
                                {{ $reportage->est_publie ? '✅ Publié' : '📝 Brouillon' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('reportages.show', $reportage) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('reportages.edit', $reportage) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reportage->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    
                    <!-- Modal de suppression -->
                    <div class="modal fade" id="deleteModal{{ $reportage->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmation de suppression</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer le reportage "{{ $reportage->titre }}" ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <form action="{{ route('reportages.destroy', $reportage) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Aucun reportage trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $reportages->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
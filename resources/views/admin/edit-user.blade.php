@extends('layouts.app')

@section('title', 'Modifier utilisateur')

@section('content')
<div class="card">
    <div class="card-header warning-color white-text">
        <h4><i class="fas fa-user-edit"></i> Modifier l'utilisateur</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="md-form">
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                        <label>Nom complet</label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="md-form">
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                        <label>Email</label>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="md-form">
                <select name="role" class="browser-default custom-select">
                    <option value="">Choisir un rôle</option>
                    <option value="visiteur" {{ old('role', $user->role) == 'visiteur' ? 'selected' : '' }}>Visiteur</option>
                    <option value="journaliste" {{ old('role', $user->role) == 'journaliste' ? 'selected' : '' }}>Journaliste</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
                @error('role')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning">Mettre à jour</button>
            <a href="{{ route('admin.users') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
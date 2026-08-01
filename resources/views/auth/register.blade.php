<x-guest-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-success text-white text-center py-4 rounded-top-4">
                        <h3 class="mb-0"><i class="fas fa-tv me-2"></i>JT Manager</h3>
                        <p class="mb-0 small">Créez votre compte</p>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-user me-2"></i>Nom complet
                                </label>
                                <input id="name" type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    name="name" value="{{ old('name') }}" 
                                    required autofocus placeholder="Votre nom">
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input id="email" type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" 
                                    required placeholder="exemple@email.com">
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">
                                    <i class="fas fa-lock me-2"></i>Mot de passe
                                </label>
                                <input id="password" type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required placeholder="••••••••">
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-bold">
                                    <i class="fas fa-check-circle me-2"></i>Confirmer le mot de passe
                                </label>
                                <input id="password_confirmation" type="password" 
                                    class="form-control" 
                                    name="password_confirmation" required placeholder="••••••••">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>S'inscrire
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <a class="text-primary small" href="{{ route('login') }}">
                                    Déjà un compte ? <strong>Connectez-vous</strong>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
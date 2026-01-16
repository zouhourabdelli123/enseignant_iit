<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="{{ asset('js/login.js') }}" defer></script>

    <div class="container">
        <div class="login-grid">
            <div class="hero-section">
                <div class="hero-content">
                    <div class="hero-badge">
                        <div class="hero-icon">IIT</div>
                        <span class="hero-badge-text">Espace Enseignant</span>
                    </div>

                    <h1 class="hero-title">Institut International<br>Technologie</h1>

                    <p class="hero-description">
                        Plateforme moderne pour la gestion de vos cours, le partage de ressources pédagogiques et le suivi de vos étudiants.
                    </p>

                    <div class="hero-features">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            Accès à tous vos cours et documents
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            Suivi en temps réel des activités
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            Sécurité et confidentialité garanties
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-header">
                    <h2 class="form-title">Connexion</h2>
                    <p class="form-subtitle">Entrez vos identifiants pour accéder à votre espace personnel</p>
                </div>

                @if (session('status'))
                    <div class="alert-success">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Adresse email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            class="form-input @error('email') is-invalid @enderror"
                            placeholder="nom.prenom@iit.tn"
                        >
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            class="form-input @error('password') is-invalid @enderror"
                            placeholder="Entrez votre mot de passe"
                        >
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-options">
                        <div class="checkbox-wrapper">
                            <input class="checkbox-input" type="checkbox" name="remember" id="remember_me">
                            <label class="checkbox-label" for="remember_me">Se souvenir de moi</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="submit-btn">
                        Se connecter
                    </button>
                </form>

                <div class="form-footer">
                    <p class="footer-text">© 2024 Institut International Technologie</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

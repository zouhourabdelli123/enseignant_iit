<header class="app-header">
    <div class="header-left">
        <button class="menu-toggle" id="menuToggle" aria-label="Ouvrir le menu">
            <i class="fas fa-bars"></i>
        </button>

        <div class="brand" id="logoHeader">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
        </div>

        <div class="date-display">
            <i class="fas fa-calendar-alt"></i>
            <span id="current-date">{{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('l d F Y') }}</span>
            <span class="date-sep">-</span>
            <i class="fas fa-clock"></i>
            <span id="current-time">{{ \Carbon\Carbon::now()->format('H:i') }}</span>
        </div>
    </div>

    <div class="header-right">
      

        <div class="user-profile" id="userProfile">
            <div class="user-avatar">AB</div>
            <div class="user-info">
                <h4>M(me).{{ auth()->user()->nom }}</h4>
            </div>
            <i class="fas fa-chevron-down"></i>

            <div class="user-dropdown" id="userDropdown">
                <div class="dropdown-header">
                    <div class="dropdown-avatar">AB</div>
                    <div>
                        <p class="dropdown-name">M(me).{{ auth()->user()->nom }}</p>
                        <p class="dropdown-email">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user"></i>
                    <span>Mon Profil</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-cog"></i>
                    <span>Parametres</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-bell"></i>
                    <span>Notifications</span>
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item logout-item">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Deconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    // User dropdown toggle
    (function () {
        const userProfile = document.getElementById('userProfile');
        const userDropdown = document.getElementById('userDropdown');

        if (userProfile && userDropdown) {
            userProfile.addEventListener('click', function (e) {
                e.stopPropagation();
                userDropdown.classList.toggle('show');
                console.log('Dropdown toggled:', userDropdown.classList.contains('show'));
            });

            document.addEventListener('click', function (e) {
                if (!userProfile.contains(e.target)) {
                    userDropdown.classList.remove('show');
                }
            });

            userDropdown.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        } else {
            console.error('User profile or dropdown not found');
        }
    })();
</script>

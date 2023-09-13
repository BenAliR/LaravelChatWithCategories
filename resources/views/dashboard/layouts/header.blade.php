<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/"><i class="bi bi-house-door-fill"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ (request()->is('posts*')) ? 'active' : '' }}" href="/dashboard/chatgroups" data-bs-toggle="tooltip" title="Voir les groupes"><i class="bi bi-people-fill"></i> Groupes</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ (request()->is('categories*')) ? 'active' : '' }}" href="/dashboard/categories" data-bs-toggle="tooltip" title="Voir les catégories"><i class="bi bi-card-list"></i> Catégories</a>
                    </li>
                @endauth
            </ul>

            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-fill"></i> Bon retour, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> Mon tableau de bord</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Se déconnecter</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item mx-2">
                        <a href="/login" class="nav-link {{ (request()->is('login*')) ? 'active' : '' }}" data-bs-toggle="tooltip" title="Se connecter"><i class="bi bi-box-arrow-in-right"></i> Se connecter</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<script src="
https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js
"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Initialiser le composant infobulle
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

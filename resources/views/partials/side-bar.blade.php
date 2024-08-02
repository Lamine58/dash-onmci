<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset(env('LOGO'))}}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{asset(env('LOGO'))}}" alt="" width="120">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset(env('LOGO'))}}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{asset(env('LOGO'))}}" alt="" width="90">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route("dashboard")}}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route("dashboard")}}">
                        <i class="ri-group-line"></i> <span data-key="t-dashboards">Membres</span>
                    </a>
                </li>
                @if(Auth::user()->permission('LISTE PROJET') || Auth::user()->permission('AJOUT PROJET'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#project" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="project">
                            <i class="ri-information-line"></i> <span data-key="t-authentication">Projets</span>
                        </a>
                        <div class="collapse menu-dropdown" id="project">
                            <ul class="nav nav-sm flex-column" >
                                @if(Auth::user()->permission("AJOUT PROJET"))
                                    <li class="nav-item">
                                        <a href="{{route("project.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter un projet </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission("LISTE PROJET"))
                                    <li class="nav-item">
                                        <a href="{{route("project.index")}}" class="nav-link" data-key="t-calendar"> Listes projets  </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#event" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="event">
                        <i class="ri-mic-line"></i> <span data-key="t-authentication">Evènements</span>
                    </a>
                    <div class="collapse menu-dropdown" id="event">
                        <ul class="nav nav-sm flex-column" >
                            @if(Auth::user()->permission("AJOUT TYPE D'ASSURANCE"))
                                <li class="nav-item">
                                    <a href="{{route("insurance-type.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter un type d'assurance </a>
                                </li>
                            @endif
                            @if(Auth::user()->permission("LISTE TYPE D'ASSURANCE"))
                                <li class="nav-item">
                                    <a href="{{route("insurance-type.index")}}" class="nav-link" data-key="t-calendar"> Liste type d'assurance  </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @if(Auth::user()->permission('LISTE ACTUALITE') || Auth::user()->permission('AJOUT ACTUALITE'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#blog" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="blog">
                            <i class="ri-information-line"></i> <span data-key="t-authentication">Actualités</span>
                        </a>
                        <div class="collapse menu-dropdown" id="blog">
                            <ul class="nav nav-sm flex-column" >
                                @if(Auth::user()->permission("AJOUT ACTUALITE"))
                                    <li class="nav-item">
                                        <a href="{{route("blog.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter une actualité </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission("LISTE ACTUALITE"))
                                    <li class="nav-item">
                                        <a href="{{route("blog.index")}}" class="nav-link" data-key="t-calendar"> Listes actualités  </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route("dashboard")}}">
                        <i class="ri-bank-card-2-line"></i> <span data-key="t-dashboards">Historique de paiement</span>
                    </a>
                </li>

                @if(Auth::user()->permission('MEDIATHEQUE'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route("mediateque.index")}}">
                            <i class="ri-image-add-line"></i> <span data-key="t-dashboards">Médiatèques</span>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#pages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="pages">
                        <i class="ri-earth-line"></i> <span data-key="t-authentication">Pages du site</span>
                    </a>
                    <div class="collapse menu-dropdown" id="pages">
                        <ul class="nav nav-sm flex-column" >
                            @if(Auth::user()->permission("AJOUT TYPE D'ASSURANCE"))
                                <li class="nav-item">
                                    <a href="{{route("insurance-type.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter un type d'assurance </a>
                                </li>
                            @endif
                            @if(Auth::user()->permission("LISTE TYPE D'ASSURANCE"))
                                <li class="nav-item">
                                    <a href="{{route("insurance-type.index")}}" class="nav-link" data-key="t-calendar"> Liste type d'assurance  </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>

                @if(Auth::user()->permission('CONFIGURATION SITE'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route("setting.index")}}">
                            <i class="ri-settings-3-line"></i> <span data-key="t-dashboards">Configuration du site</span>
                        </a>
                    </li>
                @endif
                
                @if(Auth::user()->permission('AJOUT UTILISATEUR') || Auth::user()->permission('LISTE UTILISATEUR') || Auth::user()->permission('LISTE ROLE') || Auth::user()->permission('LISTE PERMISSION'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                            <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Utilisateurs</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAuth">
                            <ul class="nav nav-sm flex-column" >
                                @if(Auth::user()->permission('AJOUT UTILISATEUR'))
                                    <li class="nav-item">
                                        <a href="{{route("user.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission('LISTE UTILISATEUR'))
                                    <li class="nav-item">
                                        <a href="{{route("user.index")}}" class="nav-link" data-key="t-calendar"> Liste </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission('LISTE ROLE'))
                                    <li class="nav-item">
                                        <a href="{{route("role.index")}}" class="nav-link" data-key="t-calendar"> Rôles </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission('LISTE PERMISSION'))
                                    <li class="nav-item">
                                        <a href="{{route("permission.index")}}" class="nav-link" data-key="t-calendar"> Permissions </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>

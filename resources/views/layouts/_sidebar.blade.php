<nav class="navbar navbar-vertical navbar-expand-lg" th:fragment="sidebar" for="sidebar">
    <script>
        var navbarStyle = window.config.config.phoenixNavbarStyle;
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">

                {{-- MENU HOME --}}
                <div class="nav-item-wrapper">
                    <a class="nav-link label-1" href="/home">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon text-primary">
                                <span data-feather="home">
                            </span>
                            <span class="nav-link-text-wrapper">
                                <span class="nav-link-text">Home</span>
                            </span>
                        </div>
                    </a>
                </div>

                {{-- MENU CADASTROS --}}
                <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#multi-level" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="multi-level">
                    <div class="d-flex align-items-center">
                        <div class="dropdown-indicator-icon">
                            <span class="fas fa-caret-right icon-menu"></span>
                        </div>
                        <span class="nav-link-icon">
                            <span data-feather="save" class="icon-menu">
                        </span>
                        <span class="nav-link-text">Cadastros</span>
                    </div>
                  </a>
                  <div class="parent-wrapper label-1">
                    <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="multi-level">
                        <li class="collapsed-nav-item-title d-none">Cadastros</li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-indicator" href="{{ route('sector_list') }}">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon">
                                        <span class="far fa-address-card icon-menu"></span>
                                    </div>
                                    <span class="nav-link-text">Setor</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-indicator" href="{{ route('classification_list') }}">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon">
                                        <span class="fas fa-list-ol icon-menu"></span>
                                    </div>
                                    <span class="nav-link-text">Classificação</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-indicator" href="{{ route('checklist_list') }}">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon">
                                        <span class="fas fa-tasks icon-menu"></span>
                                    </div>
                                    <span class="nav-link-text">Checklist</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-indicator" href="{{ route('users_group_list') }}">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon">
                                        <span class="fas fa-users icon-menu"></span>
                                    </div>
                                    <span class="nav-link-text">Grupo Usuários</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-indicator" href="{{ route('unity_list') }}">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon">
                                        <span class="far fa-building icon-menu"></span>
                                    </div>
                                    <span class="nav-link-text">Unidade</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-indicator" href="{{ route('user_list') }}">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon">
                                        <span class="far fa-user icon-menu"></span>
                                    </div>
                                    <span class="nav-link-text">Usuário</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                  </div>
                </div>

                {{-- MENU RELATÓRIOS --}}
                <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#multi-level1" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="multi-level">
                    <div class="d-flex align-items-center">
                        <div class="dropdown-indicator-icon">
                            <span class="fas fa-caret-right icon-menu"></span>
                        </div>
                        <span class="nav-link-icon">
                            <i class="fas fa-cogs icon-menu"></i>
                        </span>
                        <span class="nav-link-text">Gerenciar</span>
                    </div>
                  </a>
                  <div class="parent-wrapper label-1">
                    <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="multi-level1">
                        <li class="collapsed-nav-item-title d-none">Gerenciar</li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-indicator" href="{{ route('manage_tasks') }}">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon">
                                        <span class="fas fa-play icon-menu fs--3"></span>
                                    </div>
                                    <span class="nav-link-text">Tarefas</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                  </div>
                </div>




                

            </ul>
        </div>
    </div>

    <div class="navbar-vertical-footer" style="height:40px !important;">
        <button
            class="btn navbar-vertical-toggle border-0 fw-semi-bold w-100 white-space-nowrap d-flex align-items-center">
            <span class="uil uil-left-arrow-to-left fas fa-angle-double-left fs-0"></span>
            <span class="uil uil-arrow-from-right fas fa-angle-double-right fs-0"></span>
            <span class="navbar-vertical-footer-text ms-2">Minimizar Menu</span>
        </button>
    </div>
</nav>

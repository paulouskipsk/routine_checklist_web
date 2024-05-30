<nav class="navbar navbar-top navbar-expand" id="navbarDefault" th:fragment="navbar" for="navbar-top">
    <div class="collapse navbar-collapse justify-content-between">
        <div class="navbar-logo">

            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="index.html">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/logo.png') }}" width="27" />
                        <p class="logo-text ms-2 d-none d-sm-block">Routine</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- ITENS MENU RIGHT NAVBAR -->
        <ul class="navbar-nav navbar-nav-icons flex-row">
            <li class="nav-item">
                
                <label id="btn-back" class="mb-0 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="left" title="Voltar">
                    <span class="fas fa-arrow-alt-circle-left fs-2 text-primary"></span>
                </label>
                
                <label id="btn-pdf" class="mb-0 cursor-pointer mx-2" data-bs-toggle="tooltip" data-bs-placement="left" title="Baixar em PDF">
                    <span class="far fa-file-pdf fs-2 text-danger mx-1"></span>
                </label>
                
                <div class="theme-control-toggle fa-icon-wait px-1">
                    <input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" />
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme">
                        <span class="far fa-file-pdf" data-feather="moon"></span>
                    </label>
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme">
                        <span class="icon" data-feather="sun"></span>
                    </label>
                </div>
            </li>

            <!-- MENU USER -->
            <li class="nav-item dropdown">
                <a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-l ">
                        <i class="rounded-circle far fa-user fs-1 mt-2"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300" aria-labelledby="navbarDropdownUser">
                    <div class="card position-relative border-0">
                        <div class="card-body p-0">
                            <div class="text-center pt-4 pb-3">
                                <div class="avatar avatar-xl ">
                                    <i class="rounded-circle fas fa-user-circle fs-4 mt-2"></i>
                                </div>
                                <h6 class="mt-2 text-black">{{Auth::user()->name." ". Auth::user()->lastname}}</h6>
                            </div>
                        </div>

                        <div class="overflow-auto scrollbar">
                            <ul class="nav d-flex flex-column mb-2 pb-1">
                                <li class="nav-item">
                                    <a class="nav-link px-3" href="#!">
                                        <span class="me-2 text-900" data-feather="user"></span>
                                        <span>Profile</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3" href="#!">
                                        <span class="me-2 text-900" data-feather="pie-chart"></span>Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3" href="#!">
                                        <span class="me-2 text-900" data-feather="lock"></span>Posts
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-footer p-0 border-top">
                            <ul class="nav d-flex flex-column my-1">
                                <li class="nav-item">
                                    <a class="nav-link px-3" href="#!">
                                        <span class="me-1 text-900" data-feather="settings"></span>Settings
                                    </a>
                                </li>
                            </ul>

                            <hr class="p-0 m-0" />

                            <div class="px-3 mt-3">
                                <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="/logout">
                                    <span class="me-2" data-feather="log-out"> </span>Sair do Sistema
                                </a>
                            </div>

                            <div class="my-2 text-center fw-bold fs--2 text-600">
                                <a class="text-600 me-1" href="#!">Privacy policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-top navbar-expand" id="navbarDefault" th:fragment="navbar" for="navbar-top">
    <div class="collapse navbar-collapse justify-content-between">
        <div class="navbar-logo">

            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="/home">
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
                <div class="theme-control-toggle fa-icon-wait px-2">
                    <input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" />
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme">
                        <span class="icon" data-feather="moon"></span>
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
                                    {{-- <img class="rounded-circle " src="{{ asset('vendors/template/assets/img/team/72x72/57.webp') }}" alt="" /> --}}
                                    <i class="rounded-circle fas fa-user-circle fs-4 mt-2"></i>
                                </div>
                                <h6 class="mt-2 text-black">{{Auth::user()->name." ". Auth::user()->lastname}}</h6>
                            </div>
                        </div>

                        <div class="card-footer p-0 border-top mb-2">

                            <div class="px-3 mt-3">
                                <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="app/download">
                                    <span class="text-success">
                                        <i class="me-2 fa-brands fa-android"></i>
                                        Download do APP Android
                                    </span>
                                   
                                </a>
                            </div>

                           
                            <div class="px-3 mt-3">
                                <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="/logout">
                                    <span class="text-danger"> 
                                        <i class="me-2 fa-solid fa-right-from-bracket"></i>
                                        Sair do Sistema
                                    </span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
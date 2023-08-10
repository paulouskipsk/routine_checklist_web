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

            <!-- NOTIFICATION -->
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">
                    <span data-feather="bell" style="height:20px;width:20px;"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret" id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                    <div class="card position-relative border-0">

                        <div class="card-header p-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="text-black mb-0">Notificatons</h5>
                                <button class="btn btn-link p-0 fs--1 fw-normal" type="button">Mark all as read</button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="scrollbar-overlay" style="height: 27rem;">
                                <div class="border-300">
                                    <div class="px-2 px-sm-3 py-3 border-300 notification-card position-relative read border-bottom">
                                        <div class="d-flex align-items-center justify-content-between position-relative">
                                            <div class="d-flex">
                                                <div class="avatar avatar-m status-online me-3">
                                                    <img class="rounded-circle" src="{{ asset('vendors/template/assets/img/team/40x40/30.webp') }}" alt="" />
                                                </div>

                                                <div class="flex-1 me-sm-3">
                                                    <h4 class="fs--1 text-black">Jessie Samson</h4>
                                                    <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal">
                                                        <span class='me-1 fs--2'>💬</span>Mentioned you in a
                                                        comment.
                                                        <span class="ms-2 text-400 fw-bold fs--2">10m</span>
                                                    </p>
                                                    <p class="text-800 fs--1 mb-0">
                                                        <span class="me-1 fas fa-clock"></span>
                                                        <span class="fw-bold">10:41 AM </span>August 7,2021
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="font-sans-serif d-none d-sm-block">
                                                <button class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle" type="button" data-stop-propagation="data-stop-propagation" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                                    <span class="fas fa-ellipsis-h fs--2 text-900"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end py-2">
                                                    <a class="dropdown-item" href="#!">Mark as unread</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer p-0 border-top border-0">
                            <div class="my-2 text-center fw-bold fs--2 text-600">
                                <a class="fw-bolder" href="pages/notifications.html">Notification history</a>
                            </div>
                        </div>
                    </div>
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
                                <h6 class="mt-2 text-black">Jerry Seinfield</h6>
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
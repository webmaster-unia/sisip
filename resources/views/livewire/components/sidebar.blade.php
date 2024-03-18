<aside class="navbar navbar-vertical navbar-expand-lg">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand">
            <a href="" class="d-flex align-items-center justify-content-center gap-2">
                <img src="{{ asset('static/logo-unia.webp') }}" alt="Logo Unia" class="navbar-brand-image">
                <span class="text-uppercase" style="font-weight: 800; font-size: 2rem">
                    OTI
                </span>
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a style="cursor: pointer;" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <img src="{{ $user->avatar ? asset($user->avatar) : $user->avatar }}" alt="avatar"
                        class="avatar avatar-sm">
                    <div class="d-none d-xl-block ps-2">
                        <div>
                            {{ $user->name }}
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a class="dropdown-item" wire:click="logout" style="cursor: pointer;">
                        Cerrar sesión
                    </a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <div class="d-flex justify-content-center mt-3 flex-column align-items-center">
                <img src="{{ $user->avatar ? asset($user->avatar) : $user->avatar }}" alt="avatar"
                    class="avatar avatar-lg ms-3">
                <span class="fw-bold fs-3 mt-3 text-center ms-3">
                    {{ $user->name }}
                </span>
                <div class="mt-3 w-full ps-3">
                    <span class="badge bg-cyan-lt px-3 py-2 w-100">
                        asdasd
                    </span>
                </div>
                <div class="mt-2 mb-4 mb-lg-0 w-full ps-3">
                    <a href="?theme=dark" class="btn w-100 hide-theme-dark mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                        </svg>
                    </a>
                    <a href="?theme=light" class="btn w-100 hide-theme-light mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path
                                d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                        </svg>
                    </a>
                    <button type="button" class="btn w-100" wire:click="logout">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 12l10 0"></path>
                            <path d="M10 12l4 4"></path>
                            <path d="M10 12l4 -4"></path>
                            <path d="M4 4l0 16"></path>
                        </svg>
                        Cerrar sesión
                    </button>
                </div>
            </div>
            <ul class="navbar-nav pt-lg-3">
                <hr class="ms-lg-3 mt-2 mb-3">
                <li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('configuracion.usuario.index') || request()->routeIs('configuracion.rol.index') || request()->routeIs('configuracion.permiso.index') ? 'active' : '' }} dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="true">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                </path>
                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Configuración
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ request()->routeIs('configuracion.usuario.index') || request()->routeIs('configuracion.rol.index') || request()->routeIs('configuracion.permiso.index') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ request()->routeIs('configuracion.usuario.index') ? 'active fw-medium' : '' }}"
                                    href="{{ route('configuracion.usuario.index') }}">
                                    Usuarios
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ request()->routeIs('configuracion.rol.index') ? 'active fw-medium' : '' }}"
                                    href="{{ route('configuracion.rol.index') }}">
                                    Roles
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ request()->routeIs('configuracion.permiso.index') ? 'active fw-medium' : '' }}"
                                    href="{{ route('configuracion.permiso.index') }}">
                                    Permisos
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <hr class="ms-lg-3 my-3">
            </ul>
        </div>
    </div>
</aside>

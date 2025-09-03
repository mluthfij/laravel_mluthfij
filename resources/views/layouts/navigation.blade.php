<nav x-data="{ open: false }" class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('hospitals.index') }}">
            <x-application-logo class="d-block" style="height: 36px; width: auto;" />
        </a>

        <!-- Mobile toggle button -->
        <button @click="open = ! open" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link{{ request()->routeIs('hospitals.index') ? ' active' : '' }}" href="{{ route('hospitals.index') }}">
                        {{ __('Hospitals') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->routeIs('patients.index') ? ' active' : '' }}" href="{{ route('patients.index') }}">
                        {{ __('Patients') }}
                    </a>
                </li>
            </ul>

            <!-- User Dropdown -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Mobile Navigation Menu -->
        <div :class="{'show': open, 'd-none': ! open}" class="d-lg-none position-absolute w-100 bg-white border-top" style="top: 100%; left: 0; z-index: 1000;">
            <div class="container py-3">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link{{ request()->routeIs('hospitals.index') ? ' active' : '' }}" href="{{ route('hospitals.index') }}">
                                    {{ __('Hospitals') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{ request()->routeIs('patients.index') ? ' active' : '' }}" href="{{ route('patients.index') }}">
                                    {{ __('Patients') }}
                                </a>
                            </li>
                        </ul>
                        
                        <hr class="my-3">
                        
                        <div class="px-3 mb-3">
                            <div class="fw-bold text-dark">{{ Auth::user()->name }}</div>
                            <div class="text-muted small">{{ Auth::user()->email }}</div>
                        </div>
                        
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link text-start p-0 w-100">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

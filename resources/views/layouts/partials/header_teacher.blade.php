    <!--start top header-->
    <header class="top-header">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-icon fs-3">
                <i class="bi bi-list"></i>
            </div>
            {{-- <form class="searchbar">
                <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i>
                </div>
                <input class="form-control" type="text" placeholder="Search Bar">
                <div class="position-absolute top-50 translate-middle-y search-close-icon"><i class="bi bi-x-lg"></i>
                </div>
            </form> --}}
            <div class="top-navbar-right ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown dropdown-user-setting">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                            data-bs-toggle="dropdown">
                            <div class="user-setting d-flex align-items-center">
                                <img src="{{ asset('admin/assets/images/avatars/avatar-1.png') }}" class="user-img"
                                    alt="">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('admin/assets/images/avatars/avatar-1.png') }}"
                                            alt="" class="rounded-circle" width="54" height="54">
                                        <div class="ms-3">
                                            @php
                                                $user = auth()->user()
                                            @endphp
                                            <h6 class="mb-0 dropdown-user-name">{{ $user->name }}</h6>
                                            <small class="mb-0 dropdown-user-designation text-secondary">
                                                {{ $user->role == 1 ? 'مسؤول' : 'مدرب' }}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('teacher.edit', $user->id) }}">
                                    <div class="d-flex align-items-center">
                                        <div class=""><i class="bi bi-person-fill"></i></div>
                                        <div class="ms-3"><span>تغيير كلمة المرور</span></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <div class="d-flex align-items-center">

                                        <div class=""><i class="lni lni-exit"></i></div>
                                        <div class="ms-3"><span>تسجيل الخروج</span></div>
                                    </div>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>


                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--end top header-->

<nav class="sb-topnav navbar navbar-expand " style="z-index: 10;">


    <ul class=" navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <!-- show username -->
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" style="text-align: center;">
                <img src="{{ asset('img/user.png') }}" alt="" style="width: 30%; border-radius: 50px;">
                <br>{{ Auth::user()->name }}
                <br>{{ Auth::user()->roles->first()->name }}
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    Edit Profile
                </a>
                <a class="dropdown-item" href="{{ route('password.edit') }}">
                    Change Password
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Log Out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<!-- <li class="profile">
        <div class="profile-details">
            <div class="name_job">
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="job">{{ Auth::user()->roles->first()->name }}</div>
            </div>

        </div>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class='bx bx-log-out' id="log_out"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </li> -->
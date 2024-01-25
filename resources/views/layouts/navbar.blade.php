<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">LifeFlow-Hub</span>
    </a>
    <ul class="side-menu top">
        <li class="{{ request()->routeIs('index.dashboard') ? 'active' : '' }}">
            <a href="{{ route('index.dashboard') }}">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('index.spending') ? 'active' : '' }}">
            <a href="{{ route('index.spending') }}">
                <i class='bx bxs-dollar-circle'></i>
                <span class="text">Pengurus Perbelanjaan</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class='bx bxs-doughnut-chart'></i>
                <span class="text">Analytics</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class='bx bxs-message-dots'></i>
                <span class="text">Message</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class='bx bxs-group'></i>
                <span class="text">Team</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="logout" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class='bx bxs-log-out-circle'></i>
                        <span class="text">Logout</span>
                    </a>
            @endif
            </form>
        </li>
    </ul>
</section>

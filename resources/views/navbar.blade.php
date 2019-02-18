<nav style="background: green">
  <div class="nav-wrapper">
    <a href="#" class="brand-logo" style="margin-left:20px;font-size:25px">Pasiklaban sa Silangan</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li class="{{ $active == 'dashboard' ? 'active' : '' }}"><a class="dropdown-trigger" href="{{ url('dashboard') }}">Dashboard</a></li>
      <li class="{{ $active == 'scanner' ? 'active' : '' }}"><a href="{{ url('/scanner') }}">Scanner</a></li>
      <li class="{{ $active == 'logged' ? 'active' : '' }}"><a href="{{ url('/logged') }}">Logged List</a></li>
      <li class="{{ $active == 'raffle' ? 'active' : '' }}"><a href="{{ url('/raffle') }}">Raffle</a></li>
      <li class="{{ $active == 'logs' ? 'active' : '' }}"><a href="{{ url('/logs') }}">Logs</a></li>
      <li><a href="{{ url('/logout') }}" onclick="return confirm('Are you sure do you want to logout?')">Logout</a></li>
    </ul>
  </div>
</nav>\

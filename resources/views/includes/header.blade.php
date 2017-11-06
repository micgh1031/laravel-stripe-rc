<div id="header">
  <nav id="navigation" class="navbar scrollspy">
    <div class="container">
      <div class="navbar-brand">
        <a href="{{ url('/') }}"><img src="{{ asset('images/SolidBlueBrain.png') }}" alt="Logo"><strong>| ThrowSmart</strong></a> <!-- site logo -->
      </div>
      @auth
        <button class="navigation-toggle navbar-right">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </button>
      @endauth
    </div>
  </nav>
</div>

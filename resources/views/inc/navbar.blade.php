<nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
    
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
    
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
    
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>
    
                <ul class="nav navbar-nav">
                  <li><a href="/">Home</a></li>
                  <li><a href="#">Lorem</a></li>
                  <li><a href="#">Ipsum</a></li>
                </ul>
                
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                    <li class="dropdown">
                        <a  href="#" class="dropdown-toggle"  data-toggle="dropdown" role="button" aria-expanded="false">
                            Clock in <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                        @if($timer->working_seconds == 0)
                    <!-- clock in -->
                                <li id='clock_in'><a href='#' onclick='clock_in()'>Start day</a></li>
                        @elseif($timer->pause == 1)
                                <li id='stop-timer1'><a href='#' onclick='clock_out()'>Clock out</a></li>
                                <li id='clock_in'><a href='#' onclick='continue_clock()'>Continue</a></li>
                        @else
                                <li id='stop-timer1'><a href='#' onclick='clock_out()'>Clock out</a></li>
                                <li id='stop-timer2'><a href='#' onclick='pause_day()'>Pause</a></li>
                        @endif
                        <li><a href="#">Working day duation:<span id="wd-duration">{{$timer->working_seconds}}</span></a></li>
                        </ul> 
                    </li>



                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
    
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/dashboard">Dashboard</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
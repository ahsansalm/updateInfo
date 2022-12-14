<h1 class="topicon">I</h1>
<header class="main-header " id="header">

    <nav class="navbar navbar-static-top navbar-expand-lg">
    
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
        <i class="fa fa-align-justify"></i>
        <span class="sr-only">Toggle navigation</span>
        </button>
        <!-- search form -->
        <div class="search-form d-none d-lg-inline-block">
        <div class="input-group">
            <button type="button" name="search" id="search-btn" class="btn btn-flat">
            </button>
        </div>
        <div id="search-results-container">
            <ul id="search-results"></ul>
        </div>
        </div>

        <div class="navbar-right ">

        <ul class="nav navbar-nav">

        


        

            <!-- User Account -->
           
            <li class="dropdown user-menu">
            <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="d-none d-lg-inline-block">{{auth()->user()->name}}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <!-- User image -->
                <li class="dropdown-header">
                <img src="../../../{{auth()->user()->profile->photo}}"style="height:50px;" class="img-circle" >
                <div class="d-inline-block">
                {{auth()->user()->name}} <small class="pt-1">{{auth()->user()->email}}</small>
                </div>
                </li>

                <li>
                <a href="{{url('/MyProfile')}}">
                    <i class="mdi mdi-account"></i> Mon profil
                </a>
                </li>

                <li class="dropdown-footer">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="mdi mdi-logout"></i>
                        {{ __('Se déconnecter') }}
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
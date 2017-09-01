<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand logo" href={{ Auth::check() &&  Auth::user()->is_admin ? '/admin/dashboard' : '/dashboard'}}>Jiri</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    @if(Auth::check())
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="navbar-right">



            </div>

          <ul class="nav navbar-nav navbar-right">
              <li><a href="">Étudiants</a></li>
              <li><a href="">Jurys</a></li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{
                        Auth::user()->name }}
                        <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li>
                        {!! Form::open( ["url" => "/logout", "class" => "form-logout navbar-form"] ) !!}

                            <div>
                                <button type="submit" class="btn btn-default">Se déconnecter</button>
                            </div>

                        {!! Form::close() !!}
                    </li>
                  </ul>
              </li>


  </button>
          </ul>
        </div><!-- /.navbar-collapse -->
    @endif
  </div><!-- /.container-fluid -->
</nav>

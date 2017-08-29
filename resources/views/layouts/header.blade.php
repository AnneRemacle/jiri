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
      <a class="navbar-brand" href={{ Auth::user()->is_admin ? '/admin/dashboard' : '/dashboard'}}>Jiri</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    @if(Auth::check())
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="navbar-right">

                {!! Form::open( ["url" => "/logout", "class" => "form-logout navbar-form"] ) !!}

                    <div>
                        <button type="submit" class="btn btn-default">Se déconnecter</button>
                    </div>

                {!! Form::close() !!}
            </div>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">{{ Auth::user()->name }}</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
    @endif
  </div><!-- /.container-fluid -->
</nav>

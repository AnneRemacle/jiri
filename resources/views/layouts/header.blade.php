<header class="header">
    <h1 class="header__title">
        <a href="/dashboard">Jiri</a>
    </h1>
    <div class="header__user">
        <p class="header__user--name">{{ $user->name }}</p>
        {!! Form::open( ["url" => "/logout", "class" => "form-logout"] ) !!}

            <div>
                <button type="submit" class="btn btn-default">Se déconnecter</button>
            </div>

        {!! Form::close() !!}
    </div>
</header>

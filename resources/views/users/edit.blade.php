@extends( "layouts.template" )

@section( "title", "Modifier un utilisateur" )
@include("layouts.header")
@section( "content" )
    <section class="container">
        <h2 class="page-header title">
            Modifier l'utilisateur&nbsp;: {{ $user->name }}
            <a href="{{ route("users.index") }}" class="btn-sm btn green pull-right">Retour</a>
        </h2>
        @if ($errors->any())
            <div class="alert alert-danger col-sm-8 col-md-offset-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include("users.forms.edit")
    </section>
@endsection

@extends('base')

@section('main')

    <div class="login-container">

        <form class="ui form login-form" method="post" action="auth">
            @csrf
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="name" id="name" placeholder="Nom d'utilisateur"/>
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" id="password" placeholder="Mot de passe"/>
                    </div>
                </div>
                <button class="ui fluid large teal submit button" type="submit">Se connecter</button>
            </div>

            @if ($errors->any())
                <div class="ui error message">
                    <i class="close icon"></i>
                    <div class="header">
                        Il y avait quelques erreurs avec votre soumission
                    </div>
                    <ul class="list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br/>
            @endif

            @if(session()->get('success'))
                <div class="ui message success">
                    <div class="header">
                        Information !
                    </div>
                    <p>{{ session()->get('success') }}</p>
                </div>
            @endif

            @if(session()->get('error'))
                <div class="ui message negative">
                    <div class="header">
                        Erreur !
                    </div>
                    <p>{{ session()->get('error') }}</p>
                </div>
            @endif
        </form>

    </div>

    {{--<div style="height: 100%; background-color: #616161;">
        <div class="ui grid container">
            <div class="ui seven wide column centered middle aligned">
                <form class="ui large form">
                    <div class="ui stacked segment">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="name" id="name" placeholder="Nom d'utilisateur"/>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" id="password" placeholder="Mot de passe"/>
                            </div>
                        </div>
                        <div class="ui fluid large teal submit button">Se connecter</div>
                    </div>

                    <div class="ui error message"></div>

                </form>
            </div>
        </div>
    </div>--}}


@endsection

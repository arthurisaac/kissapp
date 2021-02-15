@extends('base')

@section('main')

    <br>
    <br>
    <div class="ui container">

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
            <div class="ui message positive">
                <div class="header">
                    Information !
                </div>
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif

        @if(session()->get('error'))
            <div class="ui message negative ">
                <div class="header">
                    Erreur !
                </div>
                <p>{{ session()->get('error') }}</p>
            </div>
        @endif


        <button onclick="window.history.back()" class="ui button primary"><i class="icon chevron left"></i>Retour
        </button>
        <br>
        <br>

        <h1>Nouvel utilisateur</h1>
        <br>
        <div class="ui grid">
            <div class="row">
                <div class="ten wide column">
                    <div class="ui segment">
                        <form action="{{ route('utilisateurs.store') }}" method="post" class="ui form">
                            @csrf

                            <br>
                            <div class="field">
                                <label for="name">Nom d'utilisateur *</label>
                                <input type="text" placeholder="Nom de l'utisateur" name="name" id="name" required>
                            </div>
                            <div class="field">
                                <label for="email">Adresse email *</label>
                                <input type="email" placeholder="Adresse email" name="email" id="email" required>
                            </div>
                            <div class="field">
                                <label for="password">Mot de passe *</label>
                                <input type="password" placeholder="Mot de passe" name="password" id="password" required minlength="6">
                            </div>
                            <div class="field">
                                <label for="role">Role</label>
                                <select id="role" name="role" class="ui search dropdown" required>
                                    <option></option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->role}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <br>
                            <button class="ui button primary" type="submit">Enregistrer</button>
                        </form>
                    </div>
                </div>
                <div class="six wide column">
                    <div class="ui segment">
                        <h2>Rôles</h2>
                        <form action="{{route('roles.store')}}" method="post" class="ui form">
                            @csrf
                            <div class="field">
                                <label for="roleNew">Nouveau role</label>
                                <input type="text" placeholder="Intitulé du role" name="role" id="roleNew">
                            </div>
                            <button class="ui button primary">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('select').dropdown();
        });

    </script>

@endsection

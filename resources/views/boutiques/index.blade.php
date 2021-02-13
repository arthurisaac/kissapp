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
            <div class="ui message success">
                <div class="header">
                    Information !
                </div>
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif

        @if(session()->get('error'))
            <div class="ui message">
                <div class="header">
                    Erreur !
                </div>
                <p>{{ session()->get('error') }}</p>
            </div>
        @endif


        <a href="{{route('boutiques.create')}}" class="ui button primary"><i class="icon add"></i> Ajouter une boutique</a>
        <br>
        <br>

        <div class="ui grid">
            <div class="row">
                <div class="column">

                    <div class="ui link cards">
                        @foreach($boutiques as $boutique)
                            <div class="card" onclick="window.location.href = '{{route('boutiques.show', $boutique->id)}}', '{{$boutique->libelle}}' ">
                                <div class="content">
                                    <div class="header">{{$boutique->libelle}}</div>
                                    <div class="meta">
                                        <a>{{$boutique->adresse}}</a>
                                    </div>
                                    {{--<div class="description">
                                    </div>--}}
                                </div>
                                <div class="extra content"><span class="right floated"></span>
                                    <span><i class="user icon"></i></span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

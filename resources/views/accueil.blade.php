@extends('base')

@section('main')

    <div class="ui container">
        <div class="ui grid">
            <div class="four wide column">
                <a href="javascript:popup('/boutiques')">Boutiques</a>
            </div>
            <div class="four wide column">
                <a href="javascript:popup('/produits')">Produits</a>
            </div>
            <div class="four wide column">
                <a href="javascript:popup('/ventes')">Ventes</a>
            </div>
            <div class="four wide column"></div>
        </div>
    </div>

@endsection

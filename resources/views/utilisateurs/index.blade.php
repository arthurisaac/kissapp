@extends('base')

@section('main')

    <br>
    <br>
    <div class="ui container">
        @if ($users)
            <table class="ui compact celled definition table">
                <thead>
                <tr>
                    <th></th>
                    <th>Nom d'utilisateur</th>
                    <th>Addresse email</th>
                    <th>Role</th>
                    <th>Date de création</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="collapsing">
                            <div class="ui fitted slider checkbox" onclick="updateAuthorization({{$user->id}}, {{$user->authorized}})">
                                <input type="checkbox" {{  ($user->authorized == 1 ? ' checked' : '') }}> <label></label>
                            </div>
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->roles->role ?? $user->role}}</td>
                        <td>{{$user->created_at}}</td>
                        <td class="center aligned">
                            <button class="ui button red icon" onclick="deleteUser({{$user->id}})">
                                <i class="trash icon"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot class="full-width">
                <tr>
                    <th></th>
                    <th colspan="5">
                        <div class="ui right floated small primary labeled icon button" onclick="window.location.href = '{{ route('utilisateurs.create') }}'">
                            <i class="user icon"></i> Ajouter utilisateur
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        @else
            <p>Une erreur a survenue</p>
        @endif
    </div>
    <script>
        function deleteUser(id){
            const confirmResult = confirm('Confirmer suppression?');
            const tokenInput = '@csrf';
            const token = $(tokenInput).val();
            if (confirmResult) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    url: `utilisateurs/${id}`,
                    type: 'DELETE',
                    data: {id: id},
                    contentType:'application/json',
                    dataType: 'text',
                    success: function() {
                        window.location.reload();
                    },
                    error: function(result){
                        alert(JSON.stringify(result));
                    }
                });
            }
        }

        function updateAuthorization(id, authorization) {
            let auth = authorization;
            console.log(authorization);
            if (authorization === 1){
                auth = 0
            } else {
                auth = 1
            }
            const tokenInput = '@csrf';
            const token = $(tokenInput).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            $.ajax({
                url: `/authorisation`,
                type: 'GET',
                data: {authorization: auth, id: id},
                contentType:'application/json',
                dataType: 'text',
                success: function() {
                    window.location.reload();
                },
                error: function(result){
                    alert(JSON.stringify(result));
                }
            });
        }
    </script>
@endsection

@extends('welcome')

@section("content")

<h2>Les Cours</h2>

@can("isFormateur")
<div class="mb-3 d-flex justify-content-end">
    <a href="{{ route('cours.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Ajouter Cour
    </a>
</div>
@endcan



@if($cours->isEmpty())
<div class="alert alert-info" role="alert">
    Pas de cours existe!
</div>
@endif

@if($cours->isNotEmpty())
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Formateur</th>
            <th>Nombre de place</th>
            <th>Actions</th> <!-- Add a new table header for actions -->
        </tr>
    </thead>
    <tbody>
        @foreach ($cours as $cour)
        <tr>
            <td>{{ $cour->id }}</td>
            <td>{{ $cour->name }}</td>
            <td>{{ $cour->description }}</td>
            <td>{{ $cour->completNameFormateur }}</td>
            <td>{{ $cour->placesNumber }}</td>
            <td>

                @can("isFormateur")
                <a href="{{ route('cours.edit', $cour->id) }}" class="btn btn-primary">Modifier</a>

                <button type="button" data-toggle="modal" data-target="#deleteConfirmationModal{{ $cour['id'] }}"
                    class="btn btn-danger">Supprimer</button>
                <a href="{{ route('particuliers.index', $cour->id) }}" class="btn btn-primary">Les particuliers</a>


                @endcan

                @cannot("isFormateur")
                <form action="{{ route('particuliers.store' ) }}" method="post">
                    @csrf
                    <input type="hidden" name="courId" value="{{ $cour['id'] }}">
                    <input type="hidden" name="userId" value="{{ $cour['id'] }}">
                    <button type='submit' class="btn btn-primary">S'inscrire</button>
                </form>
                @endcannot

                <div class="modal fade" id="deleteConfirmationModal{{ $cour['id'] }}" tabindex="-1"
                    aria-labelledby="deleteConfirmationModalLabel{{ $cour['id'] }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $cour['id'] }}">Confirmer
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Êtes-vous sûr de vouloir supprimer ce cours ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <form action="{{route('cours.destroy', $cour )}}" method="post">
                                    @csrf;
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>




            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
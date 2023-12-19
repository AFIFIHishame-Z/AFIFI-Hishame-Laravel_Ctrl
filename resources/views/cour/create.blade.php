<!-- create.blade.php -->

@extends('welcome')

@section('content')



@if(Session::has('success'))
<div class="modal fade " id="exampleModal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Le cour a ete a jouter avec succes</h1>
            </div>

            <div class="modal-footer">
                <form action="{{ route('cours.index') }}" method="get">
                    <button type="submit" class="btn btn-primary">Confirmer</button>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#exampleModal').modal('show');
    });
</script>
@endif


<div class="container">
    <h1>Cree un cour</h1>

    <form action="{{ route('cours.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nom du cours:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group mt-3">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group mt-3">
            <label for="placesNumber">Nombre de place:</label>
            <input type="number" class="form-control" id="placesNumber" name="placesNumber" required></input>
        </div>


        <div class="form-group mt-3">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Cree Cour</button>
    </form>
</div>
@endsection
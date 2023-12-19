<!-- edit.blade.php -->

@extends('welcome')

@section('content')
<div class="container">
    <h1>Modifier Cours</h1>

    <form action="{{ route('cours.update', $cour->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom du cour:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $cour->name) }}"
                required>
        </div>

        <div class="form-group mt-3">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                required>{{ old('description', $cour->description) }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label for="placesNumber">Nombre de place:</label>
            <input type="number" class="form-control" id="placesNumber"
                value="{{ old('placesNumber', $cour->placesNumber) }}" name="placesNumber" required></input>
        </div>



        <div class="form-group mt-3">
            <label for="image">Nouvelle image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
        </div>
        <div class="mt-3">
            <div>
                Ancienne image
            </div>
            <img src="https://th.bing.com/th/id/OIP.g8lXwA5Vd7VeKPQJZMAO1wHaEK?rs=1&pid=ImgDetMain" alt="" srcset="">
        </div>
        <!-- Add other form fields as needed -->

        <button type="submit" class="btn btn-primary mt-4">Update Cours</button>
    </form>
</div>
@endsection
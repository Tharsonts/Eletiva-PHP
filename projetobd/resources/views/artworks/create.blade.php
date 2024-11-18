@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: radial-gradient(circle at 50% 50%, #000, #001022);
        color: #fff;
    }

    .container {
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        max-width: 700px;
        margin: 50px auto;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #fff;
    }

    .form-control, .form-select {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 15px;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background-color: rgba(255, 255, 255, 0.3);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    option {
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        margin-right: 10px;
    }

    .btn-secondary {
        background-color: #6c757d;
    }

    .btn:hover {
        background-color: #218838;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>

<div class="container">
    <h1>{{ isset($artwork) ? 'Editar Obra de Arte' : 'Adicionar Nova Obra de Arte' }}</h1>

    <form action="{{ isset($artwork) ? route('artworks.update', $artwork->id) : route('artworks.store') }}" method="POST">
        @csrf
        @if (isset($artwork))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $artwork->title ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="technique">Técnica</label>
            <select name="technique" id="technique" class="form-control" required onchange="toggleOtherTechnique(this.value)">
                <option value="">Selecione a técnica</option>
                <option value="Pintura a óleo" {{ (isset($artwork) && $artwork->technique == 'Pintura a óleo') ? 'selected' : '' }}>Pintura a óleo</option>
                <option value="Aquarela" {{ (isset($artwork) && $artwork->technique == 'Aquarela') ? 'selected' : '' }}>Aquarela</option>
                <option value="Escultura" {{ (isset($artwork) && $artwork->technique == 'Escultura') ? 'selected' : '' }}>Escultura</option>
                <option value="Fotografia" {{ (isset($artwork) && $artwork->technique == 'Fotografia') ? 'selected' : '' }}>Fotografia</option>
                <option value="Arte digital" {{ (isset($artwork) && $artwork->technique == 'Arte digital') ? 'selected' : '' }}>Arte digital</option>
                <option value="Outra" {{ (isset($artwork) && !in_array($artwork->technique, ['Pintura a óleo', 'Aquarela', 'Escultura', 'Fotografia', 'Arte digital'])) ? 'selected' : '' }}>Outra</option>
            </select>
        </div>

        <div class="form-group" id="other-technique-group" style="display: {{ (isset($artwork) && !in_array($artwork->technique, ['Pintura a óleo', 'Aquarela', 'Escultura', 'Fotografia', 'Arte digital'])) ? 'block' : 'none' }};">
            <label for="other_technique">Especifique a técnica</label>
            <input type="text" name="other_technique" id="other_technique" class="form-control" value="{{ old('other_technique', $artwork->technique ?? '') }}">
        </div>

        <div class="form-group">
            <label for="artist_id">Artista</label>
            <select name="artist_id" id="artist_id" class="form-select" required>
                <option value="">Selecione o artista</option>
                @foreach($artists as $artist)
                    <option value="{{ $artist->id }}" {{ (isset($artwork) && $artwork->artist_id == $artist->id) ? 'selected' : '' }}>
                        {{ $artist->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="creation_date">Data de Criação</label>
            <input type="date" name="creation_date" class="form-control" value="{{ old('creation_date', $artwork->creation_date ?? '') }}" required>
        </div>

        <button type="submit" class="btn">{{ isset($artwork) ? 'Atualizar' : 'Salvar' }}</button>
        <a href="{{ route('artworks.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    function toggleOtherTechnique(value) {
        const otherTechniqueGroup = document.getElementById('other-technique-group');
        if (value === 'Outra') {
            otherTechniqueGroup.style.display = 'block';
        } else {
            otherTechniqueGroup.style.display = 'none';
            document.getElementById('other_technique').value = '';
        }
    }
</script>
@endsection
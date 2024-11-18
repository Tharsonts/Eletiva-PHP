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

    .hidden-field {
        display: none;
    }

    .form-select {
        appearance: none;
        background-image: linear-gradient(45deg, transparent 50%, white 50%),
            linear-gradient(135deg, white 50%, transparent 50%);
        background-position: calc(100% - 20px) calc(1em + 2px), calc(100% - 15px) calc(1em + 2px);
        background-size: 5px 5px, 5px 5px;
        background-repeat: no-repeat;
    }

    .form-select:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .form-select:focus {
        border: 1px solid rgba(255, 255, 255, 0.5);
        outline: none;
    }

    .form-select::-webkit-scrollbar {
        width: 8px;
    }

    .form-select::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 10px;
    }

    .form-select::-webkit-scrollbar-track {
        background: transparent;
    }

</style>

<div class="container">
    <h1>Adicionar Nova Exposição</h1>

    <form action="{{ route('expositions.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="gallery_type">Tipo de Galeria</label>
            <select name="gallery_type" id="gallery_type" class="form-select" required onchange="showGalleryFields(this.value)">
                <option value="">Selecione o tipo de galeria</option>
                <option value="Museu">Museu</option>
                <option value="Galeria de Arte">Galeria de Arte</option>
                <option value="Espaço Comercial">Espaço Comercial</option>
                <option value="Outra">Outra</option>
            </select>
        </div>

        <div id="gallery-fields" class="hidden-field">
            <div class="form-group">
                <label for="gallery_name">Nome da Galeria</label>
                <input type="text" name="gallery_name" id="gallery_name" class="form-control" value="{{ old('gallery_name') }}">
            </div>

            <div class="form-group">
                <label for="gallery_address">Endereço</label>
                <input type="text" name="gallery_address" id="gallery_address" class="form-control" value="{{ old('gallery_address') }}">
            </div>

            <div class="form-group">
                <label for="gallery_city_state">Cidade/Estado</label>
                <input type="text" name="gallery_city_state" id="gallery_city_state" class="form-control" value="{{ old('gallery_city_state') }}">
            </div>

            <div class="form-group">
                <label for="gallery_country">País</label>
                <input type="text" name="gallery_country" id="gallery_country" class="form-control" value="{{ old('gallery_country') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="theme">Tema</label>
            <select name="theme" id="theme" class="form-control" required onchange="toggleOtherTheme(this.value)">
                <option value="">Selecione o tema</option>
                <option value="Arte Contemporânea">Arte Contemporânea</option>
                <option value="Surrealismo">Surrealismo</option>
                <option value="Impressionismo">Impressionismo</option>
                <option value="Renascimento">Renascimento</option>
                <option value="Outra">Outra</option>
            </select>
        </div>

        <div class="form-group" id="other-theme-group" style="display:none;">
            <label for="other_theme">Especifique o tema</label>
            <input type="text" name="other_theme" id="other_theme" class="form-control" value="">
        </div>

        <div class="form-group">
            <label for="date">Data da Exposição</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
        </div>

        <div class="form-group">
            <label for="artworks">Obras de Arte</label>
            <select name="artworks[]" id="artworks" class="form-select" multiple>
                @foreach($artworks as $artwork)
                <option value="{{ $artwork->id }}">
                    {{ $artwork->title }} 
                    @if($artwork->artist)
                        - {{ $artwork->artist->name }}
                    @else
                        - Artista não definido
                    @endif
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn">Salvar</button>
        <a href="{{ route('expositions.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    function showGalleryFields(value) {
        const galleryFields = document.getElementById('gallery-fields');
        galleryFields.style.display = (value !== '') ? 'block' : 'none';
    }

    function toggleOtherTheme(value) {
        const otherThemeGroup = document.getElementById('other-theme-group');
        if (value === 'Outra') {
            otherThemeGroup.style.display = 'block';
        } else {
            otherThemeGroup.style.display = 'none';
            document.getElementById('other_theme').value = '';
        }
    }
</script>
@endsection

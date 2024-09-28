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

    canvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: -1;
    }

    h1 {
        font-size: 3rem;
        color: #fff;
        margin-bottom: 20px;
        text-align: center;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-header, .card-body {
        color: #fff;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        padding: 10px;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.3);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 1.1rem;
        width: 150px;
    }

    button.btn-primary {
        background-color: #17a2b8;
        color: white;
        border: none;
        margin-right: 10px;
    }

    button.btn-primary:hover {
        background-color: #138496;
    }

    a.btn-secondary {
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        text-align: center;
        border: none;
    }

    a.btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-wrapper {
        display: flex;
        justify-content: space-between;
    }
    .form-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 15px;
        width: 100%;
        background-image: url("https://cdn-icons-png.flaticon.com/512/60/60781.png");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 20px;
    }
    .form-select option {
        background-color: rgba(0, 0, 0, 0.8);
        color: #fff;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .form-select:focus option {
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .form-select:focus {
        outline: none;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }


    .form-select:focus option {
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

</style>

<div class="container">
    <h1>Edit Artist</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('artists.update', $artist->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $artist->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="biography" class="form-label">Biography</label>
                    <textarea class="form-control" id="biography" name="biography">{{ old('biography', $artist->biography ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="nationality" class="form-label">Nationality</label>
                    <select class="form-control" id="nationality" name="nationality" required>
                        <option value="" disabled>Select Nationality</option>
                        <option value="Brazilian" {{ $artist->nationality == 'Brazilian' ? 'selected' : '' }}>Brazilian</option>
                        <option value="American" {{ $artist->nationality == 'American' ? 'selected' : '' }}>American</option>
                        <option value="British" {{ $artist->nationality == 'British' ? 'selected' : '' }}>British</option>
                        <option value="Canadian" {{ $artist->nationality == 'Canadian' ? 'selected' : '' }}>Canadian</option>
                        <option value="French" {{ $artist->nationality == 'French' ? 'selected' : '' }}>French</option>
                        <option value="German" {{ $artist->nationality == 'German' ? 'selected' : '' }}>German</option>
                        <option value="Indian" {{ $artist->nationality == 'Indian' ? 'selected' : '' }}>Indian</option>
                        <option value="Chinese" {{ $artist->nationality == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="artist_category" class="form-label">Artist Category</label>
                    <select class="form-control" id="artist_category" name="artist_category" required>
                        <option value="Painter" {{ $artist->artist_category == 'Painter' ? 'selected' : '' }}>Painter</option>
                        <option value="Sculptor" {{ $artist->artist_category == 'Sculptor' ? 'selected' : '' }}>Sculptor</option>
                        <option value="Photographer" {{ $artist->artist_category == 'Photographer' ? 'selected' : '' }}>Photographer</option>
                        <option value="Digital Artist" {{ $artist->artist_category == 'Digital Artist' ? 'selected' : '' }}>Digital Artist</option>
                        <option value="Illustrator" {{ $artist->artist_category == 'Illustrator' ? 'selected' : '' }}>Illustrator</option>
                        <option value="Graphic Designer" {{ $artist->artist_category == 'Graphic Designer' ? 'selected' : '' }}>Graphic Designer</option>
                        <option value="Other" {{ $artist->artist_category == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="btn-wrapper">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('artists.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

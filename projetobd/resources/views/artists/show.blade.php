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
        margin-bottom: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-header, .card-body {
        color: #fff;
    }

    a.btn {
        display: inline-block;
        padding: 10px 20px;
        margin-bottom: 10px;
        background-color: #17a2b8;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 1.1rem;
    }

    a.btn:hover {
        background-color: #138496;
    }
</style>

<div class="container">
    <h1>View Artist</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $artist->name }}</p>
            <p><strong>Category:</strong> {{ $artist->artist_category }}</p>
            <p><strong>Biography:</strong> {{ $artist->biography }}</p>
            <p><strong>Nationality:</strong> {{ $artist->nationality }}</p>
        </div>
    </div>

    <a href="{{ route('artists.index') }}" class="btn">Voltar</a>
</div>
@endsection

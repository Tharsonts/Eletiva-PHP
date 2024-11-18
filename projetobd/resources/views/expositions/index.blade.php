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

    .content-box {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
    }

    h1 {
        text-align: center;
        margin-bottom: 10px;
        color: #fff;
    }

    .btn-add {
        background-color: #17a2b8;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        margin-bottom: 10px;
        display: inline-block;
    }

    .btn-add:hover {
        background-color: #138496;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: rgba(255, 255, 255, 0.1);
        margin-bottom: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    th {
        font-weight: bold;
    }

    .btn {
        padding: 10px 20px;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-view {
        background-color: #17a2b8;
    }

    .btn-view:hover {
        background-color: #138496;
    }

    .btn-edit {
        background-color: #ffc107;
    }

    .btn-edit:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .actions {
        display: flex;
        gap: 10px;
    }

</style>

<div class="content-box">
    <h1>Lista de Exposições</h1>

    <a href="{{ route('expositions.create') }}" class="btn-add">Adicionar Nova Exposição</a>

    <table class="table">
        <thead>
            <tr>
                <th>Tema</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expositions as $exposition)
            <tr>
                <td>{{ $exposition->theme }}</td>
                <td>{{ $exposition->date }}</td>
                <td class="actions">
                    <a href="{{ route('expositions.show', $exposition->id) }}" class="btn btn-view">View</a>
                    <a href="{{ route('expositions.edit', $exposition->id) }}" class="btn btn-edit">Edit</a>
                    <form action="{{ route('expositions.destroy', $exposition->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
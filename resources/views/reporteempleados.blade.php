@extends('bootstrap')

@section('contenido')
    <div class="container">
        <h1>Reporte Empleados</h1>
        <br>
        <br>
        <a href="{{ route('altaempleado') }}">
            <button type="button" class="btn btn-outline-info">Alta Empleado</button>
        </a>
        <br>
        <br>
        <br>
        @if (Session::has('mensaje'))
            <div class="alert alert-success">{{ Session::get('mensaje') }}</div>
        @endif
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Clave</th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Operaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consulta as $c)
                    <tr>
                        <th scope="row">{{ $c->ide }}</th>
                        <td>{{ $c->nombre }} {{ $c->apellido }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->depa }}</td>
                        <td>

                            <a href="{{ route('modificaempleado', ['ide' => $c->ide]) }}">
                                <button type="button" class="btn btn-outline-warning">Modificar</button>
                            </a>

                            @if ($c->deleted_at)
                                <a href="{{ route('activarempleado', ['ide' => $c->ide]) }}">
                                    <button type="button" class="btn btn-outline-success">Activar</button>
                                </a>
                                <a href="{{ route('borraempleado', ['ide' => $c->ide]) }}">
                                    <button type="button" class="btn btn-outline-secondary">Borrar</button>
                                </a>
                            @else
                                <a href="{{ route('desactivaempleado', ['ide' => $c->ide]) }}">
                                    <button type="button" class="btn btn-outline-danger">Desactivar</button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @stop

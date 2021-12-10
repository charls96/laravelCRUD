@extends('layout')

@section('title', 'Profesiones')

@section('content')

    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">Listado de profesiones</h1>
    </div>

    <p>
       
            <a href="{{ route('professions.trashed') }}" class="btn btn-outline-dark">Ver papelera</a>
            <a href="{{ route('professions.create') }}" class="btn btn-primary">Nueva profesión</a>
        
            {{-- <a href="{{ route('professions.index') }}" class="btn btn-outline-dark">Regresar al listado de usuarios</a> --}}
        
    </p>

    @include('professions._filters')

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Perfiles</th>
                <th scope="col">Salario medio</th>
                <th scope="col">Fechas</th>
                <th scope="col">Acciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($professions as $profession)
                <tr>
                    <th scope="row">{{ $profession->id }}</th>
                    <td>{{ $profession->title }}</td>
                    {{-- <td>{{ $profession->profiles_count }}</td> --}}
                    <td>{{ $profession->profiles->count() }}</td>
                    <td>{{ round($profession->profiles->avg('annual_salary'), 0) }}</td>
                    <td>
                        <span class="note">Creado: {{ $profession->created_at->format('d/m/Y') }}</span>
                        <span class="note">Actualizado: {{ $profession->updated_at->format('d/m/Y') }}</span>
                    </td>
                    <td>
                        <a href="{{ route('professions.show', $profession) }}" class="btn btn-outline-secondary btn-sm"><span
                                class="oi oi-eye"></span></a>
                        <a href="{{ route('profession.edit', $profession) }}" class="btn btn-outline-secondary btn-sm"><span
                                class="oi oi-pencil"></span></a>
                        {{-- @if (!$profession->profiles_count) --}}
                        @if (!$profession->profiles->count())
                            <form action="{{ url('profesiones/' . $profession->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-link">
                                    <span class="oi oi-trash"></span>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@csrf()

@extends('admin.supports.layouts.app')

@section('tittle', 'Fórum')

@section('header')
<h1>Exploradores</h1>
@endsection


@section('content')

    <a href="{{ route ('supports.create') }}">Adicionar Explorador</a>

<table>
    <thead>
        <th>Nome</th>
        <th>Idade</th>
        {{-- <th>Latitude</th>
        <th>longitude</th> --}}
        {{-- <th>Inventário</th> --}}
        <th></th>
    </thead>
    <tbody>
        @foreach($supports->items() as $support)
            <tr>
                <td>{{ $support->nome }}</td>
                {{-- <td>{{ getStatusSupport ($support->status) }}</td> --}}
                <td>{{ $support->idade }}</td>
                {{-- <td>{{ $support->latitude }}</td>
                <td>{{ $support->longitude }}</td> --}}
                {{-- <td>{{ $support->inventario }}</td> --}}
                <td>
                    <a href="{{route('supports.show',$support->id)}}">ir</a>
                    <a href="{{route('supports.edit',$support->id)}}">Editar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<x-pagination
    :paginator="$supports"
    :appends="$filters"/>

@endsection


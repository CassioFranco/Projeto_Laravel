<h1>Detalhes do explorador: {{$support->nome}}</h1>

<ul>
    <p>Dados</p>
    <li>nome: {{$support->nome}}</li>
    {{-- <li>Status: {{$support->status}}</li> --}}
    <li>idade: {{$support->idade}}</li>
    <p>Localização</p>
    <li>latitude: {{$support->latitude}}</li>
    <li>longitude: {{$support->longitude}}</li>
    <p>Mochila</p>
    <li>Itens: {{$support->inventario}}</li>
</ul>

<form action="{{route('supports.destroy', $support->id) }}" method="post">
    @csrf()
    @method('DELETE')
    <button type="submit">Deletar</button>
</form>

<a href="{{route('supports.editlocal',$support->id)}}">Atualizar Localização</a>
<p></p>
<a href="{{route('supports.additem',$support->id)}}">Adicionar Itens na Mochila</a>
<p></p>






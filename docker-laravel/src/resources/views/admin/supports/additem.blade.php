<h1>Itens de  {{$support->nome}}</h1>

<x-alert/>

<form action="{{ route('supports.update',$support->id)}}" method="POST">
    {{-- <input type="hidden" value="{{csrf_token() }}" name="_token"> --}}
    @csrf()
    @method('PUT')
    @include('admin.supports.partials.addinventario',[
        'support' => $support
    ])
</form>

<h1>Localização do explorador:  {{$support->nome}}</h1>

<x-alert/>

<form action="{{ route('supports.updatelocal',$support->id)}}" method="POST">
    {{-- <input type="hidden" value="{{csrf_token() }}" name="_token"> --}}
    @csrf()
    @method('PUT')
    @include('admin.supports.partials.updatelocal',[
        'support' => $support
    ])
</form>

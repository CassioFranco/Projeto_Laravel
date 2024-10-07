@csrf()
<p>Dados</p>
<input type="text" placeholder="Nome" name="nome" value="{{$support->nome ?? old('nome')}}">
<input type="text" placeholder="Idade" name="idade" value="{{$support->idade ?? old('idade')}}">
<p>Localização</p>
<input type="text" placeholder="Latitude" name="latitude" value="{{$support->latitude ?? old('latitude')}}">
<input type="text" placeholder="Longitude" name="longitude" value="{{$support->longitude ?? old('longitude')}}">
<p>Inventário</p>
<textarea name="inventario"  cols="30" rows="5" placeholder="Itens">{{$support->inventario ?? old('inventario')}}</textarea>
<p>Obrigado por fazer parte do time!</p>
<button type="submit">Enviar</button>

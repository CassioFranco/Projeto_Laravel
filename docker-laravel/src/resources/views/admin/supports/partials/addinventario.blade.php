@csrf()

<p>Inventário</p>
<textarea name="inventario"  cols="30" rows="5" placeholder="Itens">{{$support->inventario ?? old('inventario')}}</textarea>
<p></p>
<button type="submit">Enviar</button>

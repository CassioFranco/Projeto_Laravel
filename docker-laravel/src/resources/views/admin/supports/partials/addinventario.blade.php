@csrf()
<p>Adicionar Itens:</p>

<p>seguindo a seguinte ordem:</p>
<p>nome,valor,localização onde foi encontrador</p>
<p>exemplo:</p>
<p>ametista, R$1000, Coordenadas:(40.7128° N, 74.0060° W).</p>


<textarea name="inventario"  cols="30" rows="5" placeholder="Itens">{{$support->inventario ?? old('inventario')}}</textarea>
<p></p>
<button type="submit">Enviar</button>

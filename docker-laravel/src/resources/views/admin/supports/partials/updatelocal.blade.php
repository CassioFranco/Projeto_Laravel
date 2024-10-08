@csrf()

<p>Atulizar localização</p>


<p>Localização</p>
<input type="text" placeholder="Latitude" name="latitude" value="{{$support->latitude ?? old('latitude')}}">
<input type="text" placeholder="Longitude" name="longitude" value="{{$support->longitude ?? old('longitude')}}">

<button type="submit">Enviar</button>

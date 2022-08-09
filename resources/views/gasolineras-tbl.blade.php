@foreach($gasolineras as $gas)
  <tr>
    <td>{{$gas->_id ?? ''}}</td>
    <td>{{$gas->regular ?? ''}}</td>
    <td>{{$gas->premium ?? ''}}</td>
    <td>{{$gas->dieasel ?? ''}}</td>
    <td>{{$gas->calle ?? ''}}</td>
    <td>{{$gas->colonia ?? ''}}</td>
    <td>{{$gas->municipio ?? ''}}</td>
    <td>{{$gas->estado ?? ''}}</td>
    <td>{{$gas->codigopostal ?? ''}}</td>
    <td>{{$gas->rfc ?? ''}}</td>
    <td>{{$gas->razonsocial ?? ''}}</td>
    <td>{{$gas->date_insert ?? ''}}</td>
    <td>{{$gas->numeropermiso ?? ''}}</td>
    <td>{{$gas->fechaaplicacion ?? ''}}</td>
    <td>{{$gas->﻿permisoid ?? ''}}</td>
    <td>{{$gas->longitude ?? ''}}</td>
    <td>{{$gas->latitude ?? ''}}</td>
    <td>
      <a class="btn btn-outline-success btn-sm rounded" href="{{route('gasolinerias.edit', $gas->id)}}">Editar</a>
      <form action="{{route('gasolinerias.destroy', $gas->id)}}" method='post'>
        <input type='hidden' name='_method' value='DELETE'>
        <button class="btn btn-danger btn-sm rounded" type="submit">Eliminar</button>
        <input type='hidden' name='_token' value='{{csrf_token()}}'>
      </form>
    </td>
  </tr>
@endforeach
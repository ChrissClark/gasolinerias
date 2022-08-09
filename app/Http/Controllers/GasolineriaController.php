<?php

namespace App\Http\Controllers;

use App\Models\Gasolineria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GasolineriaController extends Controller
{
    /**
     * Muestra todas las gasolinerias de la BD.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Se obtiene la informacion de la api del gobierno.
        /* $gasolineras = \Illuminate\Support\Facades\Http::get("https://api.datos.gob.mx/v1/precio.gasolina.publico")->json()['results'];
        foreach($gasolineras as $gas){
            $data = [
                '_id' => $gas['_id'] ?? '',
                'regular' => empty($gas['regular']) ? null : $gas['regular'],
                'premium' => empty($gas['premium']) ? null : $gas['premium'],
                'dieasel' => empty($gas['dieasel']) ? null : $gas['dieasel'],
                'calle' => $gas['calle'] ?? null,
                'colonia' => $gas['colonia'] ?? null,
                'municipio' => $gas['municipio'] ?? null,
                'estado' => $gas['estado'] ?? null,
                'codigopostal' => $gas['codigopostal'] ?? '',
                'rfc' => $gas['rfc'] ?? '',
                'razonsocial' => $gas['razonsocial'] ?? '',
                'date_insert' => $gas['date_insert'] ?? '',
                'numeropermiso' => $gas['numeropermiso'] ?? '',
                'fechaaplicacion' => $gas['fechaaplicacion'] ?? '',
                'permisoid' => $gas['﻿permisoid'] ?? '',
                'longitude' => $gas['longitude'] ?? '',
                'latitude' => $gas['latitude'] ?? '',
            ];
            Gasolineria::Create($data);
        } */
        $gasolineras = Gasolineria::orderBy('regular', 'asc')->get();

        return view('index', ['gasolineras' => $gasolineras]);
    }

    /**
     * Muestra el formulario para dar de alta una nueva gasolineria.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gasolineria = new Gasolineria();
        
        return view('formGas', ["gasolineria" => $gasolineria]);
    }

    /**
     * Registra una nueva gasolineria en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $this->validateData();
        //Agragar fechas de este momento en string format a los datos a guardar
        $datos['date_insert'] = date('Y-m-d H:i:s');
        $datos['fechaaplicacion'] = date('Y-m-d H:i:s');
        Gasolineria::Create($datos);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gasolineria  $gasolineria
     * @return \Illuminate\Http\Response
     */
    public function show(Gasolineria $gasolineria)
    {
        //
    }

    /**
     * Muestra el formulario para editar una gasolineria.
     *
     * @param  \App\Models\Gasolineria  $gasolineria
     * @return \Illuminate\Http\Response
     */
    public function edit(Gasolineria $gasolineria)
    {        
        return view('formGas', ["gasolineria" => $gasolineria]);
    }

    /**
     * Valida y Actualiza la gasolinera especificada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gasolineria  $gasolineria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gasolineria $gasolineria)
    {
        $datos = $this->validateData();
        $gasolineria->update($datos);
        
        return redirect('/');
    }

    /**
     * Elimina la gasolinera especificada.
     *
     * @param  \App\Models\Gasolineria  $gasolineria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gasolineria $gasolineria)
    {
        $gasolineria->delete();

        return back();
    }

    /** Valida los campos en el formato correspondiente para poder guardarlos en la BD. */
    protected function validateData(){
        return request()->validate([
            '_id' => 'string|min:1',
            'regular' => 'nullable|numeric',
            'premium' => 'nullable|numeric',
            'dieasel' => 'nullable|numeric',
            'calle' => 'nullable|string|max:80',
            'colonia' => 'nullable|string|max:60',
            'municipio' => 'nullable|string|max:50',
            'estado' => 'nullable|string|max:45',
            'codigopostal' => 'integer',
            'rfc' => 'string|max:15',
            'razonsocial' => 'string|max:45',
            'date_insert' => 'string|max:45',
            'numeropermiso' => 'string|max:45',
            'fechaaplicacion' => 'string',
            'permisoid' => 'integer',
            'longitude' => 'numeric',
            'latitude' => 'numeric',
        ]);
    }

    /** Rregresa una lista ordenada ascendente o desendente los precios de gasolina regular, según la ubicación que el usuario haya seleccionado.
     * 
     * @return Regresa un json con el contenido de la tabla de las gasolineras.
     */
    public function filtro(){
        if(request()->estado == "todos"){
            if(request()->descAsc == "DESC")
                $gasolineras = Gasolineria::orderBy('regular', 'desc')->get();
            else
                $gasolineras = Gasolineria::orderBy('regular', 'asc')->get();
        }
        else if(request()->municipio == "todos")
            $gasolineras = DB::select('select * from gasolinerias where estado=? ORDER BY regular '.request()->descAsc, [request()->estado]);
        else if(request()->municipio != "todos")
            $gasolineras = DB::select('select * from gasolinerias where estado=? AND municipio=? ORDER BY regular '.request()->descAsc, [request()->estado, request()->municipio]);

        $tblContent = view('gasolineras-tbl', ['gasolineras' => $gasolineras])->render();
        
        return response()->json([
            'tblContent' => $tblContent,
            'gasolineras' => $gasolineras,
        ]);
    }
}

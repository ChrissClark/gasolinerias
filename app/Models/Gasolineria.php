<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasolineria extends Model
{
    protected $fillable = ['id', '_id', 'regular', 'premium', 'dieasel', 'calle', 'colonia','municipio', 'estado', 'codigopostal', 'rfc', 'razonsocial',
                            'date_insert', 'numeropermiso', 'fechaaplicacion', 'permisoid', 'longitude', 'latitude'];
                            //['id', 'd_codigo', 'd_asenta', 'd_tipo_asenta', 'd_mnpio', 'd_estado', 'd_ciudad', 'd_CP', 'c_estado', 'c_oficina', 'c_CP',
                            //'c_tipo_asenta', 'c_mnpio', 'id_asenta_cpcons', 'd_zona', 'c_cve_ciudad'];
    public $timestamps = false;
    
}

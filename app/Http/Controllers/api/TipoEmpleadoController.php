<?php

namespace App\Http\Controllers\api;

use App\TipoEmpleado;






class TipoEmpleadoController extends ApiResponseController
{
    public function index()
    {
        $tipoEmpleados= TipoEmpleado::orderBy('nomTipo','asc')->get();
        return $this->successResponse($tipoEmpleados);
    }

}

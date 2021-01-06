<?php

namespace App\Http\Controllers\api;

use App\EmpresaCliente;
use Illuminate\Http\Request;
use App\EmpresaClienteEmpleado;
use App\Models\SedeEmpresaCliente;
use App\Models\SeguimientoCliente;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ApiResponseController;

class EmpresaClienteController extends ApiResponseController
{
    // public function index()
    // {
    //     $empresas=EmpresaCliente::with('pais','catCliente','empresaEmails','empresaTelefonos:empresa_id,catTelefono_id,numero','empresaTelefonos.categoria')->get();
    //     return $this->successResponse(["empresas" => $empresas]);
    // }

    //  public function index()
    // {
    //     $empresas=EmpresaCliente::with('empresaSedes')->get();
    //     return $this->successResponse(["sedes" => $empresas]);
    // }

    // public function index()
    // {
    //     $empresas=EmpresaClienteEmpleado::with('catSexo','catEmpleado','empresaCliente')->get();
    //     return $this->successResponse(["empleados" => $empresas]);
    // }

    public function index()
    {
        $empresas=SeguimientoCliente::with('accionSiguiente','prioridad','accion','Status')->get();
        return $this->successResponse(["sedes" => $empresas]);
    }

    
}

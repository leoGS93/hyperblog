<?php

namespace App\Http\Controllers\api;

use App\TipoSangre;





class TipoSangreController extends ApiResponseController
{
    public function index()
    {
        $tiposSangre= TipoSangre::orderBy('nombre','asc')->get();
        return $this->successResponse($tiposSangre);
    }

}

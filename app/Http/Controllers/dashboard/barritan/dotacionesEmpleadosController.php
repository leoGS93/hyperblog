<?php

namespace App\Http\Controllers\dashboard\barritan;

use App\DotacionesEmpleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class dotacionesEmpleadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rol.empresa');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

 
    public function store(Request $request)
    {
       

        $dotacion=new DotacionesEmpleado();
        $dotacion->id_empleado=$request['id_empleado'];
        $dotacion->id_producto=$request['producto'];
        $dotacion->cantidad=$request['cantidad'];
        $dotacion->observacion=$request['observacion'];
        $dotacion->save();

        Session::flash('status_registro', 'se asigno el elemento con exito!');
        return redirect('dashboard/empleados/inventario/'.$request['id_empleado']);

        
    }

 
    public function actualizar(Request $request)
    {       
            
            $id = $request['id_dotacion'];
            
            $dotacion=DotacionesEmpleado::find($id); 

            $request->validate([
                'observacionEdit'=>'required',
            ]);

            $dotacion->observacion=$request['observacionEdit'];
            $dotacion->estado=0;
            $dotacion->save();

            Session::flash('status_registro', 'se realizo la devolucion del elemento con exito!');
            return redirect('dashboard/empleados/inventario/'.$request['id_empleado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

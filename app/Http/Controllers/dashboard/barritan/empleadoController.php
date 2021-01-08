<?php

namespace App\Http\Controllers\dashboard\barritan;


use DataTables;
use App\Empleado;
use App\TipoSangre;
use App\TipoEmpleado;
use Redirect,Response;
use App\DotacionesEmpleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreEmpleadoPost;

class empleadoController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rol.empresa');
    }

   
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Empleado::
            join('tipo_empleados','tipo_empleados.id_tipEmpleado','=','empleados.id_tipEmpleado')->
            join('tipo_sangres','tipo_sangres.id_tipoSangre','=','empleados.id_tipSangre')->
            select('empleados.*','tipo_empleados.nomTipo','tipo_sangres.nombre')->
            orderBy('empleados.priNom','ASC')->get();
            return Datatables::of($data)
           
            ->addIndexColumn()
            ->addColumn('imagen', function ($row) { $url="https://recursosbarritan.s3.us-east-2.amazonaws.com".$row->avatar; 
                return '<img src='.$url.' border="0" width="60px" class="img-rounded" align="center" />';
             })
             ->addColumn('names', function ($row) { 
                return $row->priNom.' '.$row->segNom;
             })
             ->addColumn('surnames', function ($row) { 
                return $row->priApe.' '.$row->segApe;
             })
            ->addColumn('action', function($row){  $ruta="/dashboard/empleados/".$row->id_empleado;
            $action = '<a class="btn btn-info verMaquina" id="verMaquina" href='.$ruta.'>Ver</a>
                      <a class="btn btn-dark verMaquina" id="verMaquina" href='.$ruta.'/edit'.'>Editar</a>
                      <button data-toggle="modal" data-target="#deleteCliente" data-nombre="'.$row->priNom.' '.$row->priApe.'" data-id="'.$row->id_empleado.'"
                        class="btn btn-danger"><i class="fa fa-trash"></i></button>
                      ';
            
            return $action;
            
            })
            ->rawColumns(['imagen'],['action'])
            ->make(true);
            
            
            }
            
            return view('dashboard.control-interno.empleados.index');
    }

    public function create()
    {
        $tiposEmpleados= TipoEmpleado::get();
        $tiposSangres= TipoSangre::get();
        return view('dashboard.control-interno.empleados.create',compact('tiposEmpleados','tiposSangres'));
    }

    public function store(StoreEmpleadoPost $request)
    {
       

        if($foto = Empleado::setFoto($request->portada))
            $request->request->add(['foto'=>$foto]);
            
   
        $empleado=new Empleado();
        $empleado->id_tipEmpleado=$request['id_tipEmpleado'];
        $empleado->id_tipSangre=$request['id_tipSangre'];
        $empleado->cedula=$request['cedula'];
        $empleado->eps=$request['eps'];
        $empleado->arl=$request['arl'];
        $empleado->priNom=$request['priNombre'];
        $empleado->segNom=$request['segNombre'];
        $empleado->priApe=$request['priApellido'];
        $empleado->segApe=$request['segApellido'];
        $empleado->email=$request['email'];
        $empleado->numTelefono=$request['numTelefono'];
        $empleado->direccion=$request['direccion'];
        $empleado->avatar=$request['foto'];
        $empleado->save();

        Session::flash('status_registro', 'se registro el empleado con exito!');
        return redirect('dashboard/empleados');

        
    }

    public function show($url)
    {
        $empleado = Empleado::where('id_empleado',$url)->firstOrFail();
        return view('dashboard.control-interno.empleados.perfil',compact('empleado'));
    }

    public function inventario(Request $request,$url)
    {
        $empleado = Empleado::where('id_empleado',$url)->firstOrFail();

    

        if ($request->ajax()) {
            
            $data=DotacionesEmpleado::
            join('empleados','empleados.id_empleado','=','dotaciones_empleados.id_empleado')->
            join('productos','productos.id_producto','=','dotaciones_empleados.id_producto')->
            select('dotaciones_empleados.*','productos.id_producto','productos.nombre','productos.img')
            ->where('dotaciones_empleados.id_empleado',$url)
            ->where('dotaciones_empleados.estado','1')
            ->get();

       
            return Datatables::of($data)
           
            ->addIndexColumn()
            
            ->addColumn('imagen', function ($row) { $url="https://recursosbarritan.s3.us-east-2.amazonaws.com".$row->img; 
                return '<img src='.$url.' border="0" width="60px" class="img-rounded" align="center" />';
             })

             ->addColumn('estado', function ($row) { 
            
                   $estado='<span class="badge badge-success">Activo</span>';
               
               return $estado;
            })

            ->addColumn('action', function($row){  $ruta="/dashboard/empleados/".$row->id_dotEmpleado;
            $action = '<button id="entrega" data-toggle="modal" data-target="#devolucionModal" data-observacion="'.$row->observacion.'" data-nombre="'.$row->nombre.'" data-id="'.$row->id_dotEmpleado.'"
                        class="btn btn-info"><i class="fas fa-undo-alt"></i> Devolucion</button>
                      ';
            
            return $action;
            
            })
            ->editColumn('fecha', function ($request) {
                return $request->created_at->toFormattedDateString();
            })
            ->rawColumns(['estado','imagen','action'])
            ->make(true);
            
            
            }

        return view('dashboard.control-interno.empleados.inventario',compact('empleado'));
        
    }

    public function inventarioHistory(Request $request,$url)
    {
        $empleado = Empleado::where('id_empleado',$url)->firstOrFail();

    

        if ($request->ajax()) {
            
            $data=DotacionesEmpleado::
            join('empleados','empleados.id_empleado','=','dotaciones_empleados.id_empleado')->
            join('productos','productos.id_producto','=','dotaciones_empleados.id_producto')->
            select('dotaciones_empleados.*','productos.id_producto','productos.nombre','productos.img')
            ->where('dotaciones_empleados.id_empleado',$url)
            ->get();

       
            return Datatables::of($data)
           
            ->addIndexColumn()
            ->addColumn('imagen', function ($row) { $url="https://recursosbarritan.s3.us-east-2.amazonaws.com".$row->img; 
                return '<img src='.$url.' border="0" width="60px" class="img-rounded" align="center" />';
             })

             ->addColumn('estado', function ($row) { 
                if ($row->estado) {
                   $estado='<span class="badge badge-success">Activo</span>';
                }else{
                   $estado='<span class="badge badge-danger">Inactivo</span>';
                }
               return $estado;
            })

            ->addColumn('action', function($row){  $ruta="/dashboard/empleados/".$row->id_dotEmpleado;
            $action = '
                      ';
            
            return $action;
            
            })
            ->editColumn('fecha', function ($request) {
                return $request->created_at->toFormattedDateString();
            })
            ->rawColumns(['estado','imagen','action'])
            ->make(true);
            
            
            }

        return view('dashboard.control-interno.empleados.historyInventario',compact('empleado'));
        
    }

    public function edit($id)
    {
        $tiposEmpleados= TipoEmpleado::get();
        $tiposSangres= TipoSangre::get();
        $empleado=Empleado::find($id);
        return view('dashboard.control-interno.empleados.edit',compact('empleado', 'tiposEmpleados','tiposSangres'));
    }

    public function update(Request $request, $id)
    {
        $empleado=Empleado::find($id); 

        $request->validate([
            'id_tipEmpleado' =>'required',
            'id_tipSangre'=> 'required',
            'priNombre'=> 'required',
            'priApellido'=> 'required',
            'email'=>['required',
                       'string',
                        'email',
                        'max:255',
                        Rule::unique('empleados', 'email')->ignore($empleado->id_empleado, 'id_empleado'),
                        ],
            'numTelefono'=>'required',
            'direccion' => 'required',
        ]);

        
     
        
        
        if($foto = Empleado::setFoto($request->portada,$empleado->avatar)){
            $request->request->add(['foto'=>$foto]);

            $empleado->id_tipEmpleado=$request['id_tipEmpleado'];
            $empleado->id_tipSangre=$request['id_tipSangre'];
            $empleado->cedula=$request['cedula'];
            $empleado->eps=$request['eps'];
            $empleado->arl=$request['arl'];
            $empleado->priNom=$request['priNombre'];
            $empleado->segNom=$request['segNombre'];
            $empleado->priApe=$request['priApellido'];
            $empleado->segApe=$request['segApellido'];
            $empleado->email=$request['email'];
            $empleado->numTelefono=$request['numTelefono'];
            $empleado->direccion=$request['direccion'];
            $empleado->avatar=$request['foto'];

        }else{
            $empleado->id_tipEmpleado=$request['id_tipEmpleado'];
            $empleado->id_tipSangre=$request['id_tipSangre'];
            $empleado->cedula=$request['cedula'];
            $empleado->eps=$request['eps'];
            $empleado->arl=$request['arl'];
            $empleado->priNom=$request['priNombre'];
            $empleado->segNom=$request['segNombre'];
            $empleado->priApe=$request['priApellido'];
            $empleado->segApe=$request['segApellido'];
            $empleado->email=$request['email'];
            $empleado->numTelefono=$request['numTelefono'];
            $empleado->direccion=$request['direccion'];
        }
        $empleado->save();
    
        Session::flash('status_actualizar', 'se actualizo el empleado con exito!');
        return redirect('/dashboard/empleados');
    }

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id)->delete();
   
        Session::flash('status_eliminar', 'se elimino el empleado con exito!');
        return back();
    }
}

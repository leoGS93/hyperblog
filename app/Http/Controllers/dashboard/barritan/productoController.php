<?php

namespace App\Http\Controllers\dashboard\barritan;

use DataTables;
use App\Producto;
use Redirect,Response;
use App\DotacionesEmpleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreProductoPost;

class productoController extends Controller
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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Producto::get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('imagen', function ($row) { $url="https://recursosbarritan.s3.us-east-2.amazonaws.com".$row->img; 
                return '<img src='.$url.' border="0" width="60px" class="img-rounded" align="center" />';
             })
            ->addColumn('action', function($row){  $ruta="/dashboard/productos/".$row->id_producto;
            $action = '<a class="btn btn-info verMaquina" id="verMaquina" href='.$ruta.'>Ver asignación</a>
                      <a class="btn btn-dark verMaquina" id="verMaquina" href='.$ruta.'/edit'.'>Editar</a>
                      <button data-toggle="modal" data-target="#deleteProducto" data-nombre="'.$row->nombre.'" data-id="'.$row->id_producto.'"
                        class="btn btn-danger"><i class="fa fa-trash"></i></button>
                      ';
            
            return $action;
            
            })
            ->rawColumns(['imagen'],['action'])
            ->make(true);
            }
            
            return view('dashboard.control-interno.productos.index');
    }

    public function indexAjax()
    {
      $data = Producto::select(['id_producto', 'nombre'])->orderBy('nombre','ASC')->get();
      return $data;
    }    

    public function asignadosTotalAjax($id)
    {
        $productos = Producto::select(['stock'])->where('id_producto',$id)->firstOrFail();
        $asignados=DotacionesEmpleado::where('id_producto',$id)->Where('estado','1')->sum('cantidad');

        $array = array(
            "total" => $productos,
            "asignados" => $asignados,
        );

        return $array;
    }    
    
    public function create()
    {
        return view('dashboard.control-interno.productos.create');
    }

    public function store(StoreProductoPost $request)
    {
       

        if($foto = Producto::setFoto($request->img))
            $request->request->add(['foto'=>$foto]);
            
   
        $productos=new Producto();
        $productos->nombre=$request['nombre'];
        $productos->descripcion=$request['descripcion'];
        $productos->stock=$request['stock'];
        $productos->img=$request['foto'];
        $productos->save();

        Session::flash('status_registro', 'se registro el producto con exito!');
        return redirect('dashboard/productos');

        
    }

    public function show($url)
    {
        $productos = Producto::where('id_producto',$url)->firstOrFail();
        $asignados=DotacionesEmpleado::where('id_producto',$url)->sum('cantidad');
        return view('dashboard.control-interno.productos.show',compact('productos','asignados'));
    }

    public function edit($id)
    {
        $productos=Producto::find($id);
        return view('dashboard.control-interno.productos.edit', ["productos"=>$productos]);
    }

    public function update(Request $request, $id)
    {
        $productos=Producto::find($id); 

        $request->validate([ 
             'nombre'=> ['required',
                          Rule::unique('productos', 'nombre')->ignore($productos->id_producto, 'id_producto'),
                        ],
            'descripcion'=>'required',
            'stock'=> 'required',
         
        ]);

        
        
        if($foto = Producto::setFoto($request->img,$productos->img)){
            $request->request->add(['foto'=>$foto]);

            $productos->nombre=$request['nombre'];
            $productos->descripcion=$request['descripcion'];
            $productos->stock=$request['stock'];
            $productos->img=$request['foto'];

        }else{
            $productos->nombre=$request['nombre'];
            $productos->descripcion=$request['descripcion'];
            $productos->stock=$request['stock'];
         
        }
        $productos->save();
    
        Session::flash('status_actualizar', 'se actualizo el producto con exito!');
        return redirect('/dashboard/productos');
    }

    public function destroy($id)
    {
        $productos = Producto::findOrFail($id)->delete();
   
        Session::flash('status_eliminar', 'se elimino el producto con exito!');
        return back();
    }

    public function productoAsignado(Request $request,$id)
    {
        if ($request->ajax()) {
            $data = DotacionesEmpleado::
                    join('empleados', 'empleados.id_empleado', '=', 'dotaciones_empleados.id_empleado')->
                    select('empleados.priNom','empleados.segNom','empleados.priApe','empleados.segApe','dotaciones_empleados.id_producto','dotaciones_empleados.cantidad','dotaciones_empleados.created_at')->          
                    where('dotaciones_empleados.id_producto',$id)->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('fecha', function ($request) {
               // return $request->created_at->format('Y-m-d'); // human readable format
                return $request->created_at->toFormattedDateString();
              })
            ->addColumn('nombre', function ($row) { 
                return $row->priNom.' '.$row->segNom.' '.$row->priApe.' '.$row->segApe;
             })
             
            ->addColumn('action', function($row){  $ruta="/dashboard/productos/".$row->id_producto;
            $action = '<a class="btn btn-info verMaquina" id="verMaquina" href='.$ruta.'>Ver asignación</a>
                      <a class="btn btn-dark verMaquina" id="verMaquina" href='.$ruta.'/edit'.'>Editar</a>
                      ';
            
            return $action;
            
            })
            ->rawColumns(['action'])
            ->make(true);
            }
    }
}

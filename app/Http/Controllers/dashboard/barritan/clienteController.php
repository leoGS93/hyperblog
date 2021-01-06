<?php

namespace App\Http\Controllers\dashboard\barritan;

use DataTables;
use App\Cliente;
use Redirect,Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientePost;
use App\Http\Requests\UpdateClientePut;
use Illuminate\Support\Facades\Session;




                    

class clienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rol.empresa');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Cliente::orderBy('priNombre','desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            
            ->addColumn('imagen', function ($row) { $url="https://recursosbarritan.s3.us-east-2.amazonaws.com".$row->avatar; 
                return '<img src='.$url.' border="0" width="60px" class="img-rounded" align="center" />';
             })
            ->addColumn('action', function($row){  $ruta="/dashboard/clientes/".$row->id_cliente;
            $action = '<a class="btn btn-info verMaquina" id="verMaquina" href='.$ruta.'>Ver</a>
                      <a class="btn btn-dark verMaquina" id="verMaquina" href='.$ruta.'/edit'.'>Editar</a>
                      <button data-toggle="modal" data-target="#deleteCliente" data-nombre="'.$row->priNombre.' '.$row->priApellido.'" data-id="'.$row->id_cliente.'"
                        class="btn btn-danger"><i class="fa fa-trash"></i></button>
                      ';
            
            return $action;
            
            })
            ->rawColumns(['imagen'],['action'])
            ->make(true);
            }
            
            return view('dashboard.control-interno.clientes.index');
    }

    public function create()
    {
        return view('dashboard.control-interno.clientes.create');
    }

    public function store(StoreClientePost $request)
    {
       

        if($foto = Cliente::setFoto($request->portada))
            $request->request->add(['foto'=>$foto]);
            
   
        $cliente=new Cliente();
        $cliente->cargo=$request['cargo'];
        $cliente->empresa=$request['empresa'];
        $cliente->priNombre=$request['priNombre'];
        $cliente->segNombre=$request['segNombre'];
        $cliente->priApellido=$request['priApellido'];
        $cliente->segApellido=$request['segApellido'];
        $cliente->email=$request['email'];
        $cliente->numTelefono=$request['numTelefono'];
        $cliente->direccion=$request['direccion'];
        $cliente->avatar=$request['foto'];
        $cliente->save();

        Session::flash('status_registro', 'se registro el cliente con exito!');
        return redirect('dashboard/clientes');

        
    }

    public function show($url)
    {
        $cliente = Cliente::where('url_clean',$url)->firstOrFail();
        return view('dashboard.control-interno.cliente.show',compact('cliente'));
    }

    public function edit($id)
    {
        $cliente=Cliente::find($id);
        return view('dashboard.control-interno.clientes.edit', ["cliente"=>$cliente]);
    }

    public function update(Request $request, $id)
    {
        $cliente=Cliente::find($id); 

        $request->validate([
            'email'=>['required',
                      'email',
                      'max:255',
                      Rule::unique('clientes', 'email')->ignore($cliente->id_cliente, 'id_cliente'),
             ], 
             'cargo' =>'required',
            'empresa'=> 'required',
            'priNombre'=>'required',
            'priApellido'=> 'required',
            'numTelefono'=>'required',
        ]);

        
     
        
        
        if($foto = Cliente::setFoto($request->portada,$cliente->avatar)){
            $request->request->add(['foto'=>$foto]);

            $cliente->cargo=$request['cargo'];
            $cliente->empresa=$request['empresa'];
            $cliente->priNombre=$request['priNombre'];
            $cliente->segNombre=$request['segNombre'];
            $cliente->priApellido=$request['priApellido'];
            $cliente->segApellido=$request['segApellido'];
            $cliente->email=$request['email'];
            $cliente->numTelefono=$request['numTelefono'];
            $cliente->direccion=$request['direccion'];
            $cliente->avatar=$request['foto'];

        }else{
            $cliente->cargo=$request['cargo'];
            $cliente->empresa=$request['empresa'];
            $cliente->priNombre=$request['priNombre'];
            $cliente->segNombre=$request['segNombre'];
            $cliente->priApellido=$request['priApellido'];
            $cliente->segApellido=$request['segApellido'];
            $cliente->email=$request['email'];
            $cliente->numTelefono=$request['numTelefono'];
            $cliente->direccion=$request['direccion'];
        }
        $cliente->save();
    
        Session::flash('status_actualizar', 'se actualizo el cliente con exito!');
        return redirect('/dashboard/clientes');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id)->delete();
   
        Session::flash('status_eliminar', 'se elimino el cliente con exito!');
        return back();
    }
}

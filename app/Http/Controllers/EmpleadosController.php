<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleados;
use App\Models\nominas;
use App\Models\departamentos;
use Session;
class EmpleadosController extends Controller
{

    public function reporteempleados(){
        $consulta = empleados::withTrashed()->join('departamentos','empleados.idd','=','departamentos.idd')
                        ->select('empleados.ide','empleados.nombre','empleados.apellido','departamentos.nombre as depa','empleados.email','empleados.deleted_at')
                        ->orderBy('empleados.nombre')
                        ->get();
                        
        return view('reporteempleados')->with('consulta', $consulta);
    }
    public function altaempleado(){
        $consulta = empleados::orderBy('ide','DESC')
                            ->take(1)->get();

        $cuantos = count($consulta);
        if($cuantos==0)
        {
            $idesigue = 1;
        }
        else{
            $idesigue = $consulta[0]->ide + 1;
        }
        
        $departamentos = departamentos::orderBy('nombre')->get();

        return view('altaempleado')
        ->with('idesigue',$idesigue)
        ->with('departamentos',$departamentos);
    }
    public function guardarempleado(Request $request)
    {

    $this->validate($request,[
        'nombre'  => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ü]+$/',
        'apellido'  => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ü]+$/',
        'email'  => 'required|email',
        'celular'  => 'required|regex:/^[0-9]{10}$/',
        
    ]);

        $empleados = new empleados;
        $empleados->ide = $request->ide;
        $empleados->nombre = $request->nombre;
        $empleados->apellido = $request->apellido;
        $empleados->email= $request->email;
        $empleados->celular = $request->celular;
        $empleados->sexo = $request->sexo;
        $empleados->descripcion = $request->descripcion;
        $empleados->idd = $request->idd;
        $empleados->save();

       Session::flash('mensaje', "El empleado $request->nombre $request->apellido ha sido dado de alta correctament");

            return redirect()->route('reporteempleados');
        
    }

    public function activarempleado($ide)
    {
        empleados::withTrashed()->where('ide',$ide)->restore();

        Session::flash('mensaje', "El empleado ha sido activado correctamente");

            return redirect()->route('reporteempleados');
    }

    public function desactivaempleado($ide)
    {
        $empleados = empleados::find($ide);
        $empleados->delete();
        Session::flash('mensaje', "El empleado ha sido desactivado correctamente");

            return redirect()->route('reporteempleados');
        
    }
    public function borraempleado($ide)
    {
        $buscaempleado = nominas::where('ide',$ide)->get();
        $cuantos = count($buscaempleado);
        if($cuantos==0)
        {
        empleados::withTrashed()->find($ide)->forceDelete();
        Session::flash('mensaje', "El empleado ha sido borrado del sistema correctamente");

        return redirect()->route('reporteempleados');
        }
        else{
            Session::flash('mensaje', "El empleado no se puede eliminar ya que tiene registros en otra tabla");

            return redirect()->route('reporteempleados');
        }
    }
    
    public function modificaempleado($ide)
    {
        $consulta = empleados::withTrashed()->join('departamentos','empleados.idd','=','departamentos.idd')
                        ->select(
                            'empleados.ide',
                            'empleados.nombre',
                            'empleados.apellido',
                            'empleados.sexo',
                            'departamentos.nombre as depa',
                            'empleados.email',
                            'empleados.idd',
                            'empleados.celular',
                            'empleados.descripcion'
                            )
                        ->where('ide',$ide)
                        ->get();
        $departamentos = departamentos::all();
        return view('modificaempleado')
        ->with('consulta',$consulta[0])
        ->with('departamentos',$departamentos);
    }

    public function guardacambios(Request $request)
    {  
        $this->validate($request,[
        'nombre'  => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ü]+$/',
        'apellido'  => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ü]+$/',
        'email'  => 'required|email',
        'celular'  => 'required|regex:/^[0-9]{10}$/',
        
    ]);

        $empleados = empleados::withTrashed()->find($request->ide);
        $empleados->ide = $request->ide;
        $empleados->nombre = $request->nombre;
        $empleados->apellido = $request->apellido;
        $empleados->email= $request->email;
        $empleados->celular = $request->celular;
        $empleados->sexo = $request->sexo;
        $empleados->descripcion = $request->descripcion;
        $empleados->idd = $request->idd;
        $empleados->save();


      /*  return view('mensajes')
        ->with('proceso',"Modifica empleados")
        ->with('mensaje',"El empleado $request->nombre $request->apellido ha sido modificado correctamente")
        ->with('error',0); */
        Session::flash('mensaje', "El empleado $request->nombre ha sido modificado correctamente");

        return redirect()->route('reporteempleados');
    }

    public function eloquent()
    {
        //$consulta = empleados::all();\

       /* $empleados = new empleados;
        $empleados->ide = 3;
        $empleados->nombre = "joel";
        $empleados->apellido = "Lara";
        $empleados->email= "joe1@gmail.com";
        $empleados->celular = "7344345566";
        $empleados->sexo = "M";
        $empleados->descripcion = "Prueba de insercion";
        $empleados->idd = 1;
        $empleados->save();*/

        /*$empleados = empleados::create([
        'ide' => 4, 'nombre' => "Paty", 'apellido' => "Mendez", 'email' => "paty@gmail.com",
        'celular' =>"7234244343", 'sexo' =>"F", 'descripcion' => "prueba", 'idd'=> 2
        ]);*/

       /* $empleados = empleados::find(2);
        $empleados->nombre = "Dulce";
        $empleados->apellido = "Montiel";
        $empleados->save();*/

        /*empleados::where('sexo', 'M')
        ->update(['nombre' => 'Daniel', 'celular' => '5555555555']);*/


       //empleados::destroy(4);

        // $empleados = empleados::find(3);
        // $empleados->delete();

    //    $empleados=empleados::where('sexo', 'M')
    //    ->where('apellido', 'Lara')
    //    ->delete();
       
       // $consulta = empleados::all();

       //$consulta = empleados::withTrashed()->get();

        /* $consulta = empleados::onlyTrashed()
             ->where('sexo','M')
            ->get(); */

        /*  empleados::withTrashed()->where('ide',3)->restore();
         $consulta = empleados::all();
        return $consulta;
         return "restauracion realizada";  */

         /* $empleados=empleados::find(1)->forceDelete();
         $consulta = empleados::all(); */


    //     $consulta = empleados::all();

    //     $consulta = empleados::where('sexo','M')->get();

    //     $consulta = empleados::where('edad','>=',20)
    //                          ->where('edad','<=',30)
    //                          ->get();

    //     $consulta = empleados::where('edad','>=',20)
    //                          ->orwhere('sexo','F')
    //                          ->get();

    //     $consulta = empleados::whereBetween('edad',[20,24])->get();

    //     $consulta = empleados::whereIn('ide',[2,3,4,5])
    //                          ->orderBy('nombre', 'desc')
    //                          ->get();

    //     $consulta = empleados::where('edad', '>=',20)
    //                             ->where('edad', '<=',30)
    //                             ->take(2)
    //                             ->get();
                        
    //     $consulta = empleados::select(['nombre', 'apellido', 'edad'])
    //                             ->where('edad', '>=',30)
    //                             ->get();

    //     $consulta = empleados::select(['nombre', 'apellido', 'edad'])
    //                             ->where('apellido', 'LIKE','%er%')
    //                             ->get();
        
    //     $consulta = empleados::where('sexo', 'F')->sum('salario');

    //     $consulta = empleados::groupBy('sexo')
    //                         ->selectRaw('sexo,sum(salario) as salariototal')
    //                         ->get();
        
    //     $consulta = empleados::groupBy('sexo')
    //                         ->selectRaw('sexo,count(*) as cuantos')
    //                         ->get();

                            
    //  /*SQL = "SELECT e.ide, e.nombre, d.nombre AS departamento, e.edad i
    //     FROM empleados AS e
    //     INNER JOIN departamentos AS d ON d.idd = e.idd
    //     WHERE e.edad>=30"*/
                            
        
    //     $consulta = empleados::join('departamentos','empleados.idd','=','departamentos.idd')
    //                         ->select('empleados.ide','empleados.nombre','departamentos.nombre as depa','empleados.edad')
    //                         ->where('empleados.edad', '>=',30)
    //                         ->get();

    //     $cuantos =count($consulta);
    

        
    //     return $cuantos;


    }

    public function vista1()
    {
        return view('vista1');
    }    
    public function vista2()
    {
        return view('vista2');
    }
    public function vb()
    {
        return view('bootstrap');
    }
    public function saludo($nombre,$dias)
    {
        $pago = 100;
        $nomina = $dias * $pago;
        return view('empleado', compact('nombre', 'dias', 'nomina'));

        //return view('empleado', ['nombre' => $nombre, 'dias' => $dias]);

        /* return view('empleado')
        ->with('nombre', $nombre)
        ->with('dias', $dias);*/
    }
    public function salir(){
        return "Salir";
    }
    public function mensaje()
    {
        return "Hola trabajador";
    }
    public function pago()
    {
        $dias = 7;
        $pago = 600;
        $nomina = $dias * $pago;
        return "el pago del empleado es $nomina";
    }
    public function nomina ($diast,$pago){
        $nomina = $diast * $pago;
        dd($nomina,$pago,$diast);
        return "el pago es $nomina con dias $diast y pago diario de $pago";
    }
}

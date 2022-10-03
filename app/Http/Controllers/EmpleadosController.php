<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function altaempleado(){
        return view('altaempleado');
    }
    public function guardarempleado(Request $request)
    {
       // return $request;
       $nombre = $request->nombre;
       $sexo = $request->sexo;
       if($sexo =='M')
       {
        echo "El empleado $nombre es de sexo Masculino";
       }
       else{
        echo "El empleado $nombre es de sexo Femenino";
       }
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

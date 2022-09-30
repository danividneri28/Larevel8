<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/estilo.css')}}">
    <title>Vista1</title>
</head>
<body>
    <h1> Empresa Danivid.com </h1>
    <br>
    Nombre del empleado  {{$nombre}} trabajo {{$dias}} se le pago {{$nomina}}
    <br>
    @if($nombre =="Gojo")
    <h1> Hola Gojo</h1>
    <br>
    <img src="{{asset('fotos/gojo.png')}}" alt="" weigth="250" height="250">
    @endif
    @if($nombre =="Sukuna")
    <h1> Hola Sukuna</h1>
    <br>
    <img src="{{asset('fotos/sukuna.png')}}" alt="" weigth="250" height="250">
    @else
    <h1>Sin Foto</h1>
    <br>
    @endif
    <br>
    <a href="{{route('salir') }}">salir</a>
 </body>
</html>
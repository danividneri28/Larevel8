@extends('bootstrap')

@section('contenido')
<div class="container">
    <h1>Proceso {{$proceso}}</h1>
<br/>
@if($error==0)
<div class="alert alert-dismissible alert-success">
   {{$mensaje}}
</div>
@else
<div class="alert alert-dismissible alert-warning">
    {{$mensaje}}
</div>
@endif
</div>
@stop
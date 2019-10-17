@extends ('layouts.admin')
@section('content')
<div class="row">

    <div class="col-md-8">
        @include('principal.charts.index')
    </div>

    <div class="col-md-4">
        @include('principal.partials-box.productos')
        @include('principal.partials-box.facturas')
        @include('principal.partials-box.compras')
        @include('principal.partials-box.clientes')
    </div>

    <div class="col-md-6">
        @include('principal.ranking-cliente.ranking')
    </div>

    <div class="col-md-6">
        @include('principal.ranking-municipio.ranking')
    </div>

</div>
@endsection
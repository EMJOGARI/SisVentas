@extends ('layouts.admin')
@section('content')
<diw class="row">

    <div class="col-md-6">
        @include('principal.ranking-cliente.ranking')
    </div>
    <div class="col-md-6">
        <div class="row">
              <div class="col-md-6">
                  @include('principal.partials-box.productos')
              </div>

              <div class="col-md-6">
                  @include('principal.partials-box.facturas')
              </div>

              <div class="col-md-6">
                  @include('principal.partials-box.compras')
              </div>

              <div class="col-md-6">
                  @include('principal.partials-box.clientes')
              </div>
        </div>
    </diw>
    <div class="col-md-12">
        @include('principal.ranking-municipio.ranking')
    </div>

</div>
@endsection
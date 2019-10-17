<div class="box box-primary">
  <div class="box-header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <h3 class="box-title"><strong>{!! 'Compras & Ventas '. date('Y') !!}</strong></h3>
      </div>

    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
        {!! $chart->container() !!}

        {!! $chart->script() !!}
  </div>
  <!-- /.box-body -->
</div>
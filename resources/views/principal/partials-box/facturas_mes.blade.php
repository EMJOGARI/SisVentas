<div class="info-box bg-green">
    <span class="info-box-icon"><i class="fa fa-money"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">@foreach($ventas_mes as $ven)
                                        Ventas {{ $ven->nombre }}</h3>
                                    @endforeach </span>
        <span class="info-box-number">
            @foreach($cantidad_mes as $cant)
                {{ $cant->cantidad }} Art. =</h3>
            @endforeach            
            @foreach($venta_total_mes as $ven)
                {{ number_format($ven->ventas, 2, ',', '.') }}</h3>
            @endforeach
        </span>
        <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
            @foreach($ventas_mes as $ven)
                Facturas emitidas: {{ $ven->ventas }}</h3>
            @endforeach
        </span>
    </div><!-- /.info-box-content -->
</div><!-- /.info-box -->
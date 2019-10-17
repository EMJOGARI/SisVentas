<div class="info-box bg-green">
    <span class="info-box-icon"><i class="fa fa-money"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">Ventas {{ date('Y') }}</span>
        <span class="info-box-number">
            @foreach($venta_total as $ven)
                {{ number_format($ven->ventas, 2, ',', '.') }}</h3>
            @endforeach
        </span>
        <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
            @foreach($ventas as $ven)
                Facturas emitidas: {{ $ven->ventas }}</h3>
            @endforeach
        </span>
    </div><!-- /.info-box-content -->
</div><!-- /.info-box -->
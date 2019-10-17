<div class="info-box bg-yellow">
    <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">Compras {{ date('Y') }}</span>
        <span class="info-box-number">
            @foreach($ingreso_total as $ing)
                {{ number_format($ing->compras, 2, ',', '.') }}
            @endforeach
        </span>
        <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
            @foreach($ingresos as $ing)
                Compras realizadas: {{ $ing->ingresos }}
            @endforeach
        </span>
    </div><!-- /.info-box-content -->
</div><!-- /.info-box -->
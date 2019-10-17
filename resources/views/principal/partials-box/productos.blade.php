<div class="info-box bg-purple">
    <span class="info-box-icon"><i class="fa fa-tags"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">Inventario Neto</span>
        <span class="info-box-number">{{ number_format($neto_inventario, 2, ',', '.') }}</span>
        <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
            @foreach($articulos as $art)
                Productos en stock: {{ $art->total }}
             @endforeach
        </span>
    </div><!-- /.info-box-content -->
</div><!-- /.info-box -->
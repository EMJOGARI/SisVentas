<div class="info-box bg-aqua">
    <span class="info-box-icon"><i class="fa fa-users "></i></span>
    <div class="info-box-content">
        <span class="info-box-text">Clientes</span>
        <span class="info-box-number">
            @foreach($clientes as $per)
                {{ $per->personas }}
            @endforeach
        </span>
        <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
            @foreach($cli_new as $per)
                Clientes nuevos: {{ $per->personas }}
            @endforeach
        </span>
    </div><!-- /.info-box-content -->
</div><!-- /.info-box -->
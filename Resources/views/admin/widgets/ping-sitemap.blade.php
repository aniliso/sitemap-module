<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Google Site Haritası</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="display: block;">
        <a id="ping-sitemap" class="btn btn-block btn-warning">Bildir</a>
    </div>
    <!-- /.box-body -->
</div>

<script>
    var pingSitemap = $("#ping-sitemap");
    var successClass = 'btn btn-block btn-success';
    var errorClass = 'btn btn-block btn-error';
    var warningClass = 'btn btn-block btn-warning';
    pingSitemap.on('click', function () {
        pingSitemap.removeClass().addClass(warningClass).html('Bildiriliyor...');
        $.get("{{ route('sitemap.ping') }}", function(data){
            if(data.success) {
                pingSitemap.html('Bildirildi').removeClass().addClass(successClass);
            } else {
                pingSitemap.html('Bildirilmedi').removeClass().addClass(errorClass);
            }
        });
    });
</script>
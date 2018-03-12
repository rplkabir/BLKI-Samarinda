<form class="form-horizontal" action="{{url('/admin/renlakgiat/cari/')}}" method="POST"  enctype="multipart/form-data">
    {{ csrf_field() }}
        <div class="form-group">
            <div class="col-md-5">
                <label for="status_nominatif_instruktur" class="control-label">Kejuruan</label>
                <input type="search" name="cariK" class="form-control">
            </div>
            <div class="col-md-5">
                <label for="status_nominatif_instruktur" class="control-label">Program Pelatihan</label>
                <input type="search" name="cariP" class="form-control">
            </div>
            <div class="col-md-2">
                <button class="btn btn-default"><span class="material-icons">search</span></button>
            </div>
        </div>
</form>
    
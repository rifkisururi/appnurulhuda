@extends('layouts.layout')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Tagihan</h1>
</div>
<div class="card-header py-3" align="right">
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btnprimary shadow-sm" data-toggle="modal" data-target="#exampleModalScrollable">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
    </button>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Santri</th>
                        <th>Tagihan</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tagihan as $t)
                    <tr>
                        <td>{{ $t->nama_santri}}</td>
                        <td>{{ $t->name}}</td>
                        <td> <?php echo number_format($t->jumlah) ?></td>
                        <td>
                            <?php
                            if ($t->flag_pay == 0) {
                                echo "belum bayar";
                            } else {
                                echo "lunas";
                            }
                            ?>
                        </td>
                        <td> <button class="btn btn-success">Terima</button> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" ariahidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modaltitle" id="exampleModalScrollableTitle">Tambah Data Santri</h5>
                <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('santri-post') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Santri</label>
                        <select class="form-control" name="id_user" required>
                            <option value="">Pilih Santri</option>
                            @foreach($santri as $s){
                            <option>{{ $s->name }}</option>
                            }
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Tagihan</label>
                        <select class="form-control" name="id_tagihan_master" id="id_tagihan_master" onchange='getNominal()' required>
                            <option value="">Pilih Tagihan</option>
                            @foreach($tagihan_master as $tm){
                            <option value="{{ $tm->id }}">{{ $tm->name }}</option>
                            }
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <td><input type="text" class="form-control" name="jumlah" id="jumlah" disabled> </td>
                    </div>
                    <div class="form-group">
                        <label style="color: red;">Setelah tekan tombol "Simpan", orang tua/ Wali santri akan mendapat notifkasi tagihan melalui Whatsapp</label>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" datadismiss="modal"> Batal</button>
                    <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                </div>
        </div>
        </form>
    </div>
</div>

<script>
    function getNominal() {
        var id = document.getElementById("id_tagihan_master").value;
        var url = "http://127.0.0.1:8000/nominal_tagihan/" + id;
        $.get(url, function(data) {
            console.log(data.data.jumlah);
            document.getElementById("jumlah").value = numberWithCommas(data.data.jumlah);
        });

    }

    function numberWithCommas(x) {
        x = x.toString();
        var pattern = /(-?\d+)(\d{3})/;
        while (pattern.test(x))
            x = x.replace(pattern, "$1,$2");
        return x;
    }
</script>

@endsection
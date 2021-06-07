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
                        <th>Yayasan</th>
                        <th>Nominal</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tagihan as $t)
                    <tr>
                        <td>{{ $t->nama_santri}}</td>
                        <td>{{ $t->name}}</td>
                        <td>{{ $t->namaYayasan}}</td>

                        <td> <?php echo number_format($t->jumlah) ?></td>
                        <td>{{ $t->jatuh_tempo}}</td>
                        <td>
                            <?php
                            if ($t->flag_pay == 0) {
                                echo "belum bayar";
                            } else {
                                echo "lunas";
                            }
                            ?>
                        </td>
                        <td>

                            @php
                            if ($t->tanggal_bayar == '2021-01-01') {
                            @endphp
                            <button class="btn btn-info" onclick="action({{$t->id}},1)">Terima Pembayaran</button>
                            @php
                            }else{
                            $tgl1 = date('Y-m-d'); // pendefinisian tanggal awal
                            $tgl2 = date('Y-m-d', strtotime('-3 days', strtotime($tgl1)));

                            if ($t->tanggal_bayar >= $tgl2) {
                            @endphp
                            <button class="btn btn-warning" onclick="action({{$t->id}},0)">batalkan penerimaan</button>
                            @php
                            }else{
                            @endphp
                            <button class='btn btn-success'>Lunas</button>

                            @php
                            }
                            }

                            @endphp

                        </td>
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
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Santri</label><br>
                        <select class="form-control" id="santri" name="id_user" required>
                            <option value="">Pilih Santri</option>
                            @foreach($santri as $s){
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                            }
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Tagihan</label>
                        <select class="form-control" name="id_tagihan_master" id="id_tagihan_master" onchange='getNominal()' required data-live-search="true">
                            <option value="">Pilih Tagihan</option>
                            @foreach($tagihan_master as $tm){
                            <option value="{{ $tm->id }}">{{ $tm->name }}</option>
                            }
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" disabled>
                        <input type="text" class="form-control" hidden name="jumlah" id="jumlah2">
                    </div>
                    <div class="form-group">
                        <label>Jatuh Tempo</label>
                        <input type="date" class="form-control" name="jatuhtempo">
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
    $(document).ready(function() {
        $('#santri').select2({
            theme: 'bootstrap4',
            selectOnClose: true,
            placeholder: "masukan nama santri ...",
            allowClear: true
        });
    });

    function getNominal() {
        var id = document.getElementById("id_tagihan_master").value;
        var url = "nominal_tagihan/" + id;
        $.get(url, function(data) {
            console.log(data.data.jumlah);
            document.getElementById("jumlah").value = data.data.jumlah;
            document.getElementById("jumlah2").value = data.data.jumlah;

        });
    }

    function action(id, status) {
        var note;
        if (status == 1) {
            note = "Apakah anda yakin sudah menerima pembayaran ini ?";
        } else {
            note = "Apakah anda yakin membatalkan penerimaan pembayaran ini ?";
        }
        var isconfirm = confirmAlert(note);
        if (isconfirm == 1) {
            var url = "tagihanAction?id=" + id + "&action=" + status;
            $.get(url, function(data) {
                location.reload();
            });

        }
    }

    function numberWithCommas(x) {
        x = x.toString();
        var pattern = /(-?\d+)(\d{3})/;
        while (pattern.test(x))
            x = x.replace(pattern, "$1,$2");
        return x;
    }

    function confirmAlert(note) {
        var isconfirm;
        var r = confirm(note);
        if (r == true) {
            isconfirm = 1;
        } else {
            isconfirm = 0;
        }

        return isconfirm;
    }
</script>

@endsection
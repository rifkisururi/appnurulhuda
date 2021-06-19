@extends('layouts.template')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Master Data Tagihan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item">Master Data Tagihan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header py-3" align="right">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalScrollable">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
                    </button>
                </div>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nama Tagihan</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tagihan_master as $t)
                                    <tr>
                                        <td>{{ $t->name}}</td>
                                        <td>{{ $t->keterangan}}</td>
                                        <td> <?php echo number_format($t->jumlah) ?></td>
                                        <td>
                                            <button onclick="edit({{$t->id}},'{{$t->name}}','{{$t->keterangan}}',{{$t->jumlah}})" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit">
                                                <i class=""></i> Edit
                                            </button>
                                            @php
                                            if($t->used == 0){
                                            @endphp
                                            <a href="/tagihanMasterHapus/{{$t->id}}"><button class="btn btn-danger">Delete</button></a>
                                            @php
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
            </div>
    </section>
</div>
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" ariahidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modaltitle" id="exampleModalScrollableTitle">Tambah Data Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tagihanMaster-post') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Tagihan</label>
                        <td><input type="text" class="form-control" name="name" required> </td>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <td><input type="text" class="form-control" name="keterangan" required> </td>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <td><input type="number" class="form-control" name="jumlah" min="1" required> </td>
                        <label style="color: red;">Cukup angka saja, jangan ditambah tanda baca titik (.) atau koma (,)</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" datadismiss="modal"> Batal</button>
                    <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                </div>
            </form>
        </div>

    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" ariahidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modaltitle" id="exampleModalScrollableTitle">Update Data Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tagihanMaster-put') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Tagihan</label>
                        <td><input type="text" class="form-control" id="nama" name="name" required> </td>
                        <td><input type="text" class="form-control" id="id" name="id" hidden> </td>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <td><input type="text" class="form-control" id="keterangan" name="keterangan" required> </td>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <td><input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required> </td>
                        <label style="color: red;">Cukup angka saja, jangan ditambah tanda baca titik (.) atau koma (,)</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" datadismiss="modal"> Batal</button>
                    <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    function numberWithCommas(x) {
        x = x.toString();
        var pattern = /(-?\d+)(\d{3})/;
        while (pattern.test(x))
            x = x.replace(pattern, "$1,$2");
        return x;
    }

    function edit(id, nama, keterangan, jumlah) {
        document.getElementById('id').value = id;
        document.getElementById('nama').value = nama;
        document.getElementById('keterangan').value = keterangan;
        document.getElementById('jumlah').value = jumlah;

    }

    function hapus(id) {
        var note;
        note = "Apakah anda yakin menghapus data ini ?";
        var isconfirm = confirmAlert(note);
        if (isconfirm == 1) {
            var url = "yayasan?id=" + id;
            $.get(url, function(data) {
                location.reload();
            });
        }
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
@extends('layouts.template')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Master Data Yayasan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item">Master Data Yayasan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalAdd">
                        <i class="fas fa-plus fa-sm text-white-50 "></i> Tambah
                    </button>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nama Yayasan</th>
                                    <th>Status</th>
                                    <th>Jumlah Santri</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($yayasan as $y)
                                <tr>
                                    <td>{{ $y->nama}}</td>
                                    <td>
                                        @php
                                        if($y->status == 1){
                                        echo "Aktif";
                                        }else {
                                        echo "Tidak Aktif";
                                        }
                                        @endphp
                                    </td>
                                    <td>{{ $y->jumlah }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit" onclick="change({{ $y->id }},{{ $y->status }},'{{ $y->nama}}')">Edit</button>
                                        @php
                                        if($y->jumlah == 0){
                                        echo "<button class='btn btn-danger' onclick='hapus({$y->id})'>Hapus</button>";
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

<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="" ariahidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modaltitle" id="exampleModalScrollableTitle">Tambah Data Yayasan</h5>
                <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control">
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

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="" ariahidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" id="id" name="id" class="form-control" hidden>
                        <input type="text" id="nama" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status_1" value="1">
                            <label class="form-check-label">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status_0" value="0">
                            <label class="form-check-label">
                                Tidak Aktif
                            </label>
                        </div>

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
        $('#dataTable').DataTable();
    });

    function change(id, status, nama) {
        console.log('nama', nama);
        document.getElementById('id').value = id;
        document.getElementById('nama').value = nama;
        if (status == 1) {
            document.getElementById('status_1').checked = true;
        } else {
            document.getElementById('status_0').checked = true;
        }
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
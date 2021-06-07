@extends('layouts.layout')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Master Data Santri</h1>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <div class="card-body">
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalScrollable">
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
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit" onclick="change({{ $y->id }},{{ $y->id }},'{{ $y->nama}}')">Edit</button>
                            @php
                            if($y->jumlah == 0){
                            echo "<button class='btn btn-danger' onclick='hapus({{ $y->id}})'>Hapus</button>";
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
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control">
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

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" ariahidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                        <select name="status" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
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
    function change(id, status, nama) {
        document.getElementById('id').value = id;
        document.getElementById('status').value = status;
        document.getElementById('nama').value = nama;
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
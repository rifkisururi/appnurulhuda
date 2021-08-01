@extends('layouts.layout')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Tagihan</h1>
</div>
<div class="card-header py-3">
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

                            @php
                            if($t->used == 0){
                            @endphp

                            <a href="/tagihanMasterHapus/{{$t->id}}"><button class="btn btn-danger">Delete</button></a>
                            @php
                            }
                            @endphp
                            <button onclick="edit({{$t->id}},'{{$t->name}}','{{$t->keterangan}}',{{$t->jumlah}})" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#editData">
                                Edit
                            </button>
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
                <h5 class="modaltitle" id="exampleModalScrollableTitle">Tambah Data Master Tagihan</h5>
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
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" ariahidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tagihanMaster-post') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Tagihan</label>
                        <td>
                            <input type="text" class="form-control" name="name" id="namaTagihan" required>
                            <input type="text" class="form-control" name="idTagihan" id="idTagihan" required hidden>
                        </td>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <td><input type="text" class="form-control" name="keterangan" id="keterangan" required> </td>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <td><input type="number" class="form-control" name="jumlah" min="1" id="jumlah" required> </td>
                        <label style="color: red;">Cukup angka saja, jangan ditambah tanda baca titik (.) atau koma (,)</label>
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
    function edit(id, nama, keterangan, jumlah) {
        document.getElementById('idTagihan').value = id;
        document.getElementById('namaTagihan').value = nama;
        document.getElementById('keterangan').value = keterangan;
        document.getElementById('jumlah').value = jumlah;
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
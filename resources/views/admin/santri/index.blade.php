@extends('layouts.layout')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Master Data Santri</h1>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <div class="card-body">
        <form method="GET">
            <div class="form-group row">
                <label for="inputCity">Pilih Yayasan</label>
                <div class="col-sm-6">
                    <select class="form-control" name="id_yayasan" required>
                        <option value="">Pilih Yayasan</option>
                        <option value="0">Semua Yayasan</option>
                        @foreach($yayasan as $y){
                        <option value="{{ $y->id }}">{{ $y->nama }}</option>
                        }
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary">Filter</button>
            </div>
        </form>


        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalScrollable">
            <i class="fas fa-plus fa-sm text-white-50 "></i> Tambah
        </button>

        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Hp</th>
                        <th>Yayasan</th>
                        <th>Hak Akses</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($santri as $u)
                    <tr>
                        <td>{{ $u->name}}</td>
                        <td>{{ $u->email}}</td>
                        <td>
                            {{ $u->no_hp1}} <br>
                            {{ $u->no_hp2}}
                        </td>
                        <td>{{ $u->namaYayasan}}</td>
                        <td>
                            {{ $u->hakAkses}}
                        </td>
                        <td>

                            @role('admin')
                            <a href="user/ubahAkses/{{ $u->id}}"><button class="btn btn-warning btn-sm">Ubah Akses</button></a>
                            @endrole

                            <button onclick="edit('{{$u->id}}','{{ $u->name}}','{{ $u->email}}','{{ $u->no_hp1}}','{{ $u->no_hp2}}' ,'{{ $u->id_yayasan}}','{{ $u->namaYayasan}}')" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEdit">
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
                <h5 class="modaltitle" id="exampleModalScrollableTitle">Tambah Data Santri</h5>
                <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('santri-post') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No Hp</label>
                        <input type="text" name="no_hp1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No Hp Alternatif</label>
                        <input type="text" name="no_hp2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Yayasan</label>
                        <select class="form-control" name="id_yayasan" required>
                            <option value="">Pilih Yayasan</option>
                            @foreach($yayasan as $y){
                            <option value="{{ $y->id }}">{{ $y->nama }}</option>
                            }
                            @endforeach
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

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" ariahidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modaltitle" id="exampleModalScrollableTitle">Edit Data Santri</h5>
                <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('santri-post') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" id="nama" class="form-control">
                        <input type="number" name="id" id="idSantri" class="form-control" hidden>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No Hp</label>
                        <input type="text" name="no_hp1" id="no_hp1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No Hp Alternatif</label>
                        <input type="text" name="no_hp2" id="no_hp2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Yayasan</label>
                        <select class="form-control" name="id_yayasan" id="" required>
                            <option value="" id="id_yayasanValue">
                                <p id="namaYayasan">Nam</p>
                            </option>
                            @foreach($yayasan as $y){
                            <option value="{{ $y->id }}">{{ $y->nama }}</option>
                            }
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                </div>
        </div>
        </form>
    </div>
</div>

<script>
    function edit(id, nama, email, no_hp1, no_hp2, id_yayasan, namaYayasan) {
        console.log(nama);
        document.getElementById('idSantri').value = id;
        document.getElementById('nama').value = nama;
        document.getElementById('email').value = email;
        document.getElementById('no_hp1').value = no_hp1;
        document.getElementById('no_hp2').value = no_hp2;
        document.getElementById('no_hp2').value = no_hp2;
        document.getElementById('id_yayasanValue').value = id_yayasan;
        console.log('namaYayasan', namaYayasan);
        document.getElementById('id_yayasanValue').innerHTML = namaYayasan;

    }

    function hapusFilter() {
        window.reload();
    }
</script>
@endsection
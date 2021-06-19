@extends('layouts.template')
@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Master Data Santri</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item">Master Data Santri</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <form method="GET">
                            <div class="form-group row">
                                <h3>Yayasan</h3>
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
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 18px;">
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
                                            <a href="user/ubahAkses/{{ $u->id}}"><button class="btn btn-warning ">Ubah Akses</button></a>
                                            <a href="user/ubahAkses/{{ $u->id}}"><button class="btn btn-primary ">Edit Data</button></a>
                                            <!-- <button type="button" class="btb btn-sm btn-warning" data-toggle="modal" data-target="#editData" onclick="({{$u->id}})">Ubah Data</button> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" ariahidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modaltitle">Tambah Data Santri</h5>
                <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('santri-post') }}" method="POST">
                @csrf
                <div class="modal-body" style="font-size: 18px;">
                    <div class="form-group">
                        <label>Nama Santri</label>
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


<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    function hapusFilter() {
        window.reload();
    }

    function ubahData(id) {
        console.log('test');

        //document.getElementById('id').value = id;
        //document.getElementById('name').value = name;
    }
</script>
@endsection
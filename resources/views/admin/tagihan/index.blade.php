@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">
    
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Tambah Tagihan
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table>
            <tr>
                <td>Nama Santri</td>
                <td></td>
                <td>
                    <select class="form-control" id="sel1">
                        <option>Nama Santri 1</option>
                        <option>Nama Santri 2</option>
                        <option>Nama Santri 3</option>
                        <option>Nama Santri 4</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nama Tagihan</td>
                <td></td>
                <td><input type="text" class="form-control"> </td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td></td>
                <td><input type="number" class="form-control"> </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button class="btn btn-primary">Simpan</button> </td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Santri</th>
                        <th>Tagihan</th>
                        <th>Jumlah</th>>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tagihan as $t)
                    <tr>
                        <td>{{ $t->nama_santri}}</td>
                        <td>{{ $t->name}}</td>
                        <td>{{ $t->jumlah}}</td>
                        <td>
                        <?php 
                            if($t->flag_pay == 0){
                                echo "belum bayar";
                            }else{
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
            
@endsection
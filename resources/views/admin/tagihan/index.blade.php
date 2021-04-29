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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tagihan</h5>
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
                    <select class="form-control" name="id_user">
                        @foreach($santri as $s){
                            <option>{{ $s->name }}</option>
                        }
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nama Tagihan</td>
                <td></td>
                <td>
                    <select class="form-control" name="id_tagihan_master" id="id_tagihan_master" onchange='getNominal()'>
                        @foreach($tagihan_master as $tm){
                            <option value="{{ $tm->id }}">{{ $tm->name }}</option>
                        }
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td></td>
                <td><input type="number" class="form-control" name="jumlah" id="jumlah" disabled> </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button class="btn btn-primary" data-dismiss="modal">Simpan</button> </td>
            </tr>
        </table>
      </div>
      <div class="modal-footer" hidden>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <br>
    Filter<br>
    Status Tagihan 
    <select class="form-control" id="sel1">
        <option>Semua</option>
        <option>Lunas</option>
        <option>Belum Lunas</option>
    </select>
    
    <button class="btn btn-primary">Cari</button>

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
                        <td> <?php echo number_format($t->jumlah) ?></td>
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

            <script>
            
            
            function getNominal(){
                var id = document.getElementById("id_tagihan_master").value;
                var url = "http://127.0.0.1:8000/nominal_tagihan/" + id;
                $.get(url, function(data){
                    console.log(data.data.jumlah);
                    
                    document.getElementById("jumlah").value = data.data.jumlah;
                });

            }

            </script>
            
@endsection
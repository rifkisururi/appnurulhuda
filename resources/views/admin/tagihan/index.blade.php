@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">

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
                        
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            </div>
            </div>
            </div>
            
@endsection
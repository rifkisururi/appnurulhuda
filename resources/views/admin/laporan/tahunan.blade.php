@extends('layouts.layout')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Tagihan</h1>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4" style="overflow-x: auto">
    <div class="card-body">
        <div class="table-responsive" >
            <table class="table table-bordered table-striped" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Santri</th>
                        <th>Januari</th>
                        <th>Febuari</th>
                        <th>Maret</th>
                        <th>April</th>
                        <th>Mei</th>
                        <th>Juni</th>
                        <th>Juli</th>
                        <th>Agustus</th>
                        <th>September</th>
                        <th>Oktober</th>
                        <th>November</th>
                        <th>Desember</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $d)
                    <tr>
                        <td>{{$d->name}}</td>
                        <td>
                            @php
                                $sisa = $d->tagihan1-$d->pembayaran1;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
                                }
                            @endphp                            
                        </td>
                        
                        <td>
                            @php
                                $sisa = $d->tagihan2-$d->pembayaran2;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
                                }
                            @endphp                            
                        </td>
                        
                        <td>
                            @php
                                $sisa = $d->tagihan3-$d->pembayaran3;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
                                }
                            @endphp                            
                        </td>
                        
                        <td>
                            @php
                                $sisa = $d->tagihan4-$d->pembayaran4;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
                                }
                            @endphp                            
                        </td>
                        
                        <td>
                            @php
                                $sisa = $d->tagihan5-$d->pembayaran5;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
                                }
                            @endphp                            
                        </td>
                        <td>
                            @php
                                $sisa = $d->tagihan6-$d->pembayaran6;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
                                }
                            @endphp                            
                        </td>
                        <td>
                            @php
                                $sisa = $d->tagihan7-$d->pembayaran7;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
                                }
                            @endphp                            
                        </td>
                        
                        <td>
                            @php
                                $sisa = $d->tagihan8-$d->pembayaran8;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
                                }
                            @endphp                            
                        </td>
                        
                        <td>
                            @php
                                $sisa = $d->tagihan9-$d->pembayaran9;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
                                }
                            @endphp                            
                        </td>
                        
                        <td>
                            @php
                                $sisa = $d->tagihan10-$d->pembayaran10;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
                                }
                            @endphp                            
                        </td>
                        
                        <td>
                            @php
                                $sisa = $d->tagihan11-$d->pembayaran11;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
                                }
                            @endphp                            
                        </td>
                        
                        <td>
                            @php
                                $sisa = $d->tagihan12-$d->pembayaran12;
                                if($sisa == 0){
                                    echo "<button class='btn btn-info btn-sm'>Lunas</button>";
                                }else{
                                    echo "<button class='btn btn-warning btn-sm'>".number_format($sisa)."</button>";
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

@endsection
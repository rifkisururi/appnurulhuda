@extends('layouts.layout')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Tagihan</h1>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4" style="overflow-x: auto">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Santri</th>
                        <th>Tunggakan</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{$d->name}}</td>
                        <td>
                            @php
                            echo $d->tunggakan;
                            @endphp
                        </td>
                        <td>
                            @php
                            echo number_format($d->total);
                            @endphp
                        </td>
                        <td>
                            <button class="btn btn-primary">Terima Pembayaran</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
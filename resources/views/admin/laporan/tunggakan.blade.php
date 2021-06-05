@extends('layouts.layout')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Tunggakan Pembayaran</h1>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4" style="overflow-x: auto">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Santri</th>
                        <th>Yayasan</th>
                        <th>Tunggakan</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{$d->name}}</td>
                        <td>{{$d->NamaYayasan}}</td>
                        
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
                            <button onclick="gantiID({{$d->id}})" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Terima Pembayaran
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Tunggakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe url="" id="iframe" style="border: none;" width="100%" height="500px"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    function gantiID(id) {
        var url = "tagihanSantri?id=" + id;
        document.getElementById('iframe').src = url;
    }
</script>


@endsection
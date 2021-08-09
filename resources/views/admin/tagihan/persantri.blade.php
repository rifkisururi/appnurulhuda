<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

@guest
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{$namaSantri}}</h1>
</div>

@else
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{$namaSantri}}</h1>
</div>
@endguest



<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Tagihan</th>
                        <th>Nominal</th>
                        <th>Jatuh Tempo</th>
                        @guest
                        @else
                        @if (Auth::user()->hasRole('bendahara'))
                        <th>Aksi</th>
                        @endif
                        @endguest
                    </tr>
                </thead>
                <tbody>
                    @foreach($tagihan as $t)
                    <tr>
                        <td>{{ $t->name}}</td>
                        <td> <?php echo number_format($t->jumlah) ?></td>
                        <td>{{ $t->jatuh_tempo}}</td>
                        @guest
                        @else
                        @if (Auth::user()->hasRole('bendahara'))
                        <td>
                            <button class="btn btn-info" onclick="action({{$t->id}},1)">Terima Pembayaran</button>
                        </td>
                        @endif
                        @endguest
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<script>
    function action(id, status) {
        var note;
        if (status == 1) {
            note = "Apakah anda yakin sudah menerima pembayaran ini ?";
        } else {
            note = "Apakah anda yakin membatalkan penerimaan pembayaran ini ?";
        }
        var isconfirm = confirmAlert(note);
        if (isconfirm == 1) {
            var url = "tagihanAction?id=" + id + "&action=" + status;
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
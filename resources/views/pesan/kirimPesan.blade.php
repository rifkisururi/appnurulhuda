@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">Kirim Pesan</div>

                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group row">
                            @csrf
                            <div class="col-md-12">
                                <label for="user">Media</label><br>
                                <input type="radio" name="media" value="whatsapp" onclick="pengirim('{{$SENDER_WA}}')" required> Whatsapp
                                <input type="radio" name="media" value="email" onclick="pengirim('{{$SENDER_EMAIL}}')"> E-Mail
                            </div>
                            <div class="col-md-6">
                                <br>
                                <label for="email">Pengirim</label>
                                <input id="sender" type="text" class="form-control" value="" readonly>
                            </div>

                            <div class="col-md-12">
                                <br>
                                <label for="email">Tujuan</label>
                                <br>
                                <input type="radio" name="yayasan" value="0" onclick="tujuan(0)" required> Semua Santri <br>
                                @foreach($yayasan as $y)
                                <input type="radio" name="yayasan" value="{{ $y->id }}" onclick="tujuan('{{ $y->id }}')"> Semua Santri {{ $y->nama }}<br>
                                @endforeach
                                <input type="radio" name="yayasan" value="-1" onclick="tujuan(-1)" required> Custom Tujuan <br>


                                <div id="customTujuan">
                                    <select class="form-control col-md-12" multiple id="santri" name="id_user[]">
                                        <option value="">Pilih Santri</option>
                                        @foreach($santri as $s){
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        }
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <br>
                                <label for="email">Isi Pesan</label><br>
                                <textarea class="form-control" name="isiPesan" rows="3" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <button class="btn btn-primary">Kirim Pesan</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#santri').select2({
            theme: 'bootstrap4',
            closeOnSelect: false,
            placeholder: "masukan nama santri ...",
            allowClear: true
        });
        tujuan(1);
    });

    function pengirim(isi) {
        document.getElementById('sender').value = isi;
    }

    function tujuan(id) {
        if (id < 0) {
            $('#customTujuan').removeAttr('hidden');
        } else {
            $("#customTujuan").attr("hidden", true);
        }
    }
</script>

@endsection
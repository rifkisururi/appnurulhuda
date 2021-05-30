@extends('layouts.layout')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Santri</h1>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card-body">
        <div class="table-responsive">

            <form method="POST" action="personalinfo">
            @csrf
                <div class="form-group" hidden>
                    <label>NIS</label>
                    <input type="text" class="form-control" name="nis" value="{{$data->name}}">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="{{$data->name}}">
                </div>
                
                <div class="form-group">
                    <label>No HP 1</label>
                    <input type="text" class="form-control" name="no_hp1" value="{{$data->no_hp1}}">
                </div>
                
                <div class="form-group">
                    <label>No HP 2</label>
                    <input type="text" class="form-control" name="no_hp2" value="{{$data->no_hp2}}">
                </div>
                <div class="form-group">
                    <label>Alamat Email</label>
                    <input type="email" class="form-control" name="email" value="{{$data->email}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="passwordlama">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password Baru</label>
                    <input type="password" class="form-control" name="passwordBaru" id="passwordBaru">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ulaing Password Baru</label>
                    <input type="password" class="form-control" name="passwordBaru2" id="passwordBaru2">
                </div>
                <button type="submit" class="btn btn-primary">Perbarui Data</button>
            </form>

        </div>
    </div>
</div>
@endsection
@extends('layouts.layout')
@section('content')
<form action="" method="POST">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <fieldset>
        <legend>Ubah Akses User</legend>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="user">Nama User</label>
                <input id="name" type="text" name="uname" class="form-control" value="{{$user->name}}" readonly>
            </div>
            <div class="col-md-6">
                <label for="email">Email</label>
                <input id="email" type="text" name="email" class="form-control" value="{{$user->email}}" readonly>
            </div>
            <div class="col-md-6">
                <label for="akses">Ubah Akses</label>
                <select id="roles" name="role" class="form-control" required>
                    @foreach ($user ->roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    <?php $name = $role->name; ?>
                    @endforeach

                    @foreach ($roles as $r)
                    <?php if ($name != $r) {  ?>
                        <option value="{{$r}}">{{$r}}</option>
                    <?php } ?>
                    @endforeach

                </select>
            </div>
        </div>
    </fieldset>
    <div class="col-md-10">
        <input type="submit" class="btn btn-success btn-send" value="Ubah Akses">
        <a href="../../user"><input type="Button" class="btn btn-primary btn-send" value="Kembali"></a>
    </div>
    <hr>
</form>
@endsection
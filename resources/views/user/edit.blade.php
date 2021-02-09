@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background:#C3D6D7">

              <br>

              <div style="background-color:lightblue">
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
              </div>

              <form method="post" action="{{url('user/user-list',$user->id)}}">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group">
                  <label for="exampleFormControlInput1">Öğrenci İsmi:</label>
                  <input class="form-control" name="name" type="text" placeholder="isim" value="{{$user->name}}" required>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">E-mail Adresi:</label>
                  <input class="form-control" name="email" type="email" placeholder="isim@örnek.com" value="{{$user->email}}" required>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Şifre:</label>
                  <input class="form-control" name="password" type="password" placeholder="şifre" value="{{$user->password}}" required>
                </div>
                <div class="form-group" align="center">
                  <button type="submit" class="btn btn-primary btn-outline-light btn-xl" style="background:#C38D08">Güncelle</button>
                </div>
              </form>

            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="panel-body" style="background:#D5D6D5">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <br>

                <div style="background-color:lightblue">
                    @foreach ($errors->all() as $error)
                      <li>{{$error}}</li>
                    @endforeach
                </div>

                <form method="post" action="{{url('admin')}}">
                  @csrf
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Öğrenci İsmi:</label>
                    <input class="form-control" name="name" type="text" placeholder="isim" value="{{old('name')}}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">E-mail Adresi:</label>
                    <input class="form-control" name="email" type="email" placeholder="isim@örnek.com" value="{{old('email')}}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Şifre:</label>
                    <input class="form-control" name="password" type="password" placeholder="şifre" value="{{old('password')}}" required>
                  </div>
                  <div class="form-group" align="center">
                    <button type="submit" class="btn btn-primary btn-outline-light btn-xl" style="background:#239707">Oluştur</button>
                  </div>
                </form>

              </div>
            </div>
        </div>
    </div>
</div>
@endsection

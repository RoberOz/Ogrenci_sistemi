@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="panel-body" style="background:#C3D6D7">
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

                <form method="post" action="{{url('departments/department-list')}}">
                  @csrf
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Bölüm ismi:</label>
                    <input class="form-control" name="name" type="text" placeholder="isim" value="{{old('name')}}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Bölüm Kaç Senelik:</label>
                    <br>
                    <select name="years" required>
                      <option value="">Seçim Yapınız</option>
                      <option value="2" {{old('years') == '2' ? 'selected' : ''}}>2</option>
                      <option value="4" {{old('years') == '4' ? 'selected' : ''}}>4</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Kurulma Tarihi:</label>
                    <input class="form-control" name="foundation_year" type="text" placeholder="yyyy" value="{{old('foundation_year')}}" required>
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

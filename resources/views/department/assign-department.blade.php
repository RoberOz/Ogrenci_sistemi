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

                <form method="post" action="{{url('departments/department-user/')}}">
                  @csrf
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Öğrencinin İsmi:</label>
                    <input class="form-control" name="student_name" type="text" placeholder="isim" value="{{$user->name}}" disabled required>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Bölüm İsmi:</label>
                    <input class="form-control" name="departmen_name" type="text" placeholder="isim" value="{{$department->name}}" disabled required>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Öğrencinin Bölüme Başlama Yılı:</label>
                    <input class="form-control" name="department_registered_year" type="text" placeholder="yyyy" value="{{old('department_registered_year')}}" required>
                  </div>
                  <div class="form-group" align="center">
                    <input type=hidden name=user_id value={{$user->id}}></input>
                    <input type=hidden name=department_id value={{$department->id}}></input>
                    <input type=hidden name=department_foundation_year value={{$department->foundation_year}}></input>
                    <button type="submit" class="btn btn-primary btn-outline-light btn-xl" style="background:#239707">Oluştur</button>
                  </div>
                </form>

              </div>
            </div>
        </div>
    </div>
</div>
@endsection

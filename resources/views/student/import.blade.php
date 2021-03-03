@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
              <div class="card-header">Excel ile Öğrenci Kaydet</div>

              <br>

              <div style="background-color:lightblue">
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
              </div>

              <br>
              <form method="post" action="{{url('students/import')}}" enctype="multipart/form-data">
                @csrf
                <div align="center">
                  <input type="file" name="file">
                  <button type="submit" class="btn btn-primary btn-outline-light">Import</button>
                </div>
              </form>
              <br>

            </div>
        </div>
    </div>
</div>
@endsection

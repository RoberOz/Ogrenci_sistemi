@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <br>
                <form method="post" action="{{url('admin/process')}}">
                  <table align="center">
                    @csrf
                    <tr height="35">
                      <td align='center' width = "115"><label>Öğrenci İsmi:</label></td>
                      <td ><input type="text" name="name" value="{{old('name')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align='center' width = "115"><label>E-mail Adresi:</label></td>
                      <td ><input type="email" name="email" value="{{old('email')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align='center' width = "115"><label>Şifre:</label></td>
                      <td ><input type="password" name="password" value="{{old('password')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="center" colspan="2"><button type="submit">Oluştur</button></td>
                    </tr>
                  </table>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

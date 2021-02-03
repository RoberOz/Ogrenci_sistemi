@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

              <br>
              <form method="post" action="{{url('admin',$user->id)}}">
                <table align = "center">
                  {{ method_field('PUT') }}
                  @csrf
                  <tr height="35">
                    <td align='center' width = "115"><label>Öğrenci İsmi:</label></td>
                    <td ><input type="text" name="name" value="{{$user->name}}" required></input></td>
                  </tr>
                  <tr height="35">
                    <td align='center' width = "115"><label>E-mail Adresi:</label></td>
                    <td ><input type="email" name="email" value="{{$user->email}}" required></input></td>
                  </tr>
                  <tr height="35">
                    <td align='center' width = "115"><label>Şifre:</label></td>
                    <td ><input type="password" name="password" value="{{$user->password}}" required></input></td>
                  </tr>
                  <tr height="35">
                    <td align="center" colspan="2"><button type="submit">Güncelle</button></td>
                  </tr>
                </table>
              </form>

            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Öğrenciler') }}</div>
                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif

                      <table width=100%>
                        <tr height=35>
                          <td align="center"><strong>-Öğrenci İsmi-</strong></td>
                          <td align="center"><strong>-Öğrenci E-mail Adresi-</strong></td>
                          <td align="center"><strong></strong></td>
                          <td align="center"><strong></strong></td>
                        </tr>
                        @foreach ($users as $user)
                          <tr height=35>
                            <td align="center">{{$user->name}}</td>
                            <td align="center">{{$user->email}}</td>
                            <td align="center">Düzenle</td>
                            <td align="center">Sil</td>
                          </tr>
                        @endforeach
                      </table>

                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

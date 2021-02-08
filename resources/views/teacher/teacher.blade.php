@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6"><strong>{{ __('Öğrenci Listesi') }}</strong></div>
                  <div class="card-body" style="background:#C3D6D7">

                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif

                      <div class="col-sm-14">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0" role="grid">
                          <thead style="background:#B6B6B6">
                              <tr role="row" align="center">
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                  İsim
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 150px;">
                                  E-mail Adresi
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                  Durum
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                  İşlemler
                                </th>
                              </tr>
                          </thead>
                          <tbody style="background:#D1D1D1">
                            @foreach ($users as $user)
                              @if ($user->hasRole('student'))
                                <tr role="row" class="odd">
                                  <td align="center"><br>{{$user->name}}</td>
                                  <td align="center"><br>{{$user->email}}</td>
                                  <td align="center"><br>
                                    @if ($user->hasRole('admin'))
                                      Admin
                                    @elseif($user->hasRole('teacher'))
                                      Öğretmen
                                    @else
                                      @if ($user->is_graduated == 0)
                                        Okuyor
                                      @else
                                        Mezun
                                      @endif
                                    @endif
                                  </td>
                                  <td align="center">
                                    @if (auth()->user()->hasRole('admin'))
                                      <button class="btn btn-primary btn-outline-light btn-xl" style="background:#C38D08" onclick="location.href='{{route('user.edit',$user->id)}}'">Düzenle</button>
                                    @else
                                      @if (auth()->user()->id == $user->id)
                                        <button class="btn btn-primary btn-outline-light btn-xl" style="background:#C38D08" onclick="location.href='{{route('user.edit',$user->id)}}'">Düzenle</button>
                                      @endif
                                    @endif
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>

                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6"><strong>{{ __('Ders Listesi') }}</strong></div>
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
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                  İşlemler
                                </th>
                              </tr>
                          </thead>
                          <tbody style="background:#D1D1D1">

                            @foreach ($lectures as $lecture)
                              @foreach ($lecture->users as $user)
                                @if ($user->pivot->user_id == auth()->user()->id)
                                  <tr role="row" class="odd">
                                    <td align="center"><br>{{$lecture->name}}</td>
                                    <td align="center">
                                      <button class="btn btn-primary btn-outline-light btn-xl" style="background:#32A2EC" onclick="location.href=''">Dersi Sil</button>
                                    </td>
                                  </tr>
                                @endif
                              @endforeach
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

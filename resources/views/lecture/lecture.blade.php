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
                            <form method="post" action="{{url('lecture/user-lecture')}}">
                              @csrf
                              @foreach ($lectures as $lecture)
                                <tr role="row" class="odd">
                                  <td align="center"><br>{{$lecture->lectureName}}</td>
                                <!--  <input class="form-control" name="lectureName" type="hidden" value="{{$lecture->lectureName}}"> -->
                                  <td align="center">
                                    <div class="form-group" align="center">
                                      <br>
                                      <input type="checkbox" name="lectureNames[]" value="{{$lecture->lectureName}}" style="width: 30px;height: 30px;">
                                    </div>
                                  </td>
                                </tr>
                              @endforeach
                              <tr>
                                <td>
                                </td>
                                <td align="center">
                                  <button type="submit" class="btn btn-primary btn-outline-light btn-xl" style="background:#239707">Derslerime Ekle</button>
                                </td>
                              </tr>
                            </form>
                          </tbody>
                        </table>
                      </div>

                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6"><strong>{{ __("$department->name'ne Ders Ata") }}</strong></div>
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
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 200px;">
                                  Dersler
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 10px;">
                                  Dönem
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 20px;">
                                  İşlemler
                                </th>
                              </tr>
                          </thead>
                          <tbody style="background:#D1D1D1">
                            <form method="post" action="{{url('departments/department-assign-lecture')}}">
                              @csrf
                              @foreach ($lectures as $lecture)
                                <tr role="row" class="odd">
                                  <td align="center">{{$lecture->name}}</td>
                                  <td align="center">{{$lecture->period}}</td>
                                  <td align="center"><input type="checkbox" name="lectureNames[{{$lecture->period}}][]" value="{{$lecture->name}}" style="width: 30px;height: 30px;"></td>
                                  <input type="hidden" name="departmentId" value="{{$department->id}}">
                                  <input type="hidden" name="departmentYear" value="{{$department->foundation_year}}">
                                </tr>
                              @endforeach
                              <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td align="center">
                                  <button class="btn btn-primary btn-outline-light btn-xl" style="background:#239707">Dersleri Bölüme Ekle</button>
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

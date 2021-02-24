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

                      <div style="background-color:lightblue">
                        @foreach ($errors->all() as $error)
                          <li>{{$error}}</li>
                        @endforeach
                      </div>

                      <form method="post" action="{{url('departments/department-assign-lecture')}}">
                        @csrf
                        <div class="container">
                          <div class="col-md-15">
                            <div class="row justify-content-center">
                              <div class="card" style="background:#C6C6C6">
                                <div class="card-body">
                                  <tr>
                                    <td>
                                      <strong><label>Sınıf:  </label></strong>
                                      <select name="class" required>
                                        <option value="">Seçim Yapınız</option>
                                        @for ($i=1; $i < $department->years + 1; $i++)
                                          <option value="{{$i}}" {{old('class') == ''.$i.'' ? 'selected' : ''}}>{{$i}}. Sınıf</option>
                                        @endfor
                                      </select>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <strong><label>Dönem:  </label></strong>
                                      <select name="period" required>
                                        <option value="">Seçim Yapınız</option>
                                        <option value="1" {{old('period') == '1' ? 'selected' : ''}}>Güz</option>
                                        <option value="2" {{old('period') == '2' ? 'selected' : ''}}>Bahar</option>
                                      </select>
                                    </td>
                                  </tr>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <br>

                        <div class="col-sm-14">
                          <table class="table table-bordered table-hover" width="100%" cellspacing="0" role="grid">
                            <thead style="background:#B6B6B6">
                              <tr role="row" align="center">
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 200px;">
                                  Dersler
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 20px;">
                                  İşlemler
                                </th>
                              </tr>
                            </thead>
                            <tbody style="background:#D1D1D1">
                              @foreach ($lectures as $lecture)
                                <tr role="row" class="odd">
                                  <td align="center">{{$lecture->name}}</td>
                                  <td align="center"><input type="checkbox" name="lectureNames[]" value="{{$lecture->name}}" style="width: 30px;height: 30px;"></td>
                                  <input type="hidden" name="departmentId" value="{{$department->id}}">
                                </tr>
                              @endforeach
                              <tr>
                                <td>
                                </td>
                                <td align="center">
                                  <button class="btn btn-primary btn-outline-light btn-xl" style="background:#239707">Dersleri Bölüme Ekle</button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </form>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

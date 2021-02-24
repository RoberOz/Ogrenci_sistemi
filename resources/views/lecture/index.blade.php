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

                      @if (isset($departmentUser))
                        <div class="col-sm-14">
                          <table class="table table-bordered table-hover" width="100%" cellspacing="0" role="grid">
                            <thead style="background:#B6B6B6">
                              <tr role="row" align="center">
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                  Dersler
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                  İşlemler
                                </th>
                              </tr>
                            </thead>
                            <tbody style="background:#D1D1D1">
                              <form method="post" action="{{url('lectures/user-lecture')}}">
                                @csrf
                                @foreach ($users as $user)
                                  @if ($user->id == auth()->user()->id)
                                    @foreach ($user->departments as $department)
                                      @foreach ($departmentLectures as $departmentLecture)
                                        @if ($departmentLecture->department_id == $department->id)
                                          @foreach ($lectures as $lecture)
                                            @if ($lecture->id == $departmentLecture->lecture_id)
                                              <tr role="row" class="odd">
                                                <td align="center">{{$lecture->name}}</td>
                                                <td align="center">
                                                  <div class="form-group" align="center">
                                                    <input type="checkbox" name="lectureNames[]" value="{{$lecture->name}}" style="width: 30px;height: 30px;">
                                                  </div>
                                                </td>
                                              </tr>
                                            @endif
                                          @endforeach
                                        @endif
                                      @endforeach
                                    @endforeach
                                  @endif
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
                      @else
                        <div align="center" class="alert" style="color:#E00B0B">
                          <i class="fas fa-exclamation"></i>
                          <strong>
                            Herhangi bir bölüme atanmamış olarak gözüküyorsunuz. Lütfen danışman hocanız ile görüşünüz.
                          </strong>
                        </div>
                      @endif

                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

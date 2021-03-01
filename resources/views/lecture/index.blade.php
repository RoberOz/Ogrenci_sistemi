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
                        @if ($period !== 0)
                          <div class="col-sm-14">
                            <table class="table table-bordered table-hover" width="100%" cellspacing="0" role="grid">
                              <thead style="background:#B6B6B6">
                                <tr role="row" align="center">
                                  <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                    Dersler
                                  </th>
                                  <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                    Sınıf
                                  </th>
                                  <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                    Dönem
                                  </th>
                                  @if ($isFirstPeriodRegistrationDate || $isSecondPeriodRegistrationDate)
                                    <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                      İşlemler
                                    </th>
                                  @endif
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
                                                @if ($period == $departmentLecture->period)
                                                  @if ($studentCurrentClass >= $departmentLecture->class)
                                                    <tr role="row" class="odd">
                                                      <td align="center">{{$lecture->name}}</td>
                                                      <td align="center">{{$departmentLecture->class}}. Sınıf</td>
                                                      <td align="center">
                                                        @if ($departmentLecture->period == 1)
                                                          Güz
                                                        @elseif($departmentLecture->period == 2)
                                                          Bahar
                                                        @endif
                                                      </td>
                                                      @if ($isFirstPeriodRegistrationDate || $isSecondPeriodRegistrationDate)
                                                        <td align="center">
                                                          <div class="form-group" align="center">
                                                            <input type="checkbox" name="lectureNames[]" value="{{$lecture->name}}" style="width: 30px;height: 30px;">
                                                            <input type="hidden" name="class" value="{{$departmentLecture->class}}">
                                                            <input type="hidden" name="period" value="{{$departmentLecture->period}}">
                                                          </div>
                                                        </td>
                                                      @endif
                                                    </tr>
                                                  @endif
                                                @endif
                                              @endif
                                            @endforeach
                                          @endif
                                        @endforeach
                                      @endforeach
                                    @endif
                                  @endforeach
                                  @if ($isFirstPeriodRegistrationDate || $isSecondPeriodRegistrationDate)
                                    <tr>
                                      <td>
                                      </td>
                                      <td>
                                      </td>
                                      <td>
                                      </td>
                                      <td align="center">
                                        <button type="submit" class="btn btn-primary btn-outline-light btn-xl" style="background:#239707">Derslerime Ekle</button>
                                      </td>
                                    </tr>
                                  @endif
                                </form>
                              </tbody>
                            </table>
                          </div>
                        @elseif ($period == 0)
                          <div align="center" class="alert" style="color:#E00B0B">
                            <i class="fas fa-exclamation"></i>
                            <strong>
                              Dönemin açılmasını bekleyiniz.
                            </strong>
                          </div>
                        @endif
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card" style="background:#C3D6D7">
            <div class="card-header" style="background:#C6C6C6">
              <strong>
                @foreach ($departments as $department)
                  @if ($department->id == $departmentId)
                    {{$department->name}} --
                    @foreach ($lectures as $lecture)
                      @if ($lecture->id == $lectureId)
                        {{$lecture->name}} --
                      @endif
                    @endforeach
                  @endif
                @endforeach
                Sınav Tarihleri
              </strong>
            </div>
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

                  <div class="col-sm-14">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0" role="grid">
                      <thead style="background:#B6B6B6">
                        <tr role="row" align="center">
                          <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                            Bölüm
                          </th>
                          <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                            Ders
                          </th>
                          <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                            Sınıf
                          </th>
                          <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                            Dönem
                          </th>
                          <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                            Vize
                          </th>
                          <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                            Final
                          </th>
                        </tr>
                      </thead>
                      <tbody style="background:#D1D1D1">
                          <tr role="row" class="odd">
                            @foreach ($departments as $department)
                              @if ($department->id == $departmentId)
                                <td align="center"><br><br>{{$department->name}}</td>
                              @endif
                            @endforeach
                            @foreach ($lectures as $lecture)
                              @if ($lecture->id == $lectureId)
                                <td align="center"><br><br>{{$lecture->name}}</td>
                              @endif
                            @endforeach
                            <td align="center"><br><br>{{$class}}.Sınıf</td>
                            <td align="center">
                              @if ($period == 1)
                                <br><br> Güz
                              @elseif ($period == 2)
                                <br><br> Bahar
                              @endif
                            </td>
                            <td align="center">
                              <form method="post" action="{{url('departments/department-lecture-exams')}}">
                                @csrf
                                <input type="date" name="first_exam"><br><br>
                                <input type="time" name="exam_start_time"> -
                                <input type="time" name="exam_end_time"><br><br>
                                <input type="hidden" name="department_lecture_id" value="{{$departmentLecture->id}}">
                                <input type="hidden" name="exam_id" value="1">
                                <button type="submit" class="btn btn-primary btn-outline-light btn-sm" style="background:#19A713">Ata</button>
                              </form>
                            </td>
                            <td align="center">
                              <form method="post" action="{{url('departments/department-lecture-exams')}}">
                                @csrf
                                  <input type="date" name="second_exam"><br><br>
                                  <input type="time" name="exam_start_time"> -
                                  <input type="time" name="exam_end_time"><br><br>
                                  <input type="hidden" name="department_lecture_id" value="{{$departmentLecture->id}}">
                                  <input type="hidden" name="exam_id" value="2">
                                <button type="submit" class="btn btn-primary btn-outline-light btn-sm" style="background:#19A713">Ata</button>
                              </form>
                            </td>
                          </tr>
                      </tbody>
                    </table>
                  </div>

              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

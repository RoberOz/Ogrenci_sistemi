@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6">
                  <strong>
                    Sınav Listesi
                  </strong>
                </div>
                  <div class="card-body" style="background:#C3D6D7">

                      <div class="col-sm-14">
                        <div class="card">
                          <div class="card-body" style="background:#C6C6C6">

                            <table class="table table-bordered table-hover" width="100%" cellspacing="0" role="grid">
                              <thead style="background:#B6B6B6">
                                <tr role="row" align="center">
                                  <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                    Dersler
                                  </th>
                                  <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                    Sınav
                                  </th>
                                  <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                    Verilen Not
                                  </th>
                                  <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                    Sonuç
                                  </th>
                                </tr>
                              </thead>
                              <tbody style="background:#D1D1D1">
                                @foreach ($lectures as $lecture)
                                  @foreach ($lecture->users as $user)
                                    @if ($user->id == auth()->user()->id)
                                      @foreach ($departmentUser->departments as $department)
                                        @foreach ($departmentLectures as $departmentLecture)
                                          @if (($departmentLecture->department_id == $department->pivot->department_id) && ($lecture->id == $departmentLecture->lecture_id))
                                            @foreach ($examinations as $examination)
                                              @if ($departmentLecture->id == $examination->department_lecture_id)
                                                <tr role="row" class="odd">
                                                  <td align="center">{{$lecture->name}}</td>
                                                  <td align="center">
                                                    @foreach ($examinations as $examination)
                                                      @if ($examination->exam_order == 'first_exam')
                                                        Vize
                                                      @elseif ($examination->exam_order == 'second_exam')
                                                        Final
                                                      @endif
                                                    @endforeach
                                                  </td>
                                                  <td align="center"></td>
                                                  <td align="center">
                                                    <button class="btn btn-primary btn-outline-light btn-sm" style="background:#19A713" onclick="location.href='{{route('exam-results-show',$examination->id)}}'">Gör</button>
                                                  </td>
                                                </tr>
                                              @endif
                                            @endforeach
                                          @endif
                                        @endforeach
                                      @endforeach
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
    </div>
</div>
@endsection

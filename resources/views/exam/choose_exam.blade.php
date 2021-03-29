@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6"><strong>{{ __('Sınav Seç') }}</strong></div>
                  <div class="card-body" style="background:#C3D6D7">

                      @if (session('failed_choose_exeam'))
                          <div class="alert alert-danger" role="alert">
                              Sınav seçimi başarısız
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
                                Vize Sınavı
                              </th>
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                Final Sınavı
                              </th>
                            </tr>
                          </thead>
                          <tbody style="background:#D1D1D1">
                            <tr>
                              <td align="center">
                                @foreach ($examinations as $examination)
                                  @if ($departmentLecture->id == $examination->department_lecture_id && $examination->exam_id == 1)
                                    {{$examination->exam_date}} <br> {{$examination->exam_start_time}} - {{$examination->exam_end_time}}
                                    <br><br>
                                    <button class="btn btn-primary btn-outline-light" style="background:#19A713" onclick="location.href='{{route('modify-exam',[$examination->department_lecture_id,$examination->exam_id])}}'">Seç</button>
                                  @endif
                                @endforeach
                              </td>
                              <td align="center">
                                @foreach ($examinations as $examination)
                                  @if ($departmentLecture->id == $examination->department_lecture_id && $examination->exam_id == 2)
                                    {{$examination->exam_date}} <br> {{$examination->exam_start_time}} - {{$examination->exam_end_time}}
                                    <br><br>
                                    <button class="btn btn-primary btn-outline-light" style="background:#19A713" onclick="location.href='{{route('modify-exam',[$examination->department_lecture_id,$examination->exam_id])}}'">Seç</button>
                                  @endif
                                @endforeach
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
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6"><strong>{{ __($department->name.' Dersleri') }}</strong></div>
                  <div class="card-body" style="background:#C3D6D7">

                      @if (session('success_exam_delete'))
                          <div class="alert alert-success" role="alert">
                              <h6 style="color:green">Sınav tarihi başarıyla silindi</h6>
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
                                Dersler
                              </th>
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                Sınıf
                              </th>
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                Dönem
                              </th>
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                Vize Sınav Tarihi
                              </th>
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                Final Sınav Tarihi
                              </th>
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                İşlemler
                              </th>
                            </tr>
                          </thead>
                          <tbody style="background:#D1D1D1">
                            @foreach ($department->lectures as $lecture)
                              <tr role="row" class="odd">
                                <td align="center"><br>{{$lecture->name}}</td>
                                <td align="center"><br>{{$lecture->pivot->class}}. Sınıf</td>
                                <td align="center">
                                  @if ($lecture->pivot->period == 1)
                                    <br>Güz
                                  @elseif ($lecture->pivot->period == 2)
                                    <br>Bahar
                                  @endif
                                </td>
                                <td align="center">
                                  @foreach ($examinations as $examination)
                                    @if ($examination->department_lecture_id == $lecture->id && $examination->exam_order == 'first_exam')
                                      <br>{{$examination->exam_date}}
                                      <button class="js-delete-department-exam-date-lecture-btn btn btn-primary btn-outline-light btn-xs" data-id={{$examination->id}} style="background:#DC2818">X</button>
                                    @endif
                                  @endforeach
                                </td>
                                <td align="center">
                                  @foreach ($examinations as $examination)
                                    @if ($examination->department_lecture_id == $lecture->id && $examination->exam_order == 'second_exam')
                                      <br>{{$examination->exam_date}}
                                      <button class="js-delete-department-exam-date-lecture-btn btn btn-primary btn-outline-light btn-xs" data-id={{$examination->id}} style="background:#DC2818">X</button>
                                    @endif
                                  @endforeach
                                </td>
                                <td align="center">
                                  <button class="btn btn-primary btn-outline-light" style="background:#19A713" onclick="location.href='{{route('department-exam-dates',[$lecture->pivot->department_id,$lecture->pivot->lecture_id])}}'">Sınav Tarihi Değiştir</button>
                                  <button class="btn btn-primary btn-outline-light" style="background:#C38D08" onclick="location.href='{{route('choose-exam',[$lecture->pivot->department_id,$lecture->pivot->lecture_id])}}'">Sınav Sorularını Düzenle</button>
                                  <button class="js-delete-department-lecture-btn btn btn-primary btn-outline-light btn-xs" department-id={{$department->id}} data-id={{$lecture->id}} style="background:#DC2818">Dersi Sil</button>
                                </td>
                              </tr>
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

@push('department-lecture-delete-javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
      $('.js-delete-department-lecture-btn').on('click', function () {
          let departmentLectureId = $(this).attr("data-id");
          let departmentId = $(this).attr("department-id");
          console.log(departmentLectureId);
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '/departments/'+ departmentId +'/lecture/'+ departmentLectureId,
              method: 'delete',
              success: function(response) {
                window.location.href = "";
              }
          });
      });
    });
</script>
@endpush

@push('department-lecture-exam-date-delete-javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
      $('.js-delete-department-exam-date-lecture-btn').on('click', function () {
          let examination = $(this).attr("data-id");
          console.log(examination);
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '/departments/department-lecture/exam-dates/'+ examination,
              method: 'delete',
              success: function(response) {
                window.location.href = "";
              }
          });
      });
    });
</script>
@endpush

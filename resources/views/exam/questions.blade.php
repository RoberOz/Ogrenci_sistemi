@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6">
                  <strong>
                    @if ($examination->exam_id == 1)
                      Vize
                    @elseif ($examination->exam_id == 2)
                      Final
                    @endif
                    - Tarih: {{$examination->exam_date}} - Başlangıç: {{$examination->exam_start_time}} - Bitiş: {{$examination->exam_end_time}}
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
                        <div class="card">
                          <div class="card-body" style="background:#C6C6C6">

                            <form method="post" action="{{url('exams/modify-exam-store')}}">
                              <div class="list-group col" id="examinationQuestions">
                                <button type="button" class="js-add-exam-question-btn btn btn-primary btn-outline-light" style="width:150px;" examination-id={{$examination->id}}>Soru Ekle</button>
                                <br>
                                @foreach ($examinationQuestions as $examinationQuestion)
                                  @csrf
                                  @if ($examinationQuestion->examination_id == $examination->id)
                                    <div class="list-group-item">
                                      <textarea name="content" rows="2" cols="80" required>{{$examinationQuestion->content}}</textarea>
                                      <button type="button" class="js-delete-exam-question-btn btn btn-primary btn-outline-light" style="background:#B60C09" data-id={{$examinationQuestion->id}}>Soruyu Sil</button>
                                      <br>
                                      @foreach ($examinationQuestion->options as $key => $value)
                                        <input type="text" name="key[]" value="{{$key}}" style="width:25px;"> :
                                        <input type="text" name="value[]" value="{{$value}}">
                                        <input type="hidden" name="examinationQuestionId" value="{{$examinationQuestion->id}}">
                                        <button type="button" class="js-delete-exam-question-option-btn btn btn-primary btn-outline-light btn-sm" style="background:#B60C09" data-id={{$examinationQuestion->id}} key={{$key}}>X</button>
                                        <br><br>
                                      @endforeach
                                      <button type="button" class="js-add-exam-question-option-btn btn btn-primary btn-outline-light" style="width:150px;" examination-question-id={{$examinationQuestion->id}}>Şık Ekle</button>
                                    </div>
                                  @endif
                                @endforeach
                              </div>
                              <br>
                              <div align="center">
                                <button class="btn btn-primary btn-outline-light" style="background:#19A713;">Kaydet</button>
                              </div>
                            </form>

                          </div>
                        </div>
                      </div>

                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('exam-javascripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.6.0/Sortable.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
let examinationQuestion = document.getElementById("examinationQuestions");
  new Sortable(examinationQuestion, {
    animation: 150,
    ghostClass: 'blue-background-class'
  });
</script>

<script>
$(document).ready(function(){
      $('.js-delete-exam-question-btn').on('click', function () {
          let examQuestionId = $(this).attr("data-id");
          console.log(examQuestionId);
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '{{ url('/exams/modify-exam')}}/'+examQuestionId,
              method: 'delete',
              success: function(response) {
                window.location.href = "";
              }
          });
      });
    });
</script>

<script>
$(document).ready(function(){
      $('.js-add-exam-question-btn').on('click', function () {
          let examinationId = $(this).attr("examination-id");
          console.log(examinationId);
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '{{ url('/exams/modify-exam-add-question')}}',
              method: 'post',
              data: {
                'examinationId': examinationId,
              },
              success: function(response) {
                window.location.href = "";
              }
          });
      });
    });
</script>

<script>
$(document).ready(function(){
      $('.js-delete-exam-question-option-btn').on('click', function () {
          let examinationQuestionId = $(this).attr("data-id");
          let key = $(this).attr("key");
          console.log(examinationQuestionId);
          console.log(key);
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '{{ url('/exams/modify-exam-delete-question-option')}}',
              method: 'get',
              data: {
                'examinationQuestionId': examinationQuestionId,
                'key': key,
              },
              success: function(response) {
                window.location.href = "";
              }
          });
      });
    });
</script>

<script>
$(document).ready(function(){
      $('.js-add-exam-question-option-btn').on('click', function () {
          let examinationQuestionId = $(this).attr("examination-question-id");
          console.log(examinationQuestionId);
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '{{ url('/exams/modify-exam-add-question-option')}}',
              method: 'post',
              data: {
                'examinationQuestionId': examinationQuestionId,
              },
              success: function(response) {
                window.location.href = "";
              }
          });
      });
    });
</script>
@endpush

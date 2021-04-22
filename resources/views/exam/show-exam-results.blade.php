@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6">
                  <strong>
                    @foreach ($departmentLectures as $departmentLecture)
                      @foreach ($lectures as $lecture)
                        @if ($departmentLecture->id == $examination->department_lecture_id)
                          @if ($departmentLecture->lecture_id == $lecture->id)
                            {{$lecture->name}} - Sınav Sonucu -
                            @if ($examination->exam_order == 'first_exam')
                              Vize
                            @elseif ($examination->exam_order == 'second_exam')
                              Final
                            @endif
                          @endif
                        @endif
                      @endforeach
                    @endforeach
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
                                    Soru
                                  </th>
                                  <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                    Verdiğiniz Cevap
                                  </th>
                                  <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                  </th>
                                </tr>
                              </thead>
                              <tbody style="background:#D1D1D1">
                                @foreach ($examinationQuestions as $examinationQuestion)
                                  <tr role="row" class="odd">
                                    <td align="center">
                                      {{$examinationQuestion->order}}
                                    </td>
                                    @foreach ($examinationQuestionAnswers as $examinationQuestionAnswer)
                                      @if ($examinationQuestion->id == $examinationQuestionAnswer->question_id)
                                        <td align="center">
                                          {{$examinationQuestionAnswer->answer_key}}
                                        </td>
                                        <td align="center">
                                          @if ($examinationQuestionAnswer->answer_key == $examinationQuestion->correct_answer['key'])
                                            <span>&#x2714;</span>
                                          @else
                                            <span>&#10006;</span>
                                          @endif
                                        </td>
                                      @endif
                                    @endforeach
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <strong>Toplam Soru:</strong> {{$totalQuestion}} <br>
                            <strong>Doğru:</strong> {{$correctAnswers}} <br>
                            <strong>Yanlış:</strong> {{$wrongAnswers}} <br>
                            <strong>Boş Bırakılan:</strong> {{$unAnswered}} <br>
                            <strong>Verilen Not:</strong>
                          </div>
                        </div>
                      </div>

                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

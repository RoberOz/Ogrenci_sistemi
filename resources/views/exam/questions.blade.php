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
                            <div align="center">
                              <table>
                                <form method="post" action="{{url('exams/modify-exam')}}" id="form">
                                  @csrf
                                  <tr>
                                    <td align="center">
                                      <strong>Soru:</strong>
                                    </td>
                                    <td align="center">
                                      <textarea name="content" rows="2" cols="60" required>{{ old('content') }}</textarea>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="center">
                                    </td>
                                    <td align="left">
                                      <strong>A:</strong>
                                      <input type="text" name=options[]>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="center">
                                    </td>
                                    <td align="left">
                                      <strong>B:</strong>
                                      <input type="text" name=options[]>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="center">
                                    </td>
                                    <td align="left">
                                      <strong>C:</strong>
                                      <input type="text" name=options[]>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="center">
                                    </td>
                                    <td align="left">
                                      <strong>D:</strong>
                                      <input type="text" name=options[]>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td align="center">
                                      <input type="hidden" name="department_lecture_id" value="{{$examination->department_lecture_id}}">
                                      <input type="hidden" name="exam_id" value="{{$examination->exam_id}}">
                                      <input type="hidden" name="examination_id" value="{{$examination->id}}">
                                      <button type="submit" class="btn btn-primary btn-outline-light btn-lg">Soruyu Ekle</button>
                                    </td>
                                  </tr>
                                </form>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-14">
                        <div class="card">
                          <div class="card-body" style="background:#C6C6C6">

                            <div id="questions" class="list-group col">
                              @foreach ($questions as $question)
                                @if ($question->examination_id == $examination->id)
                                  <div class="list-group-item">{{$question->content}}</div>
                                @endif
                              @endforeach
                            </div>

                          </div>
                        </div>
                      </div>

                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('asd')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.6.0/Sortable.js"></script>

<script>
let question = document.getElementById("questions");
  new Sortable(question, {
    animation: 150,
    ghostClass: 'blue-background-class'
  });
</script>
@endpush

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

                            <examination-form
                              :examination="{{$examination}}"
                              :examinationquestions="{{$examinationQuestions}}"
                            ></examination-form>

                          </div>
                        </div>
                      </div>

                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

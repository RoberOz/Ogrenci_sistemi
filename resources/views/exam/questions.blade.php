@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6">
                  <strong>
                    @if ($examination->exam_order == 'first_exam')
                      Vize
                    @elseif ($examination->exam_order == 'second_exam')
                      Final
                    @endif
                    - Tarih: {{$examination->exam_date}} - Başlangıç: {{$examination->exam_start_time}} - Bitiş: {{$examination->exam_end_time}}
                  </strong>
                </div>
                  <div class="card-body" style="background:#C3D6D7">

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

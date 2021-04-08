@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6">

                </div>
                  <div class="card-body" style="background:#C3D6D7">

                    <div class="col-sm-14">
                      <div class="card">
                        <div class="card-body" style="background:#C6C6C6">

                          <online-examination
                            :examinationquestions="{{$examinationQuestions}}"
                          ></online-examination>

                        </div>
                      </div>
                    </div>

                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

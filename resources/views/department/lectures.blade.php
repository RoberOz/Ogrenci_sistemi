@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6"><strong>{{ __($department->name.' Dersleri') }}</strong></div>
                  <div class="card-body" style="background:#C3D6D7">

                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif

                      <div class="col-sm-14">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0" role="grid">
                          <tbody style="background:#D1D1D1">
                            @foreach ($department->lectures as $lecture)
                              <tr role="row" class="odd">
                                <td align="center">{{$lecture->name}}</td>
                                <td align="center">{{$lecture->pivot->class}}. Sınıf</td>
                                <td align="center">
                                  @if ($lecture->pivot->period == 1)
                                    Güz
                                  @elseif ($lecture->pivot->period == 2)
                                    Bahar
                                  @endif
                                </td>
                                <td align="center">
                                  <button class="js-delete-department-lecture-btn btn btn-primary btn-outline-light btn-xs" department-id={{$department->id}} data-id={{$lecture->id}} style="background:#DC2818">X</button>
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
              url: '{{ url('/departments/department-lecture')}}',
              method: 'get',
              data: {
                'departmentId': departmentId,
                'departmentLectureId':departmentLectureId,
              },
              success: function(response) {
                window.location.href = "";
              }
          });
      });
    });
</script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6"><strong>{{ __('Seçtiğim Ders Listesi') }}</strong></div>
                  <div class="card-body" style="background:#C3D6D7">

                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif

                      <div class="col-sm-14">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0" role="grid">
                          <thead style="background:#B6B6B6">
                            <tr role="row" align="center">
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                Dersler
                              </th>
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                Sınıf
                              </th>
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                Dönem
                              </th>
                              @if ($isFirstPeriodRegistrationDate || $isSecondPeriodRegistrationDate)
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                  İşlemler
                                </th>
                              @endif
                            </tr>
                          </thead>
                          <tbody style="background:#D1D1D1">

                            @foreach ($lectures as $lecture)
                              @foreach ($lecture->users as $user)
                                @if ($user->pivot->user_id == auth()->user()->id)
                                  @if ($period == $user->pivot->period)
                                    <tr role="row" class="odd">
                                      <td align="center"><br>{{$lecture->name}}</td>
                                      <td align="center"><br>{{$user->pivot->class}}. Sınıf</td>
                                      <td align="center"><br>
                                        @if ($user->pivot->period == 1)
                                          Güz
                                        @elseif ($user->pivot->period == 2)
                                          Bahar
                                        @endif
                                      </td>
                                      @if ($isFirstPeriodRegistrationDate || $isSecondPeriodRegistrationDate)
                                        <td align="center">
                                          <button class="js-delete-lecture-btn btn btn-primary btn-outline-light btn-xl" style="background:#32A2EC" data-id={{$lecture->id}}>Dersi Sil</button>
                                        </td>
                                      @endif
                                    </tr>
                                  @endif
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
@endsection

@push('lecture-delete-javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
      $('.js-delete-lecture-btn').on('click', function () {
          let lectureId = $(this).attr("data-id");
          console.log(lectureId);
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '{{ url('/lectures/user-lecture')}}/'+lectureId,
              method: 'delete',
              success: function(response) {
                window.location.href = "user-lecture";
              }
          });
      });
    });
</script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6"><strong>{{ __('Bölüm Listesi') }}</strong></div>
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
                                  Bölümler
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                  Bölüm Başkanı
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                  İşlemler
                                </th>
                              </tr>
                          </thead>
                          <tbody style="background:#D1D1D1">
                            @foreach ($departments as $department)
                              <tr role="row" class="odd">
                                <td align="center"><br>{{$department->name}}</td>
                                <td align="center"><br>
                                    @if ($department->user_id !== null)
                                      {{$department->user->name}}
                                      <button class="js-delete-department-head-btn btn btn-primary btn-outline-light btn-xs" data-id={{$department->id}} style="background:#DC2818">X</button>
                                    @else
                                      <form method="post" action="{{url('/department/department-head')}}">
                                        @csrf
                                        <select name="department_head">
                                          @foreach ($users as $user)
                                            @if ($user->id !== $department->user_id)
                                              <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endif
                                          @endforeach
                                        </select>
                                        <input type=hidden name=department_id value={{$department->id}}></input>
                                        <button class="btn btn-primary btn-outline-light btn-sm"  style="background:#1AAE14" type="submit">Ata</button>
                                      </form>
                                    @endif
                                </td>
                                <td align="center">
                                  <button class="btn btn-primary btn-outline-light btn-xl" style="background:#32A2EC" onclick="location.href='{{route('department-lecture.show',$department->id)}}'">Detay</button>
                                  <button class="btn btn-primary btn-outline-light btn-xl" style="background:#32A2EC" onclick="location.href='{{route('department-assign-lecture.show',$department->id)}}'">Bölüme Ders Ata</button>
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

@push('department-head-delete-javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
      $('.js-delete-department-head-btn').on('click', function () {
          let departmentHeadId = $(this).attr("data-id");
          console.log(departmentHeadId);
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '{{ url('/department/department-head')}}/'+departmentHeadId,
              method: 'delete',
              success: function(response) {
                window.location.href = "department-list";
              }
          });
      });
    });
</script>
@endpush

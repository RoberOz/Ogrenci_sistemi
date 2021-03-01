@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6"><strong>{{ __('Öğrenci Listesi') }}</strong></div>
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
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0" role="grid">
                          <thead style="background:#B6B6B6">
                              <tr role="row" align="center">
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                  İsim
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 150px;">
                                  E-mail Adresi
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                  Durum
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                  Bölüm
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 70px;">
                                  İşlemler
                                </th>
                              </tr>
                          </thead>
                          <tbody style="background:#D1D1D1">
                            @foreach ($users as $user)
                              <tr role="row" class="odd">
                                <td align="center"><br>{{$user->name}}</td>
                                <td align="center"><br>{{$user->email}}</td>
                                <td align="center"><br>
                                  @if ($user->hasRole('admin'))
                                    Admin
                                  @elseif($user->hasRole('teacher'))
                                    Öğretmen
                                  @else
                                    @if ($user->is_graduated == 0)
                                      Okuyor
                                    @else
                                      Mezun
                                    @endif
                                  @endif
                                </td>
                                <td align="center"><br>
                                  @foreach ($user->departments as $departmentUser)
                                     @if ($departmentUser->pivot->user_id == $user->id)
                                       @foreach ($departments as $department)
                                         @if ($departmentUser->pivot->department_id == $department->id)
                                           {{$department->name}}
                                           <button class="js-delete-department-user-btn btn btn-primary btn-outline-light btn-xs" department-id={{$department->id}} data-id={{$user->id}} style="background:#DC2818">X</button>
                                           @php $isAssignedDepartment = "true" @endphp
                                         @endif
                                       @endforeach
                                     @endif
                                  @endforeach
                                  @if ($isAssignedDepartment == "false")
                                    <form method="get" action="{{url('/departments/department-user/create')}}">
                                      @csrf
                                      <select name="department_id">
                                        @foreach ($departments as $selectDepartment)
                                          <option value="{{$selectDepartment->id}}">{{$selectDepartment->name}}</option>
                                        @endforeach
                                      </select>
                                      <input type=hidden name=user_id value={{$user->id}}></input>
                                      <button class="btn btn-primary btn-outline-light btn-sm"  style="background:#1AAE14" type="submit">Ata</button>
                                    </form>
                                  @endif
                                  @php $isAssignedDepartment = "false" @endphp
                                </td>
                                <td align="center">
                                  @if (auth()->user()->hasRole('admin'))
                                    <button class="btn btn-primary btn-outline-light btn-xl" style="background:#C38D08" onclick="location.href='{{route('user-list.edit',$user->id)}}'">Düzenle</button>
                                  @else
                                    @if (auth()->user()->id == $user->id)
                                      <button class="btn btn-primary btn-outline-light btn-xl" style="background:#C38D08" onclick="location.href='{{route('user-list.edit',$user->id)}}'">Düzenle</button>
                                    @endif
                                  @endif
                                  @role('admin')
                                    <button class="js-delete-user-btn btn btn-primary btn-outline-light btn-xl" style="background:#B60C09" data-id={{$user->id}}>Kişiyi Sil</button>
                                  @endrole
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

@push('department-user-delete-javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
      $('.js-delete-department-user-btn').on('click', function () {
          let userId = $(this).attr("data-id");
          let departmentId = $(this).attr("department-id");
          console.log(userId);
          console.log(departmentId);
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '{{ url('/departments/department-user')}}',
              method: 'get',
              data: {
                'userId': userId,
                'departmentId':departmentId,
              },
              success: function(response) {
                window.location.href = "student-list";
              }
          });
      });
    });
</script>
@endpush

@push('user-delete-javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
      $('.js-delete-user-btn').on('click', function () {
          let userId = $(this).attr("data-id");
          console.log(userId);
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '{{ url('/users/user-list')}}/'+userId,
              method: 'delete',
              success: function(response) {
                window.location.href = "student-list";
              }
          });
      });
    });
</script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="background:#C6C6C6"><strong>{{ __('Öğrenciler') }}</strong></div>
                  <div class="card-body" style="background:#C3D6D7">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif

                      <table width=100%>
                          <tr height=35 class="alert alert-dark" role="alert">
                            <td align="center"><strong>-Öğrenci İsmi-</strong></td>
                            <td align="center"><strong>-Öğrenci E-mail Adresi-</strong></td>
                            <td align="center"><strong></strong></td>
                            <td align="center"><strong></strong></td>
                          </tr>
                        @foreach ($users as $user)
                          <tr height=35 class="alert alert-secondary" role="alert">
                            <td align="center">{{$user->name}}</td>
                            <td align="center">{{$user->email}}</td>
                            <td align="center">
                              @if (auth()->user()->hasRole('admin'))
                                <button class="btn btn-primary btn-outline-light btn-xl" style="background:#C38D08" onclick="location.href='{{route('admin.edit',$user->id)}}'">Düzenle</button>
                              @else
                                @if (auth()->user()->id == $user->id)
                                  <button class="btn btn-primary btn-outline-light btn-xl" style="background:#C38D08" onclick="location.href='{{route('admin.edit',$user->id)}}'">Düzenle</button>
                                @endif
                              @endif
                            </td>
                            <td align="center">
                              @role('admin')
                                <button class="js-delete-user-btn btn btn-primary btn-outline-light btn-xl" style="background:#B60C09" data-id={{$user->id}}>Kişiyi Sil</button>
                              @endrole
                            </td>
                          </tr>
                        @endforeach
                      </table>
                      <br>
                      <div align="center">
                        @role('admin')
                          <button class="btn btn-primary btn-outline-light btn-xl" style="background:#4C8DE1" onclick="location.href='admin/create'">Ekle</button>
                        @endrole
                      </div>
                  </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
      $('.js-delete-user-btn').on('click', function () {
          let userId = $(this).attr("data-id");
          console.log(userId);
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '{{ url('/admin')}}/'+userId,
              method: 'delete',
              success: location.reload()
          });
      });
    });
</script>
@endpush

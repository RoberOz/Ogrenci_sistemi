@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Öğrenciler') }}</div>
                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif

                      <table width=100%>
                        <tr height=35>
                          <td align="center"><strong>-Öğrenci İsmi-</strong></td>
                          <td align="center"><strong>-Öğrenci E-mail Adresi-</strong></td>
                          <td align="center"><strong></strong></td>
                          <td align="center"><strong></strong></td>
                        </tr>
                        @foreach ($users as $user)
                          <tr height=35>
                            <td align="center">{{$user->name}}</td>
                            <td align="center">{{$user->email}}</td>
                            <td align="center">
                              <button onclick="location.href='{{route('admin.edit',$user->id)}}'">Düzenle</button>
                            </td>
                            <td align="center">
                              <button class="js-delete-user-btn" data-id={{$user->id}}>Kişiyi Sil</button>
                            </td>
                          </tr>
                        @endforeach
                      </table>
                      <br>
                      <div align="center">
                        <button onclick="location.href='admin/create'">Ekle</button>
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

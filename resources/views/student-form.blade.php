@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card" style="background:#F2F2F2">

                <div style="background-color:lightblue">
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </div>

                <br>

                <form method="post" action="{{url('student_form/form')}}" >
                  <table align="center" style="margin-left: 300px;">
                    @csrf
                    <tr height="35">
                      <td align='right' width = "300"><label>T.C Kimlik No:</label></td>
                      <td ><input type="text" name="tc_kimlik_no" value="{{old('tc_kimlik_no')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Doğum Tarihi: </label></td>
                      <td ><input type="date" name="birth_date" value="{{old('birth_date')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Email Adresi: </label></td>
                      <td ><input type="email" name="email" value="{{old('email')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Öğrenci Numarası: </label></td>
                      <td ><input type="text" name="student_no" value="{{old('student_no')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Anne-Baba Beraber: </label></td>
                      <td>
                        <input type="checkbox" name="is_parents_together" value="1" ? {{old('is_parents_together')}}>Evet<br>
                        <input type="checkbox" name="is_parents_together" value="0" ? {{old('is_parents_together')}}>Hayır<br>
                      </td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Ailem ile Beraber Yaşıyorum: </label></td>
                      <td>
                        <input type="checkbox" name="living_with_family" value="1">Evet<br>
                        <input type="checkbox" name="living_with_family" value="0">Hayır<br>
                      </td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Aile Adresi: </label></td>
                      <td ><textarea name="family_address" rows="3" cols="60">{{old('family_address')}}</textarea></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Beraber Yaşadığınız Kişiler: </label></td>
                      <td ><textarea name="living_with" rows="2" cols="30">{{old('living_with')}}</textarea></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Şuan Yaşadığınız Adres: </label></td>
                      <td ><textarea name="current_address" rows="3" cols="60" required>{{old('current_address')}}</textarea></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Okula Geldiğiniz Taşıt: </label></td>
                      <td ><input type="text" name="getting_school_with" rows="3" cols="60" value="{{old('getting_school_with')}}"></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Çalışma Durumunuz: </label></td>
                      <td>
                        <select name="working_status" required>
                          <option value="" ? {{old('working_status')}}>Seçim Yapınız</option>
                          <option value="Çalışıyor ve Okuyor">Çalışıyor ve Okuyor</option>
                          <option value="Okuyor">Okuyor</option>
                        </select>
                      </td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Herhangi Bir Kaza Geçirdiniz mi? :  </label></td>
                      <td ><input type="text" name="been_in_accident" value="{{old('been_in_accident')}}"></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Hiç operasyon geçirdiniz mi? :  </label></td>
                      <td ><input type="text" name="had_any_surgery" value="{{old('had_any_surgery')}}"></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Herhangi Bir Hastalık Geçirdiniz mi? :  </label></td>
                      <td ><input type="text" name="did_have_any_sickness" value="{{old('did_have_any_sickness')}}"></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Kaç Kardeşsiniz? :  </label></td>
                      <td>
                        <select name="how_many_siblings" required>
                          <option value="" ? {{old('how_many_siblings')}}>Seçim Yapınız</option>
                          @for ($i=0; $i < 11; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                      </td>
                    </tr>
                    <tr height="35">
                      <td align="center" colspan="2"><br><button class="btn btn-primary btn-outline-light btn-xl" style="background:#4C8DE1" type="submit">Formu Gönder</button></td>
                    </tr>
                  </table>
                </form>

              </div>
          </div>
      </div>
  </div>
@endsection

@push('checkbox-javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
  $("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
</script>
@endpush

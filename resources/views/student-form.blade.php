@extends('layouts.app')

@section('content')
  @if (session('success_student_form'))
      <div class="alert alert-success" role="alert">
          Öğrenci formu gönderildi
      </div>
  @endif

  <div class="row justify-content-center">
    <div style="background-color:lightblue">
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </div>
  </div>

  <br>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col">
          <div class="card" style="background:#F2F2F2">
            <div class="card-header">Excel ile Öğrenci Formu Kaydet</div>

            <br><br>

            <form method="post" action="{{url('student_forms/import')}}" enctype="multipart/form-data">
              @csrf
              <div align="center">
                <input type="file" name="file">
                <button type="submit" class="btn btn-primary btn-outline-light btn-xl">Yükle</button>
              </div>
            </form>
            <br>

          </div>
      </div>

      <div class="col">
        <div class="card" style="background:#F2F2F2">
          <div class="card-header">Öğrenci Formlarını indir</div>
            <div align="center">
              <br><br>
                <button onClick="location.href='{{route('student-form-export')}}'" class="btn btn-primary btn-outline-light btn-xl">Form Listesini İndir</button>
                <button onClick="location.href='{{route('student-form-export-example')}}'" class="btn btn-primary btn-outline-light btn-xl">Örnek Form</button>
              <br><br>
            </div>
          </div>
        </div>
      </div>
  </div>

  <br>

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card" style="background:#F2F2F2">
                <br>
                <form method="post" action="{{url('student_forms/form')}}" >
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
                        <input type="radio" name="is_parents_together" value="1" {{old('is_parents_together') == '1' ? 'checked' : ''}}>Evet<br>
                        <input type="radio" name="is_parents_together" value="0" {{old('is_parents_together') == '0' ? 'checked' : ''}}>Hayır<br>
                      </td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Ailem ile Beraber Yaşıyorum: </label></td>
                      <td>
                        <input type="radio" name="living_with_family" value="1" {{old('living_with_family') == '1' ? 'checked' : ''}}>Evet<br>
                        <input type="radio" name="living_with_family" value="0" {{old('living_with_family') == '0' ? 'checked' : ''}}>Hayır<br>
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
                          <option value="">Seçim Yapınız</option>
                          <option value="Çalışıyor ve Okuyor" {{old('working_status') == 'Çalışıyor ve Okuyor' ? 'selected' : ''}}>Çalışıyor ve Okuyor</option>
                          <option value="Okuyor" {{old('working_status') == 'Okuyor' ? 'selected' : ''}}>Okuyor</option>
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
                          <option value="">Seçim Yapınız</option>
                          @for ($i=0; $i < 11; $i++)
                            <option value="{{$i}}" {{old('how_many_siblings') == $i ? 'selected' : ''}}>{{$i}}</option>
                          @endfor
                        </select>
                      </td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Boy :  </label></td>
                      <td ><input type="text" name="height" value="{{old('height')}}" placeholder='cm' required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Kilo :  </label></td>
                      <td ><input type="text" name="weight" value="{{old('weight')}}" placeholder='kg' required></input></td>
                    </tr>
                    <tr height="35">
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Anne Adı :  </label></td>
                      <td ><input type="text" name="mother_name" value="{{old('mother_name')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Anne Meslek :  </label></td>
                      <td ><input type="text" name="mother_job" value="{{old('mother_job')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Anne İş Adresi:  </label></td>
                      <td ><input type="text" name="mother_job_address" value="{{old('mother_job_address')}}"></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Anne Yaşadığı Adresi:  </label></td>
                      <td ><input type="text" name="mother_current_address" value="{{old('mother_current_address')}}"></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Anne Doğum Tarihi:  </label></td>
                      <td ><input type="date" name="mother_birth_date" value="{{old('mother_birth_date')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Anne Hayatta mı? :  </label></td>
                      <td>
                        <input type="radio" name="is_mother_alive" value="1" {{old('is_mother_alive') == '1' ? 'checked' : ''}}>Evet<br>
                        <input type="radio" name="is_mother_alive" value="0" {{old('is_mother_alive') == '0' ? 'checked' : ''}}>Hayır<br>
                      </td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Anne Email:  </label></td>
                      <td ><input type="email" name="mother_email" value="{{old('mother_email')}}"></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Anne Telefon Numarası:  </label></td>
                      <td ><input type="text" name="mother_phone_number" value="{{old('mother_phone_number')}}" required></input></td>
                    </tr>
                    <tr height="35">
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Baba Adı :  </label></td>
                      <td ><input type="text" name="father_name" value="{{old('father_name')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Baba Meslek :  </label></td>
                      <td ><input type="text" name="father_job" value="{{old('father_job')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Baba İş Adresi:  </label></td>
                      <td ><input type="text" name="father_job_address" value="{{old('father_job_address')}}"></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Baba Yaşadığı Adresi:  </label></td>
                      <td ><input type="text" name="father_current_address" value="{{old('father_current_address')}}"></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Baba Doğum Tarihi:  </label></td>
                      <td ><input type="date" name="father_birth_date" value="{{old('father_birth_date')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Baba Hayatta mı? :  </label></td>
                      <td>
                        <input type="radio" name="is_father_alive" value="1" {{old('is_father_alive') == '1' ? 'checked' : ''}}>Evet<br>
                        <input type="radio" name="is_father_alive" value="0" {{old('is_father_alive') == '0' ? 'checked' : ''}}>Hayır<br>
                      </td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Baba Email:  </label></td>
                      <td ><input type="email" name="father_email" value="{{old('father_email')}}"></input></td>
                    </tr>
                    <tr height="35">
                      <td align="right"><label>Baba Telefon Numarası:  </label></td>
                      <td ><input type="text" name="father_phone_number" value="{{old('father_phone_number')}}" required></input></td>
                    </tr>
                    <tr height="35">
                      <td align="center" colspan="2"><br><button class="btn btn-primary btn-outline-light btn-xl" style="background:#4C8DE1" type="submit">Formu Gönder</button></td>
                    </tr>
                  </table>
                </form>
                <br>
              </div>
          </div>
      </div>
  </div>
@endsection

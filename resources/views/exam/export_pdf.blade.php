<!DOCTYPE html>
<html lang="tr">
  <body>
    <div class="container" style="font-family: DejaVu Sans, sans-serif;">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">

              @foreach ($examinationQuestions as $examinationQuestion)
                <table>
                  <tr>
                    <td>
                      {{$examinationQuestion->order}})
                      {{$examinationQuestion->content}}<br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      @foreach ($examinationQuestion->options as $option)
                        {{$option['key']}})
                        {{$option['value']}}
                        <br>
                      @endforeach
                      <br>
                    </td>
                  </tr>
                </table>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

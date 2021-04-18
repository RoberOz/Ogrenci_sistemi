@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                    <div class="col-sm-14">
                      <table class="table table-bordered table-hover" width="100%" cellspacing="0" role="grid">
                        <thead style="background:#B6B6B6">
                            <tr role="row" align="center">
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                              </th>
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 150px;">
                                {{$firstPeriod}} Dönemi
                              </th>
                              <th tabindex="0" rowspan="1" colspan="1" style="width: 83px;">
                                {{$secondPeriod}} Dönemi
                              </th>
                            </tr>
                        </thead>
                        <tbody style="background:#D1D1D1">
                          <tr>
                            <td align="center">
                              <strong>Kayıt Tarihi Başlangıç:</strong>
                            </td>
                            <td align="center">
                              {{$firstPeriodDates['lecture_registeration_start_date']}}
                            </td>
                            <td align="center">
                              {{$secondPeriodDates['lecture_registeration_start_date']}}
                            </td>
                          </tr>
                          <tr>
                            <td align="center">
                              <strong>Kayıt Tarihi Bitiş:</strong>
                            </td>
                            <td align="center">
                              {{$firstPeriodDates['lecture_registeration_end_date']}}
                            </td>
                            <td align="center">
                              {{$secondPeriodDates['lecture_registeration_end_date']}}
                            </td>
                          </tr>
                          <tr>
                            <td align="center">
                              <strong>Dönem Başlangıç:</strong>
                            </td>
                            <td align="center">
                              {{$secondPeriodDates['start_date']}}
                            </td>
                            <td align="center">
                              {{$secondPeriodDates['start_date']}}
                            </td>
                          </tr>
                          <tr>
                            <td align="center">
                              <strong>Dönem Bitiş:</strong>
                            </td>
                            <td align="center">
                              {{$secondPeriodDates['end_date']}}
                            </td>
                            <td align="center">
                              {{$secondPeriodDates['end_date']}}
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
        </div>
    </div>
</div>
@endsection

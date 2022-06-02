@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
 
@endsection

@section('content')

<div class="card">                                
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive table-bordered">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                             
                                <th id="th-1" style="width: 150px">رقم القضية</th>
                                <th id="th-2" style="width: 150px">رقم الدعوى</th>
                                <th id="th-3">الحكم</th>
                                <th id="th-4" style="width: 150px">تاريخ الجلسة    </th>
                                <th id="th-5" style="width: 150px">تاريخ نهاية الحكم</th>
                                <th id="th-6" style="width: 150px">الأيام المتبقية</th>
                                <th id="th-7" style="width: 150px">فترة السماح</th>
                                <th id="th-8">نوع الجلسة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stages_noti as $stage_noti)
                                
                           
                            <tr class='clickable-row' >
                                  
                            <td>{{$stage_noti->N_CASE_ID}}</td>
                                  <td>
                                      {{$stage_noti->S_CASE_UID}}
                                  </td>
                                  <td> {{$stage_noti->S_HEARING_DESIGION}}</td>
                                  <td>{{$stage_noti->DT_HearingEnterDate}}</td>
                                 
                                  <td>{{ \Carbon\Carbon::parse($stage_noti->DT_HearingEnterDate)->addDays($stage_noti->N_Period) }}</td>
                                  <td>{{ ($today_date)->diffInDays( \Carbon\Carbon::parse($stage_noti->DT_HearingEnterDate)->addDays($stage_noti->N_Period), false )}}</td>
                                  <td>{{$stage_noti->N_Period}}</td>
                               <td>
                               <span class="badge badge-boxed  badge-soft-primary">{{$stage_noti->S_Desc_A}}</span>
                               </td>
                              
                              </tr>
                              @endforeach
                                                                                                                         
                        </tbody>
                    </table>
                </div><!--end table-responsive-->                                            
            </div><!--end col-->
        </div> <!--end row-->
        <div class="float-left mt-4">
            {{ $stages_noti->links() }}
            
            </div>
    </div><!--end card-body-->                                                                                                        
</div><!--end card-->
    
@endsection

@section('page-script')

<script>
      if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "التنبيهات"; 
    document.getElementById("breadcrumb-2").innerHTML = "تنبيهات الجلسات"; 

    document.getElementById("page-name").innerHTML = "تنبيهات الجلسات";
      }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "notifications";
    document.getElementById("breadcrumb-1").innerHTML = "hearing alert";


    document.getElementById("page-name").innerHTML = "HEARING ALERT";

    document.getElementById("th-1").innerHTML = "Main case number";
    document.getElementById("th-2").innerHTML = "Case number";
    document.getElementById("th-3").innerHTML = "Decision";
    document.getElementById("th-4").innerHTML = "Date of hearing";
    document.getElementById("th-5").innerHTML = "Hearing end date";
    document.getElementById("th-6").innerHTML = "Permission";
    document.getElementById("th-7").innerHTML = "Decision period";
    document.getElementById("th-8").innerHTML = "Case type";


      }
</script>
    
@endsection
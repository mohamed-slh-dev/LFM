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
                                <th id="th-1" style="width: 100px;">رقم الملف</th>
                                <th id="th-2" style="width: 100px;">رقم القضية</th>
                                <th id="th-3">رقم الدعوى</th>
                                <th id="th-4" style="width: 150px;">تاريخ الجلسة</th>
                                <th id="th-5" style="width: 150px;">  تاريخ الجلسة القادمة</th>
                                <th id="th-6">القرار</th>
                                <th id="th-7">عرض</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($short_stages as $stage)
                           
                            <tr  >
                                 <td> {{$stage->S_CASE_FILE_NUM}} </td>
                                <td> {{$stage->N_CASE_ID}} </td>
                                <td> {{$stage->S_CASE_UID}}</td>
                                <td> {{$stage->DT_HearingEnterDate}}</td>
                              
                                <td>{{$stage->DT_HEARING_DATE}}</td>
                                <td>{{$stage->S_HEARING_DESIGION}}</td>
                                <td class="text-center">
                                   
                                   <a href="{{url('case-stages/'.$stage->N_CASE_DETAILS_ID)}}">
                                    <button class="btn-sm btn-dark"> <i class="dripicons-preview "></i></button>  
                                </a>
                                    
                                    </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!--end table-responsive-->                                            
            </div><!--end col-->
        </div> <!--end row-->
        <div class="float-left mt-4">
            {{ $short_stages->links() }}
            
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
    document.getElementById("breadcrumb-2").innerHTML = "تنبيهات نواقص الجلسات"; 

    document.getElementById("page-name").innerHTML = "تنبيهات نواقص الجلسات";
      }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "notifications";
    document.getElementById("breadcrumb-1").innerHTML = "missing hearing alert";


    document.getElementById("page-name").innerHTML = "MISSING HEARING ALERT";

    document.getElementById("th-1").innerHTML = "File number";
    document.getElementById("th-2").innerHTML = "Main case number";
    document.getElementById("th-3").innerHTML = "Case number";
    document.getElementById("th-4").innerHTML = "Date of hearing ";
    document.getElementById("th-5").innerHTML = "Next hearing date";
    document.getElementById("th-6").innerHTML = "Decision";
    document.getElementById("th-7").innerHTML = "View";


      }
</script>
    
@endsection
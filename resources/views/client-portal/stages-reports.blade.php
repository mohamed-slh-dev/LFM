@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')

@endsection

@section('content')
   
    <div id="btnss" class="text-center">
            <button onclick="printDiv()" class="btn btn-primary mx-3 mb-3">
                <i class="fa fa-print"></i>
              </button>
    </div>
   

    <div class="row">
      

    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-body invoice-head pt-0"> 
                <div class="row">
                    <div class="col-md-12 text-center">                                                
                        <img src="../assets/images/report-logo.png" alt="logo-small" class="logo-sm mr-2" height="75">                                            
                    </div>
                </div>
                    <div class="row" style="border: 1px solid #b9b9b9;">
                        <div class="col-3">
                            <h6> <span id="stages-count">  عدد الجلسات : </span> {{$stages_noti->count()}}</h6>
                        </div>
                        <div class="col-6 text-center">
                         
    
                        </div>
                            <div class="col-3">
                                <h6> <span id="print-date"> تاريخ الطباعة :</span> {{$print_date}}</h6>
                                </div>   
                         
                        </div>
             
            </div><!--end card-body-->
            <div class="card-body">
       
                <hr>
    
                <div class="row">
              
                    <div class="col-lg-12">
                        <div class="table-responsive">
                          <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 100px;" id="tb2-1"></th>
                                    <th style="width: 150px;" id="tb2-2"></th>
                                    <th style="width: 120px;" id="tb2-3"></th>
                                    <th style="width: 180px;" id="tb2-4"></th>
                                    <th  style="width: 140px;" id="tb2-5">  </th>
                                    <th style="width: 140px;" id="tb2-6"> </th>
                                   
                                    <th style="width: 100px;" id="tb2-9"></th>
                                 

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stages_noti as $stage_noti)
                                    
                               
                                <tr class='clickable-row' >
                                    
                                    <td>{{$stage_noti->S_CASE_FILE_NUM}}</td>
                                <td>{{$stage_noti->N_CASE_ID}}</td>
                                      <td>
                                          {{$stage_noti->S_CASE_UID}}
                                      </td>
                                      <td> {{$stage_noti->S_HEARING_DESIGION}}</td>
                                      <td>{{$stage_noti->DT_HearingEnterDate}}</td>
                                     
                                      <td>{{$stage_noti->DT_HEARING_DATE}}</td>
                                   <td>
                                   <span class="badge badge-boxed  badge-soft-primary">{{$stage_noti->S_Desc_A}}</span>
                                   </td>
                                
                                

                                  
                                  </tr>
                                  @endforeach
                                                                                                                             
                            </tbody>
                        </table>
                      </div>                                          
                    </div> 
                  
                    
    
                    
                </div>
    
                
              
            </div>
        </div><!--end card-->
    </div><!--end col-->
        

      
 </div><!--end row-->

@endsection

@section('page-script')
<script> 
    function printDiv() {   
        document.getElementById("chat-sticky").style.display = "none";
        document.getElementById("btnss").style.display = "none"; 
        window.print(); 
        document.getElementById("chat-sticky").style.display = "block"; 
        document.getElementById("btnss").style.display = "block"; 

    } 

</script>

<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.crm_leads.init.js')}}"></script> 
<script src="{{asset('assets/pages/jquery.projects_task.init.js')}}"></script>

<script>
           if (lang == "ar") {
document.body.style.direction = "rtl"; 
document.body.style.textAlign = "right"; 

document.getElementById("breadcrumb-float").classList.add('float-left');
document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
document.getElementById("breadcrumb-2").innerHTML = " لوحة القضايا الرئيسية"; 

document.getElementById("page-name").innerHTML = " لوحة القضايا الرئيسية";

document.getElementById("tb2-1").innerHTML = "رقم الملف";
   document.getElementById("tb2-2").innerHTML = "رقم القضية";
   document.getElementById("tb2-3").innerHTML = "رقم الدعوى";
   document.getElementById("tb2-4").innerHTML = "قرار الجلسة";
   document.getElementById("tb2-5").innerHTML = "تاريخ الجلسة الحالية";
   document.getElementById("tb2-6").innerHTML = "تاريخ الجلسة القادمة";

   document.getElementById("tb2-9").innerHTML = "نوع الجلسة";

           }else{
            document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "cases manage";
document.getElementById("breadcrumb-1").innerHTML = "cases dashboard";

document.getElementById("page-name").innerHTML = "CASES REPORTS";

document.getElementById("tb2-1").innerHTML = "File number";
document.getElementById("tb2-2").innerHTML = "Main Case number";
document.getElementById("tb2-3").innerHTML = "Case number";
document.getElementById("tb2-4").innerHTML = "Decision";
document.getElementById("tb2-5").innerHTML = "Date of hearing ";
document.getElementById("tb2-6").innerHTML = "Next date of hearing";
document.getElementById("tb2-9").innerHTML = "Case type";



           }
</script>
    
@endsection
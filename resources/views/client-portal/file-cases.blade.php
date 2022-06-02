@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-3" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
الدعاوى
@endsection

@section('content')

<div class="row">

    @foreach ($stages as $stage)
    <div class="col-lg-6">
        <div class="card">
          <div class="card-body"> 
           @if (Session::get('lang') == "ar")
                 <div class="task-box ">
                     <div class="row">

                  
                     <div class="col-4 text-right">
                        <h5 class="mt-0 " style="font-weight: bold;"> - {{$stage->S_CASE_UID}} </h5>

                     </div>
                     <div class="col-4 text-center">
                        <p class="text-muted mb-2  ">
                            قيمة المطالبة : {{number_format($stage->cliam_amount,2) }}  
                          </p>
                    </div>
                    <div class="col-4 text-left">
                        <a href="{{url('client-main-case-cases/'.$stage->N_CASE_ID)}}" >
                            <button class="btn-sm btn-outline-dark btn-round">
                                <span>عرض القضية </span>
                            </button>
                         </a>
                    </div>
                </div>
                  
                  
                 
      
                      <div style="display: block ruby;" class="text-center mt-3">
                  <p class="text-muted mb-2  ">
                 الخصم : {{$stage->againstName}}  
                   </p>
                      </div>
                   <div style="display: block ruby;" class="mt-4">
                        <p class=" text-left mb-1" style="float: left;"> مرحلة الدعوى :   {{$stage->caseStage}} </p>
                      <p class=" text-right mb-1">  نوع الدعوى :  {{$stage->caseType}} </p>
                   </div>
                     
      
                   <hr>
                   
                   <div class="d-flex justify-content-between">
                   <a href="{{url('client-case-details/'.$stage->N_CASE_DETAILS_ID)}}">
                     <button class="btn btn-outline-dark waves-effect waves-light">البيانات</button></a> 
                           
                     <a href="{{url('client-case-stages/'.$stage->N_CASE_DETAILS_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >الجلسات</button></a>
      
      
                         <a href="{{url('client-case-tasks/'.$stage->N_CASE_DETAILS_ID,$stage->N_CASE_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >المهام</button></a>
      
                       <a href="{{url('client-case-documents/'.$stage->N_CASE_DETAILS_ID,$stage->N_CASE_ID)}}"><button class="btn btn-outline-secondary  waves-effect waves-light" >المستندات</button></a>
                  
                   </div>                                        
               </div><!--end task-box--> 
              @else
                <div class="task-box">
                    <div class="row">
                        <div class="col-4 text-left">
                           <h5 class="mt-0 " style="font-weight: bold;"> - {{$stage->S_CASE_UID}} </h5>
   
                        </div>
                        <div class="col-4 text-center">
                           <p class="text-muted mb-2  ">
                               Cliam Amount : {{number_format($stage->cliam_amount,2) }} 
                             </p>
                       </div>
                       <div class="col-4 text-right">
                           <a href="{{url('client-main-case-cases/'.$stage->N_CASE_ID)}}" >
                               <button class="btn-sm btn-outline-dark btn-round">
                                   <span>View Case </span>
                               </button>
                            </a>
                       </div>
                   </div>
                   <div style="display: block ruby;" class="text-center mt-3">
                    <p class="text-muted mb-2  ">
                   Against : {{$stage->againstName}}  
                     </p>
                        </div>

                   <div style="display: block ruby;" class="mt-4">
                        <p class=" mb-1" style="float: right;">  Case stage :  {{$stage->caseStage}} </p>
                      <p class=" mb-1"> Case type : {{$stage->caseType}} </p>
                   </div>
                     
      
                   <hr>
                   
                   <div class="d-flex justify-content-between">
                   <a href="{{url('client-case-details/'.$stage->N_CASE_DETAILS_ID)}}">
                     <button class="btn btn-outline-dark waves-effect waves-light">DETAILS</button></a> 
      
                     
                     <a href="{{url('client-case-stages/'.$stage->N_CASE_DETAILS_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >HEARINGS</button></a>
      
      
                         <a href="{{url('client-case-tasks/'.$stage->N_CASE_DETAILS_ID,$stage->N_CASE_ID)}}"><button class="btn btn-outline-dark waves-effect waves-light" >TASKS</button></a>
      
                       <a href="{{url('client-case-documents/'.$stage->N_CASE_DETAILS_ID,$stage->N_CASE_ID)}}"><button class="btn btn-outline-secondary  waves-effect waves-light" >DOCUMENTS</button></a>
                  
                   </div>                                        
               </div><!--end task-box-->  
              @endif                                   
              
          </div><!--end card-body-->
      </div><!--end card-->
  </div><!--end col-->
       @endforeach

    {{-- <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

              
                <div class="table-responsive">
                    <table class="table table-bordered table-centered">
                <thead>
                    <tr>
                        <th id="th-1" style="width: 100px;">رقم الدعوى</th>
                        <th id="th-2"  style="width: 100px;">نوع الدعوى</th>
                        <th id="th-3"  style="width: 100px;">مرحلة الدعوى</th>
                        <th id="th-4"  style="width: 150px;"> تاريخ التسجيل</th>
                        <th id="th-5"  style="width: 180px;"> الخصم</th>
                        <th id="th-6" style="width: 100px;"> المطالبة المالية</th>
                        <th id="th-7" style="width: 140px;">عرض بيانات الدعوى</th>

                </tr>
                </thead>
             
                <tbody>
                       
                    @foreach ($stages as $stage)
            
                    <tr>
                       
                        <td > {{$stage->S_CASE_UID}}</td>
                            <td  > {{$stage->caseType}}</td>
                            <td > {{$stage->caseStage}}</td>
                            <td  > {{$stage->register_date}}</td>
                            <td  > {{$stage->againstName}}</td>
                            <td  > {{$stage->cliam_amount}}</td>
                          
                            <td class="text-center">
                                <a href="{{url('client-main-case-cases/'.$stage->N_CASE_ID)}}">
                                    <button class="btn-sm btn-outline-dark waves-effect waves-light" > <i class="dripicons-preview"></i> </button>
                                </a>
     
                            </td>
                        </tr>
                        @endforeach
                  
                </tbody>
                
            </table>
                </div>
            </div>
        </div> 
        {{ $stages->links() }}                                           
    </div> --}}
   
</div>
 
@endsection

@section('page-script')
    
<script>
           if (lang == "ar") {
document.body.style.direction = "rtl"; 
document.body.style.textAlign = "right"; 

document.getElementById("breadcrumb-float").classList.add('float-left');
document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
document.getElementById("breadcrumb-2").innerHTML = " الملفات"; 
document.getElementById("breadcrumb-3").innerHTML = " دعاوى الملف"; 

document.getElementById("page-name").innerHTML = " الملفات";


  }else
  {
   document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-3").innerHTML = "cases manage";
document.getElementById("breadcrumb-2").innerHTML = "file ";
document.getElementById("breadcrumb-1").innerHTML = "file cases";


document.getElementById("page-name").innerHTML = "FILE CASES";

document.getElementById("th-1").innerHTML = "Case number";
document.getElementById("th-2").innerHTML = "Case type";
document.getElementById("th-3").innerHTML = "Case stage";
document.getElementById("th-4").innerHTML = "Registeration Date";
document.getElementById("th-5").innerHTML = "Against";
document.getElementById("th-6").innerHTML = "Cliam Amount";
document.getElementById("th-7").innerHTML = "View Case Details";





   }
</script>
    
@endsection
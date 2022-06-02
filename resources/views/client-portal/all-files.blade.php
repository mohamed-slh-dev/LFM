@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
    
@endsection

@section('content')



<div class="row">
    @foreach ($main_cases as $mc)
  
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body pb-0">  
               <div style="display: ruby;" class="row">  
                   <div class=" col-6">
                            
                  </div>                            
               <div class=" d-flex justify-content-end col-6">                                        
                  
               </div> 
           </div>
                <div class="text-center project-card" style="margin-top: -50px;">
                  <img src="{{asset('assets/images/case-img.png')}}" alt="" height="90" class=" d-block" style="margin-top: 25px; margin-left:40%;"> 
                   <br>
      
                     @if (Session::get('lang') == "ar")
                    
                     <div style="display:inline-block">
                       <h4> <i class="mdi mdi-account  mr-2 text-success ml-2"></i> {{$mc->clientName}}  </h4> 
                       <h4> <i class="mdi mdi-account  mr-2 text-danger ml-2"></i>  {{$mc->againstName}}</h4>

                     </div>
                     <br>
                     <p class="text-muted mb-2 mt-1"><span class="text-secondary font-14" id="card-case-subject"><b> موضوع القضية</b></span> : {{$mc->S_CASE_SUBJECT}}
                     </p>
      
                     <p class="text-muted mb-2 mt-1"><span class="text-info font-12" id="card-case-amount"><b>  قيمة المطالبة</b></span> : {{$mc->N_PaymentValue}}
                     </p>
      
                     <a href="{{url('client-file-cases/'.$mc->N_CASE_ID)}}"><button class="btn btn-outline-secondary waves-effect my-3" id="card-case-view">عرض القضية</button></a>
      
                      <a href="{{url('client-case-report/'.$mc->N_CASE_ID)}}"> <button class="btn btn-outline-info waves-effect waves-light mr-3" type="submit" id="card-case-report" > تقرير القضية</button></a>
                    <br>
                     <div class="row">
                         <div class="col-6">
                           <p class="text-muted ">  <span id="card-case-create">تاريخ الانشاء</span> : {{$mc->DT_CASE_DATE}}   </p>
      
                         </div>
                         <div class="col-6">
                           <p class="text-muted "> <span id="card-case-register">تاريخ التسجيل</span>  : {{$mc->register_date}}   </p>
      
                       </div>
      
                     </div>
                     @else
                     <div style="display:inline-block">
                       <h4> <i class="mdi mdi-account  mr-2 text-success ml-2"></i> {{$mc->clientName}}  </h4> 
                       <h4> <i class="mdi mdi-account  mr-2 text-danger ml-2"></i>  {{$mc->againstName}}</h4>

                     </div>
                     <br>
                     <p class="text-muted mb-2 mt-1"><span class="text-secondary font-14" id="card-case-subject"><b> Case subject</b></span> : {{$mc->S_CASE_SUBJECT}}
                     </p>
      
                     <p class="text-muted mb-2 mt-1"><span class="text-info font-12" id="card-case-amount"><b>Cliam amont</b></span> : {{$mc->N_PaymentValue}}
                     </p>
      
                     <a href="{{url('client-file-cases/'.$mc->N_CASE_ID)}}"><button class="btn btn-outline-secondary waves-effect my-3" id="card-case-view">View case</button></a>
      
                      <a href="{{url('client-case-report/'.$mc->N_CASE_ID)}}"> <button class="btn btn-outline-info waves-effect waves-light mr-3" type="submit" id="card-case-report" >Case report</button></a>
                    <br>
                     <div class="row">
                         <div class="col-6">
                           <p class="text-muted ">  <span id="card-case-create">Create date</span> : {{$mc->DT_CASE_DATE}}   </p>
      
                         </div>
                         <div class="col-6">
                           <p class="text-muted "> <span id="card-case-register">Register date</span>  : {{$mc->register_date}}   </p>
      
                       </div>
      
                     </div>
                         
                     @endif
                        
                </div>                                                                      
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col--> 

    @endforeach

</div>
<div class="float-left mt-4">
    {{ $main_cases->links() }}
    
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

document.getElementById("page-name").innerHTML = " الملفات";


           }else{
            document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "cases manage";
document.getElementById("breadcrumb-1").innerHTML = "files";

document.getElementById("page-name").innerHTML = "FILES";




           }
</script>
    
@endsection
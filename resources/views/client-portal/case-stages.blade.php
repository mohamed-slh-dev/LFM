@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-3" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')

@endsection

@section('content')
    <div class="row">

      
           @foreach ($case_stages as $case_stage)
               
           <div class="col-lg-4">
               <div class="card ico-card">                                
                   <div class="card-body">
                       <span class="badge badge-soft-success font-12" id="badge">
                        {{$case_stage->N_Reviewed}}
                       </span>
                       <div class="media">
                        <img src="{{asset('assets/images/hammer.png')}}" class="mx-3 thumb-md" alt="...">
                           <div class="media-body align-self-center">                                                                                                                       
                               <h5 class="mb-4 font-16 "> {{$case_stage->typeName}}</h5>
                               <p class=" mb-4"> 
                                {{$case_stage->S_HEARING_DESIGION}}
                               </p>

                               @if (Session::get('lang') == "ar")
                               <div class="row">
                                   
                                <div class="col-md-5">                                                    
                                    <p class=" mb-4 text-muted"> تاريخ الجلسة : <br>
                                     <span>{{$case_stage->DT_HearingEnterDate }}</span></p>
                                </div><!--end col-->
                                <div class="col-md-7 text-right">                                                    
                                    <p class="mb-4 text-muted">تاريخ الجلسة القادمة : <br>
                                     <span>{{$case_stage->DT_HEARING_DATE}}</span></p>
                                </div><!--end col-->
                            </div><!--end row-->
                            <ul class="list-inline mb-4 pr-0">
                                <li class="list-inline-item">
                                   لدى محكمة : {{$case_stage->courtName }}
                                </li>
                               
                            </ul>
                           
                               @else
                               <div class="row">
                                   
                                <div class="col-md-5">                                                    
                                    <p class=" mb-4 text-muted">Stage date : <br>
                                     <span>{{$case_stage->DT_HearingEnterDate }}</span></p>
                                </div><!--end col-->
                                <div class="col-md-7 text-left">                                                    
                                    <p class="mb-4 text-muted">Next stage date : <br>
                                     <span>{{$case_stage->DT_HEARING_DATE}}</span></p>
                                </div><!--end col-->
                            </div><!--end row-->
                            <ul class="list-inline mb-4 pl-0">
                                <li class="list-inline-item">
                                   Court : {{$case_stage->courtName }}
                                </li>
                               
                            </ul>
                 
                               @endif
                               
                             
                           </div><!--end media body-->
                       </div><!--end media-->                                   
                   </div><!--end card-body-->
               </div><!--end card-->
           </div><!--end col-->
     @endforeach
          
           
       </div>  <!--end row-->

@endsection

@section('page-script')

<script>
     if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = 'الدعاوى'; 
    document.getElementById("breadcrumb-3").innerHTML = "جلسات الدعوى"; 

    document.getElementById("page-name").innerHTML = "جلسات الدعوى"; 


   
   if ( document.getElementById("badge")) {
    document.getElementById("badge").classList.add("float-left"); 
   }

  


     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = 'cases' ;
    document.getElementById("breadcrumb-1").innerHTML = "case stages" ;


    document.getElementById("page-name").innerHTML = "CASE STAGES";

    if ( document.getElementById("badge")) {
    document.getElementById("badge").classList.add("float-right"); 
    }
   

    
     }
</script>
    
@endsection
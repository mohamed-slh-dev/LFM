@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-3" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')

@endsection

@section('content')
    <div class="row">

        <div class="col-lg-12 ">
               <div class="">
                   <ul class="list-inline pr-0">                                    
                      
                       <li class="list-inline-item">

                       <button type="button" class="btn btn-primary waves-effect waves-light  mb-3" data-toggle="modal" data-animation="bounce" data-target=".add-stage" id="new-stage"></button>

                       </li>
                   </ul>
               </div>                            
           </div><!--end col-->
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
                            <div>
                                <a href="{{url('delete-stage/'.$case_stage->N_HEARING_ID)}}"   class="btn btn-sm btn-outline-danger d-sm-inline-block float-left mr-3"> حذف </a>                                            
                            <a  data-toggle="modal" data-animation="bounce" data-target=".edit-stage-{{$case_stage->N_HEARING_ID}}" class="btn btn-sm btn-outline-info d-sm-inline-block float-left"> تعديل </a>                                            

                            </div>
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
                            <div>
                            <a href="{{url('delete-stage/'.$case_stage->N_HEARING_ID)}}"   class="btn btn-sm btn-outline-danger d-sm-inline-block float-right ml-3">DELETE</a>                                            
                            <a  data-toggle="modal" data-animation="bounce" data-target=".edit-stage-{{$case_stage->N_HEARING_ID}}" class="btn btn-sm btn-outline-info d-sm-inline-block float-right">Edit</a>                                            

                            </div>
                               @endif
                               
                             
                           </div><!--end media body-->
                       </div><!--end media-->                                   
                   </div><!--end card-body-->
               </div><!--end card-->
           </div><!--end col-->
     @endforeach
          
           
       </div>  <!--end row-->

       <div class="modal fade add-stage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('add-case-stage')}}">
                        @csrf
                <div class="row">
                         <div class="col-md-6">
                               
                                 
                                <div class="form-group">
                                   

                                    <div class="form-group">
                                        <label id="stage-count"></label>
                                        <input disabled type="text" class="form-control" value=" {{$case_stages->count()}} " >
                                        
                                       
                                    </div>

                               
                                </div>


                            </div>
                            <input type="hidden" class="form-control" name="case_id" value=" {{$case_id}} " >

                            <div class="col-md-6">
                            <div class="form-group">
                                  
                                <div class="form-group">
                                    <label id="stage-type"></label>
                                    <select class="custom-select" name="type">
                                        @foreach ($stage_type as $type)
                                        <option value="{{$type->N_DetailedCode}}">{{$type->S_Desc_A}}</option>  
                                        @endforeach 
                                      </select>
                                  
                                </div>

                                   
                                </div>
                               

                            </div>
                            

                    

                    
              <div class="col-12"> <hr></div>
                   <div class="col-lg-6">

                    
                    
                    <div class="form-group">
                        <label  id="stage-now-date"></label>
                        <input class="form-control" name="stage_date" type="date" id="now_date" required="">
                   
                    </div>
                    
                           

                                  <div class="form-group">
                                    <label id="stage-consult"></label>
                                      <select class="custom-select" name="consult">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>  
                                        @endforeach 
                                            
                                        </select>
                               
                                </div>
                                  

                                <div class="form-group">
                                    <label id="stage-court"> </label>
                                    <select class="custom-select" name="court">
                                        @foreach ($court as $courtt)
                                        <option value="{{$courtt->N_DetailedCode}}">{{$courtt->S_Desc_A}}</option>  
                                        @endforeach 
                                    </select>                               
                                </div>

                              <div class="form-group">
                                    <label id="stage-hall"></label>
                                    <input type="text" class="form-control" id="now_date" name="hall">
                               
                                </div>

                      </div>
                      
                      <div class="col-lg-6">

                          

                              <div class="form-group">
                                    <label id="stage-next-date"></label>
                                    <input type="date" class="form-control"  name="next_date">
                               
                                </div>


                                   <div class="form-group">
                                    <label id="stage-lawyer"></label>
                                      <select class="custom-select"  name="lawyer">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>  
                                        @endforeach 
                                        </select>
                               
                                </div>

                                   <div class="form-group">
                                    <label id="stage-by"></label>
                                      <input type="text"  class="form-control" disabled placeholder="المستخدم الحالي">
                               
                                </div>

                                <div class="form-group">
                                    <label id="stage-session"></label>
                                      <select class="custom-select" name="session_type">
                                         <option selected="اونلاين">
                                             اونلاين</option>
                                            <option value="حضوري">
                                                حضوري</option>
                                           
                                        </select>
                               
                                </div>
                      </div>

                      <div class="col-lg-12">

                           <div class="form-group">
                                    <label id="stage-decission"></label>
                                    <textarea class="form-control" name="decision_ar" rows="5" id="message"></textarea>
                               
                                </div>

                                   <div class="form-group">
                                    <label id="stage-decission-eng"> </label>
                                    <textarea class="form-control" name="decision_eng" rows="5" id="message"></textarea>
                               
                                </div>

                                   <div class="form-group">
                                    <label id="stage-note"></label>
                                    <textarea class="form-control" rows="5" name="notes" id="message"></textarea>
                               
                                </div>

                            

                                 <button class="btn btn-primary my-4" type="submit" id="stage-add-btn"> </button>
                                 </div>

                                                    
                         </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  

   
@foreach ($case_stages as $stage)
<div class="modal fade edit-stage-{{$stage->N_HEARING_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('edit-case-stage')}}">
                        @csrf
                        @if (Session::get('lang') == "ar")
                        <div class="row">
                    

                            <div class="col-lg-12">
                                <div class="col-sm-4 px-0">
                                    <label id="edit-stage-type"> نوع الجلسة</label>
                                    <select class="custom-select" name="type">
                                        <option value="{{$stage->typeCode}}">{{$stage->typeName}}</option>  
                                        @foreach ($stage_type as $type)
                                        <option value="{{$type->N_DetailedCode}}">{{$type->S_Desc_A}}</option>  
                                        @endforeach 
                                      </select>
                                 </div>
                                 <hr>
                            </div>
                           <div class="col-lg-6">
        
                            <input type="hidden" name="stage_id" id="" value="{{$stage->N_HEARING_ID}}">
                            
                            <div class="form-group">
                                <label id="edit-stage-now-date">تاريخ الجلسة </label>
                            <input  class="form-control" type="date" value="{{$stage->DT_HearingEnterDate}}" name="enter_date" id="now_date" >
                           
                            </div>
                            <div class="form-group">
                                <label id="edit-stage-consult">المستشار</label>
                                  <select class="custom-select" name="consult">
                                    <option value="{{$stage->consultId}}">{{$stage->consultName}}</option>  
        
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>  
                                    @endforeach 
                                        
                                    </select>
                           
                            </div>
                            
                            <div class="form-group">
                                <label id="edit-stage-court"> لدى محكمة</label>
                                <select class="custom-select" name="court">
                                    <option value="{{$stage->courtId}}">{{$stage->courtName}}</option>  
        
                                    @foreach ($court as $stage_court)
                                    <option value="{{$stage_court->N_DetailedCode}}">{{$stage_court->S_Desc_A}}</option>  
                                    @endforeach 
                                </select>                               
                            </div>
                                      <div class="form-group">
                                            <label id="edit-stage-hall"> القاعة</label>
                                            <input type="text" class="form-control" value="{{$stage->S_Hall}}"  name="hall" >
                                       
                                        </div>
        
                              </div>
                              
                              <div class="col-lg-6">
        
                                  
        
                                      <div class="form-group">
                                            <label id="edit-stage-next-date">تاريخ الجلسة القادمة</label>
                                            <input type="date" class="form-control" value="{{$stage->DT_HEARING_DATE}}" name="next_date" >
                                       
                                        </div>
                                        <div class="form-group">
                                            <label id="edit-stage-lawyer">المحامي المترافع</label>
                                              <select class="custom-select"  name="lawyer">
                                                <option value="{{$stage->lawyerId}}">{{$stage->lawyerName}}</option>  
        
                                                @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>  
                                                @endforeach 
                                                </select>
                                       
                                        </div>
                                        
                                    <div class="form-group">
                                        <label id="edit-stage-session">نوع الحضور</label>
                                          <select class="custom-select" name="session_type">
                                            <option selected value="{{$stage->sessiontype}}">
                                                {{$stage->sessiontype}}</option>
        
                                             <option value="اونلاين">
        
                                                 اونلاين</option>
                                                <option value="حضوري">
                                                    حضوري</option>
                                               
                                            </select>
                                   
                                    </div>
        
                              </div>
        
                              <div class="col-lg-12">
        
                                   <div class="form-group">
                                            <label id="edit-stage-decission">القرار الصادر</label>
                                            <textarea class="form-control" name="decision_ar"  rows="5" id="message">{{$stage->S_HEARING_DESIGION}}</textarea>
                                       
                                        </div>
        
                                           <div class="form-group">
                                            <label id="edit-stage-decission-eng">القرار الصادر EG</label>
                                            <textarea class="form-control" name="decision_eng" rows="5" id="message">{{$stage->decision_eng}}</textarea>
                                       
                                        </div>
        
                                           <div class="form-group">
                                            <label id="edit-stage-note">ملاحظات</label>
                                            <textarea class="form-control" rows="5" name="notes" id="message">{{$stage->S_Notes}}</textarea>
                                       
                                        </div>
        
                                    
        
                                         <button class="btn btn-info my-4" type="submit" id="edit-stage-btn"> تعديل الجلسة </button>
                                         </div>
        
                                                            
                                 </div>  
                        @else
                           <div class="row">
                    

                            <div class="col-lg-12">
                                <div class="col-sm-4 px-0">
                                    <label id="edit-stage-type">Stage type</label>
                                    <select class="custom-select" name="type">
                                        <option value="{{$stage->typeCode}}">{{$stage->typeName}}</option>  
                                        @foreach ($stage_type as $type)
                                        <option value="{{$type->N_DetailedCode}}">{{$type->S_Desc_A}}</option>  
                                        @endforeach 
                                      </select>
                                 </div>
                                 <hr>
                            </div>
                           <div class="col-lg-6">
        
                            <input type="hidden" name="stage_id" id="" value="{{$stage->N_HEARING_ID}}">
                            
                            <div class="form-group">
                                <label id="edit-stage-now-date">Stage date </label>
                            <input  class="form-control" type="date" value="{{$stage->DT_HearingEnterDate}}" name="enter_date" id="now_date" >
                           
                            </div>
                            <div class="form-group">
                                <label id="edit-stage-consult">Consultant</label>
                                  <select class="custom-select" name="consult">
                                    <option value="{{$stage->consultId}}">{{$stage->consultName}}</option>  
        
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>  
                                    @endforeach 
                                        
                                    </select>
                           
                            </div>
                            
                            <div class="form-group">
                                <label id="edit-stage-court"> Court</label>
                                <select class="custom-select" name="court">
                                    <option value="{{$stage->courtId}}">{{$stage->courtName}}</option>  
        
                                    @foreach ($court as $stage_court)
                                    <option value="{{$stage_court->N_DetailedCode}}">{{$stage_court->S_Desc_A}}</option>  
                                    @endforeach 
                                </select>                               
                            </div>
                                      <div class="form-group">
                                            <label id="edit-stage-hall"> Hall</label>
                                            <input type="text" class="form-control" value="{{$stage->S_Hall}}"  name="hall" >
                                       
                                        </div>
        
                              </div>
                              
                              <div class="col-lg-6">
        
                                  
        
                                      <div class="form-group">
                                            <label id="edit-stage-next-date">Next stage date</label>
                                            <input type="date" class="form-control" value="{{$stage->DT_HEARING_DATE}}" name="next_date" >
                                       
                                        </div>
                                        <div class="form-group">
                                            <label id="edit-stage-lawyer">Lawyer</label>
                                              <select class="custom-select"  name="lawyer">
                                                <option value="{{$stage->lawyerId}}">{{$stage->lawyerName}}</option>  
        
                                                @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>  
                                                @endforeach 
                                                </select>
                                       
                                        </div>
                                        
                                    <div class="form-group">
                                        <label id="edit-stage-session">Atendance type</label>
                                          <select class="custom-select" name="session_type">
                                            <option selected value="{{$stage->sessiontype}}">
                                                {{$stage->sessiontype}}</option>
        
                                             <option value="اونلاين">
        
                                                 اونلاين</option>
                                                <option value="حضوري">
                                                    حضوري</option>
                                               
                                            </select>
                                   
                                    </div>
        
                              </div>
        
                              <div class="col-lg-12">
        
                                   <div class="form-group">
                                            <label id="edit-stage-decission">Decission AR</label>
                                            <textarea class="form-control" name="decision_ar"  rows="5" id="message">{{$stage->S_HEARING_DESIGION}}</textarea>
                                       
                                        </div>
        
                                           <div class="form-group">
                                            <label id="edit-stage-decission-eng"> Decission ENG</label>
                                            <textarea class="form-control" name="decision_eng" rows="5" id="message">{{$stage->decision_eng}}</textarea>
                                       
                                        </div>
        
                                           <div class="form-group">
                                            <label id="edit-stage-note">Notes</label>
                                            <textarea class="form-control" rows="5" name="notes" id="message">{{$stage->S_Notes}}</textarea>
                                       
                                        </div>
        
                                    
        
                                         <button class="btn btn-info my-4" type="submit" id="edit-stage-btn">Update </button>
                                         </div>
        
                                                            
                                 </div> 
                        @endif
                
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  
        
    @endforeach

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

    document.getElementById("new-stage").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> إضافة جلسة'; 

   
   if ( document.getElementById("badge")) {
    document.getElementById("badge").classList.add("float-left"); 
   }

    document.getElementById("stage-count").innerHTML = "عدد الجلسات الحالي"; 
    document.getElementById("stage-type").innerHTML = "نوع الجلسة"; 
    document.getElementById("stage-now-date").innerHTML = "تاريخ الجلسة الحالي"; 
    document.getElementById("stage-consult").innerHTML = "المستشار"; 
    document.getElementById("stage-next-date").innerHTML = "تاريخ الجلسة القادمة"; 
    document.getElementById("stage-lawyer").innerHTML = "المحامي المترافع"; 
    document.getElementById("stage-court").innerHTML = "المحكمة"; 
    document.getElementById("stage-by").innerHTML = "بواسطة"; 
    document.getElementById("stage-hall").innerHTML = "القاعة"; 
    document.getElementById("stage-session").innerHTML = "نوع الحضور"; 
    document.getElementById("stage-decission").innerHTML = "القرار الصادر عربي"; 
    document.getElementById("stage-decission-eng").innerHTML = "القرار الصادر انجليزي"; 
    document.getElementById("stage-note").innerHTML = "ملاحظات"; 
    document.getElementById("stage-add-btn").innerHTML = "<span class='mdi mdi-plus-box mx-2'></span>اضافة جلسة"; 





     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = 'cases' ;
    document.getElementById("breadcrumb-1").innerHTML = "case stages" ;


    document.getElementById("page-name").innerHTML = "CASE STAGES";

    document.getElementById("new-stage").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add new stage'; 
    if ( document.getElementById("badge")) {
    document.getElementById("badge").classList.add("float-right"); 
    }
    document.getElementById("stage-count").innerHTML = "Number of stages"; 
    document.getElementById("stage-type").innerHTML = "Stage type"; 
    document.getElementById("stage-now-date").innerHTML = "Stage date"; 
    document.getElementById("stage-consult").innerHTML = "Consultant"; 
    document.getElementById("stage-next-date").innerHTML = "Next stage date"; 
    document.getElementById("stage-lawyer").innerHTML = "Lawyer"; 
    document.getElementById("stage-court").innerHTML = "Court"; 
    document.getElementById("stage-by").innerHTML = "Created by"; 
    document.getElementById("stage-hall").innerHTML = "Hall"; 
    document.getElementById("stage-session").innerHTML = "Session type"; 
    document.getElementById("stage-decission").innerHTML = "Decission ar"; 
    document.getElementById("stage-decission-eng").innerHTML = "Decission eng"; 
    document.getElementById("stage-note").innerHTML = "Notes"; 
    document.getElementById("stage-add-btn").innerHTML = "<span class='mdi mdi-plus-box mx-2'></span>Add stage"; 


    
     }
</script>
    
@endsection
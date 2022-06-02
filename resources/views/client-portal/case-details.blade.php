@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-3" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>

@endsection

@section('page-name')
  بيانات الدعاوى 
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-lg-8">
            <form class="form" >
                @csrf
               <div class="card client-card">                               
                  <div class="card-body" >

                  <div class="row">
                  
                   
                    <div class="col-12"> 
                        <div class="form-group row">
                                 
                                   <div class="col-sm-4">
                                      <label id="stage-number">رقم الدعوى</label>
                                      <input class="form-control" disabled  name="case_uid" value="{{$case_details->S_CASE_UID}}" type="text" id="example-text-input">
                                  </div>
                                  
                                  <div class="col-sm-4">
                                     <label  id="stage-file-number">رقم الملف</label>
                                      <input class="form-control" disabled value="{{$case_details->fileID}}"  type="text" id="example-text-input">
                                  </div>

                                   <div class="col-sm-4">
                                     <label id="stage-case-number">رقم القضية</label>
                                     <input  type="hidden" value="{{$case_details->N_CASE_ID}}" name="main_case_id"  type="text" >

                                     <input class="form-control" disabled value="{{$case_details->N_CASE_ID}}" type="text" id="example-text-input">
                                  </div>

                                 
                               

                              </div>
            
                   </div>
                   
                   <div class="col-12"> 
                    <div class="form-group row">
                       <div class="col-6">
                            <label style="font-weight: bold;"  id="stage-client">  الموكل</label>
                       <input type="text" name="" disabled placeholder="{{$case_details->clientName}}" class="form-control" id="">
                        </div>
                        <div class="col-6">
                          <label style="font-weight: bold;"  id="stage-against">  الخصم</label>
                     <input type="text" name="" disabled placeholder="{{$case_details->againstName}}" class="form-control" id="">
                      </div>
                </div>              
            </div>

                   <div class="col-12"> 
                    <div class="form-group row">
                        <div class="col-4"> 
                            <label  id="stage-request-number">  رقم الطلب الالكتروني</label>
                            <input type="text" disabled name="request_number" value="{{$case_details->request_number}}" class="form-control" id="">
                        </div>
                        <div class="col-4"> 
                            <label  id="stage-request-date">  تاريخ الطلب الالكتروني</label>
                            <input type="date" disabled name="request_date" value="{{$case_details->request_date}}" class="form-control" id="">
                        </div>
                </div>              
            </div>
                     <div class="col-12"> 
                        <div class="form-group row">
                                 
                          <div class="col-sm-4">
                            <label  id="stage-client-type"> صفة الموكل</label>
                                 <select class="custom-select" name="client_type" >
                                   <option value="{{$case_details->clientTypeCode}}">{{$case_details->clientTypeName}}</option>
                                 
                                   
                                  </select>
                           </div>
                                  <div class="col-sm-4">
                                   <label  id="stage-stage">مرحلة الدعوى</label>
                                        <select class="custom-select" name="case_stage" >
                                          <option value="{{$case_details->stageCode}}">{{$case_details->stageName}}</option>
                                        
                                        </select>
                                  </div>
                                    <div class="col-sm-4">
                                     <label  id="stage-type">نوع الدعوى</label>
                                        <select class="custom-select" name="case_type" >
                                          <option value="{{$case_details->typeCode}}">{{$case_details->typeName}}</option>
                                        
                                          
                                      </select>
                                  </div>
                               
                                 

                              </div>
            
                   </div>

                   <div class="col-12"> 
                    <div class="form-group row">
                             
                        <div class="col-sm-4">
                                 <label  id="stage-admin">المكلف الاداري</label>
                                    <select class="custom-select" name="lawyer_1" >
                                      <option value="{{$case_details->id_1}}">{{$case_details->name_1}}</option>
                                    
                                      
                                  </select>
                              </div>

                         <div class="col-sm-4">
                                 <label  id="stage-consult">المستشار </label>
                                 <select class="custom-select" name="lawyer_2" >
                                  <option value="{{$case_details->id_2}}">{{$case_details->name_2}}</option>
                                
                                  
                              </select>
                              </div>
                                <div class="col-sm-4">
                                 <label  id="stage-lawyer"> المحامي المترافع   </label>
                                 <select class="custom-select" name="lawyer_3" >
                                  <option value="{{$case_details->id_3}}">{{$case_details->name_3}}</option>
                                
                                  
                              </select>          
                           </div>
                              

                          </div>
        
               </div>
                   
                <div class="col-12"> 
                        <div class="form-group row">
                                 
                            <div class="col-sm-4">
                                     <label  id="stage-court">لدى محكمة</label>
                                        <select class="custom-select" name="court" >
                                          <option value="{{$case_details->courtCode}}">{{$case_details->courtName}}</option>
                                       
                                          
                                      </select>
                                  </div>

                             <div class="col-sm-4">
                                     <label  id="stage-dept">الدائرة</label>
                                        <select class="custom-select" name="dept" >
                                          <option value="{{$case_details->deptCode}}">{{$case_details->deptName}}</option>
                                        
                                      </select>
                                  </div>
                                    <div class="col-sm-4">
                                     <label  id="stage-register-date">تاريخ التسجيل </label>
                                        <input class="form-control" disabled value="{{$case_details->registerDate}}" name="rigster_case_date" type="date" id="example-text-input">
                                  </div>
                                  

                              </div>
            
                   </div>

                    

                   <div class="col-12"> 
                        <div class="form-group row">
                                 
                            <div class="col-sm-4">
                              <label id="stage-expert"></label>
                              <select class="custom-select" name="expert">
                                         <option value="{{$case_details->expertId}}">{{$case_details->expertName}}</option>
                                       
                                      </select>
                                  </div>

                                  <div class="col-sm-4">
                                    <label id="stage-fees"></label>
                                       <input class="form-control" disabled name="fee" value="{{$case_details->S_COURT_FEES}}" type="text" id="example-text-input">
                          </div>
                                  
                                  

                              </div>
            
                   </div>
            
                      <div class="col-12"> 
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label id="stage-info"></label>
                            <textarea class="form-control" disabled  name="subject"  id="message">
                              {{$case_details->S_SUMMARY}}
                            </textarea>
                          </div>
                        </div>
                      </div>
      
                    

                 </div> 
                  </div>
              </div>
            </form>
          </div>
     </div>
@endsection

@section('page-script')

<script>
        if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = '<a href="{{url('client-main-case-cases/'.$case_details->N_CASE_ID)}}">القضية {{$case_details->N_CASE_ID}} </a>'; 
    document.getElementById("breadcrumb-3").innerHTML = "بيانات الدعوى"; 

    document.getElementById("page-name").innerHTML = "بيانات الدعوى";

    document.getElementById("stage-number").innerHTML = "رقم الدعوى ";
    document.getElementById("stage-file-number").innerHTML = "رقم الملف ";
    document.getElementById("stage-case-number").innerHTML = "رقم القضية ";
    document.getElementById("stage-request-number").innerHTML = "رقم الطلب الالكتروني ";
    document.getElementById("stage-request-date").innerHTML = "تاريخ الطلب الالكتروني ";
    document.getElementById("stage-client-type").innerHTML = "صفة الموكل ";
    document.getElementById("stage-stage").innerHTML = "مرحلة الدعوى ";
    document.getElementById("stage-type").innerHTML = "نوع الدعوى ";
    document.getElementById("stage-register-date").innerHTML = "تاريخ التسجيل ";
    document.getElementById("stage-admin").innerHTML = "المكلف الاداري ";
    document.getElementById("stage-consult").innerHTML = "المستشار ";
    document.getElementById("stage-lawyer").innerHTML = "المحامي المترافع ";
    document.getElementById("stage-court").innerHTML = "المحكمة ";
    document.getElementById("stage-dept").innerHTML = "الدائرة ";
    document.getElementById("stage-expert").innerHTML = "مكتب الخبراء ";
    document.getElementById("stage-fees").innerHTML = "رسوم الدعوى ";
    document.getElementById("stage-info").innerHTML = "معلومات الدعوى ";
        }else{
          document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = '<a href="{{url('client-main-case-cases/'.$case_details->N_CASE_ID)}}">case {{$case_details->N_CASE_ID}} </a>' ;
    document.getElementById("breadcrumb-1").innerHTML = "case details" ;


    document.getElementById("page-name").innerHTML = "CASE DETAILS";

    document.getElementById("stage-number").innerHTML = "Stage number ";
    document.getElementById("stage-file-number").innerHTML = "File number";
    document.getElementById("stage-case-number").innerHTML = "Case number ";
    document.getElementById("stage-request-number").innerHTML = "Online request number ";
    document.getElementById("stage-request-date").innerHTML = "Online request date ";
    document.getElementById("stage-client-type").innerHTML = "Client adjective ";
    document.getElementById("stage-stage").innerHTML = "Stage level ";
    document.getElementById("stage-type").innerHTML = "Stage type ";
    document.getElementById("stage-register-date").innerHTML = "Register date ";
    document.getElementById("stage-admin").innerHTML = "Adminstrative charge ";
    document.getElementById("stage-consult").innerHTML = "Consultant ";
    document.getElementById("stage-lawyer").innerHTML = "Lawyer ";
    document.getElementById("stage-court").innerHTML = "Court ";
    document.getElementById("stage-dept").innerHTML = "Departments of jurisdiction  ";
    document.getElementById("stage-expert").innerHTML = "Expert office";
    document.getElementById("stage-fees").innerHTML = "Stage fees ";
    document.getElementById("stage-info").innerHTML = "Stage info. ";
        }
</script>
    
@endsection
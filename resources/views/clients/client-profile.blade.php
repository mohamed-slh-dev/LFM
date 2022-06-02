@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  
@endsection

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom  met-pro-bg">
                <div class="met-profile">
                    <div class="row">
                        <div class="col-lg-4 mb-3 mb-lg-0 align-self-center">
                            <div class="met-profile-main">
                                <div class="met-profile-main-pic">
                  <img src="{{asset('assets/images/clients-imgs/'.$client_details->client_logo)}}" alt="" width="130" height="130" class="rounded-circle">
                     
                                </div>
                                <div class="met-profile_user-detail mr-3">
                                    @if (Session::get('lang') == "ar")
                                    <h5 class="met-user-name"> {{$client_details->S_CLIENT_AR_NAME}} </h5> 
                                    @else
                                    <h5 class="met-user-name"> {{$client_details->S_CLIENT_EG_NAME}} </h5> 

                                    @endif
                                                                                          
                                    <p class="mb-0 met-user-name-post" id="p-type"></p>
                                </div>
                            </div>                                                
                        </div><!--end col-->
                        <div class="col-lg-4 mr-auto">
                            <ul class="list-unstyled personal-detail">
                                <li class=""><b><i class="dripicons-phone mx-2  text-info font-18"></i>  <span id="phone"> </span> </b> : {{$client_details->phone}} </li>
                                <li class="mt-2"><b> <i class="dripicons-mail text-info font-18 mx-2"></i> <span id="email"></span> </b> : {{$client_details->S_Email}} </li>
                                <li class="mt-2"><b> <i class="dripicons-location text-info font-18  mx-2"></i> <span id="address"></span>  </b> : {{$client_details->S_ADDRESS }} </li>
                            </ul>
                            <div class="button-list btn-social-icon"> 
                                <a href="{{$client_details->facebook}}">
                                    <button type="button" class="btn btn-secondary btn-round">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                    </a>                                               
                               
                                    <a href="{{$client_details->twitter}}">
                                        <button type="button" class="btn btn-secondary btn-round ">
                                            <i class="fab fa-twitter"></i>
                                        </button>
                                    </a>
                               

                                    <a href="{{$client_details->linkedin}}">
                                         <button type="button" class="btn btn-secondary btn-round  ">
                                    <i class="fab fa-linkedin"></i>
                                </button>
                                    </a>
                               
                                    <a href="{{$client_details->telegram}}">
                                         <button type="button" class="btn btn-secondary btn-round  ">
                                    <i class="fab fa-telegram"></i>
                                </button>
                                    </a>
                               

                                    <a href="{{$client_details->skype}}">
                                        <button type="button" class="btn btn-secondary btn-round  ">
                                    <i class="fab fa-skype"></i>
                                </button> 
                                    </a>
                               
                                    <a href="{{$client_details->zoom_meetings}}">
                                        <button type="button" class="btn btn-secondary btn-round  ">
                                    <i class="fas fa-video "></i>
                                </button> 
                                    </a>
                               
                                    <a href="{{$client_details->microsoft_team}}">
                                        <button type="button" class="btn btn-secondary btn-round  ">
                                    <i class="fab fa-microsoft"></i>
                                </button> 
                                    </a>
                               
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end f_profile-->                                                                                
            </div><!--end card-body-->
            <div class="card-body">
                <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      
                        <a 
                        @if ($open == 'details')
                        class="nav-link active" 
                        @endif
                        class="nav-link" 
                        id="details-tab" data-toggle="pill" href="#general_detail"></a>
                    </li>
                    <li class="nav-item">
                        <a 
                        @if ($open == 'files')
                        class="nav-link active" 
                        @endif
                        class="nav-link "
                         id="files-tap" data-toggle="pill" href="#files_tap"></a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" id="cases-tap" data-toggle="pill" href="#main_cases_tap"></a>
                    </li>
                  
                    <li class="nav-item">
                        <a class="nav-link" id="license-tap" data-toggle="pill" href="#license"></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="contracts-tap" data-toggle="pill" href="#contracts"></a>
                    </li>
                </ul>        
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->

<div class="row">
    <div class="col-12">
        <div class="tab-content detail-list" id="pills-tabContent">
            <div 
            @if ($open == 'details')
            class="tab-pane fade show active"
            @endif
            class="tab-pane fade"
             id="general_detail">
                <form class="form" action=" {{ url('update-client-details/'.$client_details->N_CLIENT_ID) }}"method="POST" enctype="multipart/form-data" >
                    @csrf
                <div class="row">
                 

                <div class="col-lg-6">

                <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2  mt-2" id="name-ar"></label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="name_ar" type="text" value=" {{$client_details->S_CLIENT_AR_NAME }} " id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2  mt-2" id="name-eng"></label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="name_eng" value="{{$client_details->S_CLIENT_EG_NAME }}" type="text" id="example-text-input">
                                </div>
                            </div>
                        
                    
                 </div>
          
                 <div class="col-lg-3">
                </div>
           <div class="col-lg-3">
               <div class="form-group row">
               <input type="file" name="logo" id="input-file-now-custom-1" class="dropify" data-default-file="{{asset('assets/images/clients-imgs/'.$client_details->client_logo)}}"/>
               </div>
           </div>

            <div class="col-12"> <hr></div>
           
              <div class="col-lg-6 mb-5">
                  <div class="form-group row">
                              <label class="col-sm-2  mt-2" id="branch"></label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="branch">
                                    <option selected value="{{$client_details->branchCode}}">{{$client_details->branchName}}</option>
                                    @foreach ($branchs as $branch)
                                    <option value="{{$branch->N_DetailedCode}}">{{$branch->S_Desc_A}}</option>  
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2  mt-2" id="mail-box"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="mb_number" type="text" value="{{$client_details->S_MB}}" id="example-number-input">
                            </div>
                        </div>
                          <div class="form-group row">
                              <label class="col-sm-2  mt-2" id="nation"></label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="nation">
                                <option value="{{$client_details->nationCode   }}">{{$client_details->nationName}}</option>
                                @foreach ($nationality as $nation)
                                <option value="{{$nation->N_DetailedCode}}">{{$nation->S_Desc_A}}</option>  
                                @endforeach
                                    
                                </select>
                            </div>
                        </div>
                          <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2   mt-2" id="address-label"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="address" type="text" value="{{$client_details->S_ADDRESS}}" id="example-number-input">
                            </div>
                        </div>
                          <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2   mt-2" id="ssn"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="ssn" type="text" value="{{$client_details->ssn}}" id="example-number-input">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2  mt-2 " id="fb"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="facebook" type="text" value="{{$client_details->facebook}}" id="example-number-input">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 mt-2 " id="twitter"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="twitter" type="text" value="{{$client_details->twitter}}" id="example-number-input">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2  mt-2 " id="linkedin"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="linkedin" type="text" value="{{$client_details->linkedin}}" id="example-number-input">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2  mt-2 " id="skype"> </label>
                            <div class="col-sm-10">
                                <input class="form-control" name="skype" type="text" value="{{$client_details->skype}}" id="example-number-input">
                            </div>
                        </div>
                 </div>

              <div class="col-lg-6 mb-5">
                  <div class="form-group row">
                            <label for="example-date-input" class="col-sm-2  mt-2" id="phone-label"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="phone" value="{{$client_details->phone}}" type="text" >
                            </div>
                        </div>
                          
                        <div class="form-group row">
                            <label for="example-date-input" class="col-sm-2   mt-2" id="fax"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="fax" value="{{$client_details->S_FAX}} " type="text" >
                            </div>
                        </div>  

                          <div class="form-group row">
                            <label for="example-date-input" class="col-sm-2  mt-2" id="p-mail"> </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                            <input type="email" id="example-input2-group1" name="email" class="form-control" value="{{$client_details->S_Email}}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="far fa-envelope"></i></span>
                            </div>
                        </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-date-input" class="col-sm-2  mt-2" id="s-mail">  </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                            <input type="email" id="example-input2-group1" name="email2" class="form-control" value="{{$client_details->S_Email2}}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="far fa-envelope"></i></span>
                            </div>
                        </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2  mt-2" id="ship-address"> </label>
                            <div class="col-sm-10">
                                <input class="form-control" name="sh_address" type="text" value="{{$client_details->shipping_address}}" id="example-number-input">
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 mt-2 " id="telegram"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="telegram" type="text" value="{{$client_details->telegram}}" id="example-number-input">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2  mt-2" id="microsoft"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="microsoft" type="text" value="{{$client_details->microsoft_team}}" id="example-number-input">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2  mt-2" id="zoom"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="zoom" type="text" value="{{$client_details->zoom_meetings}}" id="example-number-input">
                            </div>
                        </div>

                      

                      

                      
                            
                            </div> 
                            <div class="col-lg-12 text-center">
                            <button class="btn btn-success" id="save-btn">حفظ</button>
                            </div> 
                        </div>   
                </form>    
                
                <div class="col-12 mt-4"> <hr> </div>
                <div class="col-12 pt-4" style="border: 1px solid #b5b5b5;">
                    <form class="form" action=" {{ url('update-client-password/'.$client_details->N_CLIENT_ID) }}"method="POST" >
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="example-date-input" class="col-3 mt-2" id="update-pass"> </label>
                                        <div class="col-8">
                                            <input class="form-control" name="password"  type="password" >
                                        </div>
                                    </div> 
            
                                </div>
                                <div class="col-6 ">
                                    <button class="btn btn-success" id="update-pass-btn"></button>
                                    </div> 
                            </div>
                         
                        
                        </form>
                        </div> 
</div><!--end general detail-->

<div 
@if ($open == 'files')
class="tab-pane fade show active"
@endif
class="tab-pane fade "
 id="files_tap">                 
  <div class="row">
        <div class="col-lg-6 ">
        <div class="">
            <ul class="list-inline pr-0">                                    
               
                <li class="list-inline-item">

                <button type="button" class="btn btn-primary waves-effect waves-light float-right mb-3" data-toggle="modal" data-animation="bounce" data-target=".add-file" id="add-new-file"></button>

                </li>
            </ul>
        </div>
     </div>
        <div class="col-lg-6 ">
            <div class=" text-center">
                <ul class="list-inline pr-0">                                    
                   
                    <li class="list-inline-item">
    
                        <h4> <span id="files-count"></span> : {{$files_count}} </h4>
                    </li>

                </ul>
            </div>
    </div><!--end col-->
    

    <div class="col-lg-12">

        <div class="card client-card"> 
            <form class="form"  method="POST" action="{{route('search-files')}}">
                @csrf                           
           <div class="card-body text-center" >
                 <div class="row">
                 <div class="col-10">
                    <div class="row">
            

                <div class="col-3  ">
                    <div class="form-group row">
                  <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="file-num-search"></label>
                  <div class="col-sm-8">
                    <input class="form-control " name="file_num" value=" " type="text" id="example-text-input">

                  </div>
              </div>
                     
       </div>

                <div class="col-3  ">
                             <div class="form-group row">
                           <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="client-name-search"></label>
                           <div class="col-sm-8">
                             <select class="custom-select text-center" name="client">
                              
                                <option value="{{$client_details->N_CLIENT_ID}}">{{$client_details->S_CLIENT_AR_NAME}}</option>
                               
                              </select>
                           </div>
                       </div>
                              
                </div>
                 
                
            <div class="col-1">
             <button class="btn btn-success waves-effect waves-light mr-3" id="files-search-btn"> </button>
            </div>
                </div>
                 </div>
               

                           
                          
                        
                </div>

          </div>
            </form>
       </div>      
    </div>

             
    @foreach ($client_files as $file)
      
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body py-1 ">                                        
                <div class=" d-flex justify-content-end">                                        
                    <div class="dropdown d-inline-block">
                     <a class="nav-link dropdown-toggle arrow-none" id="dLabel1" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                         <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                     </a>
                        <div class="dropdown-menu text-center" aria-labelledby="dLabel3">
                            @if (Session::get('lang') == "ar")
                            <a data-toggle="modal" data-animation="bounce" data-target=".edit-file-{{$file->id}}" class="dropdown-item" href="#">تعديل</a>
                            <a class="dropdown-item" href="#">حذف</a>
                            @else 
                            <a data-toggle="modal" data-animation="bounce" data-target=".edit-file-{{$file->id}}" class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a> 
                            @endif
                          
                        </div>
                    </div>
                </div> 
                <div class="text-center project-card" style="margin-top: -40px;">
                    <img src="{{asset('assets/images/clients-imgs/'.$file->client_logo)}}" alt="" height="80" class="mx-auto d-block mb-0"> 
                   <br>
                   <span class="badge badge-soft-purple font-11">{{$file->branchName}}</span>
                   @if (Session::get('lang') == "ar")
                   <p class="text-muted mb-2 mt-3"><span class="text-secondary font-14" id="file-info"><b>بيانات الملف </b></span> : {{$file->more_info}}
                   </p>
                   @else
                   <p class="text-muted mb-2 mt-3"><span class="text-secondary font-14" id="file-info">File info.<b> </b></span> : {{$file->more_info}}
                   </p>
                    @endif
                  
                    
                     <h4 class="project-title mb-0" >   {{$file->file_id}} </h4>
                     <form action="{{route('file-case')}}" method="post">
                         @csrf
                         <input type="hidden" name="file_id" value="{{$file->file_id}}">
                         @if (Session::get('lang') == "ar")
                         <button class="btn btn-outline-secondary waves-effect waves-light my-3" type="submit" >عرض</button>
  
                         @else
                         <button class="btn btn-outline-secondary waves-effect waves-light my-3" type="submit" >View case</button>

                         @endif
       
                       </form>                 

                    <p class="text-muted mb-0"> {{$file->create_date}} </p>
                        
                </div>                                                                      
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
    @endforeach


    </div><!--end row--> 
    <div class="float-left mt-4">
        {{ $client_files->links() }}
        
        </div>
</div><!--end education detail-->
<!-- ///////////////////////////////////////////////////////////////////////////////// -->

<div class="tab-pane fade" id="main_cases_tap">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="">
                    <ul class="list-inline pr-0">                                    
                       
                       <li class="list-inline-item">
        
                            <h4> <span id="cases-num"></span> : {{$main_cases_count}} </h4>
                        </li>
                    </ul>
                </div>
        </div><!--end col-->
   
          
  


                   
@foreach ($client_cases as $mc)
    
<div class="col-lg-4">
    <div class="card">
        <div class="card-body pb-0">  
        <div style="display: ruby; " class="row">  
        <div class="col-6">
            @if (Session::get('lang') == "ar")
            <h5 class="text-muted"> <span id="case-file-number">رقم الملف</span> : {{$mc->S_CASE_FILE_NUM }} </h5>
            @else
            <h5 class="text-muted"> <span id="case-file-number">File number</span> : {{$mc->S_CASE_FILE_NUM }} </h5>
            @endif
        </div>                            
            <div class=" d-flex justify-content-end col-6">                                        
                <div class="dropdown d-inline-block">
                    <a class="nav-link dropdown-toggle arrow-none" id="dLabel3" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                    </a>
                    <div class="dropdown-menu text-center" aria-labelledby="dLabel3">
                        @if (Session::get('lang') == "ar")
                        <a data-toggle="modal" data-animation="bounce" data-target=".edit-main-case-{{$mc->N_CASE_ID}}" class="dropdown-item" href="#">تعديل</a>
                        <a class="dropdown-item text-danger" href="{{url('close-case/'.$mc->N_CASE_ID)}}">اغلاق القضية</a>
                    
                   @else 
                   <a data-toggle="modal" data-animation="bounce" data-target=".edit-main-case-{{$mc->N_CASE_ID}}" class="dropdown-item" href="#">edit</a>
                   <a class="dropdown-item text-danger" href="{{url('close-case/'.$mc->N_CASE_ID)}}"> close case</a>
               
                   @endif
                       </div>
                </div>
            </div> 
        </div>
            <div class="text-center project-card" style="margin-top: -50px;">
              <img src="{{asset('assets/images/case-img.png')}}" alt="" height="90" class="mx-auto d-block" style="margin-top: 25px;padding-right: 15px;"> 
               <br>
  
               @if (Session::get('lang') == "ar")
               <h4 class="" style="margin-top: -25px;"> <span> رقم القضية </span>  : {{$mc->N_CASE_ID}}</h4>
                 
               <br>
               <p class="text-muted mb-2 mt-1"><span class="text-secondary font-14" id="card-case-subject"><b> موضوع القضية</b></span> : {{$mc->S_CASE_SUBJECT}}
               </p>

               <p class="text-muted mb-2 mt-1"><span class="text-info font-12" id="card-case-amount"><b>  قيمة المطالبة</b></span> : {{$mc->N_PaymentValue}}
               </p>

               <a href="{{url('main-case-cases/'.$mc->N_CASE_ID)}}"><button class="btn btn-outline-secondary waves-effect my-3" id="card-case-view">عرض القضية</button></a>

                <a href="#"> <button class="btn btn-outline-info waves-effect waves-light mr-3" type="submit" id="card-case-report" > تقرير القضية</button></a>
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
               <h4 class="" style="margin-top: -25px;"> <span> Case number </span>  : {{$mc->N_CASE_ID}}</h4>
                 
               <br>
               <p class="text-muted mb-2 mt-1"><span class="text-secondary font-14" id="card-case-subject"><b> Case subject</b></span> : {{$mc->S_CASE_SUBJECT}}
               </p>

               <p class="text-muted mb-2 mt-1"><span class="text-info font-12" id="card-case-amount"><b>Cliam amont</b></span> : {{$mc->N_PaymentValue}}
               </p>

               <a href="{{url('main-case-cases/'.$mc->N_CASE_ID)}}"><button class="btn btn-outline-secondary waves-effect my-3" id="card-case-view">View case</button></a>

                <a href="#"> <button class="btn btn-outline-info waves-effect waves-light mr-3" type="submit" id="card-case-report" >Case report</button></a>
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

    </div><!--end row-->
    <div class="float-left mt-4">
        {{ $client_cases->links() }}
        
        </div>
</div><!--end portfolio detail-->
<!-- //////////////////////////////////////////////////////////////////////////// -->                       
         <div class="tab-pane fade" id="license">
               <div class="row">                        
           
                @foreach ($identities as $identity)
                 <div class="col-lg-3">
                   <div class="card e-co-product">
                       <a href="">  
                       <img src="{{asset('assets/clients-identities/'.$identity->identity)}}" alt="" class="img-fluid">
                       </a>                                    
                       <div class="card-body product-info">
                           <a href="" class="product-title" style="font-weight: bold">{{$identity->identity_name}}</a>
                           <div class="d-flex justify-content-between my-2">
                            @if (Session::get('lang') == "ar")
                            <p > تاريخ الاصدار :  <span class=" text-muted">{{$identity->start_date}}</span> </p>
                            <p > تاريخ الانتهاء :  <span class=" text-muted">{{$identity->end_date}}</span> </p>
                        
                               @else
                               <p >Release date :  <span class=" text-muted">{{$identity->start_date}}</span> </p>
                               <p > End date :  <span class=" text-muted">{{$identity->end_date}}</span> </p>
                           
                               @endif
                               </div>
                               @if (Session::get('lang') == "ar")
                               <button class="btn btn-cart btn-sm waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".add_ident_{{$identity->id}}"><i class="mdi mdi-attachment ml-1"></i>اضافة اثبات</button>
  
                               @else
                               <button class="btn btn-cart btn-sm waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".add_ident_{{$identity->id}}"><i class="mdi mdi-attachment mr-1"></i>Add identity</button>
 
                               @endif
                          </div><!--end card-body-->
                   </div><!--end card-->
               </div><!--end col-->
               @endforeach
            </div><!--end row-->
            </div><!--end settings detail-->
            
@foreach ($identities as $ident)
    
<div class="modal fade add_ident_{{$ident->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-identity')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ident_id" value="{{$ident->id}}">
              <div class="row">
                   <div class="col-12"> 
                      <div class="form-group row">
                               
                        
                                 <div class="col-sm-6">
                                  <label for="noe_date" class="identity-doc"></label>
                                  <input type="file" required name="image" class="form-control" id="">
                                </div>
                            </div>
                         </div>

                         <div class="col-12"> 
                           <div class="form-group row">
                                    
                             
                                      <div class="col-sm-6">
                                       <label for="noe_date" class="identity-start"></label>
                                       <input type="date" required name="start_date" class="form-control" id="">
                                     </div>

                                     <div class="col-sm-6">
                                       <label for="noe_date" class="identity-end"></label>
                                       <input type="date" required name="end_date" class="form-control" id="">
                                     </div>
                                 </div>
                              </div>

                        <div class="col-12">
                                <button class="btn btn-sm btn-primary mr-1 font-15 identity-add" ></button>
                            </div> 
                  

                     </div>
                </form> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
@endforeach

 <div class="tab-pane fade" id="contracts">
       <div class="row">  
        <div class="col-lg-3 mb-3">
               
            <div class="form-group  mb-0">
               
                <button type="button" class="btn btn-primary waves-effect waves-light mb-0 " data-toggle="modal" data-animation="bounce" data-target=".new-contract" id="add-contract-btn"></button>

            </div>

           
       
          </div>
                  <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="mt-0 header-title" id="contract-tbl-title"></h4>
                            <p class="text-muted mb-3">
                            </p>

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 table-centered">
                                    <thead>
                                    <tr>
                                        
                    <th id="tbl-1"></th>
                    <th id="tbl-2"></th>
                    <th id="tbl-3"></th>
                    <th id="tbl-4"></th>
                    <th id="tbl-5"></th>
                    <th id="tbl-6" class="text-center"></th>
                    <th id="tbl-7" class="text-center"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                  @foreach ($contracts as $cont)
                                 <tr>
                                 <td>{{$cont->contract_name}}</td>
                                    <td>{{$cont->contractType}}</td>
                                    <td>{{$cont->amount}}</td>
                                    <td>{{$cont->start_date}}</td>
                                    <td>{{$cont->end_date}}</td>
                                    <td class="text-center">
                                        @if ($cont->document)
                                        <a href="{{asset('assets/clients-contracts/'.$cont->document)}}" class="download-icon-link" download>
                                            <i class="dripicons-download file-download-icon font-16"></i> 
                                                </a>
                                            @else 
                                            <a> </a>
                                        @endif
                                        
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('delete-contract/'.$cont->id)}}" class="ml-3"><i class="fas fa-trash text-danger font-16"></i></a>
                                     </td>
                                 </tr>
                                            
                                 @endforeach    
                                    </tbody>
                                </table><!--end /table-->
                            </div><!--end /tableresponsive-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
                                            
        </div>
            </div><!--end settings detail-->
       
        
  
</div><!--end row-->

<div class="modal fade new-contract" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close " data-dismiss="modal" aria-hidden="true">×</button>
 
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-contract-admin')}}" enctype="multipart/form-data">
                    @csrf
                   
              <div class="row">
              <input type="hidden" name="client_id" value="{{$client_id}}">
                
                   <div class="col-12"> 
                      <div class="form-group row">
                               
                                <div class="col-4">
                                 <label style="font-weight: bold;" class="mb-3" id="add-contract-name"></label>
                                 <input class="form-control" type="text" name="name" id="example-text-input">
 
                                </div>
                                <div class="col-4">
                                    <label style="font-weight: bold;" class="mb-3" id="add-contract-type"></label>
                                    <select name="type" id=""class="form-control" >
                                        @foreach ($contract_type as $cont_type)
                                        <option value="{{$cont_type->N_DetailedCode}}">{{$cont_type->S_Desc_A}}</option>  
                                        @endforeach
                                    </select>
                                   </div>
                                   <div class="col-4">
                                    <label style="font-weight: bold;" class="mb-3" id="add-contract-doc"></label>
                                    <input class="form-control" type="file" name="doc" id="example-text-input">
    
                                   </div>
                            </div>
          
                 </div>
                 <div class="col-12"> 
                    <div class="form-group row">
                             
                              <div class="col-4">
                               <label style="font-weight: bold;" class="mb-3" id="add-contract-amount"></label>
                               <input class="form-control" type="number" name="amount" id="example-text-input">

                              </div>
                              <div class="col-4">
                                  <label style="font-weight: bold;" class="mb-3" id="add-contract-start"></label>
                                  <input class="form-control" type="date" name="start" id="example-text-input">
  
                                 </div>
                                 <div class="col-4">
                                    <label style="font-weight: bold;" class="mb-3" id="add-contract-end"></label>
                                    <input class="form-control" type="date" name="end" id="example-text-input">
    
                                   </div>
                          </div>
        
               </div>
                 
                 <div class="col-12"> 
                    <div class="form-group row">
                             
                              <div class="col-12">
                               <label style="font-weight: bold;" class="mb-3" id="add-contract-subject"></label>
                               <textarea class="form-control" name="subject" rows="3" id="message"></textarea>

                              </div>
                          </div>
        
               </div>

               <div class="col-12"> <hr> </div>


                 <div class="col-12"> 
                    <div class="form-group row">
                      <div class="col-sm-4">
                          <label style="font-weight: bold;" class="mb-3" id="add-contract-country"> </label>
                          <input class="form-control" name="country" type="text" id="example-text-input">
                      </div>
                      <div class="col-sm-4">
                          <label style="font-weight: bold;" class="mb-3" id="add-contract-city"></label>
                          <input class="form-control" type="text" name="city" id="example-text-input">

                       </div>

                       <div class="col-sm-4">
                        <label style="font-weight: bold;" class="mb-3" id="add-contract-state"></label>
                        <input class="form-control" type="text" name="state" id="example-text-input">

                     </div>
                     
                              
                    </div>
                  </div>
                   
                  <div class="col-12"> 
                    <div class="form-group row">
                      <div class="col-sm-4">
                          <label style="font-weight: bold;" class="mb-3" id="add-contract-address"> </label>
                          <input class="form-control" name="address" type="text" id="example-text-input">
                      </div>
                      <div class="col-sm-4">
                          <label style="font-weight: bold;" class="mb-3" id="add-contract-phone"></label>
                          <input class="form-control" type="text" name="phone" id="example-text-input">

                       </div>

                       <div class="col-sm-4">
                        <label style="font-weight: bold;" class="mb-3" id="add-contract-notes"></label>
                        <input class="form-control" type="text" name="notes" id="example-text-input">

                     </div>
                     
                              
                    </div>
                  </div>
                 


                     <div class="col-12"> 
                    
                         <button class="btn btn-sm btn-primary mr-1 font-15" id="add-contract-add-btn"> </button>
                 </div> 
                  

                    </div>
                </form> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 



<div class="modal fade add-file" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
             <form class="form"  method="POST" action="{{route('add-file')}}">
               @csrf
              <div class="row">
                <div class="col-12"> 
                    <div class="col-sm-2">
                        <label for="noe_date" id="new-file-file-num"></label>
                        <input class="form-control " name="next_id" value=" {{$next_file_id + 1}} " type="hidden" >

                    <input class="form-control " disabled value=" {{$next_file_id + 1}} " type="text" >
                  </div>
                  <hr>
                </div>
                
              <div class="col-12"> 
                      <div class="form-group row">
                               
                                <div class="col-sm-4">
                                 <label id="new-file-client"></label>
                                  <select class="custom-select" name="client">
                                     
                               <option value="{{$client_details->N_CLIENT_ID}}">{{$client_details->S_CLIENT_AR_NAME}}</option>
                                         
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label for="noe_date" id="new-file-by"></label>
                                <input class="form-control " disabled value="{{ auth()->user()->name }}" type="text" id="example-text-input">
                              </div>
                               <div class="col-sm-4">
                                    <label for="noe_date" id="new-file-date"></label>
                             <input class="form-control" type="date" value="" disabled id="todayDate">
                              </div>
                               
                              
                             

                            </div>
          
                 </div>
               

                  <div class="col-12"> 
                      <div class="form-group row">
                               
                         
                                 <div class="col-sm-6">
                                  <label for="noe_date" id="new-file-branch"></label>
                                     <select class="custom-select" name="branch">
                                        @foreach ($branchs as $branch)
                                            <option value="{{$branch->N_DetailedCode}}">{{$branch->S_Desc_A}}</option>  
                                            @endforeach
                                    </select>
                                </div>

                                  <div class="col-sm-6">
                                  <label id="new-file-fees"></label>
                                  <input class="form-control" name="fee" type="number" id="example-text-input">
                                </div>
                                
                                 
                             

                            </div>
          
                 </div>
                  

                  <div class="col-12"> 
                  <label for="noe_date" id="new-file-info"></label>
                   <textarea class="form-control" name="more_info" rows="5" id="message"></textarea>
                  </div>

                     <div class="col-12 mt-3"> 
                    
          <button class="btn btn-sm btn-primary mr-1 font-15" id="new-file-btn"></button>
                 </div> 
                  

                </div> 
             </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
    
@foreach ($client_cases as $mc)
<div class="modal fade edit-main-case-{{$mc->N_CASE_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('update-main-case')}}">
                        @csrf
                <div class="row">
                    

          
               

                    <input type="hidden" name="main_case_id" id="" value="{{$mc->N_CASE_ID}}">

                
                    @if (Session::get('lang') == "ar")
                    <div class="col-12"> 
                        <div class="form-group row">
                                 
                            <div class="col-6">
                                <label id="edit-case-branch"> فرع المكتب </label>
                                <select  class="custom-select" name="branch">
                                    <option value="{{$mc->branchCode}}">{{$mc->branchName}}</option>  

                                    @foreach ($branchs as $branchh)
                                    <option value="{{$branchh->N_DetailedCode}}">{{$branchh->S_Desc_A}}</option>  
                                    @endforeach
                                </select>        
                              </div>
                              <div class="col-6">
                                <label id="edit-case-status">حالة القضية</label>
                                <select  class="custom-select" name="case_status">
                                    <option value="{{$mc->caseStatusCode}}">{{$mc->caseStatusName}}</option>  
                                    @foreach ($case_status as $cs)
                                    <option value="{{$cs->N_DetailedCode}}">{{$cs->S_Desc_A}}</option>  
                                    @endforeach
                                </select>        
                              </div>

                                 

                                
                            </div>
                    </div> 
                    
                    <div class="col-12"> 
                        <div class="form-group row">
                            <div class="col-6">
                                <label id="edit-case-assign"> المكلف الاداري</label>
                                <select  class="custom-select" name="assignTo">
                                    <option value="{{$mc->assignId}}">{{$mc->assignName}}</option>  
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} </option>
                                        
                                    @endforeach
                                </select>        
                              </div>
                              <div class="col-6">
                                <label id="edit-case-consult"> المستشار </label>
                                <select  class="custom-select" name="consult">
                                    <option value="{{$mc->consultId}}">{{$mc->consultName}}</option>  
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} </option>
                                        
                                    @endforeach
                                </select>        
                              </div>
                        </div>
                    </div>
                    <div class="col-12"> 
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="noe_date" id="edit-case-subject"> موضوع القضية</label>
                                <textarea class="form-control"  name="subject" rows="5" id="message"> {{$mc->S_CASE_SUBJECT}}</textarea>
                               </div>
                        </div>
                    </div>

                 
                       
                           
                       

                      </div>
                      <button class="btn btn-primary my-4" type="submit" id="edit-case-btn">تحديث </button>
           </div>
                    @else
                    <div class="col-12"> 
                        <div class="form-group row">
                                 
                            <div class="col-6">
                                <label id="edit-case-branch">Office branch </label>
                                <select  class="custom-select" name="branch">
                                    <option value="{{$mc->branchCode}}">{{$mc->branchName}}</option>  

                                    @foreach ($branchs as $branchh)
                                    <option value="{{$branchh->N_DetailedCode}}">{{$branchh->S_Desc_A}}</option>  
                                    @endforeach
                                </select>        
                              </div>
                              <div class="col-6">
                                <label id="edit-case-status">Case status</label>
                                <select  class="custom-select" name="case_status">
                                    <option value="{{$mc->caseStatusCode}}">{{$mc->caseStatusName}}</option>  
                                    @foreach ($case_status as $cs)
                                    <option value="{{$cs->N_DetailedCode}}">{{$cs->S_Desc_A}}</option>  
                                    @endforeach
                                </select>        
                              </div>

                                 

                                
                            </div>
                    </div> 
                    
                    <div class="col-12"> 
                        <div class="form-group row">
                            <div class="col-6">
                                <label id="edit-case-assign"> Adminstrarive charge </label>
                                <select  class="custom-select" name="assignTo">
                                    <option value="{{$mc->assignId}}">{{$mc->assignName}}</option>  
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} </option>
                                        
                                    @endforeach
                                </select>        
                              </div>
                              <div class="col-6">
                                <label id="edit-case-consult">Consultant </label>
                                <select  class="custom-select" name="consult">
                                    <option value="{{$mc->consultId}}">{{$mc->consultName}}</option>  
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} </option>
                                        
                                    @endforeach
                                </select>        
                              </div>
                        </div>
                    </div>
                    <div class="col-12"> 
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="noe_date" id="edit-case-subject">Case subject </label>
                                <textarea class="form-control"  name="subject" rows="5" id="message"> {{$mc->S_CASE_SUBJECT}}</textarea>
                               </div>
                        </div>
                    </div>

                 
                       
                           
                       

                      </div>
                      <button class="btn btn-primary my-4" type="submit" id="edit-case-btn">Update </button>
                     </div>
                        
                    @endif
                
                     </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  
        
    @endforeach

       
    @foreach ($client_files as $file)
<div class="modal fade edit-file-{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('update-file')}}">
                        @csrf
                <div class="row">
                    

          
               

                    <input type="hidden" name="file_id" id="" value="{{$file->id}}">
                    <input type="hidden" name="file_idd" id="" value="{{$file->file_id}}">

                
                    
                
                    <div class="col-12"> 
                        <div class="form-group row">
                                 
                           
                                   <div class="col-6">
                                    <label class="edit-file-branch"></label>
                                    <select class="custom-select" name="branch">
                                        <option value="{{$file->branchCode}}">{{$file->branchName}}</option>  

                                        @foreach ($branchs as $branch)
                                        <option value="{{$branch->N_DetailedCode}}">{{$branch->S_Desc_A}}</option>  
                                        @endforeach
                                    </select>        
                                  </div>

                                    <div class="col-6">
                                        <label class="edit-file-fees"></label>
                                        <input type="number" class="form-control" value="{{$file->office_fee}}" name="fee" >
                                   
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="noe_date" class="edit-file-info"></label>
                                    <textarea class="form-control"  name="more_info" rows="5" id="message"> {{$file->more_info}}</textarea>
                                   </div>
                            </div>
                               
                                   
                               

                              </div>
            
                   </div>
                    

                      

                                 <button class="btn btn-primary my-4 edit-file-btn" type="submit"> </button>
                                                    
                         </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  
        
    @endforeach

@endsection

@section('page-script')

<script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.profile.init.js')}}"></script>

<script src="{{asset('assets/plugins/filter/isotope.pkgd.min.js')}}"></script>

<script src="{{asset('assets/plugins/filter/masonry.pkgd.min.js')}}"></script>
<script src="{{asset('assets/plugins/filter/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.gallery.inity.js')}}"></script>

<script>
    if (lang == "ar") {
document.body.style.direction = "rtl"; 
document.body.style.textAlign = "right"; 

document.getElementById("breadcrumb-float").classList.add('float-left');
document.getElementById("breadcrumb-1").innerHTML = "العملاء"; 
document.getElementById("breadcrumb-2").innerHTML = "تفاصيل العميل"; 

document.getElementById("page-name").innerHTML = "تفاصيل العميل";

document.getElementById("p-type").innerHTML = "عميل";

document.getElementById("phone").innerHTML = "  رقم الهاتف";
document.getElementById("email").innerHTML = " البريد الالكتروني ";
document.getElementById("address").innerHTML = " العنوان";


document.getElementById("details-tab").innerHTML = " البانات الشخصية";
document.getElementById("files-tap").innerHTML = "الملفات";
document.getElementById("cases-tap").innerHTML = "القضايا";
document.getElementById("license-tap").innerHTML = "الهوية و رخص العمل";
document.getElementById("contracts-tap").innerHTML = "العقود و التوكيلات";

document.getElementById("name-ar").innerHTML = "اسم عربي";
 document.getElementById("name-eng").innerHTML = " اسم انجليزي";
 document.getElementById("branch").innerHTML = "الفرع";
 document.getElementById("mail-box").innerHTML = "صندوق البريد";
 document.getElementById("nation").innerHTML = "الجنسية";

 document.getElementById("p-mail").innerHTML = "البريد الالكتروني";
 document.getElementById("s-mail").innerHTML = "بريد النظام";
 document.getElementById("phone-label").innerHTML = "رقم الهاتف";
 document.getElementById("fax").innerHTML = "فاكس";
 document.getElementById("ssn").innerHTML = "رقم الإثبات / رقم الرخصة";
 document.getElementById("address-label").innerHTML = "العنوان";

 document.getElementById("ship-address").innerHTML = "عنوان الشحن";
 document.getElementById("fb").innerHTML = "فيسبوك";
 document.getElementById("twitter").innerHTML = "تويتر";
 document.getElementById("telegram").innerHTML = "تيليقرام";
 document.getElementById("skype").innerHTML = "سكايب";
 document.getElementById("microsoft").innerHTML = " اجتماعات مايكروسوفت ";
 document.getElementById("zoom").innerHTML ="زووم";
 document.getElementById("linkedin").innerHTML = "لينكدان";

 document.getElementById("save-btn").innerHTML = "حفظ";
 document.getElementById("update-pass-btn").innerHTML = "تحديث";
 document.getElementById("update-pass").innerHTML = "كلمة المرور الجديدة";


 document.getElementById("add-new-file").innerHTML =' <i class="mdi mdi-plus-box ml-2"></i> إضافة ملف جديد';  
 document.getElementById("file-num-search").innerHTML = "رقم الملف";
 document.getElementById("client-name-search").innerHTML = "اسم العميل";
 document.getElementById("files-search-btn").innerHTML = "بحث";  
 document.getElementById("files-count").innerHTML = " عدد الملفات";  


 


 var timestampArray = document.getElementsByClassName("edit-file-branch");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'الفرع';
  
}var timestampArray = document.getElementsByClassName("edit-file-info");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'بيانات الملف';
  
}var timestampArray = document.getElementsByClassName("edit-file-fees");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'رسوم المكتب';
  
}var timestampArray = document.getElementsByClassName("edit-file-btn");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تحديث الملف';
  
}

 document.getElementById("new-file-branch").innerHTML = "الفرع"; 
 document.getElementById("new-file-file-num").innerHTML = "رقم الملف";  
 document.getElementById("new-file-client").innerHTML = "اسم العميل";  
 document.getElementById("new-file-by").innerHTML = "بواسطة"; 
 document.getElementById("new-file-date").innerHTML = "تاريخ الانشاء";    
 document.getElementById("new-file-info").innerHTML = "بيانات الملف"; 
 document.getElementById("new-file-fees").innerHTML = "رسوم المكتب";  
 document.getElementById("new-file-btn").innerHTML = "اضافة ملف"; 


 document.getElementById("cases-num").innerHTML = "عدد القضايا"; 







 var timestampArray = document.getElementsByClassName("identity-doc");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'اثبات الهوية (صورة)';
  
}
var timestampArray = document.getElementsByClassName("identity-start");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تاريخ الاصدار';
  
}
var timestampArray = document.getElementsByClassName("identity-end");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تاريخ الانتهاء';
  
}
var timestampArray = document.getElementsByClassName("identity-add");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تحميل';
  
}

document.getElementById("add-contract-btn").innerHTML = '<i class="mdi mdi-plus-box ml-2"></i> إضافة  عقد'; 

document.getElementById("contract-tbl-title").innerHTML = 'جميع العقود و التوكيلات'; 

document.getElementById("tbl-1").innerHTML = "الموضوع"; 
document.getElementById("tbl-2").innerHTML = "نوع العقد"; 
document.getElementById("tbl-3").innerHTML = "المبلغ"; 
document.getElementById("tbl-4").innerHTML = "تاريخ البداية"; 
document.getElementById("tbl-5").innerHTML = "تاريخ الانتهاء"; 
document.getElementById("tbl-6").innerHTML = "المستند"; 
document.getElementById("tbl-7").innerHTML = "حذف"; 

document.getElementById("add-contract-name").innerHTML = "اسم العقد"; 
document.getElementById("add-contract-type").innerHTML = "نوع العقد"; 
document.getElementById("add-contract-doc").innerHTML = "مستند العقد"; 
document.getElementById("add-contract-amount").innerHTML = "المبلغ"; 
document.getElementById("add-contract-start").innerHTML = "تاريخ البداية"; 
document.getElementById("add-contract-end").innerHTML = "تاريخ الانتهاء"; 
document.getElementById("add-contract-subject").innerHTML = "الموضوع"; 
document.getElementById("add-contract-country").innerHTML = "البلد"; 
document.getElementById("add-contract-city").innerHTML = "المدينة"; 
document.getElementById("add-contract-state").innerHTML = "الولاية"; 
document.getElementById("add-contract-address").innerHTML = "العنوان"; 
document.getElementById("add-contract-phone").innerHTML = "رقم الهاتف"; 
document.getElementById("add-contract-notes").innerHTML = "ملاحظات"; 
document.getElementById("add-contract-add-btn").innerHTML = "اضافة"; 




    }else{
        document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "clients";
document.getElementById("breadcrumb-1").innerHTML = "clients details";

document.getElementById("page-name").innerHTML = "CLIENTS DETAILS";

document.getElementById("p-type").innerHTML = "Client";
document.getElementById("phone").innerHTML = "Phone number";
document.getElementById("email").innerHTML = "E-mail";
document.getElementById("address").innerHTML = "Address";

document.getElementById("details-tab").innerHTML = "Personal details";
document.getElementById("files-tap").innerHTML = "Files";
document.getElementById("cases-tap").innerHTML = "Cases";
document.getElementById("license-tap").innerHTML = "Identity and licenes";
document.getElementById("contracts-tap").innerHTML = "Contracts";


document.getElementById("name-ar").innerHTML = "Name arabic";
 document.getElementById("name-eng").innerHTML = "Name english";
 document.getElementById("branch").innerHTML = "Branch";
 document.getElementById("mail-box").innerHTML = "Mail box";
 document.getElementById("nation").innerHTML = "Nationality";
 document.getElementById("address-label").innerHTML = "Address";
 document.getElementById("ssn").innerHTML = "SSN / license number";
 document.getElementById("p-mail").innerHTML = "E-mail";
 document.getElementById("s-mail").innerHTML = "System E-mail";
 document.getElementById("phone-label").innerHTML = "Phone";
 document.getElementById("fax").innerHTML = "Fax";

 document.getElementById("ship-address").innerHTML = "Shipping address";
 document.getElementById("fb").innerHTML = "Facebook";
 document.getElementById("twitter").innerHTML = "Twitter";
 document.getElementById("telegram").innerHTML = "Telegram";
 document.getElementById("skype").innerHTML = "Skype";
 document.getElementById("microsoft").innerHTML = "Microsoft meetings";
 document.getElementById("zoom").innerHTML ="Zoom";
 document.getElementById("linkedin").innerHTML = "Linkedin";

 
 document.getElementById("save-btn").innerHTML = "save";
 document.getElementById("update-pass-btn").innerHTML = "update";
 document.getElementById("update-pass").innerHTML = "New password";

 document.getElementById("add-new-file").innerHTML =' <i class="mdi mdi-plus-box ml-2"></i> Add new file';  
 document.getElementById("file-num-search").innerHTML = "File number";
 document.getElementById("client-name-search").innerHTML = "Client name";
 document.getElementById("files-search-btn").innerHTML = "search";
 document.getElementById("files-count").innerHTML = "Number of files";  



 var timestampArray = document.getElementsByClassName("edit-file-branch");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Branch';
  
}

var timestampArray = document.getElementsByClassName("edit-file-info");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'File info.';
  
}

var timestampArray = document.getElementsByClassName("edit-file-fees");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Office fee';
  
}

var timestampArray = document.getElementsByClassName("edit-file-btn");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Update file';
  
}

 document.getElementById("new-file-branch").innerHTML = "Brnach"; 
 document.getElementById("new-file-file-num").innerHTML = "File No.";  
 document.getElementById("new-file-client").innerHTML = "Client name";  
 document.getElementById("new-file-by").innerHTML = "Created by"; 
 document.getElementById("new-file-date").innerHTML = "Created date";    
 document.getElementById("new-file-info").innerHTML = "File info."; 
 document.getElementById("new-file-fees").innerHTML = "Office fee";  
 document.getElementById("new-file-btn").innerHTML = "Add file"; 

 document.getElementById("cases-num").innerHTML = "Cases number"; 

 


 var timestampArray = document.getElementsByClassName("identity-doc");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Identity (image)';
  
}
var timestampArray = document.getElementsByClassName("identity-start");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Release date';
  
}
var timestampArray = document.getElementsByClassName("identity-end");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'End date';
  
}
var timestampArray = document.getElementsByClassName("identity-add");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Upload';
  
}

document.getElementById("add-contract-btn").innerHTML = '<i class="mdi mdi-plus-box mr-2"></i> Add contract'; 
document.getElementById("contract-tbl-title").innerHTML = 'All contracts'; 

document.getElementById("tbl-1").innerHTML = "Subject"; 
document.getElementById("tbl-2").innerHTML = "Contract type"; 
document.getElementById("tbl-3").innerHTML = "Amount"; 
document.getElementById("tbl-4").innerHTML = "Start date"; 
document.getElementById("tbl-5").innerHTML = "End date"; 
document.getElementById("tbl-6").innerHTML = "Document"; 
document.getElementById("tbl-7").innerHTML = "Delete"; 


document.getElementById("add-contract-name").innerHTML = "Contract name"; 
document.getElementById("add-contract-type").innerHTML = "Contract type"; 
document.getElementById("add-contract-doc").innerHTML = "Document"; 
document.getElementById("add-contract-amount").innerHTML = "Amount"; 
document.getElementById("add-contract-start").innerHTML = "Start date"; 
document.getElementById("add-contract-end").innerHTML = "End date"; 
document.getElementById("add-contract-subject").innerHTML = "Subject"; 
document.getElementById("add-contract-country").innerHTML = "Country"; 
document.getElementById("add-contract-city").innerHTML = "City"; 
document.getElementById("add-contract-state").innerHTML = "State"; 
document.getElementById("add-contract-address").innerHTML = "Address"; 
document.getElementById("add-contract-phone").innerHTML = "Phone number"; 
document.getElementById("add-contract-notes").innerHTML = "Notes"; 
document.getElementById("add-contract-add-btn").innerHTML = "Add "; 


    }
</script>
    
@endsection
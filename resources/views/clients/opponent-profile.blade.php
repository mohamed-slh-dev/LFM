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
                  <img src="{{asset('assets/images/users/'.$opponent_details->against_logo)}}" alt="" class="rounded-circle">
                     
                                </div>
                                <div class="met-profile_user-detail mr-3">
                                    @if (Session::get('lang') == "ar")
                                    <h5 class="met-user-name"> {{$opponent_details->S_AGAINST_AR_NAME}} </h5>                                                        
                                    @else
                                    <h5 class="met-user-name"> {{$opponent_details->S_AGAINST_EG_NAME}} </h5>                                                        

                                    @endif
                                    <p class="mb-0 met-user-name-post" id="p-type"></p>
                                </div>
                            </div>                                                
                        </div><!--end col-->
                        <div class="col-lg-4 mx-auto ">
                      
                            <ul class="list-unstyled personal-detail">
                                <li class=""><b><i class="dripicons-phone mx-2 text-info font-18"></i> <span id="phone"> </span> </b> : {{$opponent_details->phone}} </li>
                                <li class="mt-2"><b> <i class="dripicons-mail text-info font-18 mt-2 mx-2"></i><span id="mail"></span> </b> : {{$opponent_details->S_Email}} </li>
                                <li class="mt-2"><b> <i class="dripicons-location text-info font-18 mt-2 mx-2"></i>  <span id="address"></span> </b> : {{$opponent_details->S_ADDRESS }} </li>
                            </ul>
                            
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
                        class="nav-link "
                         id="details-tap" data-toggle="pill" href="#general_detail"></a>
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
                        <a class="nav-link" id="docs-tap" data-toggle="pill" href="#settings_detail"></a>
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
                <form class="form" action=" {{ url('update-opponent-details/'.$opponent_details->N_AGAINST_ID) }}"method="POST" >
                    @csrf
                <div class="row">
                 

                <div class="col-lg-6">

                <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 mt-2 " id="name-ar"></label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="name_ar" type="text" value=" {{$opponent_details->S_AGAINST_AR_NAME }} " id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 mt-2 " id="name-eng"></label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="name_eng" value="{{$opponent_details->S_AGAINST_EG_NAME }}" type="text" id="example-text-input">
                                </div>
                            </div>
                        
                    
                 </div>
          
            <div class="col-lg-4">
                
            </div>

            <div class="col-12"> <hr></div>
           
              <div class="col-lg-6 mb-5">
                  <div class="form-group row">
                              <label class="col-sm-2 mt-2 " id="branch"></label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="branch">
                                    <option selected value="{{$opponent_details->branchCode}}">{{$opponent_details->branchName}}</option>
                                    @foreach ($branch as $branch)
                                    <option value="{{$branch->N_DetailedCode}}">{{$branch->S_Desc_A}}</option>  
                                    @endforeach                                   
                                    
                                </select>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 mt-2 " id="mail-box"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="mb_number" type="text" value="{{$opponent_details->S_MB}}" id="example-number-input">
                            </div>
                        </div>
                          <div class="form-group row">
                              <label class="col-sm-2 mt-2 " id="nation"></label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="nation">
                                    <option value="{{$opponent_details->nationCode   }}">{{$opponent_details->nationName}}</option>
                                    @foreach ($nationality as $nation)
                                    <option value="{{$nation->N_DetailedCode}}">{{$nation->S_Desc_A}}</option>  
                                    @endforeach                               
                                    
                                </select>
                            </div>
                        </div>
                          <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 mt-2 " id="address-label"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="address" type="text" value="{{$opponent_details->S_ADDRESS}}" id="example-number-input">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 mt-2 " id="ssn"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="passport" type="text" value="{{$opponent_details->N_PASSPORT_ID}}" id="example-number-input">
                            </div>
                        </div>
                         
                 </div>

              <div class="col-lg-6 mb-5">
                  <div class="form-group row">
                            <label for="example-date-input" class="col-sm-2 mt-2 " id="phone-label"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="phone" value="{{$opponent_details->phone}}" type="text" >
                            </div>
                        </div>
                          

                          <div class="form-group row">
                            <label for="example-date-input" class="col-sm-2 mt-2 " id="p-mail"> </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                            <input type="email" id="example-input2-group1" name="email" class="form-control" value="{{$opponent_details->S_Email}}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="far fa-envelope"></i></span>
                            </div>
                        </div>
                            </div>
                        </div>
                       
                       <div class="form-group row">
                            <label for="example-date-input" class="col-sm-2 mt-2 " id="fax"></label>
                            <div class="col-sm-10">
                                <input class="form-control" name="fax" value="{{$opponent_details->S_FAX}} " type="text" >
                            </div>
                        </div>  
                            
                            </div> 
                            <div class="col-lg-12 text-left">
                            <button class="btn btn-success" id="save-btn"></button>
                            </div> 
                        </div>   
                </form>                                          
</div><!--end general detail-->

<div
@if ($open == 'files')
class="tab-pane fade show active"
@endif
class="tab-pane fade "
 id="files_tap">                 
  <div class="row">
    <div class="col-lg-12 ">
        <div class="">
            <ul class="list-inline pr-0">                                    
               
                <li class="list-inline-item">

                    <h4> <span id="files-count"></span> : {{$files_count}} </h4>
                </li>
            </ul>
        </div>
</div><!--end col-->
       
      
             
@foreach ($opponent_files as $file)
    
<div class="col-lg-4">
    <div class="card">
        <div class="card-body">                                        
           
            <div class="text-center project-card">
               <br>
               <span class="badge badge-soft-purple font-11"></span>

               <h3 class="project-title my-3"> <span id="file-file-num"></span> : {{$file->file_id}}</h3>
             
              
                 <form action="{{route('file-case')}}" method="post">
                     @csrf
                     <input type="hidden" name="file_id" value="{{$file->file_id}}">
                     
                      <button class="btn btn-outline-dark waves-effect btn-round waves-light my-3" type="submit" id="view-case"> </button>
   
                   </form>                       
            
                    
            </div>                                                                      
        </div><!--end card-body-->
    </div><!--end card-->
</div><!--end col-->
    @endforeach

</div><!--end row--> 
</div><!--end education detail-->
<!-- ///////////////////////////////////////////////////////////////////////////////// -->

<div class="tab-pane fade" id="main_cases_tap">
<div class="row">
   



    <div class="col-lg-12 ">
        <div class="text-right">
            <ul class="list-inline pr-0">                                    
               
               <li class="list-inline-item">

                    <h4><span id="cases-num"></span> : {{$main_cases_count}} </h4>
                </li>
            </ul>
        </div>
</div><!--end col-->
  
   @foreach ($opponent_cases as $mc)
    
   
<div class="col-lg-4">
    <div class="card">
        <div class="card-body">  
        <div style="display: ruby;">  
                <div>
           <h5 class="text-muted"> <span id="case-file-number"></span> : {{$mc->S_CASE_FILE_NUM }} </h5>
        </div>                            
            
        </div>
            <div class="text-center project-card">
              <img src="{{asset('assets/images/case-img.png')}}" alt="" height="90" class="mx-auto d-block mb-1"> 
               <br>
  
                 <h4 class="my-0"> <span id="card-case-number"></span> : {{$mc->N_CASE_ID}}</h4>
                 <br>
                 <p class="text-muted">  <span id="card-case-create"></span> : {{$mc->DT_CASE_DATE}}   </p>
                 <p class="text-muted mb-2 mt-1"><span class="text-secondary font-14" id="card-case-subject"><b></b></span> : {{$mc->S_CASE_SUBJECT}}
                 </p>

                 <a href="{{url('main-case-cases/'.$mc->N_CASE_ID)}}"><button class="btn btn-outline-secondary waves-effect my-3" id="card-case-view"></button></a>

                  <a href="#"> <button class="btn btn-outline-info waves-effect waves-light mr-3" type="submit" id="card-case-report" ></button></a>
                <br>

                <p class=""><span id="card-case-register"></span> : {{$mc->register_date}}   </p>
                    
            </div>                                                                      
        </div><!--end card-body-->
    </div><!--end card-->
</div><!--end col-->    
   @endforeach  
              
</div><!--end row-->
</div><!--end portfolio detail-->
<!-- //////////////////////////////////////////////////////////////////////////// -->                       
         <div class="tab-pane fade" id="settings_detail">
                <div class="row">       

                                            
        </div>
            </div><!--end settings detail-->
       
        
  
</div><!--end row-->

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
document.getElementById("breadcrumb-2").innerHTML = "تفاصيل الخصم"; 

document.getElementById("page-name").innerHTML = "تفاصيل الخصم";


document.getElementById("p-type").innerHTML = "خصم";

document.getElementById("phone").innerHTML = "  رقم الهاتف";
document.getElementById("mail").innerHTML = " البريد الالكتروني ";
document.getElementById("address").innerHTML = " العنوان";


document.getElementById("details-tap").innerHTML = " البانات الشخصية";
document.getElementById("files-tap").innerHTML = "الملفات";
document.getElementById("cases-tap").innerHTML = "القضايا";
document.getElementById("docs-tap").innerHTML = "المستندات";


document.getElementById("name-ar").innerHTML = "اسم عربي";
 document.getElementById("name-eng").innerHTML = " اسم انجليزي";
 document.getElementById("branch").innerHTML = "الفرع";
 document.getElementById("mail-box").innerHTML = "صندوق البريد";
 document.getElementById("nation").innerHTML = "الجنسية";

 document.getElementById("p-mail").innerHTML = "البريد الالكتروني";
 document.getElementById("phone-label").innerHTML = "رقم الهاتف";
 document.getElementById("fax").innerHTML = "فاكس";
 document.getElementById("ssn").innerHTML = "رقم الجواز";
 document.getElementById("address-label").innerHTML = "العنوان";

 document.getElementById("save-btn").innerHTML = "حفظ";

 document.getElementById("files-count").innerHTML = " عدد الملفات"; 
 document.getElementById("file-file-num").innerHTML = "رقم الملف";  
 document.getElementById("view-case").innerHTML = "عرض القضية";  



  document.getElementById("cases-num").innerHTML = "عدد القضايا"; 
  document.getElementById("card-case-subject").innerHTML = "موضوع القضية"; 
 document.getElementById("case-file-number").innerHTML = " رقم الملف"; 
 document.getElementById("card-case-number").innerHTML = " رقم القضية"; 
 document.getElementById("card-case-create").innerHTML = " تاريخ الانشاء"; 
 document.getElementById("card-case-register").innerHTML = "تاريخ التسجيل"; 

 document.getElementById("card-case-view").innerHTML = "عرض القضية"; 
 document.getElementById("card-case-report").innerHTML = "تقرير القضية"; 
 


}else{

 document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "clients";
document.getElementById("breadcrumb-1").innerHTML = "against details";

document.getElementById("page-name").innerHTML = "AGAINST DETAILS";


document.getElementById("p-type").innerHTML = "Client";
document.getElementById("phone").innerHTML = "Phone number";
document.getElementById("mail").innerHTML = "E-mail";
document.getElementById("address").innerHTML = "Address";

document.getElementById("details-tap").innerHTML = "Personal details";
document.getElementById("files-tap").innerHTML = "Files";
document.getElementById("cases-tap").innerHTML = "Cases";
document.getElementById("docs-tap").innerHTML = "Documents";

document.getElementById("name-ar").innerHTML = "Name arabic";
 document.getElementById("name-eng").innerHTML = "Name english";
 document.getElementById("branch").innerHTML = "Branch";
 document.getElementById("mail-box").innerHTML = "Mail box";
 document.getElementById("nation").innerHTML = "Nationality";
 document.getElementById("address-label").innerHTML = "Address";
 document.getElementById("ssn").innerHTML = "Passport number";
 document.getElementById("p-mail").innerHTML = "E-mail";
 document.getElementById("phone-label").innerHTML = "Phone";
 document.getElementById("fax").innerHTML = "Fax";

 document.getElementById("save-btn").innerHTML = "save";

 document.getElementById("files-count").innerHTML = "Number of files"; 
 document.getElementById("file-file-num").innerHTML = "File number";  
 document.getElementById("view-case").innerHTML = "View case";  


 document.getElementById("cases-num").innerHTML = "Cases number"; 
 document.getElementById("card-case-subject").innerHTML = "Case subject"; 
 document.getElementById("case-file-number").innerHTML = "File number"; 
 document.getElementById("card-case-number").innerHTML = "Case No."; 
 document.getElementById("card-case-create").innerHTML = "Create date"; 
 document.getElementById("card-case-register").innerHTML = "Register date"; 

 document.getElementById("card-case-view").innerHTML = "View case"; 
 document.getElementById("card-case-report").innerHTML = "Case report"; 





      }
</script>
    
@endsection
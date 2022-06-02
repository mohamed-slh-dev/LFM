@extends('layouts.client-layout')

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
                                  
                                    <h5 class="met-user-name"> {{$client_details->S_CLIENT_AR_NAME}} </h5> 
                                   
                                    <h5 class="met-user-name"> {{$client_details->S_CLIENT_EG_NAME}} </h5> 

                                 
                                                                                          
                                    <p class="mb-0 met-user-name-post" id="p-type"></p>
                                </div>
                            </div>                                                
                        </div><!--end col-->
                        <div class="col-lg-4 mr-auto">
                            <ul class="list-unstyled personal-detail">
                                <li class=""><b><i class="dripicons-phone mx-2  text-info font-18"></i>  <span id="phone"> </span> </b> : {{$client_details->phone}} </li>
                                <li class="mt-2"><b> <i class="dripicons-mail text-info font-18 mx-2"></i> <span id="mail"></span> </b> : {{$client_details->S_Email}} </li>
                                <li class="mt-2"><b> <i class="dripicons-location text-info font-18  mx-2"></i> <span id="address"></span>  </b> : {{$client_details->S_ADDRESS }} </li>
                            </ul>
                            <div class="button-list btn-social-icon"> 
                                <a href="{{$client_details->facebook}}">
                                    <button type="button" class="btn btn-primary btn-round">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                    </a>                                               
                               
                                    <a href="{{$client_details->twitter}}">
                                        <button type="button" class="btn btn-primary btn-round">
                                            <i class="fab fa-twitter"></i>
                                        </button>
                                    </a>
                               

                                    <a href="{{$client_details->linkedin}}">
                                         <button type="button" class="btn btn-dark btn-round  ">
                                    <i class="fab fa-linkedin"></i>
                                </button>
                                    </a>
                               
                                    <a href="{{$client_details->telegram}}">
                                         <button type="button" class="btn btn-primary btn-round  ">
                                    <i class="fab fa-telegram"></i>
                                </button>
                                    </a>
                               

                                    <a href="{{$client_details->skype}}">
                                        <button type="button" class="btn btn-dark btn-round  ">
                                    <i class="fab fa-skype"></i>
                                </button> 
                                    </a>
                               
                                    <a href="{{$client_details->zoom_meetings}}">
                                        <button type="button" class="btn btn-primary btn-round  ">
                                    <i class="fas fa-video "></i>
                                </button> 
                                    </a>
                               
                                    <a href="{{$client_details->microsoft_team}}">
                                        <button type="button" class="btn btn-primary btn-round  ">
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
                      
                        <a  class="nav-link active"    id="details-tab" data-toggle="pill" href="#general_detail">البيانات الشخصية</a>
                    </li>
                   
                 
                </ul>        
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->

<div class="row">
    <div class="col-12">
        <div class="tab-content detail-list" id="pills-tabContent">
            <div  class="tab-pane fade show active" id="general_detail">
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
                
                <div class="col-12 my-5"> <hr> </div>
             
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
                        <div class="col-6 text-right">
                            <button class="btn btn-success" id="update-pass-btn"></button>
                        </div> 
                    </div>
                 
                
                </form>
                </div>
             
</div><!--end general detail-->

        </div>
    </div>
</div>
    
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
document.getElementById("breadcrumb-1").innerHTML = "منصتي"; 
document.getElementById("breadcrumb-2").innerHTML = "ملفي الشخصي"; 

document.getElementById("page-name").innerHTML = "تفاصيل العميل";

document.getElementById("p-type").innerHTML = "عميل";

document.getElementById("phone").innerHTML = "  رقم الهاتف";
document.getElementById("mail").innerHTML = " البريد الالكتروني ";
document.getElementById("address").innerHTML = " العنوان";
document.getElementById("details-tab").innerHTML = " البانات الشخصية";

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
     }else{

        document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "my platform";
document.getElementById("breadcrumb-1").innerHTML = "my profile";

document.getElementById("page-name").innerHTML = "CLIENTS DETAILS";

document.getElementById("p-type").innerHTML = "Client";
document.getElementById("phone").innerHTML = "Phone number";
document.getElementById("mail").innerHTML = "E-mail";
document.getElementById("address").innerHTML = "Address";

document.getElementById("details-tab").innerHTML = "Personal details";


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

     }
</script>
    
@endsection
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
                                <img src="{{('assets/images/'.$about->logo)}}" alt="" width="300" height="150" class="rounded-circle">
                                  
                                </div>
                                <div class="met-profile_user-detail mr-3">
                                    <h4 class="text-white">{{$about->company_name}} </h4>                                                        
                                    <p class="mb-0 met-user-name-post" id="about-firm">عن الشركة</p>
                                </div>
                            </div>                                                
                        </div><!--end col-->
                        <div class="col-lg-8 text-center">
                            <ul class="list-unstyled personal-detail">
                                <li class=""><b><i class="dripicons-phone ml-2 text-info font-18"></i> <span id="phone"> </span> </b> {{$about->phone}} </li>
                                <li class="mt-2"><b> <i class="dripicons-mail text-info font-18 mt-2 ml-2"></i> <span id="mail"></span> </b>  : {{$about->email}} </li>
                                <li class="mt-2"><b> <i class="dripicons-location text-info font-18 mt-2 ml-2"></i> <span id="address"></span> </b>  {{$about->address}} </li>
                            </ul>
                            <div class="button-list btn-social-icon">                                                
                                <button type="button" class="btn btn-secondary btn-round">
                                    <i class="fab fa-facebook-f"></i>
                                </button>

                                <button type="button" class="btn btn-secondary btn-round ">
                                    <i class="fab fa-twitter"></i>
                                </button>

                                <button type="button" class="btn btn-secondary btn-round  ">
                                    <i class="fab fa-dribbble"></i>
                                </button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end f_profile-->                                                                                
            </div><!--end card-body-->
            <div class="card-body">
                <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="about-office-tap" data-toggle="pill" href="#general_detail">عن المكتب</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="establish-tap" data-toggle="pill" href="#education_detail">التأسيس</a>
                    </li>
                
                </ul>        
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
<div class="row">
    <div class="col-12">
        <div class="tab-content detail-list" id="pills-tabContent">
            <div class="tab-pane fade show active" id="general_detail">
                <div class="row">
                    <div class="col-12">                                            
                        <div class="card" style=" height: 50vh; ">
                            <div class="card-body">
                               <div class="row">
                                   <div class="col-md-2">
                                       <img src="../assets/images/{{$about->logo}}" alt="" height="200" class="img-fluid">
                                   </div>
                                   <div class="col-md-6">
                                       <div class="met-basic-detail">
                                            <h4>{{$about->company_name}}</h4>
                                            <p class="text-uppercase font-14" id="law-firm-title">مكتب محاماة</p>
                                            <p class="text-muted font-14">
                                                {{$about->about}}
                                            </p>
                                            
                                   
                                            
                                       </div>
                                   </div>
                                   <div class="col-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6 mx-auto">
                                                <div class="own-detail" style="background-color: #491500 !important">
                                                    <h1>30+</h1>
                                                    <h5 id="worked-years">سنوات العمل</h5>
                                                </div>
                                                <div class="own-detail own-detail-project" style=" background-color: #a94407 !important">
                                                    <h1>4483</h1>
                                                    <h5 id="cases-number">عددالقضايا </h5>
                                                </div>
                                                <div class="own-detail own-detail-happy bg-blue" style="background-color: #2b1309 !important">
                                                    <h1>396</h1>
                                                    <h5 id="clients-number">العملاء</h5>
                                                </div>
                                            </div>                                        
                                        </div>                                                                                                                       
                                   </div>
                               </div>         
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->                                             
            </div><!--end general detail-->

            <div class="tab-pane fade" id="education_detail">                                                
                <div class="row">
                    

                    <div class="col-lg-12">
                        <div class="card">                                       
                            <div class="card-body"> 
                                <h4 class="header-title mt-0 mb-3" id="establish-title">معلومات عن التأسيس</h4>
                                <div class="row">
                                    <div class="col-2">
                                        <img src="../assets/images/{{$about->logo}}" width="120" height="120" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-10 align-self-right">
                                        <p class="skill-detail">
                                            {{$about->establish}}
                                        </p>
                                    </div>
                                </div>
                                
                            </div>  <!--end card-body-->                                     
                        </div><!--end card-->
                    </div><!--end col-->
    
                </div><!--end row-->  
            </div><!--end education detail-->

            
            
            
        </div><!--end tab-content--> 
        
    </div><!--end col-->
</div><!--end row-->

@section('page-script')
    
<script>
   
     if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "الرئيسية"; 
    document.getElementById("breadcrumb-2").innerHTML = "عن المكتب"; 

    document.getElementById("page-name").innerHTML = "عن المكتب";

    document.getElementById("about-firm").innerHTML = "عن المكتب";
    document.getElementById("phone").innerHTML = " : رقم الهاتف";
    document.getElementById("mail").innerHTML = " : البريد الالكتروني ";
    document.getElementById("address").innerHTML = " : العنوان";
    document.getElementById("about-office-tap").innerHTML = "عن المكتب";
    document.getElementById("establish-tap").innerHTML = "التأسيس";

    document.getElementById("worked-years").innerHTML = "سنوات العمل";
    document.getElementById("cases-number").innerHTML = "عدد القضايا";
    document.getElementById("clients-number").innerHTML = "العملاء";

    document.getElementById("law-firm-title").innerHTML = "مكتب محاماة";
    document.getElementById("establish-title").innerHTML = "معلمومات عن التاسيس";

     }else{
    document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "home";
    document.getElementById("breadcrumb-1").innerHTML = "about";


    document.getElementById("page-name").innerHTML = "ABOUT";

    document.getElementById("about-firm").innerHTML = "About firm";
    document.getElementById("phone").innerHTML = "Phone number : ";
    document.getElementById("mail").innerHTML = "E-mail : ";
    document.getElementById("address").innerHTML = "Address : ";
    document.getElementById("about-office-tap").innerHTML = "About office";
    document.getElementById("establish-tap").innerHTML = "Establish";

    
    document.getElementById("worked-years").innerHTML = "Worked Hours";
    document.getElementById("cases-number").innerHTML = " Cases number";
    document.getElementById("clients-number").innerHTML = "Clients";

    document.getElementById("law-firm-title").innerHTML = "Law firm office";
    document.getElementById("establish-title").innerHTML = "Establish info.";

     }
</script>
@endsection

@endsection
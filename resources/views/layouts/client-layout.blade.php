<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="utf-8" />
        <title>LFM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}">
        <link href="{{asset('assets/plugins/ticker/jquery.jConveyorTicker.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/filter/magnific-popup.css')}}" rel="stylesheet" type="text/css" />



        <!-- App css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/metisMenu.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />

        @yield('page-css')
       

    </head>

    <body style="position: relative;">

        <div class="chat-sticky" id="chat-sticky" data-toggle="tooltip" data-placement="left" title="!Will launching It Soon">
            <a href="{{route('client-chats')}}"><i class="mdi mdi-chat" ></i></a> 
        </div>
      
      
        <!-- Top Bar Start -->
        <div class="topbar">
            
            <!-- Navbar -->
         <nav class="topbar-main">  

                <!-- LOGO -->
               
                <!--end logo-->
                @if ($lang == 'ar')
                <div class="topbar-left" style="float:right">
                    <a href="{{route('home')}}" class="logo">
                      
                            <span>
                                <img src="{{asset('assets/images/alshamsi.png')}}" width="200" height="150" alt="logo-large" class="logo-lg">
                            </span>
                        </a>
                    </div><!--topbar-left-->
                <ul class="list-unstyled topbar-nav mb-0 px-2 float-left"> 
                    <li   class="dropdown ">
                   
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('assets/images/clients-imgs/'.Session::get('client_pic'))}}" alt="profile-user" class="rounded-circle" /> 
                    <span class="ml-1 nav-user-name hidden-sm">{{Session::get('client_name')}}</span> <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu" style="text-align: center;">
                        <a class="dropdown-item" href="{{route('client-profile')}}"><i class="dripicons-user text-muted mr-2"></i> الملف الشخصي</a>
                                                      
                            {{-- <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/logout_') }}"><i class="dripicons-exit text-muted mr-2"></i> تسجيل الخروج</a>
                             --}}
                            <div class="dropdown-divider"></div>
                          
                            <a class="dropdown-item" href="{{ route('client-login')}}"><i class="dripicons-gear text-muted mr-2"></i> تسجيل خروج</a>

                        
                        
                        </div>
                    </li>
                @else
                <div class="topbar-left" style="float:left">
                    <a href="{{route('home')}}" class="logo">
                      
                            <span>
                                <img src="{{asset('assets/images/alshamsi.png')}}" width="200" height="150" alt="logo-large" class="logo-lg">
                            </span>
                        </a>
                    </div><!--topbar-left-->
                <ul class="list-unstyled topbar-nav mb-0 px-2 float-right"> 
                    <li   class="dropdown ">
                   
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('assets/images/clients-imgs/'.Session::get('client_pic'))}}" alt="profile-user" class="rounded-circle" /> 
                            <span class="ml-1 nav-user-name hidden-sm">{{Session::get('client_name_eng')}}</span> <i class="mdi mdi-chevron-down"></i> </span>
                                </a>
                        <div class="dropdown-menu" style="">
                        <a class="dropdown-item" href="{{route('client-profile')}}"><i class="dripicons-user text-muted mr-2"></i>My Profile</a>
                                                      
                            {{-- <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/logout_') }}"><i class="dripicons-exit text-muted mr-2"></i> تسجيل الخروج</a>
                             --}}
                            <div class="dropdown-divider"></div>
                          
                            <a class="dropdown-item" href="{{ route('client-login')}}"><i class="dripicons-gear text-muted mr-2"></i>Logout</a>

                        
                        
                        </div>
                    </li>
   
                @endif
                

                   
                    <li class="hidden-sm">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="javascript: void(0);" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            @if ($lang == 'ar')
                            العربية <img src="{{asset('assets/images/flags/UAE_flag.jpg')}}" class="mx-2" height="16" alt=""/> <i class="mdi mdi-chevron-down"></i> 
                       @else
                       English <img src="{{asset('assets/images/flags/us_flag.jpg')}}" class="mx-2" height="16" alt=""/> <i class="mdi mdi-chevron-down"></i> 

                            @endif                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{url('lang-ar')}}"><span> عربي </span><img src="{{asset('assets/images/flags/UAE_flag.jpg')}}" alt="" class="mx-2 float-right" height="14"/></a>

                            <a class="dropdown-item" href="{{url('lang-eng')}}"><span> English </span><img src="{{asset('assets/images/flags/us_flag.jpg')}}" alt="" class="mx-2 float-right" height="14"/></a>
                        </div>
                    </li><!--end li-->

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i class="dripicons-bell noti-icon"></i>
                        </a>
                       
                        <div class="dropdown-menu dropdown-lg" style="text-align: right;">
                            <!-- item-->
                            <h6 class="dropdown-item-text" style="text-align: right;">
                              التنبيهات
                            </h6>
                            <div class="slimscroll notification-list">
                                <!-- item-->
                                   
                                    @foreach ($activities as $activity)
                                    <a href="{{url('client-'.$activity->url.'')}}" class="dropdown-item notify-item active">

                                    <div class="notify-icon bg-success mr-0 ml-2">
                                        <i class="dripicons-time-reverse  mr-1">

                                    </i>
                                    </div>
                                    <p class="notify-details"> {{$activity->short_name}}</p>
                                    <small class="text-muted">{{$activity->date_time}}</small>

                                </a>
                                    @endforeach
                              
                                <!-- item-->
                              
                                <!-- item-->
                               
                             
                            </div>
                            <!-- All-->
                            <a href=" {{route('client-activities')}} " class="dropdown-item text-center text-primary">
                               عرض الكل <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li><!--end notification-list-->

                    
                    

                     

                    
                     
                </ul><!--end topbar-nav-->
    
                <ul class="list-unstyled topbar-nav mb-0">
                 <li class="menu-item float-right">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link" id="mobileToggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li> <!--end menu item--> 
                    
                   
                </ul>
                <!--end topbar-nav-->
            </nav>
            <!-- end navbar-->
            
            <!-- MENU Start -->
            <div class="navbar-custom-menu">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                         <li class=" has-submenu" id="home">
                                <a href="javascript:;" class="navbar-link">
                                <i class="mdi mdi-home" ></i>
                                    <span id="menu-home">&nbsp الرئيسية </span>
                                    
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                    <li>
                                    <a href=" {{url('/client-home')}} " id="home-page" style="display: inline-flex;"><i class="ti-home"></i> &nbsp الصفحة الرئيسية</a></li>
                                       <li><a href=" {{route('client-about')}} " id="about" style="display: inline-flex;">  <i class="mdi mdi-shield"></i>  &nbsp مكتب ناصر الشامسي للمحاماة  </a></li>
                                          <li><a href=" {{route('client-common-question')}} " id="faq" style="display: inline-flex;">  <i class="ti-list"></i> &nbsp الأسئلة الشائعة  </a></li>

                                            <li><a href=" {{route('client-rules-and-regulations')}} " id="rules" style="display: inline-flex;"> <i class="mdi  mdi-book-multiple-variant"></i>  &nbsp القوانين و التشريعات   </a></li>

                                            <li><a href=" {{route('client-library')}} " id="library" style="display: inline-flex;"> <i class='mdi mdi-book-open-page-variant'></i> &nbsp المكتبة  </a></li>

                                            <li><a href=" {{route('client-courts')}} " id="courts" style="display: inline-flex;">   <i class='mdi mdi-map-marker-radius'></i> &nbsp عرض المحاكم </a></li>
                                            <li><a href=" {{route('client-depts-jurisdictions')}} " id="circels" style="display: inline-flex;"> <i class='mdi mdi-map-marker-radius'></i> &nbsp الدوائر المختصة الأخري  </a></li>
                                   
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->

                            <li class=" has-submenu" id="case_manage">
                                <a href="javascript:;" class="navbar-link">
                                    <i class="mdi mdi-desktop-mac-dashboard "></i>
                                      <span id="my-space">&nbsp منصتي </span>
                                  
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                     <li><a href="#" id="dashboard" style="display: inline-flex;" ><i class="ti-bar-chart-alt"></i> &nbsp  الرئيسية  </a></li> 
                                       <li><a href="{{route('client-profile')}}" id="my-profile" style="display: inline-flex;" >   <i class="mdi mdi-shield-account "></i>&nbsp الملف الشخصي </a></li>
                                <li><a href="{{route('client-identity')}}" id="identity" style="display: inline-flex;" >   <i class="mdi mdi-certificate"></i>&nbsp الهوية و رخص العمل </a></li>
                                       <li><a href="{{route('client-contracts')}}" id="contracts" style="display: inline-flex;" >   <i class="mdi mdi-certificate"></i>&nbsp العقود و التوكيلات </a></li>
                                    
                                </ul>
                            </li><!--end submenu-->

                          

                            <li class=" has-submenu" id="case_manage">
                                <a href="javascript:;" class="navbar-link">
                                    <i class="mdi mdi-clipboard"></i>
                                      <span id="menu-case-manage">&nbsp إدارة القضايا </span>
                                  
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                     <li><a href="{{route('my-dashboard')}}" id="cases-dashboard" style="display: inline-flex;"  ><i class="ti-bar-chart-alt"></i> &nbsp  لوحة القضايا الرئيسية  </a></li> 
                                       <li><a href="{{route('all-files')}}" id="files" style="display: inline-flex;"  >   <i class="mdi mdi-folder-multiple"></i>&nbsp الملفات </a></li>
                                       <li><a href="{{route('all-cases')}}" id="cases" style="display: inline-flex;"  ><i class="mdi mdi-chart-timeline"></i> &nbsp الدعاوى  </a></li> 
                                       <li><a href="{{route('all-excutes')}}" id="executes" style="display: inline-flex;"  ><i class="mdi mdi-chart-timeline"></i> &nbsp التنفيذات  </a></li> 
                                       <li><a href="{{route('client-decision-notifications')}}" id="judges" style="display: inline-flex;"  ><i class="mdi mdi-chart-timeline"></i> &nbsp الاحكام  </a></li>  
                                       <li><a href=" {{route('client-activities')}} " id="activities" style="display: inline-flex;"  >  <i class="mdi mdi-update "></i> &nbsp النشاطات  </a></li>
                                       <li><a href=" {{route('client-open-case')}} " id="case-request" style="display: inline-flex;"  >  <i class="mdi mdi-folder-multiple "></i> &nbsp فتح قضية   </a></li>
                                                           
                                </ul>
                            </li><!--end submenu-->

                         
                            <li class="  has-submenu" id="reports">
                                <a href="javascript:;" class="navbar-link">
                                    <i class="mdi mdi-file-document"></i>
                                     <span id="menu-reports"> &nbsp التقاير </span>
                                   
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                   
                                   <li><a href="{{route('client-cases-reports')}}" id="cases-reports" style="display: inline-flex;" > <i class="mdi mdi-file-document"></i>  &nbsp تقارير الدعاوى</a></li>
                               
                                 <li><a href="{{route('client-stages-reports')}}" id="stages-reports" style="display: inline-flex;" > <i class="mdi mdi-chart-timeline"></i>  &nbsp تقارير الجلسات </a></li>
                                
                                    
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->

                            <li class="  has-submenu" id="reports">
                                <a href="javascript:;" class="navbar-link">
                                    <i class="mdi mdi-cash-multiple"></i>
                                     <span id="menu-finance"> &nbsp المالية </span>
                                   
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                                                  
                                 <li><a href="{{route('client-invoices')}}" id="invoices" style="display: inline-flex;" > <i class="mdi mdi-file-document"></i>  &nbsp الفواتير </a></li>
                          
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->
                            
                            <li class=" has-submenu" id="case_manage">
                                <a href="javascript:;" class="navbar-link">
                                    <i class="dripicons-ticket"></i>
                                      <span id="menu-support" >&nbsp طلبات الدعم </span>
                                  
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                <li><a href="{{route('client-tickets')}}" id="menu-tickets" style="display: inline-flex;" >   <i class="dripicons-ticket"></i>&nbsp طلبات الدعم </a></li>
                                    
                                </ul>
                            </li><!--end submenu-->

        
                        </ul><!-- End navigation menu -->
                    </div> <!-- end navigation -->
                </div> <!-- end container-fluid -->
            </div> <!-- end navbar-custom -->        
        </div>
        <!-- Top Bar End -->

        <div class="page-wrapper">
            <!-- Page Content-->
            <div class="page-content">

                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div id="breadcrumb-float"  class="">
                                    <ol class="breadcrumb d-none">
                                        @yield('path')
                                    </ol><!--end breadcrumb-->
                                </div><!--end /div-->
                                
                                <button disabled id="page-name" class="btn btn-outline-dark">
                                    @yield('page-name')
                                </button>
                              
                              
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->
                    @include('alerts.alerts')
                    @yield('content')
            
                </div><!-- container -->
            </div>
            <!-- end page content -->
            <footer class="footer text-center text-sm-left">
           
            </footer><!--end footer-->
        </div>
        <!-- end page-wrapper -->

          <!-- jQuery  -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/js/waves.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
          <!-- App js -->
          <script src="{{asset('assets/js/app.js')}}"></script>

          <script>
            var lang =  @json($lang);
            if (lang == "ar") {

                document.getElementById("menu-home").innerHTML = "الرئيسية";
              document.getElementById("home-page").innerHTML = "<a href='javascript:void(0);' class='ti-home pl-0 pt-0 ' ></a> &nbsp الرئيسية";
              document.getElementById("about").innerHTML = " <a href='javascript:void(0);' class='mdi mdi-shield pl-0 pt-0 '></a>  &nbsp مكتب ناصر الشامسي للمحامة";
              document.getElementById("faq").innerHTML = " <a href='javascript:void(0);' class='ti-list pl-0 pt-0 '></i> &nbsp الاسئلة الشائعة";
              document.getElementById("rules").innerHTML = " <a href='javascript:void(0);' class=' pl-0 pt-0 mdi  mdi-book-multiple-variant'></a>  &nbsp القوانين و التشريعات";
              document.getElementById("courts").innerHTML = "   <a  href='javascript:void(0);'class=' pl-0 pt-0 mdi mdi-map-marker-radius'></a> &nbsp المحاكم ";
              document.getElementById("circels").innerHTML = "   <a  href='javascript:void(0);'class=' pl-0 pt-0 mdi mdi-map-marker-radius'></a> &nbsp الدوائر المختصة ";
              document.getElementById("library").innerHTML = "<a href='javascript:void(0);' class=' pl-0 pt-0 mdi mdi-book-open-page-variant'></a> &nbsp المكتبة ";

              document.getElementById("my-space").innerHTML = "منصتي";
              document.getElementById("dashboard").innerHTML = '<a  href="javascript:void(0);" class="pl-0 pt-0 ti-bar-chart-alt"></a> &nbsp  الرئيسية ';
              document.getElementById("my-profile").innerHTML = '<a  href="javascript:void(0);" class="pl-0 pt-0 mdi mdi-shield-account "></a>&nbsp ملفي الشخصي ';
              document.getElementById("identity").innerHTML = '<a href="javascript:void(0);"  class="pl-0 pt-0 mdi mdi-certificate"></a>&nbsp الهوية و رخص العمل';
              document.getElementById("contracts").innerHTML = '  <a href="javascript:void(0);"  class="pl-0 pt-0 mdi mdi-certificate"></a>&nbsp العقودات';

              document.getElementById("menu-case-manage").innerHTML = "ادارة القضايا";
              document.getElementById("cases-dashboard").innerHTML = '<a class="ti-bar-chart-alt"></i> &nbsp  لوحة القضايا الرئيسية';
              document.getElementById("files").innerHTML = ' <a  href="javascript:void(0);" class="pl-0 pt-0 mdi mdi-folder-multiple"></a>&nbsp القضايا  ';
              document.getElementById("cases").innerHTML = '<a href="javascript:void(0);"  class="pl-0 pt-0 mdi mdi-chart-timeline"></a> &nbsp الدعاوى  ';
              document.getElementById("executes").innerHTML = ' <a  href="javascript:void(0);" class="pl-0 pt-0 mdi mdi-chart-timeline"></a> &nbsp التنفيذات ';
              document.getElementById("judges").innerHTML = '<a  href="javascript:void(0);" class="pl-0 pt-0 mdi mdi-chart-timeline"></a> &nbsp الاحكام  ';
              document.getElementById("activities").innerHTML = '<a href="javascript:void(0);"  class="pl-0 pt-0 mdi mdi-update "></a> &nbsp النشاطات ';
              document.getElementById("case-request").innerHTML = '<a href="javascript:void(0);"  class="pl-0 pt-0 mdi mdi-folder-multiple"></a>  &nbsp فتح قضية ';

              document.getElementById("menu-reports").innerHTML = "التقارير";
              document.getElementById("cases-reports").innerHTML = '  <a href="javascript:void(0);"  class="pl-0 pt-0 mdi mdi-file-document"></a>  &nbsp تقارير الدعاوى';
              document.getElementById("stages-reports").innerHTML = '     <a href="javascript:void(0);" class="pl-0 pt-0 mdi mdi-chart-timeline"></a>  &nbsp تقارير الجلسات';

              document.getElementById("menu-finance").innerHTML = "الفواتير";
              document.getElementById("invoices").innerHTML = ' <a  href="javascript:void(0);" class="pl-0 pt-0 mdi mdi-file-document"></a>&nbsp الفواتير';

              document.getElementById("menu-support").innerHTML = "طلبات الدعم";
              document.getElementById("menu-tickets").innerHTML = ' <a href="javascript:void(0);"  class="pl-0 pt-0 dripicons-ticket"></a>&nbsp طلبات الدعم';

                
            } else {
                document.getElementById("menu-home").innerHTML = "Home";
              document.getElementById("home-page").innerHTML = "<a  href='javascript:void(0);'  class='pr-0 ti-home' ></a> &nbsp Home";
              document.getElementById("about").innerHTML = " <a  href='javascript:void(0);' class='pr-0 mdi mdi-shield'></a>  &nbsp About";
              document.getElementById("faq").innerHTML = " <a  href='javascript:void(0);' class='pr-0 ti-list'></a> &nbsp Commom question";
              document.getElementById("rules").innerHTML = " <a  href='javascript:void(0);' class='pr-0 mdi  mdi-book-multiple-variant'></a>  &nbsp Rules and regulations";
              document.getElementById("courts").innerHTML = "   <a href='javascript:void(0);'  class='pr-0 mdi mdi-map-marker-radius'></a> &nbsp Courts ";
              document.getElementById("circels").innerHTML = "   <a  href='javascript:void(0);' class='pr-0 mdi mdi-map-marker-radius'></a> &nbsp Departments of jurisdiction  ";
              document.getElementById("library").innerHTML = "<a  href='javascript:void(0);' class='pr-0 mdi mdi-book-open-page-variant'></a> &nbsp Library ";

              document.getElementById("my-space").innerHTML = "My Plateform";
              document.getElementById("dashboard").innerHTML = '<a href="javascript:void(0);" class="pr-0 ti-bar-chart-alt"></a> &nbsp  Dashboard ';
              document.getElementById("my-profile").innerHTML = '<a href="javascript:void(0);" class="pr-0 mdi mdi-shield-account "></a>&nbsp My profile ';
              document.getElementById("identity").innerHTML = '<a href="javascript:void(0);" class="pr-0 mdi mdi-certificate"></a>&nbsp Identities & lisence';
              document.getElementById("contracts").innerHTML = '  <a href="javascript:void(0);" class="pr-0 mdi mdi-certificate"></a>&nbsp Contracts';

              document.getElementById("menu-case-manage").innerHTML = "Cases Management";
              document.getElementById("cases-dashboard").innerHTML = '<a  href="javascript:void(0);" class="ti-bar-chart-alt"></a> &nbsp  Cases Dashboard ';
              document.getElementById("files").innerHTML = ' <a  href="javascript:void(0);" class="pr-0 mdi mdi-folder-multiple"></a>&nbsp Files  ';
              document.getElementById("cases").innerHTML = '<a  href="javascript:void(0);" class="pr-0 mdi mdi-chart-timeline"></a> &nbsp Cases  ';
              document.getElementById("executes").innerHTML = ' <a href="javascript:void(0);"  class="pr-0 mdi mdi-chart-timeline"></a> &nbsp Executes ';
              document.getElementById("judges").innerHTML = '<a href="javascript:void(0);"  class="pr-0 mdi mdi-chart-timeline"></a> &nbsp Judegments  ';
              document.getElementById("activities").innerHTML = '<a  href="javascript:void(0);" class="pr-0 mdi mdi-update "></a> &nbsp Activities ';
              document.getElementById("case-request").innerHTML = '<a  href="javascript:void(0);" class="pr-0 mdi mdi-folder-multiple"></a>  &nbsp Open Case ';

              document.getElementById("menu-reports").innerHTML = "Reports";
              document.getElementById("cases-reports").innerHTML = '  <a href="javascript:void(0);" class="pr-0 mdi mdi-file-document"></a>  &nbsp Cases reports';
              document.getElementById("stages-reports").innerHTML = '     <a href="javascript:void(0);" class="pr-0 mdi mdi-chart-timeline"></a>  &nbsp Hearings reports';

              document.getElementById("menu-finance").innerHTML = "Finance";
              document.getElementById("invoices").innerHTML = ' <a  href="javascript:void(0);" class="pr-0 mdi mdi-file-document"></a>&nbsp Invoices';

              document.getElementById("menu-support").innerHTML = "Support Requests";
              document.getElementById("menu-tickets").innerHTML = ' <a href="javascript:void(0);"  class="pr-0 dripicons-ticket"></a>&nbsp Supports tickect';


            }
     </script>

          @yield('page-script')

        
       
    </body>
</html>
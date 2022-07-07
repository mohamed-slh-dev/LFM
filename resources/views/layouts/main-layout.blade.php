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

          <!--Font link -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet"> 
       
        @yield('css-link')
        
{{-- 
        
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
         <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
         <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> --}}

    </head>

    <body>
        @if (Session::get('ring'))
         <audio autoplay>
            <source src="{{asset('assets/ringbill.mp3')}} " type="audio/mpeg"> 
            </audio>
     @endif
       

        <!-- Top Bar Start -->
        <div class="topbar">
            
            <!-- Navbar -->
         <nav class="topbar-main">  

                <!-- LOGO -->
                <div class="topbar-left" id="bar-logo">
                <a href="{{route('home')}}" class="logo">
                  
                        <span>
                            <img src="{{asset('assets/images/'.$logo->logo)}}" width="160" height="150" alt="logo-large" class="logo-lg">
                        </span>
                    </a>
                </div><!--topbar-left-->
                <!--end logo-->
                <ul class="list-unstyled topbar-nav mb-0 pl-2" id="bar-cont-1"> 
                <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('assets/images/users-imgs/'.auth()->user()->avatar)}}" alt="profile-user" class="rounded-circle" /> 
                            <span class="ml-1 nav-user-name hidden-sm">{{ auth()->user()->name }}</span> <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        @if ($lang == 'ar')
                        <div class="dropdown-menu" style="text-align: right;">
                            <a class="dropdown-item" href=" {{route('my-profile')}} "><i class="dripicons-user text-muted mr-2"></i> الملف الشخصية</a>
                           
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout_') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="dripicons-exit text-muted mr-2"></i>  تسجيل الخروج
                                <form id="logout-form" action="{{ route('logout_') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        
                        
                        </div> 
                        @else
                        <div class="dropdown-menu" style="text-align: left;">
                            <a class="dropdown-item" href=" {{route('my-profile')}} "><i class="dripicons-user text-muted mr-2"></i> Profile</a>
                        
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout_') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="dripicons-exit text-muted mx-2"></i>  Logout
                                <form id="logout-form" action="{{ route('logout_') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        
                        
                        </div>
                        @endif
                     
                    </li>

                   
                    <li class="hidden-sm">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            @if ($lang == 'ar')
                                العربية <img src="{{asset('assets/images/flags/UAE_flag.jpg')}}" class="mx-2" height="16" alt=""/> <i class="mdi mdi-chevron-down"></i> 
                           @else
                           English <img src="{{asset('assets/images/flags/us_flag.jpg')}}" class="mx-2" height="16" alt=""/> <i class="mdi mdi-chevron-down"></i> 

                                @endif
                           
                        </a>
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
                                    <a href="{{url(''.$activity->url.'')}}" class="dropdown-item notify-item active">

                                    <div class="notify-icon bg-success mr-0 ml-2">
                                        <i class="dripicons-time-reverse  mr-1">

                                    </i>
                                    </div>
                                    <p class="notify-details"> {{$activity->short_name}}
                                        <small class="text-muted">تمت بواسطة {{$activity->user_create}} , {{$activity->date_time}}</small>
                                    </p>
                                </a>
                                    @endforeach
                              
                                <!-- item-->
                              
                                <!-- item-->
                               
                             
                            </div>
                            <!-- All-->
                            <a href=" {{route('activities')}} " class="dropdown-item text-center text-primary">
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
                    
                    <li class="hide-phone app-search mx-5" id="search-bar">
                        <form role="search" class="">
                            <input type="text" placeholder="" class="form-control">
                            <a href=""><i class="fas fa-search"></i></a>
                        </form>
                    </li>
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
                         <li class="d-none has-submenu" id="home">
                                <a href="javascript:;" class="navbar-link">
                                <i class="mdi mdi-home" ></i>
                                    <span id="menu-home"> </span>
                                    
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                    <li>
                                    <a href=" {{url('/home')}} " id="home-page" style="display: inline-flex;"></a>
                                </li>
                                       <li>
                                           <a href=" {{route('about')}} " id="about" style="display: inline-flex;">  </a>
                                        </li>
                                          <li><a href=" {{route('common-question')}} " id="common_q" style="display: inline-flex;">  </a></li>

                                            <li>
                                            <a href=" {{route('rules-and-regulations')}} " id="rules" style="display: inline-flex;">   </a>
                                        </li>
                                    <li><a href=" {{route('library')}} " id="library" style="display: inline-flex;">  </a></li>
                                    <li><a href=" {{route('cases-news')}} " id="common_cases" style="display: inline-flex;">  </a></li>
                                    <li><a href=" {{route('courts')}} " id="courts" style="display: inline-flex;"> </a></li>
                                    <li><a href=" {{route('depts-jurisdictions')}} " id="circels" style="display: inline-flex;"></a></li>
                                   
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->
                            <li class="d-none has-submenu" id="clients">
                                <a href="javascript:;" class="navbar-link">
                                <i class="mdi mdi-account-multiple large"></i>
                                    <span id="menu-clients"></span>
                                    
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                  
                                    <li><a href=" {{route('clients')}} " id="m-clients" style="display: inline-flex;" ></a></li>
                                    <li><a href=" {{route('opponents')}} " id="againsts" style="display: inline-flex;" ></a></li>
                                    <li><a href=" {{route('experts-offices')}} " id="experts" style="display: inline-flex;" > </a></li>
                                    <li><a href="#" id="clients-reports" style="display: inline-flex;" ></a></li>
                                    <li><a href="{{route('clients-updates')}}" id="clients-updates" style="display: inline-flex;" ></a></li>

                                    <li><a href="{{route('tickets')}}" id="clients-tickets" style="display: inline-flex;" >   </a></li>

                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->

                             <li class="d-none has-submenu" id="search">
                                <a href="javascript:;" class="navbar-link">
                                <i class="mdi mdi-magnify"></i>
                                    <span id="menu-search">&nbsp البحث </span>
                    
                                </a>
                                <ul class="submenu submenu-tab">
                                <li><a href="{{route('search-dashboard')}}" id="search-dash" style="display: inline-flex;"></a></li>
                                       <li><a href=" {{route('search-clients')}} " id="clients-search" style="display: inline-flex;"> </a></li>
                                        <li><a href=" {{route('search-againsts')}} " id="againsts-search" style="display: inline-flex;"> </a></li>
                                         <li><a href=" {{route('search-files')}} "  id="files-search" style="display: inline-flex;"></a></li>
                                         <li><a href=" {{route('search-main-cases')}} "  id="main-cases-search" style="display: inline-flex;"></a></li>
                                          <li><a href="{{route('search-cases')}}"  id="cases-search" style="display: inline-flex;"> </a></li>
                                                                                 

                                </ul><!--end submenu-->
                            </li>

                            <li class="d-none has-submenu " id="case_manage">
                                <a href="javascript:;" class="navbar-link">
                                    <i class="mdi mdi-clipboard"></i>
                                      <span id="menu-case-manage"> </span>
                                  
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                     <li><a href="{{route('cases-dashboard')}}" id="case-dashboard" style="display: inline-flex;"></a></li> 
                                       <li><a href="{{route('files')}} " id="files" style="display: inline-flex;">    </a></li>
                                       <li><a href=" {{route('main-cases')}} " id="main-cases" style="display: inline-flex;">   </a></li>
                                       <li><a href=" {{route('cases')}} " id="cases" style="display: inline-flex;"> </a></li> 
                                       <li><a href=" {{route('excutes')}} " id="excutes" style="display: inline-flex;">  </a></li> 
                                          <li><a href=" {{route('cases-tasks')}} " id="case-tasks" style="display: inline-flex;">  </a></li>
                                          @if ($others == "show")
                                          <li>
                                              <a href="#"  id="case-bills" style="display: inline-flex;"> </a>
                                            </li>
                                          @endif
                                              
                                              <li><a href="{{route('case-calendar')}}" id="case-calendar" style="display: inline-flex;"></a></li>                                                                                                 
                                </ul>
                            </li><!--end submenu-->

                            <li class="d-none has-submenu" id="tasks">
                                <a href="javascript:;" class="navbar-link">
                                     <i class="mdi mdi-checkbox-multiple-marked"></i>
                                      <span id="menu-tasks"></span>
                                 
                                </a>
                                <ul class="submenu submenu-tab">
                                 <li><a href=" {{route('all-tasks')}} " id="all-tasks" style="display: inline-flex;" ></a></li>
                                  <li><a href=" {{route('adminstrative-tasks')}}" id="adminstrative-tasks" style="display: inline-flex;" > </a></li>
                                   <li><a href=" {{route('public-tasks')}}" id="public-tasks" style="display: inline-flex;" >  </a></li>
                                   <li><a href=" {{route('specific-tasks')}}" id="special-tasks" style="display: inline-flex;" >  </a></li>
                                   <li><a href="{{route('tasks-reports')}}" id="tasks-reports" style="display: inline-flex;" ></a></li>
                                </ul>
                            </li><!--end has-submenu-->
                            <li class=" d-none has-submenu" id="reports">
                                <a href="javascript:;" class="navbar-link">
                                    <i class="mdi mdi-file-document"></i>
                                     <span id="menu-reports"> &nbsp التقاير </span>
                                   
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                    @if ($others == "show")
                                    <li><a href=" {{route('file-reports')}}" id="files-reports" style="display: inline-flex;">  </a></li>
                                    <li><a href=" {{route('register-reports')}} " id="register-reports" style="display: inline-flex;"> </a></li>
                                  
                                    @endif
                               
                                 <li><a href=" {{route('stages-schedule')}} " id="stages-schedule" style="display: inline-flex;"></a></li>
                                 <li><a href=" {{route('experts-stages')}} " id="experts-stages" style="display: inline-flex;"></a></li>
                                 <li><a href=" {{route('memoir-schedule')}} " id="memoir-schedule" style="display: inline-flex;"> </a></li>

                                 @if ($others == "show")                                 
                                   <li><a href="#" id="finance-reports" style="display: inline-flex;"> </a></li>
                                     @endif  
                                    
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->
                            
                            

                            <li class=" d-none has-submenu" id="notis">
                                <a href="javascript:;" class="navbar-link">
                                    <i class="mdi mdi-bell-ring-outline"></i>
                                     <span id="menu-noti">&nbsp التنبيهات </span>
                                </a>
                                <ul class="submenu submenu-tab">
                                    <li><a href="{{route('public-notifications')}}" id="public-noti" style="display: inline-flex;" > </a></li>

                                   
                                    <li><a href=" {{route('stages-notifications')}} " id="stages-noti" style="display: inline-flex;" > </a></li>
                                    <li><a href=" {{route('shortStages-notifications')}} " id="short-stages-noti" style="display: inline-flex;">  </a></li>
                                     <li><a href=" {{route('decision-notifications')}} " id="decission-noti" style="display: inline-flex;" > </a></li>
                                    <li><a href="{{route('direct-notifications')}}" id="special-noti" style="display: inline-flex;" >   </a></li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->


                          <li class="d-none has-submenu" id="mails">
                                <a href="javascript:;" class="navbar-link">
                                    <i class="ti-comments"></i>
                                     <span id="menu-mails">&nbsp    المحادثات </span>
                                   
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                     <li><a href="#" id="mail" style="display: inline-flex;">  </a></li>
                                     <li><a href="{{route('chats')}}" id="chats" style="display: inline-flex;"></a></li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->

                               

                                <li class=" d-none has-submenu" id="HR">
                                <a href="javascript:;" class="navbar-link">
                                    <i class="mdi mdi-account-settings"></i> 
                                     <span id="menu-hr"> &nbsp  ادارة الموظفين</span>
                                    </a>
                                 <ul class="submenu submenu-tab">
                                    <li><a href="#" id="hr-dashboard" style="display: inline-flex;"> <i class="ti-bar-chart-alt"></i>  &nbsp إدارة شؤون الموظفين - الرئيسية   </a></li>
                                 <li><a href="{{route('departments')}}" id="departments" style="display: inline-flex;"><i class="mdi mdi-view-dashboard"></i> &nbsp الاقسام   </a></li>

                                    <li><a href=" {{route('all-employees')}} " id="employees" style="display: inline-flex;"><i class="mdi mdi-account-multiple large"></i> &nbsp الموظفين   </a></li>

                                    <li><a href=" {{route('hr-calendar')}} " id="menu-calendar" style="display: inline-flex;">  <i class="mdi mdi-calendar"></i> &nbsp التقويم  </a></li>
                                 <li><a href="{{route('leave')}}" id="leavs" style="display: inline-flex;">  <i class="mdi mdi-briefcase "></i> &nbsp الإجازات  </a></li>
                                 <li><a href="{{route('login-register')}}" id="login-register" style="display: inline-flex;">  <i class="mdi mdi-login "></i> &nbsp سجلات الدخول  </a></li>

                                    <li><a href=" {{route('activities')}} " id="activities" style="display: inline-flex;">  <i class="mdi mdi-update "></i> &nbsp النشاطات  </a></li>
                                    <li><a href="#" id="hr-reports" style="display: inline-flex;">  <i class="mdi mdi-file-document"></i> &nbsp التقارير </a></li>
                                     <li><a href=" {{route('roles')}} " id="roles" style="display: inline-flex;">  <i class="mdi mdi-settings "></i> &nbsp إدارة </a></li>
                                    
                                </ul><!--end submenu-->
                              
                            </li><!--end has-submenu-->

                                <li class=" d-none has-submenu" id="setting">
                                <a href="javascript:;" class="navbar-link">
                                    <i class="mdi mdi-settings"></i> 
                                     <span id="menu-settings"> &nbsp الأعدادات </span>
                                    
                                    
                                </a>
                                <ul class="submenu submenu-tab">
                                <li><a href="{{route('public-settings')}}" id='public-settings' style="display: inline-flex;" >  <i class="mdi mdi-settings-box"></i> &nbsp الأعدادات العامة </a></li>
                                    <li><a href=" {{route('system-settings')}} " id="system-settings" style="display: inline-flex;" >  <i class="mdi mdi-settings-outline "></i> &nbsp إعدادات النظام </a></li>  
                                    <li><a href="{{route('accounts-settings')}}" id="accounts-settings" style="display: inline-flex;" >  <i class="mdi mdi-settings-outline "></i> &nbsp إعدادات الحسابات </a></li>   
                                </ul>
                            </li><!--end has-submenu-->
                        </ul><!-- End navigation menu -->
                    </div> <!-- end navigation -->
                </div> <!-- end container-fluid -->
            </div> <!-- end navbar-custom -->        
        </div>
        <!-- Top Bar End -->

        <div class="page-wrapper" style="background-image: url('{{asset('assets/images/login-background-4.')}}');  background-size: cover;  background-position: center center; background-repeat:no-repeat">
            <!-- Page Content-->
            <div class="page-content">

                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div id="breadcrumb-float"  class="">
                                    <ol class="breadcrumb">
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
        <i></i>
        <script>
           
           var modules =  @json($modules);
            for (let index = 0; index <  modules.length; index++) {
                if (document.getElementById(modules[index]) != null) {
                    document.getElementById(modules[index]).classList.remove("d-none");     

                }
            }
            var lang =  @json($lang);
            if (lang == "ar") {
                document.getElementById("bar-logo").classList.add("float-right"); 
                document.getElementById("bar-cont-1").classList.add("float-left"); 
                document.getElementById("search-bar").classList.add("float-right"); 



                document.getElementById("menu-home").innerHTML = "الرئيسية";
              document.getElementById("home-page").innerHTML = "<a href='javascript:void(0);' class='ti-home pl-0 pt-0' ></a> &nbsp الصفحة الرئيسية";
              document.getElementById("about").innerHTML = " <a href='javascript:void(0);' class='mdi mdi-shield  pl-0 pt-0'></a>  &nbsp عن المكتب ";
              document.getElementById("common_q").innerHTML = " <a href='javascript:void(0);' class='ti-list pl-0 pt-0'></a> &nbsp الأسئلة الشائعة ";
              document.getElementById("rules").innerHTML = " <a href='javascript:void(0);' class='mdi  mdi-book-multiple-variant pl-0 pt-0'></a>  &nbsp القوانين و التشريعات";
              document.getElementById("library").innerHTML = "<a href='javascript:void(0);' class='mdi mdi-book-open-page-variant pl-0 pt-0'></a> &nbsp المكتبة ";
              document.getElementById("common_cases").innerHTML = "  <a href='javascript:void(0);' class='mdi mdi-transcribe pl-0 pt-0'></a> &nbsp القضايا الشائعة";
              document.getElementById("courts").innerHTML = "   <a href='javascript:void(0);' class='mdi mdi-map-marker-radius pl-0 pt-0'></a> &nbsp عرض المحاكم ";
              document.getElementById("circels").innerHTML = "   <a href='javascript:void(0);' class='mdi mdi-map-marker-radius pl-0 pt-0'></a> &nbsp الدوائر المختصة الأخري  ";

              document.getElementById("menu-clients").innerHTML = "&nbsp  العملاء";
              document.getElementById("m-clients").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-account-multiple pl-0 pt-0"></a> &nbsp العملاء';
             document.getElementById("againsts").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-account-multiple pl-0 pt-0"></a> &nbsp الخصوم';
              document.getElementById("experts").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-account-multiple pl-0 pt-0"></a> &nbsp مكاتب الخبراء ';
              document.getElementById("clients-reports").innerHTML = '<a  href="javascript:void(0);" class="ti-id-badge pl-0 pt-0" ></a>   &nbsp تقارير العملاء';
              document.getElementById("clients-updates").innerHTML = '<a href="javascript:void(0);"  class="ti-id-badge pl-0 pt-0"></a>   &nbsp التحديثات للعملاء';
              document.getElementById("clients-tickets").innerHTML = '<a  href="javascript:void(0);" class="dripicons-ticket pl-0 pt-0"></a>&nbsp طلبات الدعم ';

              document.getElementById("menu-search").innerHTML = "&nbsp  البحث";
              document.getElementById("search-dash").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-magnify pl-0 pt-0"></a> &nbsp لوحة البحث الرئيسية ';
              document.getElementById("clients-search").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-account-search pl-0 pt-0"></a>  &nbsp بحث العملاء ';
              document.getElementById("againsts-search").innerHTML ='<a href="javascript:void(0);"  class="mdi mdi-account-search pl-0 pt-0"></a>  &nbsp بحث الخصوم ';
              document.getElementById("files-search").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-folder-multiple pl-0 pt-0"></a>&nbsp الملفات';
              document.getElementById("main-cases-search").innerHTML ='<a href="javascript:void(0);"  class="mdi mdi-file-find pl-0 pt-0"></a> &nbsp بحث القضايا ';
              document.getElementById("cases-search").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-file-find pl-0 pt-0"></a> &nbsp بحث الدعاوى';

                
              document.getElementById("menu-case-manage").innerHTML = "&nbsp  ادارة القضايا";
              document.getElementById("case-dashboard").innerHTML = '<a href="javascript:void(0);" class="ti-bar-chart-alt pl-0 pt-0"></a> &nbsp  لوحة القضايا الرئيسية   ';
              document.getElementById("files").innerHTML = ' <a href="javascript:void(0);" class="mdi mdi-folder-multiple pl-0 pt-0"></a>&nbsp الملفات ';
              document.getElementById("main-cases").innerHTML =' <a href="javascript:void(0);" class="mdi mdi-file-document pl-0 pt-0"></a>&nbsp القضايا  ';
              document.getElementById("cases").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-chart-timeline pl-0 pt-0"></a> &nbsp الدعاوى ';
              document.getElementById("excutes").innerHTML ='<a href="javascript:void(0);"  class="mdi mdi-chart-timeline pl-0 pt-0"></a> &nbsp التنفيذات ';
              document.getElementById("case-tasks").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-bookmark-check pl-0 pt-0"></a> &nbsp المهام  ';
              if (document.getElementById("case-bills")) {
                document.getElementById("case-bills").innerHTML = '<a href="javascript:void(0);" class="mdi mdi-cash-multiple pl-0 pt-0"> </a> &nbsp الفواتير  ';

                document.getElementById("finance-reports").innerHTML = '<a href="javascript:void(0);" class="mdi mdi-cash-multiple pl-0 pt-0" ></a>   &nbsp التقارير المالية';

              } 

              
              document.getElementById("case-calendar").innerHTML ='<a href="javascript:void(0);" class="mdi mdi-calendar pl-0 pt-0"></a> &nbsp التقويم ';

              document.getElementById("menu-tasks").innerHTML = "&nbsp  المهام";
              document.getElementById("all-tasks").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-checkbox-multiple-marked pl-0 pt-0 "></a>&nbsp جميع المهام';
              document.getElementById("public-tasks").innerHTML = '<a href="javascript:void(0);"  class="ti-list pl-0 pt-0 "></a> &nbsp المهام العامة  ';
              document.getElementById("special-tasks").innerHTML = ' <a href="javascript:void(0);"  class="ti-list pl-0 pt-0 "></a> &nbsp المهام الخاصة ';
              document.getElementById("adminstrative-tasks").innerHTML = '<a  href="javascript:void(0);" class="ti-list pl-0 pt-0 "></a>  &nbsp مهام ادارية ';
              document.getElementById("tasks-reports").innerHTML = '<a href="javascript:void(0);"  class="ti-list pl-0 pt-0 "></a> &nbsp تقارير المهام  </a>';



              document.getElementById("menu-reports").innerHTML = "&nbsp  التقارير";
              if (  document.getElementById("files-reports")) {
                document.getElementById("files-reports").innerHTML = ' <a href="javascript:void(0);" class="mdi mdi-file-document pl-0 pt-0" ></a>  &nbsp تقارير الملفات';
              }
              document.getElementById("stages-schedule").innerHTML = '  <a href="javascript:void(0);" class="mdi mdi-chart-timeline pl-0 pt-0"></a>  &nbsp  جدول الجلسات';
              document.getElementById("experts-stages").innerHTML = '  <a href="javascript:void(0);" class="mdi mdi-file-document pl-0 pt-0"></a>  &nbsp جدول جلسات الخبرة';
              document.getElementById("memoir-schedule").innerHTML = ' <a href="javascript:void(0);" class="mdi mdi-chart-timeline pl-0 pt-0"></a>  &nbsp  جدول المذكرات';



              document.getElementById("menu-noti").innerHTML = "&nbsp  التنبيهات";
              document.getElementById("public-noti").innerHTML = ' <a href="javascript:void(0);"  class="mdi mdi-bell-outline  pl-0 pt-0"></a>  &nbsp التنبيهات العامة ';
              document.getElementById("stages-noti").innerHTML = ' <a href="javascript:void(0);"  class="mdi mdi-bank pl-0 pt-0"></a> &nbsp تنبيهات الجلسات ';
              document.getElementById("short-stages-noti").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-bank pl-0 pt-0 "></a> &nbsp تنبيهات نواقص الجلسات  ';
              document.getElementById("decission-noti").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-hammer pl-0 pt-0 "></a> &nbsp تنبيهات الاحكام';
              document.getElementById("special-noti").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-bell-ring-outline pl-0 pt-0"></a> &nbsp التنبيهات الخاصة';


              
              document.getElementById("menu-mails").innerHTML = "&nbsp المحادثات";
              document.getElementById("mail").innerHTML = ' <a href="javascript:void(0);" class="mdi  mdi-gmail pl-0 pt-0" ></a>  &nbsp البريد';
              document.getElementById("chats").innerHTML = ' <a href="javascript:void(0);" class="ti-comments pl-0 pt-0"></a>  &nbsp المحادثات ';


                
              document.getElementById("menu-settings").innerHTML = "&nbsp الاعدادات";
              document.getElementById("public-settings").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-settings-box pl-0 pt-0 "></a> &nbsp الاعدادت العامة ';
              document.getElementById("system-settings").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-settings-outline  pl-0 pt-0 "></a> &nbsp اعدادات النظام';
              document.getElementById("accounts-settings").innerHTML = ' <a href="javascript:void(0);"  class="mdi mdi-settings-outline  pl-0 pt-0 "></a> &nbsp اعدادات الحسابات  ';

              document.getElementById("menu-hr").innerHTML = "&nbsp ادارة الموظفين";
              document.getElementById("hr-dashboard").innerHTML = '<a  href="javascript:void(0);"  class="ti-bar-chart-alt pl-0 pt-0"></a> &nbsp ادارة الموظفين الرئيسية ';
              document.getElementById("departments").innerHTML = '<a href="javascript:void(0);"   class="mdi mdi-view-dashboard pl-0 pt-0"></a> &nbsp الاقسام  ';
              document.getElementById("employees").innerHTML = '<a  href="javascript:void(0);"  class="mdi mdi-account-multiple large pl-0 pt-0"></a> &nbsp الموظفين ';
              document.getElementById("menu-calendar").innerHTML = '<a href="javascript:void(0);"   class="mdi mdi-calendar pl-0 pt-0"></a> &nbsp التقويم';
              document.getElementById("leavs").innerHTML = '<a  href="javascript:void(0);"  class="mdi mdi-briefcase  pl-0 pt-0"></a> &nbsp الإجازات ';
              document.getElementById("login-register").innerHTML = ' <a href="javascript:void(0);"   class="mdi mdi-login  pl-0 pt-0"></a> &nbsp سجلات الدخول ';
              document.getElementById("activities").innerHTML = '<a  href="javascript:void(0);"  class="mdi mdi-update  pl-0 pt-0"></a> &nbsp النشاطات ';
              document.getElementById("roles").innerHTML = ' <a  href="javascript:void(0);"  class="mdi mdi-settings  pl-0 pt-0"></a> &nbsp ادارة الصلاحيات';
              document.getElementById("hr-reports").innerHTML = '<a  href="javascript:void(0);"  class="mdi mdi-file-document pl-0 pt-0"></a> &nbsp التقارير ';
              
           
            }else{
                
                document.getElementById("bar-logo").classList.add("float-left"); 
                document.getElementById("bar-cont-1").classList.add("float-right"); 
                document.getElementById("search-bar").classList.add("float-left"); 


                document.getElementById("menu-home").innerHTML = "Home";
              document.getElementById("home-page").innerHTML = "<a href='javascript:void(0);' class='ti-home pr-0 pt-0' ></a> &nbsp Home";
              document.getElementById("about").innerHTML = " <a href='javascript:void(0);' class='mdi mdi-shield pr-0 pt-0'></a>  &nbsp About";
              document.getElementById("common_q").innerHTML = " <a href='javascript:void(0);' class='ti-list pr-0 pt-0'></a> &nbsp Commom question";
              document.getElementById("rules").innerHTML = " <a href='javascript:void(0);'  class='mdi  mdi-book-multiple-variant pr-0 pt-0'></a>  &nbsp Rules and regulations";
              document.getElementById("library").innerHTML = "<a href='javascript:void(0);' class='mdi mdi-book-open-page-variant pr-0 pt-0'></a> &nbsp Library ";
              document.getElementById("common_cases").innerHTML = "  <a href='javascript:void(0);' class='mdi mdi-transcribe pr-0 pt-0'></a> &nbsp  Common Cases";
              document.getElementById("courts").innerHTML = "   <a href='javascript:void(0);' class='mdi mdi-map-marker-radius pr-0 pt-0'></a> &nbsp Courts ";
              document.getElementById("circels").innerHTML = "   <a href='javascript:void(0);' class='mdi mdi-map-marker-radius pr-0 pt-0'></a> &nbsp Departments of jurisdiction  ";

              document.getElementById("menu-clients").innerHTML = "&nbsp  Clients";
              document.getElementById("m-clients").innerHTML = '<a href="javascript:void(0);" class="mdi mdi-account-multiple pr-0 pt-0"></a> &nbsp Clients';
              document.getElementById("againsts").innerHTML = '<a href="javascript:void(0);" class="mdi mdi-account-multiple pr-0 pt-0"></a> &nbsp Againsts';
              document.getElementById("experts").innerHTML = '<a href="javascript:void(0);" class="mdi mdi-account-multiple pr-0 pt-0"></a> &nbsp Experts offices ';
              document.getElementById("clients-reports").innerHTML = '<a href="javascript:void(0);" class="ti-id-badge pr-0 pt-0" ></a>   &nbsp Clients reports';
              document.getElementById("clients-updates").innerHTML = '<a href="javascript:void(0);" class="ti-id-badge pr-0 pt-0"></a>   &nbsp Clients updates';
              document.getElementById("clients-tickets").innerHTML = '<a href="javascript:void(0);" class="dripicons-ticket pr-0 pt-0"></a>&nbsp Clients supports ';


              document.getElementById("menu-search").innerHTML = "&nbsp  Search";
              document.getElementById("case-dashboard").innerHTML = '<a  href="javascript:void(0);" class="ti-bar-chart-alt pr-0 pt-0"></a> &nbsp  Search dashboard   ';
              document.getElementById("clients-search").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-account-search pr-0 pt-0"></a>  &nbsp Clients search ';
              document.getElementById("againsts-search").innerHTML ='<a href="javascript:void(0);"  class="mdi mdi-account-search pr-0 pt-0"></a>  &nbsp Againsts search ';
              document.getElementById("files-search").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-folder-multiple pr-0 pt-0"></a>&nbsp Files search';
              document.getElementById("main-cases-search").innerHTML ='<a  href="javascript:void(0);" class="mdi mdi-file-find pr-0 pt-0"></a> &nbsp Main cases search ';
              document.getElementById("cases-search").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-file-find pr-0 pt-0"></a> &nbsp Cases search';

              document.getElementById("menu-case-manage").innerHTML = "&nbsp  Cases manage";
              document.getElementById("case-dashboard").innerHTML = '<a href="javascript:void(0);"  class="ti-bar-chart-alt pr-0 pt-0"></a> &nbsp Cases dahsboard   ';
              document.getElementById("files").innerHTML = ' <a  href="javascript:void(0);" class="mdi mdi-folder-multiple pr-0 pt-0"></a> &nbsp Files ';
              document.getElementById("main-cases").innerHTML =' <a href="javascript:void(0);"  class="mdi mdi-file-document pr-0 pt-0"></a>&nbsp Main cases  ';
              document.getElementById("cases").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-chart-timeline pr-0 pt-0"></a> &nbsp Cases ';
              document.getElementById("excutes").innerHTML ='<a  href="javascript:void(0);" class="mdi mdi-chart-timeline pr-0 pt-0"></a> &nbsp Excutes ';
              document.getElementById("case-tasks").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-bookmark-check pr-0 pt-0"></a> &nbsp Tasks  ';
              
              if (document.getElementById("case-bills")) {
              document.getElementById("case-bills").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-cash-multiple pr-0 pt-0"></a> &nbsp Bills  ';
              document.getElementById("files-reports").innerHTML = ' <a href="javascript:void(0);"  class="mdi mdi-file-document pr-0 pt-0" ></a>  &nbsp Files reports';
              document.getElementById("register-reports").innerHTML = ' <a href="javascript:void(0);"  class="ti-file pr-0 pt-0"></a>  &nbsp Register reports';
              document.getElementById("finance-reports").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-cash-multiple pr-0 pt-0" ></a>   &nbsp Finance reports';

              }
              document.getElementById("case-calendar").innerHTML ='<a href="javascript:void(0);" class="mdi mdi-calendar pr-0 pt-0"></a> &nbsp Calendar ';
            
              document.getElementById("menu-tasks").innerHTML = "&nbsp  Tasks";
              document.getElementById("all-tasks").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-checkbox-multiple-marked pr-0 pt-0"></a>&nbsp all tasks';
              document.getElementById("public-tasks").innerHTML = '<a  href="javascript:void(0);" class="ti-list pr-0 pt-0"></a> &nbsp public tasks  ';
              document.getElementById("special-tasks").innerHTML = ' <a href="javascript:void(0);"  class="ti-list pr-0 pt-0"></a> &nbsp Specific tasks ';
              document.getElementById("adminstrative-tasks").innerHTML = '<a href="javascript:void(0);"  class="ti-list pr-0 pt-0"></a>  &nbsp Adminstrative tasks';
              document.getElementById("tasks-reports").innerHTML = '<a href="javascript:void(0);"  class="ti-list pr-0 pt-0"></a> &nbsp Tasks reports  </a>';


              document.getElementById("menu-reports").innerHTML = "&nbsp  Reports";
              if (  document.getElementById("files-reports")) {
                document.getElementById("files-reports").innerHTML = ' <a href="javascript:void(0);"  class="mdi mdi-file-document pr-0 pt-0" ></a>  &nbsp Files Reports';
              }
              document.getElementById("stages-schedule").innerHTML = '  <a  href="javascript:void(0);" class="mdi mdi-chart-timeline pr-0 pt-0"></a>  &nbsp  Stages schedule';
              document.getElementById("experts-stages").innerHTML = '  <a  href="javascript:void(0);" class="mdi mdi-file-document pr-0 pt-0"></a>  &nbsp Experts hearings schedule';
              document.getElementById("memoir-schedule").innerHTML = ' <a href="javascript:void(0);"  class="mdi mdi-chart-timeline pr-0 pt-0"></a>  &nbsp  Memoir schedule';

              document.getElementById("menu-noti").innerHTML = "&nbsp  Notifications";
              document.getElementById("public-noti").innerHTML = ' <a href="javascript:void(0);"  class="mdi mdi-bell-outline  pr-0 pt-0"></a>  &nbsp Public notifications ';
              document.getElementById("stages-noti").innerHTML = ' <a href="javascript:void(0);"  class="mdi mdi-bank pr-0 pt-0"></a> &nbsp Stages notifactions ';
              document.getElementById("short-stages-noti").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-bank  pr-0 pt-0"></a> &nbsp Short stages notifications ';
              document.getElementById("decission-noti").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-hammer pr-0 pt-0 "></a> &nbsp Decisions notifcations';
              document.getElementById("special-noti").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-bell-ring-outline pr-0 pt-0"></a> &nbsp  Direct notifications';
             
              document.getElementById("menu-mails").innerHTML = "&nbsp Chats";
              document.getElementById("mail").innerHTML = ' <a href="javascript:void(0);" class="mdi  mdi-gmail pr-0 pt-0" ></a>  &nbsp Mails';
              document.getElementById("chats").innerHTML = ' <a href="javascript:void(0);" class="ti-comments pr-0 pt-0"></a>  &nbsp Chats ';
              
              document.getElementById("menu-settings").innerHTML = "&nbsp Settings";
              document.getElementById("public-settings").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-settings-box pr-0 pt-0"></a> &nbsp Public settings ';
              document.getElementById("system-settings").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-settings-outline pr-0 pt-0 "></a> &nbsp System settings';
              document.getElementById("accounts-settings").innerHTML = ' <a  href="javascript:void(0);" class="mdi mdi-settings-outline  pr-0 pt-0"></a> &nbsp Accounts settings ';

              document.getElementById("menu-hr").innerHTML = "&nbsp HR";
              document.getElementById("hr-dashboard").innerHTML = '<a href="javascript:void(0);"  class="ti-bar-chart-alt pr-0 pt-0"></a> &nbsp HR-Dashboard ';
              document.getElementById("departments").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-view-dashboard pr-0 pt-0"></a> &nbsp Departments  ';
              document.getElementById("employees").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-account-multiple large pr-0 pt-0"></a> &nbsp All employees ';
              document.getElementById("menu-calendar").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-calendar pr-0 pt-0"></a> &nbsp Calendar';
              document.getElementById("leavs").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-briefcase  pr-0 pt-0"></a> &nbsp Leaves ';
              document.getElementById("login-register").innerHTML = ' <a href="javascript:void(0);"  class="mdi mdi-login  pr-0 pt-0"></a> &nbsp Login register ';
              document.getElementById("activities").innerHTML = '<a  href="javascript:void(0);" class="mdi mdi-update  pr-0 pt-0"></a> &nbsp Activities ';
              document.getElementById("roles").innerHTML = ' <a href="javascript:void(0);"  class="mdi mdi-settings  pr-0 pt-0"></a> &nbsp Roles & permission';
              document.getElementById("hr-reports").innerHTML = '<a href="javascript:void(0);"  class="mdi mdi-file-document pr-0 pt-0"></a> &nbsp Reports ';

            }

           
        </script>
      
         
          <!-- jQuery  -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/js/waves.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

         <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>

       

        @yield('page-script')
        {{-- <!--Plugins-->
        <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
        <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
        <script src="{{asset('assets/plugins/apexcharts/apexcharts.min.js')}}"></script> --}}
 

   
       
        {{-- <script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
         <script src="{{asset('assets/pages/jquery.profile.init.js')}}"></script>
        <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/plugins/peity-chart/jquery.peity.min.js')}}"></script>
        
        <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
        <script src="{{asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>

        <script src="{{asset('assets/pages/jquery.ana_customers.inity.js')}}"></script>


        <script src="{{asset('assets/pages/jquery.projects_dashboard.init.js')}}"></script>

        <script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
        <script src="{{asset('assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.crm_leads.init.js')}}"></script> --}}

        {{-- <!-- Required datatable js -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="../assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables/jszip.min.js"></script>
        <script src="../assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="../assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.datatable.init.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.forms-advanced.js')}}"></script> --}}
        
        {{-- <script src="../assets/plugins/tiny-editable/mindmup-editabletable.js"></script>
        <script src="../assets/plugins/tiny-editable/numeric-input-example.js"></script>
        <script src="../assets/plugins/tabledit/jquery.tabledit.js"></script> 
        <script src="../assets/pages/jquery.tabledit.init.js"></script> 

        <script src="../assets/pages/jquery.projects_task.init.js"></script> --}}


        {{-- <script src="../assets/pages/jquery.projects_dashboard.init.js"></script>
           <!-- google maps api -->
           <script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>
           <!-- Gmaps file -->
           <script src="{{asset('assets/plugins/gmaps/gmaps.min.js')}}"></script>
           <!-- demo codes -->
           <script src="{{asset('assets/pages/jquery.gmaps.init.js')}}"></script>  --}}

       
      
       
    </body>
</html>
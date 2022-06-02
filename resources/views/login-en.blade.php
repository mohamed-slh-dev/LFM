<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="utf-8" />
        <title>LFM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.png">

        <!-- App css -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />

        <style>
            body{
                text-align: left;
                direction: ltr;
            }
        </style>

    </head>

    <body class="account-body accountbg">
        <div class="col-12 text-center vh-30 mb-5" style="background-color: #ffffff4d;">
            <div class="row">
                <div class="col-3">
                    <li class="hidden-sm pt-3" style="list-style-type: none;">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                         
                            Language <img src="{{asset('assets/images/flags/us_flag.jpg')}}" class="mx-2" height="16" alt=""/> <i class="mdi mdi-chevron-down"></i> 
        
                           
                        </a>
                        <div class="dropdown-menu dropdown-menu-left">
                            <a class="dropdown-item" href="{{url('lang-ar-login')}}"><span> عربي </span><img src="{{asset('assets/images/flags/UAE_flag.jpg')}}" alt="" class="mx-2 float-left" height="14"/></a>
        
                            <a class="dropdown-item" href="{{url('lang-eng-login')}}"><span> English </span><img src="{{asset('assets/images/flags/us_flag.jpg')}}" alt="" class="mx-2 float-left" height="14"/></a>
                        </div>
                    </li><!--end li-->
                </div>
                <div class="col-6">
                    <img src=" {{asset('assets/images/LFM-logo-1.png')}} " width="180" height="130" alt="">

                </div>
                <div class="col-3"></div>
            </div>
           
        </div>
        <!-- Log In page -->
        <div class="row vh-80 ">
            <div class="col-12 align-self-center">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg" style="background-color: #ffffff4d;">
                        <div class="card-body ">
                            <div class="px-3">
                            <div class="auth-page">
                                <div class="card auth-card shadow-lg" style="background-color: #ffffff4d; ">
                                    <div class="card-body p-1">
                            <div class="px-3">
                               
                                
                                <div class="text-center auth-logo-text">
                                    <h2 class="mt-0 mb-3 " style="color: #2b1c19; font-weight:bold;">Welcome </h2>
                                    <p class=" mb-0" style="color: #2b1c19; font-weight:bold; "> Start Work</p>  
                                </div> <!--end auth-logo-text-->  
                            </div>
                      </div>
                                </div>
                            </div> 
                                <form class="form-horizontal auth-form my-4" method="POST" action="{{ route('login_') }}">
                                    @csrf

                                    @if ($message = Session::get('error'))

                                    <div class="alert alert-danger alert-block">
                                
                                        <button type="button" class="close ml-2 mb-5" data-dismiss="alert">×</button>
                                
                                        <i class="icon fas fa-ban  mt-1"></i> {{ $message }}
                                
                                    </div>
                                
                                    @endif
                                    <div class="form-group">
                                        
                                        <label for="username" style="color: #2b1c19; font-weight:bold;">E-mail</label>
                                        <div class="input-group mb-3">

                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="username" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                                      
                                            <span class="auth-form-icon">
                                                <i class="dripicons-user"></i> 
                                            </span>                                                                                                              
                                            
                                        </div>                                    
                                    </div><!--end form-group--> 
        
                                    <div class="form-group">
                                        <label for="userpassword" style="color: #2b1c19; font-weight:bold;">Password</label>                                            
                                        <div class="input-group mb-3"> 
                                                                                                 
                                            <input type="password" class="form-control  @error('password') is-invalid @enderror" id="userpassword"  name="password" required autocomplete="current-password" placeholder="Enter your password"> 
                                         
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i> 
                                            </span> 
                                        </div>                               
                                    </div><!--end form-group--> 
        
                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit">login <i class="fas fa-sign-in-alt ml-1"></i> </button>
                                        </div><!--end col--> 
                                    </div> <!--end form-group-->                           
                                </form><!--end form-->
                            </div><!--end /div-->
                            <div class="row">
                                <div class="col-6 text-center">
                                    <a href="{{route('login')}}">
                                        <button class="btn btn-light btn-round">
                                           Login as employee
                                        </button>
                                       
                                    </a>
                                </div>
                                <div class="col-6 text-center">
                                <a href="{{route('client-login')}}">
                                        <button class="btn btn-light btn-round">
                                           Login as client
                                       </button>
                                      
                                    </a>
                                </div>
                            </div>
                         
                        </div><!--end card-body-->
                    </div><!--end card-->
                    
                </div><!--end auth-page-->
            </div><!--end col-->  
                 
        </div><!--end row-->
        
        <h4 class="text-center" style="color: black">   Powered By <span style=""> <a href="http://truth.ae" target="_blank">
            <img src="{{asset('assets/images/truth-logo-1.png')}}" alt="">
        </a>
           </span> </h4>   
        <!-- End Log In page -->
    

        <!-- jQuery  -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/metisMenu.min.js"></script>
        <script src="../assets/js/waves.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.js"></script>

        @if (session('lang') == 'ar')
        {{-- <script>
            window.location.href = '/login'; //dashboard of restaurant            
        </script> --}}
    @else
    {{-- <script>
        window.location.href = '/login-en'; //dashboard of restaurant            
    </script> --}}
    @endif

    </body>
</html>
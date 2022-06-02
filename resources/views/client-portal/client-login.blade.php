
<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="utf-8" />
        <title>LFM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- App css -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="account-body accountbg">
        <div class="col-12 text-center vh-30 mb-5" style="background-color: #ffffff4d;">
            <img src=" {{asset('assets/images/LFM-logo.gif')}} " width="180" height="130" alt="">
            </div>
        <!-- Log In page -->
        <div class="row vh-80 ">
           
            <div class="col-12 align-self-center">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg" style="background-color: #ffffff4d;">
                        <div class="card-body">
                            
                            <div class="px-3">
                               
                                <div class="auth-page">
                                    <div class="card auth-card shadow-lg" style="background-color: #ffffff4d;">
                                        <div class="card-body p-1">
                                            
                                            <div class="">
                                <div class="text-center auth-logo-text">
                                    <h4 class="mt-0 mb-3 font-18">مرحبا بك في منصة ناصر الشامسي للمحاماة <br> نحن ندافع عن حقوقك
                                    </h4>
                                   
                                </div> <!--end auth-logo-text-->  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">

                                    <button type="button" class="close" data-dismiss="alert">×</button>
                            
                                    <i class="icon fas fa-ban"></i> {{ $message }}
                            
                                </div>
                                @endif
                                <form class="form-horizontal auth-form my-4" method="POST" action="{{ route('client-login-check') }}">
                                    @csrf
                                    <div class="form-group">
                                        
                                        <label for="username">البريدالألكتروني</label>
                                        <div class="input-group mb-3">

                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="username" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="البريدالألكتروني">
                                      
                                            <span class="auth-form-icon">
                                                <i class="dripicons-user"></i> 
                                            </span>                                                                                                              
                                            
                                        </div>                                    
                                    </div><!--end form-group--> 
        
                                    <div class="form-group">
                                        <label for="userpassword">كلمة المرور</label>                                            
                                        <div class="input-group mb-3"> 
                                                                                                 
                                            <input type="password" class="form-control  @error('password') is-invalid @enderror" id="userpassword"  name="password" required autocomplete="current-password" placeholder="كلمة المرور"> 
                                           
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i> 
                                            </span> 
                                        </div>                               
                                    </div>
        
                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit"><i class="fas fa-sign-in-alt ml-1"></i> تسجيل دخول </button>
                                        </div><!--end col--> 
                                    </div> <!--end form-group-->                           
                                </form><!--end form-->

                            </div><!--end /div-->
                            <div class="row">
                                <div class="col-6 text-center">
                                    <a href="{{route('login')}}">
                                        <button class="btn btn-light btn-round">
                                            الدخول كموظف
                                        </button>
                                       
                                    </a>
                                </div>
                                <div class="col-6 text-center">
                                <a href="{{route('client-login')}}">
                                        <button class="btn btn-light btn-round">
                                            الدخول كعميل
                                       </button>
                                      
                                    </a>
                                </div>
                            </div>
                         
                        </div><!--end card-body-->
                    </div><!--end card-->
                    
                </div><!--end auth-page-->
            </div><!--end col-->           
        </div><!--end row-->
        <!-- End Log In page -->
    

        <!-- jQuery  -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/metisMenu.min.js"></script>
        <script src="../assets/js/waves.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.js"></script>

    </body>
</html>
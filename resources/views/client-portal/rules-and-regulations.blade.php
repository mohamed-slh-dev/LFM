@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>

@endsection

@section('page-name')
   
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <img class="card-img-top img-fluid" src="../assets/images/Laws/new law.png" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title mt-0" id="box-1">التشريعات الصادرة حديثا</h4>
                <p class="card-text text-muted font-13"></p>
                <a href="https://www.moj.gov.ae/ar/laws-and-legislation/latest-legislations-and-laws.aspx#page=1" target="_blank"  class="btn btn-primary btn-square" id="btn-1"></a>   
            </div><!--end card -body-->
        </div><!--end card-->
    </div><!--end col-->

    <div class="col-lg-4">
        <div class="card" id="img_card">
            <img class="card-img-top img-fluid" src="../assets/images/Laws/law gate.png" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title mt-0" id="box-2">بوابة التشريعات و القوانيين</h4>
                <p class="card-text text-muted font-13"></p>
                <a href="https://elaws.moj.gov.ae/HomePages/indexAR.aspx"  target="_blank"  class="btn btn-primary btn-square" id="btn-2"></a>   
            </div><!--end card -body-->
        </div><!--end card-->
    </div><!--end col-->

    <div class="col-lg-4">
        <div class="card">
            <img class="card-img-top img-fluid" src="../assets/images/Laws/global laws.png" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title mt-0" id="box-3">ادارة التعاون الدولي</h4>
                <p class="card-text text-muted font-13"></p>
                <a href="https://www.moj.gov.ae/ar/laws-and-legislation/international-cooperation-department.aspx" target="_blank" class="btn btn-primary btn-square" id="btn-3"></a>   
            </div><!--end card -body-->
        </div><!--end card-->
    </div><!--end col-->

                        <div class="col-lg-4">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="../assets/images/Laws/court law.png" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title mt-0" id="box-4">احكام المحاكم</h4>
                                    <p class="card-text text-muted font-13"></p>
                                    <a href="https://www.moj.gov.ae/ar/laws-and-legislation/court-judgments.aspx#page=1" target="_blank"  class="btn btn-primary btn-square" id="btn-4"></a>   
                                </div><!--end card -body-->
                            </div><!--end card-->
                        </div><!--end col-->

                        <div class="col-lg-4">
                            <div class="card" id="img_card">
                                <img class="card-img-top img-fluid" src="../assets/images/Laws/Erhab list.png"  alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title mt-0" id="box-5">قوائم الارهاب</h4>
                                    <p class="card-text text-muted font-13"></p>
                                    <a href="https://www.moj.gov.ae/ar/laws-and-legislation/list-of-terrorists.aspx#page=1" target="_blank"  class="btn btn-primary btn-square" id="btn-5"></a>   
                                </div><!--end card -body-->
                            </div><!--end card-->
                        </div><!--end col-->

  </div>

  @section('page-script')
      

    <script>
        
     if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "الرئيسية"; 
    document.getElementById("breadcrumb-2").innerHTML = " القوانين و التشريعات"; 

    document.getElementById("page-name").innerHTML = "القوانين و التشريعات";

   document.getElementById("btn-1").innerHTML = "ابحث";
   document.getElementById("btn-2").innerHTML = "ابحث";
   document.getElementById("btn-3").innerHTML = "ابحث";
   document.getElementById("btn-4").innerHTML = "ابحث";
   document.getElementById("btn-5").innerHTML = "ابحث";


     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 

    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "Home";
    document.getElementById("breadcrumb-1").innerHTML = "Rules and regulation";

     document.getElementById("page-name").innerHTML = "RULES AND REGULATION";

     document.getElementById("btn-1").innerHTML = "search";
     document.getElementById("btn-2").innerHTML = "search";
     document.getElementById("btn-3").innerHTML = "search";
     document.getElementById("btn-4").innerHTML = "search";
     document.getElementById("btn-5").innerHTML = "search";


     document.getElementById("box-1").innerHTML = "law and regulation issued recently ";
     document.getElementById("box-2").innerHTML = "law gates ";
     document.getElementById("box-3").innerHTML = "Department of International Cooperation ";
     document.getElementById("box-4").innerHTML = "Court rulings ";
     document.getElementById("box-5").innerHTML = "courts judgment ";

     }
    </script>
      @endsection

@endsection
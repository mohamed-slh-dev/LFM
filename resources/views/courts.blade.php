@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
    
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">        
                <h4 class="mt-0 header-title" id="c1-title"> </h4>
                <p class="text-muted mb-3" id="c1-desc">    </p>        
                <div id="gmaps-markers" class="gmaps"></div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!-- end col -->
      <div class="col-lg-6">
        <div class="card">
            <div class="card-body">        
                <h4 class="mt-0 header-title" id="c2-title"> </h4>
                <p class="text-muted mb-3"  id="c2-desc"></p>        
                <div id="gmaps-overlay" class="gmaps"></div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!-- end col -->
      <div class="col-lg-6">
        <div class="card">
            <div class="card-body">        
                <h4 class="mt-0 header-title"  id="c3-title"></h4>
                <p class="text-muted mb-3"  id="c3-desc"></p>        
                <div id="gmaps-markers" class="gmaps"></div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!-- end col -->
      <div class="col-lg-6">
        <div class="card">
            <div class="card-body">        
                <h4 class="mt-0 header-title"  id="c4-title"></h4>
                <p class="text-muted mb-3"  id="c4-desc"></p>        
                <div id="gmaps-markers" class="gmaps"></div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!-- end col -->
</div>

@section('page-script')
    

<script>
   
     if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "الرئيسية"; 
    document.getElementById("breadcrumb-2").innerHTML = " المحاكم"; 
    document.getElementById("page-name").innerHTML = "عرض المحاكم";

    document.getElementById("c1-title").innerHTML = "محكمة الشارقة"; 
    document.getElementById("c1-desc").innerHTML = "وصف كتابي للمكمة"; 

    document.getElementById("c2-title").innerHTML = "محكمة دبي"; 
    document.getElementById("c2-desc").innerHTML = "وصف كتابي للمكمة"; 

    
    document.getElementById("c3-title").innerHTML = " محكمة الأسرة و الطفل"; 
    document.getElementById("c3-desc").innerHTML = "وصف كتابي للمكمة"; 

    document.getElementById("c4-title").innerHTML = " محكمة العين"; 
    document.getElementById("c4-desc").innerHTML = "وصف كتابي للمكمة"; 


     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "home";
    document.getElementById("breadcrumb-1").innerHTML = "courts";

     document.getElementById("page-name").innerHTML = "VIEW COURTS";

     document.getElementById("c1-title").innerHTML = "Sharjah Court "; 
    document.getElementById("c1-desc").innerHTML = "Written description of the court "; 

    document.getElementById("c2-title").innerHTML = "Dubai Court "; 
    document.getElementById("c2-desc").innerHTML = "Written description of the court "; 

    
    document.getElementById("c3-title").innerHTML = "Family and Child Court "; 
    document.getElementById("c3-desc").innerHTML = "Written description of the court "; 

    document.getElementById("c4-title").innerHTML = "Al Ain Court "; 
    document.getElementById("c4-desc").innerHTML = "Written description of the court "; 
     }
</script>
@endsection


@endsection
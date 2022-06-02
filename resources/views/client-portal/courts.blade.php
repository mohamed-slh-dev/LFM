@extends('layouts.client-layout')

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
              
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe width="600" height="450" id="gmap_canvas" src="https://maps.google.com/maps?q=Sharjah%20Court&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                            </iframe>
                        <br>
                    </div>
                </div>
              
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!-- end col -->
      <div class="col-lg-6">
        <div class="card">
            <div class="card-body">        
                <h4 class="mt-0 header-title" id="c2-title"> </h4>
                <p class="text-muted mb-3"  id="c2-desc"></p>        
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="450" id="gmap_canvas" src="https://maps.google.com/maps?q=Dubai%20Court&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                </iframe>
                   </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!-- end col -->
      <div class="col-lg-6">
        <div class="card">
            <div class="card-body">        
                <h4 class="mt-0 header-title"  id="c3-title"></h4>
                <p class="text-muted mb-3"  id="c3-desc"></p>        
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Abu%20Dhabi%20Judicial%20Department%20(%20Abu%20Dhabi%20Court%20of%20First%20Instance%20&%20Abu%20Dhabi%20Appeal%20Court%20)&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
            </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!-- end col -->
      <div class="col-lg-6">
        <div class="card">
            <div class="card-body">        
                <h4 class="mt-0 header-title"  id="c4-title"></h4>
                <p class="text-muted mb-3"  id="c4-desc"></p>        
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Al%20Ain%20Public%20Prosecution&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    <br>
                  </div>
                </div>
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
    document.getElementById("c1-desc").innerHTML = ""; 

    document.getElementById("c2-title").innerHTML = "محكمة دبي"; 
    document.getElementById("c2-desc").innerHTML = ""; 

    
    document.getElementById("c3-title").innerHTML = " محكمة ابوظبي"; 
    document.getElementById("c3-desc").innerHTML = ""; 

    document.getElementById("c4-title").innerHTML = " محكمة العين"; 
    document.getElementById("c4-desc").innerHTML = ""; 


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

    
    document.getElementById("c3-title").innerHTML = "Abu Dhabi Court "; 
    document.getElementById("c3-desc").innerHTML = "Written description of the court "; 

    document.getElementById("c4-title").innerHTML = "Al Ain Court "; 
    document.getElementById("c4-desc").innerHTML = "Written description of the court "; 
     }
</script>
@endsection


@endsection
@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
الدوائر المختصة الاخرى
@endsection

@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">        
                <h4 class="mt-0 header-title" id="c1-title"> </h4>
                <p class="text-muted mb-3" id="c1-desc">    </p>        
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Department%20of%20Community%20Development&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div></div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!-- end col -->
      <div class="col-lg-6">
        <div class="card">
            <div class="card-body">        
                <h4 class="mt-0 header-title" id="c2-title"> </h4>
                <p class="text-muted mb-3"  id="c2-desc"></p>       
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Abu%20Dhabi%20Judicial%20Department%20(%20Abu%20Dhabi%20Court%20of%20First%20Instance%20&%20Abu%20Dhabi%20Appeal%20Court%20)&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
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
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=The%20Government%20of%20Dubai%20Legal%20Affairs%20Department&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
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
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Department%20of%20Land%20and%20Property%20in%20Dubai&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
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
document.getElementById("breadcrumb-2").innerHTML = "الدوائر المختصة الاخرى"; 

document.getElementById("page-name").innerHTML = "الدوائر المختصة";

document.getElementById("c1-title").innerHTML = "دائرة تنمية المجتمع"; 
    document.getElementById("c1-desc").innerHTML = ""; 

    document.getElementById("c2-title").innerHTML = "دائرة القضاء في أبوظبي "; 
    document.getElementById("c2-desc").innerHTML = ""; 

    
    document.getElementById("c3-title").innerHTML = " دائرة الشؤون القانونية لحكومة دبي "; 
    document.getElementById("c3-desc").innerHTML = ""; 

    document.getElementById("c4-title").innerHTML = "دائرة الأراضي والأملاك في دبي "; 
    document.getElementById("c4-desc").innerHTML = ""; 
}else{
    document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "home";
document.getElementById("breadcrumb-1").innerHTML = "other departments of jurisdictions";

document.getElementById("page-name").innerHTML = "DEPARTMENTS OF JURISDICTIONS"; 


document.getElementById("c1-title").innerHTML = "Department of Community Development"; 
    document.getElementById("c1-desc").innerHTML = " "; 

    document.getElementById("c2-title").innerHTML = "Abu Dhabi Judicial Department  "; 
    document.getElementById("c2-desc").innerHTML = " "; 

    
    document.getElementById("c3-title").innerHTML = "The Government of Dubai Legal Affairs Department "; 
    document.getElementById("c3-desc").innerHTML = " "; 

    document.getElementById("c4-title").innerHTML = "Department of Land and Property in Dubai"; 
    document.getElementById("c4-desc").innerHTML = ""; 
}
</script>
@endsection


@endsection
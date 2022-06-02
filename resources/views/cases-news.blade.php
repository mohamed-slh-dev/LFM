@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
   
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/OienbTPWxAM"></iframe>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->  
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <img src="../assets/images/small/news-2.jpg" height="90" class="mr-3" alt="...">
                    <div class="media-body align-self-center mr-3">  
                        <div class="mb-2">
                          <span class="badge badge-primary px-3"></span>
                            
                            <span class="ml-2 text-muted">2\8\2020</span>
                        </div>
                        <a href="" class="font-16 d-block font-weight-normal">
                        </a>                                             
                    </div><!--end media body-->
                </div><!--end media-->        
            </div><!--end card-body-->
        </div><!--end card-->
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <img src="../assets/images/small/news-1.jpg" height="90" class="mr-3" alt="...">
                  <div class="media-body align-self-center mr-3">  
                        <div class="mb-2">
                          <span class="badge badge-primary px-3"></span>
                            
                            <span class="ml-2 text-muted">2\9\2020</span>
                        </div>
                        <a href="" class="font-16 d-block font-weight-normal">
                        </a>                                             
                    </div><!--end media body-->
                </div><!--end media-->        
            </div><!--end card-body-->
        </div><!--end card-->
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <img src="../assets/images/small/news-3.jpg" height="90" class="mr-3" alt="...">
                   <div class="media-body align-self-center mr-3">  
                        <div class="mb-2">
                          <span class="badge badge-primary px-3"></span>
                            
                            <span class="ml-2 text-muted">22\8\2012</span>
                        </div>
                        <a href="" class="font-16 d-block font-weight-normal">
                        </a>                                             
                    </div><!--end media body-->
                </div><!--end media-->        
            </div><!--end card-body-->
        </div><!--end card-->
  
    </div> <!--end col-->                          
</div><!--end row-->

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="blog-card">
                    <img src="../assets/images/small/news-1.jpg" alt="" class="img-fluid"/>
                    <div class="meta-box">
                        <ul class="p-0 mt-4 list-inline">
                            <li class="list-inline-item"><span class="badge badge-primary px-3"></span></li>
                            <li class="list-inline-item">2\5\1998</li>
                            <li class="list-inline-item">by <a href=""></a></li>
                        </ul>
                    </div><!--end meta-box-->            
                    <h4 class="mt-2 mb-3">
                        <a href="" class="case-title"></a>
                    </h4>
                    <p class="text-muted case-desc"></p>
                    <a href="#" class="text-primary read">مواصلة القراءة... <i class="fas fa-long-arrow-alt-left"></i></a>
                </div><!--end blog-card-->                                   
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
              <div class="blog-card">
                    <img src="../assets/images/small/news-1.jpg" alt="" class="img-fluid"/>
                    <div class="meta-box">
                        <ul class="p-0 mt-4 list-inline">
                            <li class="list-inline-item"><span class="badge badge-primary px-3"></span></li>
                            <li class="list-inline-item">2\5\2013</li>
                            <li class="list-inline-item">by <a href=""></a></li>
                        </ul>
                    </div><!--end meta-box-->            
                    <h4 class="mt-2 mb-3">
                        <a href="" class="case-title"></a>
                    </h4>
                    <p class="text-muted case-desc"></p>
                    <a href="#" class="text-primary read">مواصلة القراءة... <i class="fas fa-long-arrow-alt-left"></i></a>
                </div><!--end blog-card-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
             <div class="blog-card">
                    <img src="../assets/images/small/news-1.jpg" alt="" class="img-fluid"/>
                    <div class="meta-box">
                        <ul class="p-0 mt-4 list-inline">
                            <li class="list-inline-item"><span class="badge badge-primary px-3"></span></li>
                            <li class="list-inline-item">2\5\2008</li>
                            <li class="list-inline-item">by <a href=""></a></li>
                        </ul>
                    </div><!--end meta-box-->            
                    <h4 class="mt-2 mb-3">
                        <a href="" class="case-title"></a>
                    </h4>
                    <p class="text-muted case-desc"></p>
                    <a href="#" class="text-primary read">مواصلة القراءة... <i class="fas fa-long-arrow-alt-left"></i></a>
                </div><!--end blog-card-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->                           
</div><!--end row-->

@section('page-script')
    

<script>
    
     if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "الرئيسية"; 
    document.getElementById("breadcrumb-2").innerHTML = " القضايا الشائعة"; 
    document.getElementById("page-name").innerHTML = "القضايا الشائعة";
    
var timestampArray = document.getElementsByClassName("badge-primary");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'رقم القضية';
  
}

var timestampArray = document.getElementsByClassName("font-weight-normal");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'وصف مختصر للقضية';
  
}
var timestampArray = document.getElementsByClassName("case-title");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'عنوان القضية';
  
}

var timestampArray = document.getElementsByClassName("case-desc");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'تفاصيل القضية ';
  
}

var timestampArray = document.getElementsByClassName("read");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'مواصلة القراءة... <i class="fas fa-long-arrow-alt-left"></i>';
  
}
     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "home";
    document.getElementById("breadcrumb-1").innerHTML = "commom cases";

     document.getElementById("page-name").innerHTML = "COMMON CASES";
    
     var timestampArray = document.getElementsByClassName("badge-primary");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'case number';
  
}
var timestampArray = document.getElementsByClassName("font-weight-normal");

    for(var i = (timestampArray.length - 1); i >= 0; i--)
    {
        timestampArray[i].innerHTML = 'short description for the case';
    
    }

    
for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Case title';
  
}

var timestampArray = document.getElementsByClassName("case-desc");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Case description ';
  
}

var timestampArray = document.getElementsByClassName("read");

for(var i = (timestampArray.length - 1); i >= 0; i--)
{
    timestampArray[i].innerHTML = 'Read full blog... <i class="fas fa-long-arrow-alt-right"></i>';
  
}

}
   
</script>
@endsection
    
@endsection
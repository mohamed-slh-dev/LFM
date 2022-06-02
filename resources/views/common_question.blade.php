@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
    الاسئلة الشائعة
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8">
        <div class="card" >
            <div class="card-body">
                <h4 class="mt-0 header-title" id="q-title"></h4>
                <p class="text-muted" id="q-sub-title">
                </p>
                <div class="accordion" id="accordionExample-faq">
                    @foreach ($questions as $q)
                        
                  
                    <div class="card shadow-none border mb-1">
                        <div class="card-header" id="headingOne">
                        <h5 class="my-0">
                        <button class="btn btn-link ml-4" type="button" data-toggle="collapse" data-target="#collapse-{{$q->id}}" aria-expanded="true" aria-controls="collapseOne">
                            {{$q->question}}
                            </button>
                        </h5>
                        </div>
                    
                        <div id="collapse-{{$q->id}}" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample-faq">
                        <div class="card-body">
                            {{$q->answer}}
                        </div>
                        </div>
                    </div>
                    @endforeach
                                                                 
                </div><!--end accordion-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
    {{-- <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">لديك مزيد من الأسئلة؟</h4>
                <p class="text-muted">يمكنك ارسال سؤالك الينا و سنقوم بالرد عليك فورا !</p>
                <form>
                    <div class="form-group row">
                        <div class="col-sm-12 col-lg-6  mo-b-15">
                            <input class="form-control" type="text" id="name" placeholder="الأسم">                                                       
                        </div> 
                        <div class="col-sm-12 col-lg-6">
                            <input class="form-control" type="email" id="example-email-input3" placeholder="البريد الألكتروني">
                        </div>                                                   
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="subject2" placeholder="السؤال">                                                       
                        </div>                                                    
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="اضافة تفاصيل..."></textarea>
                    </div>                                                
                   
                    <button type="submit" class="btn btn-primary btn-block px-4">إرسال</button>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col--> --}}
</div><!--end row-->

@section('page-script')
    

<script>
   
     if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "الرئيسية"; 
    document.getElementById("breadcrumb-2").innerHTML = " الاسئلة الشائعة"; 
    document.getElementById("page-name").innerHTML = "الاسئلة الشائعة";

    document.getElementById("q-title").innerHTML = "الاسئلة الشائعة";
    document.getElementById("q-sub-title").innerHTML = "الاسئلة الشائعة و الاجابة عنها";

     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "home";
    document.getElementById("breadcrumb-1").innerHTML = "commom questions";

     document.getElementById("page-name").innerHTML = "COMMON QUESTIONS";

     document.getElementById("q-title").innerHTML = "Common questions";
    document.getElementById("q-sub-title").innerHTML = "some of common questions and the answer for it";
     }
</script>
@endsection

@endsection
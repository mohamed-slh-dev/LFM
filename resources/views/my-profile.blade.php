@extends('layouts.main-layout')

@section('path')
<li class="breadcrumb-item active"><a href="javascript:void(0);">تفاصيل الخصم</a></li>
<li class="breadcrumb-item active">العملاء</li>
@endsection

@section('page-name')
    تفاصيل الخصم
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom  met-pro-bg">
                <div class="met-profile">
                    <div class="row">
                        <div class="col-lg-4 mb-3 mb-lg-0 align-self-center">
                            <div class="met-profile-main">
                                <div class="met-profile-main-pic">
                  <img src="../assets/images/users-imgs/{{$details->avatar}}" alt="" width="130" height="130" class="rounded-circle">
                     
                                </div>
                                <div class="met-profile_user-detail mr-3">
                                    <h5 class="met-user-name">{{$details->name}} </h5>                                                        
                                    <p class="mb-0 met-user-name-post">مستخدم</p>
                                </div>
                            </div>                                                
                        </div><!--end col-->
                        <div class="col-lg-4 mr-auto">
                            <ul class="list-unstyled personal-detail">
                                <li class=""><b><i class="dripicons-phone ml-2 text-info font-18"></i> رقم الهاتف : </b> {{$details->phone}} </li>
                                <li class="mt-2"><b> <i class="dripicons-mail text-info font-18 mt-2 ml-2"></i> البريد الألكتروني </b> : {{$details->email}} </li>
                            </ul>
                            <div class="button-list btn-social-icon">                                                
                                <button type="button" class="btn btn-blue btn-round mr-5">
                                    <i class="fab fa-facebook-f"></i>
                                </button>

                                <button type="button" class="btn btn-secondary btn-round mr-2">
                                    <i class="fab fa-twitter"></i>
                                </button>

                                <button type="button" class="btn btn-pink btn-round  ">
                                    <i class="fab fa-dribbble"></i>
                                </button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end f_profile-->                                                                                
            </div><!--end card-body-->
            <div class="card-body">
                <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                    
                   
                     <li class="nav-item">
                        <a class="nav-link active" id="details" data-toggle="pill" href="#general_detail">البيانات الشخصية</a>
                    </li>
                  
                   
                </ul>        
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->

<div class="row">
    <div class="col-12">
        <div class="tab-content detail-list" id="pills-tabContent">
            <div class="tab-pane fade show active"   id="general_detail">
                <form class="form" action=" {{ url('update-profile/'.$details->id) }}"method="POST" enctype="multipart/form-data" >
                    @csrf
                <div class="row">
                 

                <div class="col-lg-6">

                <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label text-right">الأسم</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="name" type="text" value=" {{$details->name}} " id="example-text-input">
                                </div>
                 </div>

                 <div class="form-group row">
                    <label for="example-number-input" class="col-sm-2 col-form-label text-right">رقم الهاتف</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="phone" type="text" value="{{$details->phone}}" id="example-number-input">
                    </div>
                </div>
               

             

                <div class="form-group row">
                    <label for="example-date-input" class="col-sm-2 col-form-label text-right"> البريد الالكتروني</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                    <input type="email" id="example-input2-group1" name="email" class="form-control" value="{{$details->email}}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                    </div>
                </div>
                    </div>
                </div>
                           
                        
                    
                 </div>
                 <div class="col-lg-3">
                 </div>
            <div class="col-lg-3">
                <div class="form-group row">
                <input type="file" name="avatar" id="input-file-now-custom-1" class="dropify" data-default-file="../assets/images/users-imgs/{{$details->avatar}}"/>
                </div>
            </div>
           
            

             
                            <div class="col-lg-12 text-center">
                            <button class="btn btn-success">حفظ</button>
                            </div> 
                        </div>   
                </form>
                <div class="col-12"> <hr> </div>
                <form class="form" action=" {{ url('update-user-password/'.$details->id) }}"method="POST" >
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="example-date-input" class="col-sm-3 col-form-label text-right"> تحديث كلمة المرور </label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="password"  type="password" >
                                </div>
                            </div> 
    
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-success">تحديث كلمة المرور</button>
                            </div> 
                    </div>
                 
                
                </form> 
</div><!--end general detail-->


        
  
</div><!--end row-->



 
    
@endsection
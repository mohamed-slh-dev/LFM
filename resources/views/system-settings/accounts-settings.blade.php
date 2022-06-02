@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')

@endsection

@section('content')

<div class="row">
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">

          
            <div class="table-responsive">
                <table class="table table-bordered mb-0 table-centered">
                    <thead>
                    <tr>
                    <th>#</th>
                        <th id="th-1">اسم الموظف</th>
                        <th id="th-2">الأيميل</th>
                        <th id="th-3">الهاتف</th>
                      
                        <th class="text-center" id="th-4">تحديث كلمة المرور</th>
                        
                        
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                      
                    <tr>
                        <td> {{$user->id}} </td>
                        <td> {{$user->name}}</td>
                        <td> {{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                      
                    
                        <td class="text-center">
                            <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".edit-{{$user->id}}">
                                <i class="fas fa-edit text-info text-muted font-18" style="cursor: pointer;"></i>
                            </a>                       
                      </td>
                        
                      
                    </tr>
                    @endforeach
                    
                </tbody>
                </table><!--end /table-->
            </div><!--end /tableresponsive-->
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end col -->
</div>
@foreach ($users as $user)
    
<div class="modal fade edit-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('update-password')}}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    @if (Session::get('lang') == "ar")
                    <div class="row">
                        <div class="col-12"> 
                           <div class="form-group row">
                                    
                             
                                      <div class="col-sm-6">
                                       <label for="noe_date" id="pass-label">  كلمة المرور الجديدة</label>
                                        <input type="password" name="new_pass" class="form-control" id="">
                                     </div>
                                 </div>
                              </div>
     
                             <div class="col-12">
                                     <button class="btn btn-sm btn-primary mx-1 font-15" id="update-btn">تحديث</button>
                                 </div> 
                       
     
                          </div> 
                    @else
                    <div class="row">
                        <div class="col-12"> 
                           <div class="form-group row">
                                    
                             
                                      <div class="col-sm-6">
                                       <label for="noe_date" id="pass-label"> Reser Password</label>
                                        <input type="password" name="new_pass" class="form-control" id="">
                                     </div>
                                 </div>
                              </div>
     
                             <div class="col-12">
                                     <button class="btn btn-sm btn-primary mx-1 font-15" id="update-btn">Update</button>
                                 </div> 
                       
     
                          </div> 
                    @endif
            
                </form> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
@endforeach  
@endsection

@section('page-script')

<script>
      if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "الاعدادات"; 
    document.getElementById("breadcrumb-2").innerHTML = "اعدادات الحسابات "; 

    document.getElementById("page-name").innerHTML = "اعدادات الحسابات ";
      }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "settings";
    document.getElementById("breadcrumb-1").innerHTML = "accounts settings";


    document.getElementById("page-name").innerHTML = "ACCOUNTS SETTINGS";

    document.getElementById("th-1").innerHTML = "Employee name";
    document.getElementById("th-2").innerHTML = "E-mail";
    document.getElementById("th-3").innerHTML = "Phone";
    document.getElementById("th-4").innerHTML = "Reset password";

    document.getElementById("pass-label").innerHTML = "New password";
    document.getElementById("update-btn").innerHTML = "Reset password";

      }
</script>
    
@endsection
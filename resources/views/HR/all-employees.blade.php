@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
 
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 ">
                <div class="">
                    <ul class="list-inline pr-0">                                    
                       
                        <li class="list-inline-item">

                        <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg" id="add-emp"><i class="mdi mdi-plus-box mx-2"></i> إضافة موظف جديد</button>

                        </li>
                    </ul>
                </div>                            
            </div><!--end col-->

       



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
                                    <th id="th-4">القسم</th>
                                    <th id="th-5" style="width: 190px;">تفعيل \ تعطيل الحساب</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                  
                                <tr>
                                    <td> {{$user->id}} </td>
                                    <td> {{$user->name}}</td>
                                    <td> {{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td> {{$user->dept_name}}</td>
                                
                                    <td class="text-center">
                                        @if ($user->disabled == 1 )
                                        <a href="{{url('active-user/'.$user->id)}}"><i class="fas fa-check text-success font-16"></i></a>
                                        @else
                                        <a href="{{url('delete-user/'.$user->id)}}"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                        @endif
                                   
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

       <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('add-user') }}">
                        @csrf
                  <div class="row">
                    
            
                      <div class="col-12"> 
                          <div class="form-group row">
                                   
                                    <div class="col-sm-4">
                                       <label id="name">اسم الموظف</label>
                                        <input class="form-control" name="name" type="text" id="example-text-input">
                                    </div>

                                     <div class="col-sm-4">
                                       <label id="phone">رقم الهاتف</label>
                                        <input class="form-control" name="phone"  type="text" id="example-text-input">
                                    </div>
                                    <div class="col-sm-4">
                                        <label id="dept-name"> القسم</label>
                                        <select class="custom-select" name="dept_id">
                                        @foreach ($departments as $dept)
                                        <option value=" {{$dept->id}} "> {{$dept->dept_name}}</option>  
                                        @endforeach
                                        </select>
                                    </div>
                                 

                           </div>
              
                     </div>
                       <div class="col-12"> 
                        <div class="form-group row">
                                   
                                    <div class="col-sm-4">
                                       <label id="email">البريد الألكتروني</label>
                                        <input class="form-control" name="email" type="email" id="example-text-input">
                                    </div>

                                     <div class="col-sm-4">
                                       <label id="pass">كلمة المرور</label>
                                        <input class="form-control" name="password"  type="password" id="example-text-input">
                                    </div>
                                    <div class="col-sm-4">
                                        <label id="role">الصلاحية</label>
                                    <select class="custom-select" name="role_id">
                                        @foreach ($roles as $role)
                                        <option value=" {{$role->id}} "> {{$role->role_name}}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                 

                           </div>
              
                     </div>

                         <div class="col-12"> 
                          <button class="btn btn-sm btn-primary mr-1 font-15" id="add-btn">إضافة الموظف</button>
                         </div> 
                      

                         </div> 
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 
@endsection

@section('page-script')

<script>
    if (lang == "ar") {
        document.body.style.direction = "rtl"; 
        document.body.style.textAlign = "right"; 
    
        document.getElementById("breadcrumb-float").classList.add('float-left');
        document.getElementById("breadcrumb-1").innerHTML = "ادارة الموظفين"; 
        document.getElementById("breadcrumb-2").innerHTML = "جميع الموظفين"; 
    
        document.getElementById("page-name").innerHTML = "جميع الموظفين";
           }else{
            document.body.style.direction = "ltr"; 
        document.body.style.textAlign = "left"; 
        document.getElementById("breadcrumb-float").classList.add('float-right');
        document.getElementById("breadcrumb-2").innerHTML = "hr";
        document.getElementById("breadcrumb-1").innerHTML = "all employees";
    
    
        document.getElementById("page-name").innerHTML = "ALL EMPLOYEES";

       
        document.getElementById("add-emp").innerHTML = ' <i class="mdi mdi-plus-box mx-2"></i> Add new employee';

        document.getElementById("th-1").innerHTML = "Employee name";
        document.getElementById("th-2").innerHTML = "E-mail";
        document.getElementById("th-3").innerHTML = "Phone number";
        document.getElementById("th-4").innerHTML = "Department";
        document.getElementById("th-5").innerHTML = "Delete / Recover Account";

        document.getElementById("name").innerHTML = "Employee name";
        document.getElementById("phone").innerHTML = "Phone";
        document.getElementById("email").innerHTML = "Email";
        document.getElementById("dept-name").innerHTML = "Department";
        document.getElementById("pass").innerHTML = "Password";
        document.getElementById("role").innerHTML = "Role";
        document.getElementById("add-btn").innerHTML = "Add";

           }
</script>
    
@endsection
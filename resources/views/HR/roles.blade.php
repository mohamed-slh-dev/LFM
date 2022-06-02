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

                    <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg" id="add-role"><i class="mdi mdi-plus-box ml-2"></i> إضافة صلاحية جديدة</button>

                    </li>
                </ul>
            </div>                            
        </div><!--end col-->



   <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                  
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                            <tr>
                        
                                <th id="th-1">اسم الصلاحية</th>
                              
                                <th id="th-2" class="text-center">حذف</th>
                               
                                
                                
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                            <tr>
                               <td> {{$role->role_name}} </td>
                              
                                <td class="text-center">
                                   <a href="{{url('delete-role/'.$role->id)}}" class="ml-3"><i class="fas fa-trash text-danger font-16"></i></a>
                                </td>
                                
                              
                            </tr>
                            @endforeach
                         </tbody>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
        <div class="col-lg-6">
            <form action= "{{ route('add-user-permission') }} " method="post">
                @csrf
            <div class="col-lg-12">
                 <div class="card client-card">                               
                    <div class="card-body text-center" >
                          <div class="row">
                            <div class="col-5 pl-0">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="emp-name">اسم الموظف</label>
                                    <div class="col-sm-8">
                                    <select class="custom-select text-right" name="user_id">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                 
                                       
                         </div>
                         <div class="col-4 ">
                            <div class="form-group row">
                             <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="emp-role">الصلاحيات</label>
                             <div class="col-sm-8">
                               <select class="custom-select text-right" name="role_id">
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->role_name}}</option>
                                @endforeach
                                 </select>
                             </div>
                         </div>
                                
                  </div>

                  <div class="col-3  text-center">
                    <button class="btn-sm btn-success waves-effect waves-light m-1" id="add-permission"> اضافة صلاحية </button>
                   </div>

                          </div>

                   </div>
                </div>      
           </div>
       </form>
       <div class="card">
                <div class="card-body">

                  
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                            <tr>
                        
                                <th id="th1-1">اسم الموظف</th>
                                <th id="th1-2">الصلاحية</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($users_permissions as $permission )
                                                    <tr>
                                                      
                                                    <td>{{$permission->name}}</td>
                                                    <td>{{$permission->role_name}}</td>
                                                 
                                                       
                                                        
                                                    </tr>
                                                    @endforeach
                         </tbody>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                </div><!--end card-body-->
            </div><!--end card-->
 </div>
     
   </div>

   <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form novalidate action= "{{ route('add-role') }} " method="post">
                    @csrf
              <div class="row">
                
                <div class="col-12 mt-2"> 
                    <div class="col-sm-4">
                                <label id="add-perm-title">اسم الصلاحية</label>
                                 <input class="form-control" name="role_name" type="text" id="example-text-input">
                             </div>
                             <br>

                  </div> 
              <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                            <tr>

                                <th id="add-perm-module">اسم القسم</th>
                                <th id="add-perm-view">عرض</th>

                          </tr>
                            </thead>
                            <tbody>
                            <tr>
                               
                                <td id="add-perm-home">الرئيسية</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="1" id="1">
                                <label class="custom-control-label text-muted" for="1"></label>
                            </div> 
                                </td>
                               
                              
                            </tr>

                            <tr>
                                <td id="add-perm-client">العملاء</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="2" id="2">
                                <label class="custom-control-label text-muted" for="2"></label>
                            </div> 
                                </td>
                          
          
                              
                              
                            </tr>

                            <tr>
                                <td id="add-perm-search">البحث</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="3" id="3">
                                <label class="custom-control-label text-muted" for="3"></label>
                            </div> 
                                </td>
          
                              
                            </tr>

                            <tr>
                                 
                                <td id="add-perm-cm">ادارة القضايا</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="4" id="4">
                                <label class="custom-control-label text-muted" for="4"></label>
                            </div> 
                                </td>
          
                              
                            </tr>
                            <tr>
                                 
                                <td id="add-perm-tasks">المهام</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="5" id="5">
                                <label class="custom-control-label text-muted" for="5"></label>
                            </div> 
                                </td>
          
                              
                            </tr>
                            <tr>
                                 
                                <td id="add-perm-reports">التقارير</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="6" id="6">
                                <label class="custom-control-label text-muted" for="6"></label>
                            </div> 
                                </td>
          
                              
                            </tr>
                            <tr>
                                 
                                <td id="add-perm-noti">التنبيهات</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="7" id="7">
                                <label class="custom-control-label text-muted" for="7"></label>
                            </div> 
                                </td>
          
                              
                            </tr>
                            <tr>
                                 
                                <td id="add-perm-chats">البريد و المحاداثات</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="8" id="8">
                                <label class="custom-control-label text-muted" for="8"></label>
                            </div> 
                                </td>
          
                              
                            </tr>
                            <tr>
                                 
                                <td id="add-perm-hr">ادارة الموظفين</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="9" id="9">
                                <label class="custom-control-label text-muted" for="9"></label>
                            </div> 
                                </td>
          
                              
                            </tr>

                            <tr>
                                 
                                <td id="add-perm-settings"> الاعدادات</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="10" id="10">
                                <label class="custom-control-label text-muted" for="10"></label>
                            </div> 
                                </td>
          
                              
                            </tr>

                            <hr>
                          

                            <tr>
                                 
                                <td id="add-perm-add-client"> اضافة (عميل\خصم)</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="11" id="11">
                                <label class="custom-control-label text-muted" for="11"></label>
                            </div> 
                                </td>
          
                              
                            </tr>
                            <tr>
                                 
                                <td id="add-perm-add-file"> اضافة ملف</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="12" id="12">
                                <label class="custom-control-label text-muted" for="12"></label>
                            </div> 
                                </td>
          
                              
                            </tr>
                            <tr>
                                 
                                <td id="add-perm-add-case"> اضافة قضية</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="13" id="13">
                                <label class="custom-control-label text-muted" for="13"></label>
                            </div> 
                                </td>
          
                              
                            </tr>

                            <tr>
                                 
                                <td id="add-perm-add-stage"> اضافة دعوى</td>
                                <td> 
                                <div class="custom-control custom-switch switch-success">
                                <input type="checkbox" class="custom-control-input" value="1" name="14" id="14">
                                <label class="custom-control-label text-muted" for="14"></label>
                            </div> 
                                </td>
          
                              
                            </tr>
                            

                            
                            </tbody>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                 <div class="col-12 mt-2"> 
                       
                                <button class="btn btn-sm btn-primary mt-2 font-15" id="add-perm-btn1">إضافة الصلاحية</button>

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
        document.getElementById("breadcrumb-2").innerHTML = "الادارة"; 
    
        document.getElementById("page-name").innerHTML = "الادارة";
           }else{
            document.body.style.direction = "ltr"; 
        document.body.style.textAlign = "left"; 
        document.getElementById("breadcrumb-float").classList.add('float-right');
        document.getElementById("breadcrumb-2").innerHTML = "hr";
        document.getElementById("breadcrumb-1").innerHTML = "roles & permission";
    
    
        document.getElementById("page-name").innerHTML = "ROLES & PERMISSION";

        
       
        document.getElementById("add-role").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add new role';

        document.getElementById("th-1").innerHTML = "Role name";
        document.getElementById("th-2").innerHTML = "Delete";

        document.getElementById("th1-1").innerHTML = "Empolyee name";
        document.getElementById("th1-2").innerHTML = "Role";

        document.getElementById("emp-name").innerHTML = "Empolyee";
        document.getElementById("emp-role").innerHTML = "Role";
        document.getElementById("add-permission").innerHTML = "Add permission";

        document.getElementById("add-perm-title").innerHTML = "Role name";
        document.getElementById("add-perm-module").innerHTML = "Module";
        document.getElementById("add-perm-view").innerHTML = "View";
        document.getElementById("add-perm-home").innerHTML = "Home";
        document.getElementById("add-perm-client").innerHTML = "Clients";
        document.getElementById("add-perm-search").innerHTML = "Search";
        document.getElementById("add-perm-cm").innerHTML = "Cases manage";
        document.getElementById("add-perm-tasks").innerHTML = "Tasks";
        document.getElementById("add-perm-reports").innerHTML = "Reports";
        document.getElementById("add-perm-noti").innerHTML = "Notification";
        document.getElementById("add-perm-chats").innerHTML = "Chats";
        document.getElementById("add-perm-hr").innerHTML = "HR";
        document.getElementById("add-perm-settings").innerHTML = "Settings";
        document.getElementById("add-perm-add-client").innerHTML = "Add client";
        document.getElementById("add-perm-add-file").innerHTML = "Add file";
        document.getElementById("add-perm-add-case").innerHTML = "Add main case";
        document.getElementById("add-perm-add-stage").innerHTML = "Add stage";
        document.getElementById("add-perm-btn1").innerHTML = "Add role";


           }
</script>
    
@endsection
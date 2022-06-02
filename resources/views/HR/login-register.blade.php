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
                            <th id="th-2">تاريخ الدخول</th>
                            <th id="th-3">تاريخ الخروج</th>
                       

                      </tr>
                        </thead>
                        <tbody>
                            @foreach ($registers as $register)
                          
                         <tr>
                            
                            <td> {{$register->id}} </td>
                            <td> {{$register->user_name}} </td>
                            <td> {{$register->login}} </td>
                            <td> {{$register->logout}} </td>
                           
                      
                           
                        </tr>
                        @endforeach
                        </tbody>
                    </table><!--end /table-->
                </div><!--end /tableresponsive-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!-- end col -->
</div>
<div class=" mt-4">
    {{ $registers->links() }}
    
    </div>
    
@endsection

@section('page-script')

<script>
    if (lang == "ar") {
        document.body.style.direction = "rtl"; 
        document.body.style.textAlign = "right"; 
    
        document.getElementById("breadcrumb-float").classList.add('float-left');
        document.getElementById("breadcrumb-1").innerHTML = "ادارة الموظفين"; 
        document.getElementById("breadcrumb-2").innerHTML = "سجلات الدخول"; 
    
        document.getElementById("page-name").innerHTML = "سجلات الدخول";
           }else{
            document.body.style.direction = "ltr"; 
        document.body.style.textAlign = "left"; 
        document.getElementById("breadcrumb-float").classList.add('float-right');
        document.getElementById("breadcrumb-2").innerHTML = "hr";
        document.getElementById("breadcrumb-1").innerHTML = "login history";
    
    
        document.getElementById("page-name").innerHTML = "LOGIN HISTORY";

        document.getElementById("th-1").innerHTML = "Employee name";
        document.getElementById("th-2").innerHTML = "Login datetime";
        document.getElementById("th-3").innerHTML = "Logout datetime";

           }
</script>
    
@endsection
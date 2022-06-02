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

                 <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg" id="add-dept"><i class="mdi mdi-plus-box ml-2"></i> إضافة قسم جديد</button>

             <!--  <button type="button" class="btn btn-secondary mr-5"><i class="mdi mdi-file ml-2"></i>عرض التقريرالتفصيلي للملف</button> -->
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
                      
                             <th id="th-1">اسم القسم</th>
                             
                             <th id="th-2" class="text-center">حذف القسم</th>
                             
                         </tr>
                         </thead>
                         <tbody>
                            @foreach ($departments as $dept)
                         <tr>
                            <td>{{$dept->dept_name}}</td>
                            
                             <td class="text-center">
                               
                                <a href="{{url('delete-department/'.$dept->id)}}" class="ml-3"><i class="fas fa-trash text-danger font-16"></i></a>
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
            <div class="modal-header" style=" display: block; ">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <div class="modal-body">
                <form novalidate action= "{{ route('add-department') }} " method="post">
                    @csrf
              <div class="row">
                   <div class="col-12"> 
                      <div class="form-group row">
                               
                         
                                 <div class="col-sm-6">
                                  <label id="dept-name">اسم القسم</label>
                                    <input class="form-control" name="dept_name" type="text" id="example-text-input">
                                </div>
                            </div>
                         </div>

                    <div class="col-12">
                            <button class="btn btn-sm btn-primary mr-1 font-15" id="add-btn">اضافة</button>
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
    document.getElementById("breadcrumb-2").innerHTML = "الاقسام"; 

    document.getElementById("page-name").innerHTML = "الاقسام";
       }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "hr";
    document.getElementById("breadcrumb-1").innerHTML = "departments";


    document.getElementById("page-name").innerHTML = "DEPARTMENTS";

  
    document.getElementById("add-dept").innerHTML = '  <i class="mdi mdi-plus-box mx-2"></i> Add new department';

    document.getElementById("th-1").innerHTML = "Department name";
    document.getElementById("th-2").innerHTML = "Delete";

    document.getElementById("dept-name").innerHTML = "Department name";
    document.getElementById("add-btn").innerHTML = "Add";

       }
</script>
    
@endsection
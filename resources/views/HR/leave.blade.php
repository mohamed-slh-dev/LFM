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

                        <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg" id="add-leave"><i class="mdi mdi-plus-box mx-2"></i> اضافة اجازة</button>

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
                              
                                    <th id="th-1">اسم الموظف</th>
                                    <th id="th-2">تاريخ الاجازة من</th>
                                    <th id="th-3">تاريخ الاجازة الى</th>
                                    <th id="th-4">سبب الاجازة</th>
                                    <th id="th-5">نوع الاجازة</th>
                                    <th id="th-6">حالة الاجازة</th>
                                    <th id="th-7"  class="text-center">حذف</th>
                                    
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $leave)
                                  
                                 <tr>
                                    
                                    <td> {{$leave->name}} </td>
                                    <td> {{$leave->date_from}} </td>
                                    <td> {{$leave->date_to}} </td>
                                    <td> {{$leave->leave_subject}} </td>
                                    <td> {{$leave->leave_type}} </td>
                                    <td> {{$leave->leave_status}} </td>
                                    <td class="text-center">
                                        <a href="{{url('delete-leave/'.$leave->leave_id)}}" class="ml-3"><i class="fas fa-trash text-danger font-16"></i></a>
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

       <div class="modal fade bs-example-modal-lg" tabindex="-1"  
       role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       
                       <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                       
                   </div>
                   <div class="modal-body">
                    <form novalidate action= "{{ route('add-leave') }} " method="post">
                        @csrf
                     <div class="row">
                       
               
                         <div class="col-12"> 
                             <div class="form-group row">
                                      
                                       <div class="col-sm-4">
                                          <label id="name">اسم الموظف</label>
                                          <select class="custom-select text-right" name="user_id">
                                          
                                            @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                            </select>
                                       </div>

                                        <div class="col-sm-4">
                                          <label id="status">الحالة</label>
                                            <select class="custom-select text-right" name="status">
                                             <option>معلقة</option>
                                             <option>تمت الموافقة</option>
                                           </select>
                                       </div>
                                       <div class="col-sm-4">
                                           <label id="type">نوع الاجازة</label>
                                           <select class="custom-select text-right" name="type">
                                            <option>عامة</option>
                                              <option>مرضية</option>
                                             <option>مستحقة</option>

                                           </select>
                                       </div>
                                    

                              </div>
                 
                        </div>
                          <div class="col-12"> 
                           <div class="form-group row">
                                      
                                       <div class="col-sm-6">
                                          <label id="from">التاريخ من</label>
                                           <input class="form-control" type="date" name="from" id="example-text-input">
                                       </div>

                                        <div class="col-sm-6">
                                          <label id="to">التاريخ الى</label>
                                           <input class="form-control" type="date" name="to" id="example-text-input">
                                       </div>
                                  
                                    

                              </div>
                 
                        </div>
                         <div class="col-12"> 
                             <label for="noe_date" id="reason">سبب الاجازة</label>
                          <textarea class="form-control" name="subject" rows="5" id="message"></textarea>
                            </div> 
                        
                            <div class="col-12 mt-3"> 
                             <button class="btn btn-sm btn-primary mr-1 font-15" id="add-btn">إضافة اجازة</button>
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
        document.getElementById("breadcrumb-2").innerHTML = "الاجازات"; 
    
        document.getElementById("page-name").innerHTML = "الاجازات";
           }else{
            document.body.style.direction = "ltr"; 
        document.body.style.textAlign = "left"; 
        document.getElementById("breadcrumb-float").classList.add('float-right');
        document.getElementById("breadcrumb-2").innerHTML = "hr";
        document.getElementById("breadcrumb-1").innerHTML = "leaves";
    
    
        document.getElementById("page-name").innerHTML = "LEAVES";

        
       
        document.getElementById("add-leave").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add leave';

        document.getElementById("th-1").innerHTML = "Employee name";
        document.getElementById("th-2").innerHTML = "Date from";
        document.getElementById("th-3").innerHTML = "Date to";
        document.getElementById("th-4").innerHTML = "Reason";
        document.getElementById("th-5").innerHTML = "Type";
        document.getElementById("th-6").innerHTML = "Status";
        document.getElementById("th-7").innerHTML = "Delete";

        document.getElementById("name").innerHTML = "Employee name";
        document.getElementById("status").innerHTML = "Status";
        document.getElementById("type").innerHTML = "Leave type";
        document.getElementById("from").innerHTML = "Date from";
        document.getElementById("to").innerHTML = "Date to";
        document.getElementById("reason").innerHTML = "Leave reason";
        document.getElementById("add-btn").innerHTML = "Add";

           }
</script>
    
@endsection
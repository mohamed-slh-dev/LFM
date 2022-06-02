@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  
@endsection

@section('content')

<div class="row">

             {{-- <div class="col-lg-12 ">
                            <div class="text-right">
                                <ul class="list-inline pr-0">                                    
                                   
                                    <li class="list-inline-item">

                                    <button type="button" class="btn btn-primary waves-effect waves-light float-right mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg"><i class="mdi mdi-plus-box ml-2"></i> إضافة كود نظام جديد</button>

                                <!--  <button type="button" class="btn btn-secondary mr-5"><i class="mdi mdi-file ml-2"></i>عرض التقريرالتفصيلي للملف</button> -->
                                    </li>
                                </ul>
                            </div>                            
                        </div><!--end col--> --}}
                     <div class="col-lg-12">
                            <div class="card">
                                <div class="col-lg-12 mt-3 mx-2">
                                    <div class="">
                                        <ul class="list-inline pr-0">                                    
                                           
                                            <li class="list-inline-item">
        
                                            <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".new-stage" id="add-stage"><i class="mdi mdi-plus-box mx-2"></i> اضافة  بند</button>
        
                                          </li>
                                        </ul>
                                    </div>                            
                                </div><!--end col-->
                                <div class="card-body">
    
                                  
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 table-centered">
                                            <thead>
                                            <tr>
                                            <th id="th-1">الكود</th>
                                                <th id="th-2">البند الفرعي بالعربية</th>
                                                <th id="th-3">البند الفرعي بالانجليزية</th>
                                                <th id="th-4">المرحلة القادمة بالعربي</th>
                                                <th id="th-5">المرحلة القادمة بالانجليزي</th>

                                                <th id="th-6">فترة السماح</th>
                                                <th></th>
                                                
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sentence as $sent)
                                            <tr>
                                                <td> {{$sent->N_HEARING_TYPE }} </td>
                                                <td> {{$sent->S_Desc_A }} </td>
                                                <td>{{$sent->S_Desc_E}} </td>
                                                <td>{{$sent->S_NEXT_Desc_A }} </td>
                                                <td>{{$sent->S_NEXT_Desc_E}} </td>
                                                <td>{{$sent->N_Period}} </td>
                                            
                                                <td class="text-center">
                                                   <a  data-toggle="modal" data-animation="bounce" data-target=".edit-sentence-{{$sent->N_SEN_CONFIG_ID}}" style="cursor: pointer;" class="mx-3"><i class="fas fa-edit text-info font-16"></i></a>
                                                    <a href="{{url('delete-sentence/'.$sent->N_SEN_CONFIG_ID)}}"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                                </td>
                                                
                                              
                                            </tr>
                                            @endforeach
                                           
                                        </tbody>
                                        </table><!--end /table-->
                                       
                                    </div><!--end /tableresponsive-->
                                    <div class=" mt-4">
                                        {{ $sentence->links() }}
                                        
                                    </div>
                                   
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!-- end col -->
                         <div class="col-lg-12 ">
                         <hr style="border-top: 5px solid rgba(0,0,0,.1);">
                         </div>
                        
                           <div class="col-lg-12 ">
                            <div class="">
                                <ul class="list-inline pr-0">                                    
                                   
                                    <li class="list-inline-item">

                                    <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".task-type" id="add-task"><i class="mdi mdi-plus-box ml-2"></i> اضافة نوع مهمة</button>

                                  </li>
                                </ul>
                            </div>                            
                        </div><!--end col-->

                           <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
    
                                  
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 table-centered">
                                            <thead>
                                            <tr>
                                            <th id="th1-1">نوع المهمة</th>
                                                <th id="th1-2">الرقم التسلسلي</th>
                                               
                                                <th></th>
                                                
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>مهمة دعوى</td>
                                                <td> 1 </td>
                                                <td> </td>
                                          </tr>

                                          <tr>
                                            <td>مهمة ادارية</td>
                                            <td> 2 </td>
                                            <td> </td>
                                      </tr>
                                      <tr>
                                        <td>مهمة خاصة</td>
                                        <td> 3 </td>
                                        <td> </td>
                                  </tr>
                                  <tr>
                                    <td>مهمة عامة</td>
                                    <td> 4 </td>
                                    <td> </td>

                              </tr>
                                         
                                            @foreach ($task_types as $tt)
                                            <tr>

                                            <td> {{$tt->task_type}} </td>
                                            <td> {{$tt->id}} </td>
                                            <td><a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a></td>
                                            
                                        </tr>
                                            @endforeach

                                            </tbody>
                                        </table><!--end /table-->
                                    </div><!--end /tableresponsive-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!-- end col -->

                          <div class="col-lg-12 ">
                         <hr style="border-top: 5px solid rgba(0,0,0,.1);">
                         </div>

                            <div class="col-lg-12 ">
                            <div class="">
                                <ul class="list-inline pr-0">                                    
                                   
                                    <li class="list-inline-item">

                                    <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".new-option" id="add-option"><i class="mdi mdi-plus-box mx-2"></i> اضافة خيار جديد</button>

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
                                            <th id="th2-1">نوع الخيار</th>
                                                <th id="th2-2">الاسم عربي</th>
                                               
                                                <th id="th2-3">الاسم انجليزي</th>
                                                <th class="text-center" id="th2-4">حذف</th>
                                                
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($options as $option)
                                            <tr>
                                                <td> {{$option->codeName}} </td>
                                                <td> {{$option->S_Desc_A}} </td>
                                                <td></td>
                                                <td class="text-center">
                                                    <a href="{{url('delete-option/'.$option->N_DetailedCode)}}"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                                </td>
                                                
                                              
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table><!--end /table-->
                                    </div><!--end /tableresponsive-->
                                    <div class=" mt-4">
                                        {{ $options->links() }}
                                        
                                    </div>
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!-- end col -->
                        

                   </div>

                   <div class="modal fade task-type" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style=" display: block; ">
                                
                                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                                
                            </div>
                            <div class="modal-body">
                                <form class="form"  method="POST" action="{{route('add-task-type')}}">
                                    @csrf
                              <div class="row">
                                   <div class="col-12"> 
                                      <div class="form-group row">
                                               
                                         
                                                 <div class="col-sm-6">
                                                  <label for="noe_date" id="task-label">اسم نوع المهمة</label>
                                                     <input type="text" class="form-control" name="task_type">
                                                </div>
                                            </div>
                                         </div>
             
                                        <div class="col-12">
                                                <button class="btn btn-sm btn-primary mx-1 font-15" id="add-task-btn">اضافة</button>
                                            </div> 
                                  
            
                                     </div> 
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal --> 


               

                <div class="modal fade  new-option" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style=" display: block; ">
                                
                                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                                
                            </div>
                            <div class="modal-body">
                                <form class="form"  method="POST" action="{{route('add-option')}}">
                                    @csrf
                              <div class="row">
                                   <div class="col-12"> 
                                      <div class="form-group row">
                                               
                                         
                                                 <div class="col-sm-6">
                                                  <label for="noe_date" id="option-ar"> اسم الخيار عربي</label>
                                                     <input type="text" class="form-control" name="name_ar">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="noe_date" id="option-eng"> اسم الخيار انجليزي</label>
                                                       <input type="text" class="form-control" name="name_eng">
                                                  </div>

                                                <div class="col-sm-6">
                                                    <label for="noe_date" id="option-type"> نوع الخيار</label>
                                                    <select class="custom-select" name="type">
                                                        <option value="1">فرع</option>
                                                        <option value="3">جنسية </option>
                                                        <option value="5">نوع الدعوى</option>
                                                        <option value="31">نوع جلسة</option>
                                                        <option value="19">حالة قضية</option>
                                                        <option value="7">مرحلة دعوى</option>
                                                        <option value="t">نوع تنفيذ (نوع الخدمة)</option>
                                                        <option value="6">محكمة</option>
                                                        <option value="9">دائرة</option>
                                                        <option value="39">الاجراءات التنفيذية</option>
                                                        <option value="40">نوع العقد</option>
                                                        <option value="41"> الاجراء المطلوب في المذكرة</option>
                                                      </select>
                                                  </div>
                                            </div>
                                         </div>
             
                                        <div class="col-12">
                                                <button class="btn btn-sm btn-primary mx-1 font-15" id="add-option-btn">اضافة</button>
                                            </div> 
                                  
            
                                     </div> 
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal --> 
                @foreach ($sentence as $sent)
            <div class="modal fade  edit-sentence-{{$sent->N_SEN_CONFIG_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style=" display: block; ">
                                
                                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                                
                            </div>
                            <div class="modal-body">
                                <form class="form"  method="POST" action="{{route('edit-sentence')}}">
                                    @csrf
                              <div class="row">
                                   <div class="col-12"> 
                                      <div class="form-group row">
                                             <input type="hidden" name="sentence_id" value="{{$sent->N_SEN_CONFIG_ID}}" id="">  
                                         
                                                 <div class="col-sm-6">
                                                  <label for="noe_date" id="edit-sent-ar">  البند الفرعي عربي</label>
                                                     <input type="text" value="{{$sent->S_Desc_A}}" class="form-control" name="name_ar">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="noe_date" id="edit-sent-eng"> البند الفرعي انجليزي</label>
                                                       <input type="text" value="{{$sent->S_Desc_E}}" class="form-control" name="name_eng">
                                                  </div>
                                                <div class="col-sm-6">
                                                    <label for="noe_date" id="edit-next-ar"> المرحلة القادمة عربي</label>
                                                       <input type="text" value="{{$sent->S_NEXT_Desc_A}}" class="form-control" name="next_ar">
                                                  </div>

                                                  <div class="col-sm-6">
                                                    <label for="noe_date" id="edit-next-eng"> المرحلة القادمة انجليزي</label>
                                                       <input type="text" value="{{$sent->S_NEXT_Desc_E}}" class="form-control" name="next_eng">
                                                  </div>

                                                  <div class="col-sm-6">
                                                    <label for="noe_date" id="edit-period-days">فترة السماح</label>
                                                       <input type="number" value="{{$sent->N_Period}}" class="form-control" name="period">
                                                  </div>

                                            </div>
                                         </div>
             
                                        <div class="col-12">
                                                <button class="btn btn-sm btn-info mr-1 font-15" id="edit-period-btn">تحديث</button>
                                            </div> 
                                  
            
                                     </div> 
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal --> 
                @endforeach

                <div class="modal fade  new-stage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style=" display: block; ">
                                
                                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                                
                            </div>
                            <div class="modal-body">
                                <form class="form"  method="POST" action="{{route('add-sentence')}}">
                                    @csrf
                              <div class="row">
                                   <div class="col-12"> 
                                      <div class="form-group row">
                                         
                                        <div class="col-sm-6">
                                            <label for="noe_date" id="sent-ar">  البند الفرعي عربي</label>
                                               <input type="text" value="{{$sent->S_Desc_A}}" class="form-control" name="name_ar">
                                          </div>
                                          <div class="col-sm-6">
                                              <label for="noe_date" id="sent-eng"> البند الفرعي انجليزي</label>
                                                 <input type="text" value="{{$sent->S_Desc_E}}" class="form-control" name="name_eng">
                                            </div>
                                          <div class="col-sm-6">
                                              <label for="noe_date" id="next-ar"> المرحلة القادمة عربي</label>
                                                 <input type="text" value="{{$sent->S_NEXT_Desc_A}}" class="form-control" name="next_ar">
                                            </div>

                                            <div class="col-sm-6">
                                              <label for="noe_date" id="next-eng"> المرحلة القادمة انجليزي</label>
                                                 <input type="text" value="{{$sent->S_NEXT_Desc_E}}" class="form-control" name="next_eng">
                                            </div>

                                            <div class="col-sm-6">
                                              <label for="noe_date" id="period-days">فترة السماح</label>
                                                 <input type="number" value="{{$sent->N_Period}}" class="form-control" name="period">
                                            </div>
                                            </div>
                                         </div>
             
                                        <div class="col-12">
                                                <button class="btn btn-sm btn-info mx-1 font-15" id="add-period-btn">اضافة</button>
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
    document.getElementById("breadcrumb-1").innerHTML = "الاعدادات"; 
    document.getElementById("breadcrumb-2").innerHTML = "اعدادات النظام "; 

    document.getElementById("page-name").innerHTML = "اعدادات النظام ";
      }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "settings";
    document.getElementById("breadcrumb-1").innerHTML = "system settings";


    document.getElementById("page-name").innerHTML = "SYSTEM SETTINGS";

    document.getElementById("add-stage").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add sentence';
    document.getElementById("th-1").innerHTML = "Code ";
    document.getElementById("th-2").innerHTML = "Sentnce name arabic ";
    document.getElementById("th-3").innerHTML = "Sentnce name english  ";
    document.getElementById("th-4").innerHTML = " Next stage arabic ";
    document.getElementById("th-5").innerHTML = "Next stage english  ";
    document.getElementById("th-6").innerHTML = " Decision period ";

    document.getElementById("sent-ar").innerHTML = "Sentence arabic";
    document.getElementById("sent-eng").innerHTML = "Sentence english";
    document.getElementById("next-ar").innerHTML = "Next stage english";
    document.getElementById("next-eng").innerHTML = "Next stage english";
    document.getElementById("period-days").innerHTML = "Decision period";
    document.getElementById("add-period-btn").innerHTML = "Add";

    document.getElementById("edit-sent-ar").innerHTML = "Sentence arabic";
    document.getElementById("edit-sent-eng").innerHTML = "Sentence english";
    document.getElementById("edit-next-ar").innerHTML = "Next stage english";
    document.getElementById("edit-next-eng").innerHTML = "Next stage english";
    document.getElementById("edit-period-days").innerHTML = "Decision period";
    document.getElementById("edit-period-btn").innerHTML = "Update";

    
    document.getElementById("add-task").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add task type';
    document.getElementById("task-label").innerHTML = "Task type";
    document.getElementById("add-task-btn").innerHTML = "Add";

    document.getElementById("th1-1").innerHTML = "Task type ";
    document.getElementById("th1-2").innerHTML = "#";

    
    document.getElementById("add-option").innerHTML = '<i class="mdi mdi-plus-box mx-2"></i> Add new option';
    document.getElementById("th2-1").innerHTML = "Option type";
    document.getElementById("th2-2").innerHTML = "Name arabic"; 
    document.getElementById("th2-3").innerHTML = "Name english ";
    document.getElementById("th2-4").innerHTML = "Delete";

    document.getElementById("option-ar").innerHTML = "Option arabic";
    document.getElementById("option-eng").innerHTML = "Option english";
    document.getElementById("option-type").innerHTML = "Option type";
    document.getElementById("add-option-btn").innerHTML = "Add option";


      }
</script>

@endsection
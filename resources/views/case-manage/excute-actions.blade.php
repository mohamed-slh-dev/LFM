@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-3" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
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

                    <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg" id="add-action"></button>

                    </li>
                </ul>
            </div>                            
        </div><!--end col-->

        <div class="col-12">
            <div class="card" >
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-3" id="title"></h4>
                    @foreach ($action_names as $actionName => $excute_actions)
                    <div class="accordion" id="accordionExample-faq">
                        <div class="card shadow-none border mb-1">
                            <div class="card-header" id="headingOne">
                            <h5 class="my-0">
                              <button class="btn btn-link ml-4" type="button" data-toggle="collapse" data-target="#collapse-{{$actionName}}" aria-expanded="true" aria-controls="collapseOne">
                               {{$actionName}}
                                </button>
                            </h5>
                            </div>
                        
                            <div id="collapse-{{$actionName}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample-faq">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table table-bordered mb-0 table-centered">
                                    <thead>
                                    <tr>
                                  
                                      
                                        <th id="th-1">الوصف</th>
                                        <th id="th-2">الملاحظات</th>
                                        <th id="th-3">المبلغ المحصل</th>
                                        <th id="th-4">المستند</th>
                                        <th id="th-5">التاريخ</th>
                                       <th id="th-6">تعديل</th>
                                       <th id="th-7">حذف</th>
                                        
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                        @foreach($excute_actions as $action ) 
                                     <tr>
                                        
                                  
                                    <td > {{$action->description}}</td>
                                    <td  > {{$action->notes}}</td>
                                    <td > {{$action->collected_amount}}</td>
                                    <td>
                                        @if ($action->docs)
                                        <a href="{{asset('assets/excute-docs/actions-docs/'.$action->docs)}}" class="download-icon-link" download>
                                            <i class="dripicons-download file-download-icon"></i>
                                            </a>
                                        
                                        @endif
                                       
                                    </td>
                                    <td > {{$action->date}}</td>
                                       <td>
                                            <a class="ml-2" data-toggle="modal" data-animation="bounce" data-target=".edit_{{$action->excute_action_id}}">
                                        <i class="mdi mdi-pencil-outline text-muted font-18" style="cursor: pointer;"></i>
                                    </a>     
                                </td>
                                <td>
                                    <a class="ml-2"  href="{{url('delete-action/'.$action->excute_action_id)}} ">
                                <i class="fas fa-trash text-danger  font-18" style="cursor: pointer;"></i>
                            </a>     
                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table><!--end /table-->
                            </div><!--end /tableresponsive-->
                            </div>
                            </div>
                        </div>                                             
                    </div><!--end accordion-->
                    @endforeach
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1"  
    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                 <form class="form"  method="POST" action="{{route('add-excute-action')}}" enctype="multipart/form-data">
                     @csrf
                  <div class="row">
                    
            <input type="hidden" name="excute_stage_id" value=" {{$excute_stage_id}} " >
                      <div class="col-12"> 
                          <div class="form-group row">
                                   
                                    <div class="col-sm-4">
                                       <label id="action-name">الاجراء التنفيذي</label>
                                       <select class="custom-select text-right" name="excute_code">
                                        @foreach ($excute_actions_options as $excute)
                                        <option value="{{$excute->N_DetailedCode}}">{{$excute->S_Desc_A}}</option>  
                                        @endforeach 
                                       </select>
                                    </div>

                                     <div class="col-sm-4">
                                       <label id="action-date"> التاريخ</label>
                                       <input class="form-control" type="date" name="date" id="example-text-input">
                                    </div>
                                  
                                    <div class="col-sm-4">
                                        <label id="action-doc"> مستندات </label>
                                        <input class="form-control" type="file" name="docs" id="example-text-input">
                                     </div>
                                 

                           </div>
              
                     </div>
                     <div class="col-12"> 
                        <div class="form-group row">
                                   

                            <div class="col-sm-12">
                                <label id="action-desc"> الوصف</label>
                                <input class="form-control" type="text" name="desc" id="example-text-input">

                            </div>
    

                           </div>
              
                     </div>
                       <div class="col-12"> 
                        <div class="form-group row">
                                   
                                    <div class="col-sm-6">
                                       <label id="action-note"> الملاحظات</label>
                                       <input class="form-control" type="text" name="notes" id="example-text-input">
                                    </div>

                                     <div class="col-sm-6">
                                       <label id="action-collected"> المبلغ المحصل</label>
                                        <input class="form-control" type="number" name="collected_amount" id="example-text-input">
                                    </div>
                               

                           </div>
              
                     </div>
                   
                     
                         <div class="col-12 mt-3"> 
                          <button class="btn btn-sm btn-primary mr-1 font-15" id="action-add-btn">إضافة اجراء تنفيذي</button>
                         </div> 
                      

                      </div> 
                 </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 

    @foreach($excute_actions_models as $action ) 
    
    <div class="modal fade edit_{{$action->excute_action_id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style=" display: block; ">
                    
                    <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST" action="{{route('update-action')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="action_id" value="{{$action->excute_action_id}}">
                  <div class="row">
                    <div class="col-12"> 
                        <div class="form-group row">
                                   
                            @if (Session::get('lang') == "ar")
                            <div class="col-sm-4">
                                <label> الملاحظات</label>
                                <input class="form-control" type="text" value="{{$action->notes}}" name="notes" id="example-text-input">
                             </div>

                              <div class="col-sm-8">
                                <label> الوصف</label>
                                 <input class="form-control" type="text" value="{{$action->description}}" name="desc" id="example-text-input">
                             </div>

                             <div class="col-sm-4">
                                 <label> المبلغ المحصل</label>
                                  <input class="form-control" value="{{$action->collected_amount}}" type="number" name="collected_amount" id="example-text-input">
                              </div>
                        
                              <div class="col-sm-4">
                                 <label for="noe_date"> مستندات </label>
                                 <input class="form-control" type="file" value="{{$action->docs}}" name="docs" id="example-text-input">
                              </div>

                              <div class="col-sm-4">
                                 <label for="noe_date"> التاريخ </label>
                                 <input class="form-control" type="date" value="{{$action->date}}" name="date" id="example-text-input">
                              </div>
                    </div>
       
              </div>  
       
              <div class="col-12">
                             <button class="btn btn-sm btn-primary mr-1 font-15">تحديث</button>
                         </div>

                            @else

                            <div class="col-sm-4">
                                <label> Notes</label>
                                <input class="form-control" type="text" value="{{$action->notes}}" name="notes" id="example-text-input">
                             </div>

                              <div class="col-sm-8">
                                <label> Description</label>
                                 <input class="form-control" type="text" value="{{$action->description}}" name="desc" id="example-text-input">
                             </div>

                             <div class="col-sm-4">
                                 <label> Collected amount</label>
                                  <input class="form-control" value="{{$action->collected_amount}}" type="number" name="collected_amount" id="example-text-input">
                              </div>
                        
                              <div class="col-sm-4">
                                 <label for="noe_date"> Documents </label>
                                 <input class="form-control" type="file" value="{{$action->docs}}" name="docs" id="example-text-input">
                              </div>

                              <div class="col-sm-4">
                                 <label for="noe_date"> Date </label>
                                 <input class="form-control" type="date" value="{{$action->date}}" name="date" id="example-text-input">
                              </div>
                    </div>
       
              </div>  
       
            

                     <div class="col-12">
                             <button class="btn btn-sm btn-primary mr-1 font-15">Update</button>
                         </div>  
                            @endif
                                    
                      

                         </div>
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
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = 'التنفيذات' ;
    document.getElementById("breadcrumb-3").innerHTML = "الاجراءات التنفيذية"; 

    document.getElementById("page-name").innerHTML = "الاجراءات التنفيذية ";

    document.getElementById("title").innerHTML = "كل الاجراءات  ";


  document.getElementById("add-action").innerHTML =  '<i class="mdi mdi-plus-box mx-2"></i> اضافة اجراء تنفيذي';

  document.getElementById("action-name").innerHTML = "الاجراء التنفيذي";
  document.getElementById("action-date").innerHTML = "التاريخ";
  document.getElementById("action-doc").innerHTML = "مستندات";
  document.getElementById("action-desc").innerHTML = "الوصف";
  document.getElementById("action-note").innerHTML = "ملاحظات";
  document.getElementById("action-collected").innerHTML = "المبلغ المتحصل";
  document.getElementById("action-add-btn").innerHTML = "اضافة اجراء";

  document.getElementById("th-1").innerHTML = "الوصف";
  document.getElementById("th-2").innerHTML = "الملاحظات";
   document.getElementById("th-3").innerHTML = "المبلغ المتحصل";
   document.getElementById("th-4").innerHTML = "المستند";
  document.getElementById("th-5").innerHTML = "التاريخ";
  document.getElementById("th-6").innerHTML = "تعديل";
  document.getElementById("th-7").innerHTML = "حذف";


     }else{
    document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = 'excutes' ;
    document.getElementById("breadcrumb-1").innerHTML = "excutes actions" ;


    document.getElementById("page-name").innerHTML = "EXCUTES ACTIONS";

    document.getElementById("title").innerHTML = "All actions ";

    document.getElementById("add-action").innerHTML =  '<i class="mdi mdi-plus-box mx-2"></i> Add action';


    document.getElementById("action-name").innerHTML = "Excute action";
  document.getElementById("action-date").innerHTML = "Date";
  document.getElementById("action-doc").innerHTML = "Document";
  document.getElementById("action-desc").innerHTML = "Description";
  document.getElementById("action-note").innerHTML = "Notes";
  document.getElementById("action-collected").innerHTML = "Collected amount";
  document.getElementById("action-add-btn").innerHTML = "Add action";

  document.getElementById("th-1").innerHTML = "Description";
  document.getElementById("th-2").innerHTML = "Notes";
  document.getElementById("th-3").innerHTML = "Collected amount";
  document.getElementById("th-4").innerHTML = "Document";
  document.getElementById("th-5").innerHTML = "Date";
  document.getElementById("th-6").innerHTML = "Edit";
  document.getElementById("th-7").innerHTML = "Delete";
     }
</script>
    
@endsection
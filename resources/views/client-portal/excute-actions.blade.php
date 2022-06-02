@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-3" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
 
@endsection
@section('content')
    <div class="row">
      

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


  document.getElementById("th-1").innerHTML = "الوصف";
  document.getElementById("th-2").innerHTML = "الملاحظات";
   document.getElementById("th-3").innerHTML = "المبلغ المتحصل";
   document.getElementById("th-4").innerHTML = "المستند";
  document.getElementById("th-5").innerHTML = "التاريخ";
 

     }else{
    document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-3").innerHTML =  "cases manage"; 
    document.getElementById("breadcrumb-2").innerHTML = 'excutes' ;
    document.getElementById("breadcrumb-1").innerHTML = "excutes actions" ;


    document.getElementById("page-name").innerHTML = "EXCUTES ACTIONS";

    document.getElementById("title").innerHTML = "All actions ";




  document.getElementById("th-1").innerHTML = "Description";
  document.getElementById("th-2").innerHTML = "Notes";
  document.getElementById("th-3").innerHTML = "Collected amount";
  document.getElementById("th-4").innerHTML = "Document";
  document.getElementById("th-5").innerHTML = "Date";

     }
</script>
    
@endsection
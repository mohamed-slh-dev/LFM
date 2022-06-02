@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
   فتح قضية
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
        <div class="row">
           
            <div class="col-lg-3 ">
               
                    <div class="form-group  mb-0">
                       
                        <button type="button" class="btn btn-primary waves-effect waves-light mb-0 " data-toggle="modal" data-animation="bounce" data-target=".new-case" id="add-case"><i class="mdi mdi-plus-box mx-2"></i>فتح قضية</button>

                    </div>

                   
               
            </div>
          

            
           
            
            </div>
        </div>
        </div>
        </div>
      
    

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="mt-0 header-title" id="table-title"></h4>
                <p class="text-muted mb-3">
                </p>

                <div class="table-responsive">
                    <table class="table table-bordered mb-0 table-centered">
                        <thead>
                        <tr>
                            <th id="th-1"> </th>
                            <th id="th-2"></th>
                            <th id="th-3"></th>
                            <th id="th-4"> </th>
                            <th id="th-5"></th>
                          
                          
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($open_case as $case)

                            <tr>
                            <td>{{$case->against}}</td>
                            <td>{{$case->caseStatus}}</td>
                                <td>{{$case->subject}}</td>
                              
                                <td>{{$case->cliam_amount}}</td>
                                <td>
                             @if ($case->docs)
                                <a href="{{asset('assets/open-case-documents/'.$case->docs)}}" class="download-icon-link" download>
                                    <i class="dripicons-download file-download-icon"></i> 
                                </a>
                            @else 
                            <a> </a>
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

<div class="modal fade new-case" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
 
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-open-case')}}" enctype="multipart/form-data">
                    @csrf
                   
              <div class="row">
                <div class="col-12"> 
                    <div class="form-group row">
                      <div class="col-sm-6">
                          <label style="font-weight: bold;" class="mb-3" id="status">حالة القضية </label>
                          <select  class="custom-select" name="status">
                            @foreach ($case_status as $cs)
                            <option value="{{$cs->N_DetailedCode}}">{{$cs->S_Desc_A}}</option>  
                            @endforeach
                        </select>    
                        </div>
                      <div class="col-sm-6">
                          <label style="font-weight: bold;" class="mb-3" id="against">الخصم</label>
                          <input class="form-control" type="text" name="against" id="example-text-input">

                       </div>
                     
                              
                    </div>
                  </div>
             
                <div class="col-12"> 
                    <div class="form-group row">
                             
                        <div class="col-sm-6">
                            <label style="font-weight: bold;" class="mb-3" id="cliam">قيمة المطالبة </label>
                            <input class="form-control fraction-commas" name="cliam" type="text" id="example-text-input">
                        </div>
                        <div class="col-sm-6">
                            <label style="font-weight: bold;" class="mb-3" id="attach">تحميل مستند</label>
                            <input class="form-control" type="file" name="doc" id="example-text-input">
  
                         </div>
                          </div>
        
               </div>

                   <div class="col-12"> 
                      <div class="form-group row">
                               
                                <div class="col-12">
                                 <label style="font-weight: bold;" class="mb-3" id="subject">الموضوع</label>
                                 <input class="form-control" type="text" name="subject" id="example-text-input">
 
                                </div>
                            </div>
          
                 </div>
                 
                 
                
                   
                 


                     <div class="col-12"> 
                    
                         <button class="btn btn-sm btn-primary mr-1 font-15" id="add-btn">إضافة طلب</button>
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
    $('.fraction-commas').keyup(function() {
    
    
    //get the id number of button || remove all non=numeric things
    var value = $(this).val();
    value = value.replace(/\D/g,'');
    
    // put commas back again
    var commas = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
    
    //copy the new val
    $(this).val(commas);
    
    });
    </script>


<script>
         
    if (lang == "ar") {
   document.body.style.direction = "rtl"; 
   document.body.style.textAlign = "right"; 

   document.getElementById("breadcrumb-float").classList.add('float-left');
   document.getElementById("breadcrumb-1").innerHTML ="طلبات الدعم"; 
   document.getElementById("breadcrumb-2").innerHTML ="العملاء"; 

   document.getElementById("page-name").innerHTML ="طلبات الدعم";



   document.getElementById("table-title").innerHTML ="جميع طلبات فتح قضية";

   document.getElementById("th-1").innerHTML = "الخصم";
   document.getElementById("th-2").innerHTML = "حالة القضية";
   document.getElementById("th-3").innerHTML = "موضوع القضية";
   document.getElementById("th-4").innerHTML = "قيمة المطالبة";
   document.getElementById("th-5").innerHTML = "المستند";
 

    }else{
       document.body.style.direction = "ltr"; 
   document.body.style.textAlign = "left"; 
   document.getElementById("breadcrumb-float").classList.add('float-right');
   document.getElementById("breadcrumb-1").innerHTML = "clients support";
   document.getElementById("breadcrumb-2").innerHTML ="clients"; 

   document.getElementById("page-name").innerHTML = "OPEN CASE";

  
   document.getElementById("add-case").innerHTML =' <i class="mdi mdi-plus-box mx-2"></i> Open Case';

   document.getElementById("table-title").innerHTML ="All clients supports request";

   document.getElementById("th-1").innerHTML = "Against";
   document.getElementById("th-2").innerHTML = "Case Status";
   document.getElementById("th-3").innerHTML = "Subject";
   document.getElementById("th-4").innerHTML = "Cliam Amount";
   document.getElementById("th-5").innerHTML = "Document";
  

   document.getElementById("subject").innerHTML = "Subject";
   document.getElementById("cliam").innerHTML = "Cliam Amount";
   document.getElementById("status").innerHTML = "Cases Status";
   document.getElementById("attach").innerHTML = "Attach Doc.";
   document.getElementById("against").innerHTML = "Against Name";
   document.getElementById("add-btn").innerHTML = "Create";


    }
   </script>
@endsection
@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  الفواتير
@endsection

@section('content')

<div class="row">

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
                            <th id="th-6"></th>
                          
                        </tr>
                        </thead>
                        <tbody>
                          

                            <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                            </tr>
                                
                         

                     

                           
               
                        </tbody>
                    </table><!--end /table-->
                </div><!--end /tableresponsive-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!-- end col -->
</div>


    
@endsection

@section('page-script')
<script>
         
    if (lang == "ar") {
   document.body.style.direction = "rtl"; 
   document.body.style.textAlign = "right"; 

   document.getElementById("breadcrumb-float").classList.add('float-left');
   document.getElementById("breadcrumb-1").innerHTML ="طلبات الدعم"; 
   document.getElementById("breadcrumb-2").innerHTML ="العملاء"; 

   document.getElementById("page-name").innerHTML ="الفواتير";



   document.getElementById("table-title").innerHTML ="بيانات الفواتير";

   document.getElementById("th-1").innerHTML = "";
   document.getElementById("th-2").innerHTML = "";
   document.getElementById("th-3").innerHTML = "";
   document.getElementById("th-4").innerHTML = "";
   document.getElementById("th-5").innerHTML = "";
   document.getElementById("th-6").innerHTML = "المستند";
 

    }else{
       document.body.style.direction = "ltr"; 
   document.body.style.textAlign = "left"; 
   document.getElementById("breadcrumb-float").classList.add('float-right');
   document.getElementById("breadcrumb-1").innerHTML = "clients support";
   document.getElementById("breadcrumb-2").innerHTML ="clients"; 

   document.getElementById("page-name").innerHTML = "INVOICES";

  
   document.getElementById("table-title").innerHTML ="Invoices Details";

   document.getElementById("th-1").innerHTML = "";
   document.getElementById("th-2").innerHTML = "";
   document.getElementById("th-3").innerHTML = "";
   document.getElementById("th-4").innerHTML = "";
   document.getElementById("th-5").innerHTML = "";
   document.getElementById("th-6").innerHTML = "Document";
  
    }
   </script>
@endsection
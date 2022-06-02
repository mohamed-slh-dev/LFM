@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')

@endsection

@section('content')
    <div class="row">

    <div class="col-lg-12" id="filtter">
       <div class="card client-card">


    <form class="form"  method="POST" action="{{route('client-search-cases-reports')}}">
        @csrf                               
     <div class="card-body text-center" >
           <div class="row">
           <div class="col-12">
              <div class="row">
             
              <div class="col-2 pl-0">
                 <div class="form-group row">
                  <label for="example-text-input" class="col-6 col-form-label text-center" id="cases-search-num"></label>
                  <div class="col-6">
                      <input class="form-control pl-0 font-11"  name="case_num" type="text" id="example-text-input">
                  </div>
                 </div>
                  
                        
          </div>
          
            <div class="col-3 ">
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-4 col-form-label text-center" id="cases-search-type"> </label>
                          <div class="col-sm-8">
                       <select class="custom-select text-right" name="type">
                        <option ></option>
                        @foreach ($case_type as $case_type_filter)
                        <option value="{{$case_type_filter->N_DetailedCode}}">{{$case_type_filter->S_Desc_A}}</option>  
                        @endforeach
                             
                         </select>
                     </div>
                 </div>
                        
          </div>

          
          <div class="col-3 ">
              <div class="form-group row">
                  <label for="example-text-input" class="col-sm-5 col-form-label text-center" id="cases-search-stage"></label>
                  <div class="col-sm-7">
                 <select class="custom-select text-right" name="stage">
                  <option ></option>
                  @foreach ($case_stage as $case_stage_filter)
                  <option value="{{$case_stage_filter->N_DetailedCode}}">{{$case_stage_filter->S_Desc_A}}</option>  
                  @endforeach
                       
                   </select>
               </div>
           </div>
                  
    </div>

      <div class="col-1  text-center">
          <button class="btn btn-success waves-effect waves-light mr-3" id="cases-search-btn"> </button>
      </div>
          </div>
           </div>
           
                    
                  
          </div>

    </div>
    </form>
       </div>
    </div>
    </div>
    <div id="btnss" class="text-center">
        <button onclick="to_excel('tblData')" class="btn btn-info mb-3">
            export to excel <i class="fa fa-print"></i>
            </button>
    
            <button onclick="printDiv()" class="btn btn-primary mx-3 mb-3">
                <i class="fa fa-print"></i>
              </button>
    </div>
   

    <div class="row">
      

    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-body invoice-head pt-0"> 
                <div class="row">
                    <div class="col-md-12 text-center">                                                
                        <img src="../assets/images/report-logo.png" alt="logo-small" class="logo-sm mr-2" height="75">                                            
                    </div>
                </div>
                    <div class="row" style="border: 1px solid #b9b9b9;">
                        <div class="col-3">
                            <h6> <span id="stages-count">  عدد الدعاوى : </span> {{$stages->count()}}</h6>
                        </div>
                        <div class="col-6 text-center">
                         
    
                        </div>
                            <div class="col-3">
                                <h6> <span id="print-date"> تاريخ الطباعة :</span> {{$print_date}}</h6>
                                </div>   
                         
                        </div>
             
            </div><!--end card-body-->
            <div class="card-body">
       
                <hr>
    
                <div class="row">
              
                    <div class="col-lg-12">
                        <div class="table-responsive">
                          <table class="table table-bordered mb-0 table-centered"  id="tblData">
                      <thead>
                          <tr>
                            <th id="th-1" style="width: 100px;">رقم الدعوى</th>
                            <th id="th-2"  style="width: 100px;">نوع الدعوى</th>
                            <th id="th-3"  style="width: 100px;">مرحلة الدعوى</th>
                            <th id="th-4"  style="width: 150px;"> تاريخ التسجيل</th>
                            <th id="th-5"  style="width: 230px;"> الخصم</th>
                            <th id="th-6" style="width: 100px;"> المطالبة المالية</th>
                           
                      </tr>
                      </thead>
                   
                      <tbody>
                       
                        @foreach ($stages as $stage)
                
                        <tr>
                           
                            <td > {{$stage->S_CASE_UID}}</td>
                                <td  > {{$stage->caseType}}</td>
                                <td > {{$stage->caseStage}}</td>
                                <td  > {{$stage->register_date}}</td>
                                <td  > {{$stage->againstName}}</td>
                                <td  >  {{number_format($stage->cliam_amount,2) }} </td>
                              
                              
                               
                            </tr>
                            @endforeach
                    </tbody>
                      
                  </table>
                      </div>                                          
                    </div> 
                  
                    
    
                    
                </div>
    
                
              
            </div>
        </div><!--end card-->
    </div><!--end col-->
        

      
 </div><!--end row-->

@endsection

@section('page-script')
<script> 
    function printDiv() {   
        document.getElementById("filtter").style.display = "none"; 
        document.getElementById("chat-sticky").style.display = "none";
        document.getElementById("btnss").style.display = "none"; 
        window.print(); 
        document.getElementById("filtter").style.display = "block"; 
        document.getElementById("chat-sticky").style.display = "block"; 
        document.getElementById("btnss").style.display = "block"; 

    } 

</script>

<script> 
    function to_excel(tableID, filename = '') { 
    var downloadLink;
var dataType = 'application/vnd.ms-excel';
var tableSelect = document.getElementById(tableID);
var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

// Specify file name
filename = filename?filename+'.xls':'cases-report.xls';

// Create download link element
downloadLink = document.createElement("a");

document.body.appendChild(downloadLink);

if(navigator.msSaveOrOpenBlob){
   var blob = new Blob(['\ufeff', tableHTML], {
       type: dataType
   });
   navigator.msSaveOrOpenBlob( blob, filename);
}else{
   // Create a link to the file
   downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

   // Setting the file name
   downloadLink.download = filename;
   
   //triggering the function
   downloadLink.click();
}
} 

</script>
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.crm_leads.init.js')}}"></script> 
<script src="{{asset('assets/pages/jquery.projects_task.init.js')}}"></script>

<script>
           if (lang == "ar") {
document.body.style.direction = "rtl"; 
document.body.style.textAlign = "right"; 

document.getElementById("breadcrumb-float").classList.add('float-left');
document.getElementById("breadcrumb-1").innerHTML = "التقارير"; 
document.getElementById("breadcrumb-2").innerHTML = " تقارير الدعاوى"; 

document.getElementById("page-name").innerHTML = "تقارير الجلسات";

document.getElementById("cases-search-num").innerHTML = "رقم الدعوى";
    document.getElementById("cases-search-type").innerHTML = "نوع الدعوى ";
    document.getElementById("cases-search-stage").innerHTML = "مرحلة الدعوى ";
    document.getElementById("cases-search-btn").innerHTML = "بحث ";
           }else{
            document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "cases manage";
document.getElementById("breadcrumb-1").innerHTML = "cases dashboard";

document.getElementById("page-name").innerHTML = "HEARINGS REPORTS";


document.getElementById("cases-search-num").innerHTML = "Case number";
    document.getElementById("cases-search-type").innerHTML = "Case Type ";
    document.getElementById("cases-search-stage").innerHTML = "Case stage ";
    document.getElementById("cases-search-btn").innerHTML = "search ";

document.getElementById("th-1").innerHTML = "Case Number";
   document.getElementById("th-2").innerHTML = "Case Type";
   document.getElementById("th-3").innerHTML = "Case Stage";
   document.getElementById("th-4").innerHTML = "Registration date";
   document.getElementById("th-5").innerHTML = "Against";
   document.getElementById("th-6").innerHTML = "Cliam Amount";



           }
</script>
    
@endsection
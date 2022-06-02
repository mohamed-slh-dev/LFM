@extends('layouts.main-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  
@endsection

@section('content')
<div class="col-lg-12">

    <div class="card client-card"> 
       <form class="form"  method="POST" action="{{route('clients-updates')}}">
           @csrf                                
       <div class="card-body text-center" >
             <div class="row">
             <div class="col-12">
                <div class="row">
            

           <div class="col-3  ">
            <div class="form-group row mb-0">
          <label for="example-text-input" class="col-sm-4 px-0 mt-2" id="label"></label>
          <div class="col-sm-8" >
          
            <select class="select2 form-control  custom-select "  name="file_id">
               
               @foreach ($files as $file)
               <option value="{{$file->file_id}}">{{$file->file_id}}</option>
                 @endforeach
               
             </select>
          </div>
      </div>
             
</div>


        <div class="col-sm-2 ">
         <button class="btn btn-success waves-effect waves-light mr-3" type="submit" id="search-btn"> </button>
        </div>
            </div>
             </div>
                
            </div>

      </div>
       </form>
   </div>      
</div>


   @if ($stages_updates)
   <div class="row">
  
    <div class="col-lg-6">
    </div>

   <div class="col-lg-6" style="color: black;">
       <div class="card client-card">                               
           <div class="card-body text-left">                                   
               <h4 class="">  {{$client_name}} : To </h4> 
               <p class="text-muted text-left mt-3">Attention: legal Unit team </p>
               <h5 class="" style="color: darkblue;">{{$lase_case->court_ar}} </h5> 
                @foreach ($cases as $case)
                <h5 class=" text-left mt-3"> <span style="color: darkblue">{{$case->S_CASE_UID}}.No</span>  <span style="color: rgb(161, 1, 1)">{{$case->case_stage_ar}}</span></h5>
                @endforeach

               @foreach ($againsts_name as $against)
           <h5>{{$against->S_AGAINST_AR_NAME}} <span style="color: rgb(161, 1, 1)"> : Defendant</span> </h5>
               @endforeach
           <h5> {{$main_case->register_date}}<span style="color: rgb(161, 1, 1)" >: date of filiing </span></h5>
               <h5> {{$main_case->N_PaymentValue}} <span style="color: rgb(161, 1, 1)"> : cliam amount</span></h5> 
               <div class="row" style="border: 1px solid #9d9d9d;">
               
                <div class="col-6 text-center">
                    <h6 style="font-weight: bold">Decision</h6><br>
                    <h6 style="font-weight: bold">{{$lase_stage->decision_eng}}</h6>
                </div>

                <div class="col-6 text-center">
                    <h6 style="font-weight: bold">next session date </h6><br>
                <h6 style="font-weight: bold">{{$lase_stage->DT_HEARING_DATE}}</h6>
                </div>

               
               </div>

               <div class="row">
               

                <div class="col-6 text-right">
                    <p style="font-weight: bold">تحية طيبة وبعد،،،،</p>
                </div>

                <div class="col-6 ">
                    <p style="font-weight: bold">,Dear Sirs </p>
                </div>
               </div>

               <div class="row" style="border: 1px solid #9d9d9d;">
               
                

                <div class="col-6 text-right">
                    <h6>{{$lase_stage->S_HEARING_DESIGION}}</h6>
                </div>

                <div class="col-6 text-left">
                    <h6>{{$lase_stage->decision_eng}}</h6>
                </div>

               
               </div>

               <div class="row">
               

                <div class="col-6 text-right">
                    <p style="font-weight: bold">وتفضلوا بقبول فائق الاحترام</p>
                </div>

                <div class="col-6 ">
                    <p style="font-weight: bold">,Best regards</p>
                </div>
               </div>


              
              
           </div><!--end card-body-->                                                                     
       </div><!--end card-->
   </div><!--end col--> 
 
</div>
   @endif 



@endsection


@section('css-link')
<link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('page-script')
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.forms-advanced.js')}}"></script>

<script>

if (lang == "ar") {
document.body.style.direction = "rtl"; 
document.body.style.textAlign = "right"; 

document.getElementById("breadcrumb-float").classList.add('float-left');
document.getElementById("breadcrumb-1").innerHTML ="تحديثات العملاء"; 
document.getElementById("breadcrumb-2").innerHTML ="العملاء"; 

document.getElementById("page-name").innerHTML ="تحديثات العملاء";

document.getElementById("label").innerHTML ="رقم الملف"; 
document.getElementById("search-btn").innerHTML ="بحث"; 

}else{
document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 
document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-1").innerHTML = "clients updates";
document.getElementById("breadcrumb-2").innerHTML ="clients"; 

document.getElementById("page-name").innerHTML = "CLIENTS UPDATES";

document.getElementById("label").innerHTML ="File number"; 
document.getElementById("search-btn").innerHTML ="Search";
}
</script>
 @endsection

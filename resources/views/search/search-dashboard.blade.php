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

        <div class="card client-card"> 
            <div class="col-lg-12">
                <h4 class="mx-3" id="clients-search-title" style="font-weight: bold"></h4>
            </div>
           
           <form class="form"  method="POST" action="{{route('search-clients')}}">
               @csrf                                
           <div class="card-body text-center" >
                 <div class="row">
                 <div class="col-8">
                    <div class="row">
                  <div class="col-sm-3">
                               <input class="form-control " name="client_name" id="clients-search-input" type="text">
                              
                </div>
            <div class="col-sm-4 text-right">
             <button class="btn btn-success waves-effect waves-light mx-3" type="submit" id="clients-search-btn"> </button>
            </div>
                </div>
                 </div>
                
                 </div>

             </div>
           </form>
       </div>      
  </div>


<div class="col-lg-12">

           
    <div class="card client-card">  
        <div class="col-lg-12">
            <h4 class="mx-3" id="againsts-search-title" style="font-weight: bold"></h4>
        </div>

       <form class="form"  method="POST" action="{{route('search-againsts')}}">
           @csrf                                
       <div class="card-body text-center" >
             <div class="row">
             <div class="col-8">
                <div class="row">
              <div class="col-sm-3">
                           <input class="form-control " id="againsts-search-input" name="against_name" type="text" id="example-text-input">
                          
            </div>
        <div class="col-sm-4 text-right">
         <button class="btn btn-success waves-effect waves-light mx-3" id="againsts-search-btn">  </button>
        </div>
            </div>
             </div>
            
                       
                      
                    
            </div>

      </div>
       </form>
   </div>      
</div>

<div class="col-lg-12">

    <div class="card client-card"> 
        <div class="col-lg-12">
            <h4 class="mx-3" id="files-search-title" style="font-weight: bold"></h4>
        </div>
        <form class="form"  method="POST" action="{{route('search-files')}}">
            @csrf                           
       <div class="card-body text-center" >
             <div class="row">
             <div class="col-10">
                <div class="row">
        

            <div class="col-3  ">
                <div class="form-group row">
              <label for="example-text-input" class="col-sm-4 col-form-label px-0" id="files-search-file-num"> </label>
              <div class="col-sm-8">
                <input class="form-control " name="file_num" type="text" >

              </div>
          </div>
                 
   </div>

            <div class="col-3  ">
                         <div class="form-group row">
                       <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="files-search-client"></label>
                       <div class="col-sm-8">
                         <select class="custom-select text-center" name="client">
                             <option value=""></option>
                            @foreach ($clients as $client)
                            <option value="{{$client->N_CLIENT_ID}}">{{$client->S_CLIENT_AR_NAME}}</option>
                              @endforeach
                          </select>
                       </div>
                   </div>
                          
            </div>
             
             
    

              

        <div class="col-1  text-right">
         <button class="btn btn-success waves-effect waves-light mr-3" id="files-search-btn"> </button>
        </div>
            </div>
             </div>
                   
            </div>

      </div>
        </form>
   </div>      
</div>

<div class="col-lg-12">

    <div class="card client-card">  
        <div class="col-lg-12">
            <h4 class="mx-3" id="main-cases-title" style="font-weight: bold"></h4>
        </div>
      <form class="form"  method="POST" action="{{route('search-main-cases')}}">
          @csrf                                
       <div class="card-body text-center" >
             <div class="row">
             <div class="col-10">
                <div class="row">

              
              <div class="col-2 pl-0">
                           <input class="form-control font-13" name="main_case_num" id="main-cases-main-case-num" type="text" >
            </div>

            <div class="col-3  ">
                         <div class="form-group row">
                       <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="main-cases-status"></label>
                       <div class="col-sm-8">
                         <select class="custom-select text-center" name="status">
                          <option value=" "></option>
                          @foreach ($case_status as $case_status_filter)
                          <option value="{{$case_status_filter->N_DetailedCode}}">{{$case_status_filter->S_Desc_A}}</option>  
                          @endforeach
                          </select>
                       </div>
                   </div>
                          
            </div>
              <div class="col-3 ">
                      <div class="form-group row">
                       <label for="example-text-input" class="col-sm-4 col-form-label text-center px-0" id="main-cases-branch"></label>
                       <div class="col-sm-8">
                         <select class="custom-select text-center" name="branch">
                          <option value=" "></option>
                          @foreach ($branchs as $branch_filter)
                          <option value="{{$branch_filter->N_DetailedCode}}">{{$branch_filter->S_Desc_A}}</option>  
                          @endforeach
                            
                               
                           </select>
                       </div>
                   </div>
                          
            </div>
            
      <div class="col-1  text-right">
         <button class="btn btn-success waves-effect waves-light mr-3" id="main-cases-btn"> </button>
        </div>
            </div>
             </div>
            
                       
                      
                    
            </div>

      </div>
      </form>
   </div>      
</div>

<div class="col-lg-12">
    <div class="card client-card">
        <div class="col-lg-12">
            <h4 class="mx-3" id="cases-search-title" style="font-weight: bold"></h4>
        </div>
      <form class="form"  method="POST" action="{{route('search-cases')}}">
          @csrf                               
       <div class="card-body text-center" >
        <div class="row">
        <div class="col-12">
           <div class="row">
         
               <div class="col-3 pl-0">
                   <div class="form-group row">
                       <label for="example-text-input" class="col-sm-4 col-form-label text-center" id="cases-search-num"></label>
                       <div class="col-sm-8">
                        <input class="form-control pl-0 font-11"   name="case_num" type="text" >
                    </div>
                   </div>
                    
                          
            </div>

      
         
         <div class="col-3 ">
                   <div class="form-group row">
                  <label for="example-text-input" class="col-sm-4 col-form-label text-center" id="cases-search-type"> </label>
                  <div class="col-sm-8">
                    <select class="custom-select text-center" name="type">
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
              <select class="custom-select text-center" name="stage">
               <option ></option>
               @foreach ($case_stage as $case_stage_filter)
               <option value="{{$case_stage_filter->N_DetailedCode}}">{{$case_stage_filter->S_Desc_A}}</option>  
               @endforeach
                    
                </select>
            </div>
        </div>
               
 </div>
       <div class="col-2 ">
           <div class="form-group row">
            <label for="example-text-input" class="col-sm-5 col-form-label text-center" id="cases-search-court"></label>
            <div class="col-sm-7">
              <select class="custom-select text-center" name="court">
               <option ></option>
               @foreach ($court as $court_filter)
               <option value="{{$court_filter->N_DetailedCode}}">{{$court_filter->S_Desc_A}}</option>  
               @endforeach
                    
                </select>
            </div>
        </div>
               
 </div>

   <div class="col-1 ">
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
@endsection


@section('page-script')

<script>
     if (lang == "ar") {
    document.body.style.direction = "rtl"; 
    document.body.style.textAlign = "right"; 

    document.getElementById("breadcrumb-float").classList.add('float-left');
    document.getElementById("breadcrumb-1").innerHTML = "البحث"; 
    document.getElementById("breadcrumb-2").innerHTML = "لوحة البحث الرئيسية"; 

    document.getElementById("page-name").innerHTML = "لوحة البحث الرئيسية";

    document.getElementById("clients-search-title").innerHTML = "بحث العملاء";
    document.getElementById("clients-search-input").placeholder = "اسم العميل";
    document.getElementById("clients-search-btn").innerHTML = "بحث ";

    document.getElementById("againsts-search-title").innerHTML = "بحث الخصوم";
    document.getElementById("againsts-search-input").placeholder = "اسم الخصم";
    document.getElementById("againsts-search-btn").innerHTML = "بحث ";

    
    
    document.getElementById("files-search-title").innerHTML = "بحث الملفات";
    document.getElementById("files-search-file-num").innerHTML = "رقم الملف ";
    document.getElementById("files-search-client").innerHTML = " اسم الموكل ";
    document.getElementById("files-search-btn").innerHTML = "بحث ";

    document.getElementById("main-cases-title").innerHTML = "بحث القضايا";
    document.getElementById("main-cases-main-case-num").placeholder = "رقم القضية ";
    document.getElementById("main-cases-status").innerHTML = "حالة القضية ";
    document.getElementById("main-cases-branch").innerHTML = " الفرع ";
    document.getElementById("main-cases-btn").innerHTML = " بحث ";

    document.getElementById("cases-search-title").innerHTML = "بحث الدعاوى";
    document.getElementById("cases-search-num").innerHTML = "رقم الدعوى";
    document.getElementById("cases-search-type").innerHTML = "نوع الدعوى ";
    document.getElementById("cases-search-stage").innerHTML = "مرحلة الدعوى ";
    document.getElementById("cases-search-court").innerHTML = "المحكمة ";
    document.getElementById("cases-search-btn").innerHTML = "بحث ";


     }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "search";
    document.getElementById("breadcrumb-1").innerHTML = "search dashboard";


    document.getElementById("page-name").innerHTML = "SEARCH DASHBOARD";

    document.getElementById("clients-search-title").innerHTML = "Clients search";
    document.getElementById("clients-search-input").placeholder = "Client name";
    document.getElementById("clients-search-btn").innerHTML = "search ";

    document.getElementById("againsts-search-title").innerHTML = "Againsts search";
    document.getElementById("againsts-search-input").placeholder = "Against name";
    document.getElementById("againsts-search-btn").innerHTML = "search ";

    
    document.getElementById("files-search-title").innerHTML = "Files search";
    document.getElementById("files-search-file-num").innerHTML = "File number";
    document.getElementById("files-search-client").innerHTML = "Client name ";
    document.getElementById("files-search-btn").innerHTML = "search ";

    
    document.getElementById("main-cases-title").innerHTML = "Main cases search";
    document.getElementById("main-cases-main-case-num").placeholder = "Case number ";
    document.getElementById("main-cases-status").innerHTML = "Case status ";
    document.getElementById("main-cases-branch").innerHTML = " Branch ";
    document.getElementById("main-cases-btn").innerHTML = " search ";


    document.getElementById("cases-search-title").innerHTML = "Files search";
    document.getElementById("cases-search-num").innerHTML = "Case number";
    document.getElementById("cases-search-type").innerHTML = "Case Type ";
    document.getElementById("cases-search-stage").innerHTML = "Case stage ";
    document.getElementById("cases-search-court").innerHTML = "Case court ";
    document.getElementById("cases-search-btn").innerHTML = "search ";

     }
</script>
    
@endsection
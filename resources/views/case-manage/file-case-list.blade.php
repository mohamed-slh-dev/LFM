@extends('layouts.main-layout')

@section('path')
<li class="breadcrumb-item active"><a href="javascript:void(0);">ارقام القضايا</a></li>
<li class="breadcrumb-item active">ادارة القضايا</li>
@endsection

@section('page-name')
    ارقام القضايا
@endsection

@section('content')
    <div class="col-lg-12">

        <div class="card client-card">                               
           <div class="card-body text-center" >
                 <div class="row">
                 <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <form class="form"  method="POST" action="{{route('search-file-list')}}">
                                @csrf  
                            <div class="row">
                               
                            
                     <div class=" col-4 px-0">
                                <input class="form-control " name="file_id" placeholder="رقم الملف" type="text" id="example-text-input">
                 </div>
 
                  <div class=" col-6 text-right">
              <button class="btn btn-success waves-effect waves-light mr-3"> بحث </button>
             </div>
                            
                            </div>
                            </form>
                        </div>
                        <div class="col-6">
                            <form class="form"  method="POST" action="{{route('search-case-list')}}">
                                @csrf  
                            <div class="row">
                               
                            
                     <div class=" col-4 px-0">
                                <input class="form-control " name="main_case_id" placeholder="رقم القضية" type="text" id="example-text-input">
                 </div>
 
                  <div class=" col-6 text-right">
              <button class="btn btn-success waves-effect waves-light mr-3"> بحث </button>
             </div>
                            
                            </div>
                            </form>
                        </div>

                </div>
                 </div>
            

                           
                          
                        
                </div>

          </div>
       </div>      
  </div>
  <div class="row d-flex justify-content-center">
    <div class="col-lg-8">
          <div class="card">
             <div class="card-body">

                 <div class="table-responsive ">
                     <table class="table table-bordered  table-striped mb-0">
                         <thead>
                             <tr>
                                 <th>رقم الملف</th>
                                 <th>رقم القضية</th>
                              
                                 
                             </tr>
                         </thead>
                         <tbody>
                            @foreach ($cases as $case)
                                
                           
                              <tr>
                                 <th>{{$case->S_CASE_FILE_NUM}}</th>
                                 <td>{{$case->N_CASE_ID}}</td>
                             </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div> 
             </div>
           </div>                                           
         </div> 
                                             
      </div>
@endsection
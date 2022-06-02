@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
  
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
        <div class="row">
           
            <div class="col-lg-3 ">
               
                    <div class="form-group  mb-0">
                       
                        <button type="button" class="btn btn-primary waves-effect waves-light mb-0 " data-toggle="modal" data-animation="bounce" data-target=".new-contract" id="add-contract-btn"></button>

                    </div>

                   
               
                  </div>
         
            </div>
        </div>
   </div>
 </div>
      
    

    <div class="col-12">
                            <div class="card">
                                <div class="card-body">
    
                                    <h4 class="mt-0 header-title" id="contract-tbl-title"></h4>
                                    <p class="text-muted mb-3">
                                    </p>
    
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 table-centered">
                                            <thead>
                                            <tr>
                                                
                                                <th id="tbl-1"></th>
                                                <th id="tbl-2"></th>
                                                <th id="tbl-3"></th>
                                                <th id="tbl-4"></th>
                                                <th id="tbl-5"></th>
                                                <th id="tbl-6" class="text-center"></th>
                                                <th id="tbl-7" class="text-center"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                          @foreach ($contracts as $cont)
                                         <tr>
                                         <td>{{$cont->contract_name}}</td>
                                         <td>{{$cont->contractType}}</td>
                                            <td>{{$cont->amount}}</td>
                                            <td>{{$cont->start_date}}</td>
                                            <td>{{$cont->end_date}}</td>
                                            <td>
                                                @if ($cont->document)
                                                <a href="{{asset('assets/clients-contracts/'.$cont->document)}}" class="download-icon-link" download>
                                                    تحميل 
                                                        </a>
                                                    @else 
                                                    <a> </a>
                                                @endif
                                                
                                            </td>
                                            <td class="text-center">
                                                <a href="{{url('delete-contract/'.$cont->id)}}" class="ml-3"><i class="fas fa-trash text-danger font-16"></i></a>
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

<div class="modal fade new-contract" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close float-left" data-dismiss="modal" aria-hidden="true">×</button>
 
            </div>
            <div class="modal-body">
                <form class="form"  method="POST" action="{{route('add-contract')}}" enctype="multipart/form-data">
                    @csrf
                   
              <div class="row">
             
                
                   <div class="col-12"> 
                    <div class="form-group row">
                             
                              <div class="col-4">
                               <label style="font-weight: bold;" class="mb-3" id="add-contract-name"></label>
                               <input class="form-control" type="text" name="name" id="example-text-input">

                              </div>
                              <div class="col-4">
                                  <label style="font-weight: bold;" class="mb-3" id="add-contract-type"></label>
                                  <select name="type" id=""class="form-control" >
                                      @foreach ($contract_type as $cont_type)
                                      <option value="{{$cont_type->N_DetailedCode}}">{{$cont_type->S_Desc_A}}</option>  
                                      @endforeach
                                  </select>
                                 </div>
                                 <div class="col-4">
                                  <label style="font-weight: bold;" class="mb-3" id="add-contract-doc"></label>
                                  <input class="form-control" type="file" name="doc" id="example-text-input">
  
                                 </div>
                          </div>
        
               </div>
                 <div class="col-12"> 
                    <div class="form-group row">
                             
                              <div class="col-4">
                               <label style="font-weight: bold;" class="mb-3" id="add-contract-amount"></label>
                               <input class="form-control" type="number" name="amount" id="example-text-input">

                              </div>
                              <div class="col-4">
                                  <label style="font-weight: bold;" class="mb-3" id="add-contract-start"></label>
                                  <input class="form-control" type="date" name="start" id="example-text-input">
  
                                 </div>
                                 <div class="col-4">
                                    <label style="font-weight: bold;" class="mb-3" id="add-contract-end"></label>
                                    <input class="form-control" type="date" name="end" id="example-text-input">
    
                                   </div>
                          </div>
        
               </div>
                 
                 <div class="col-12"> 
                    <div class="form-group row">
                             
                              <div class="col-12">
                               <label style="font-weight: bold;" class="mb-3" id="add-contract-subject"></label>
                               <textarea class="form-control" name="subject" rows="3" id="message"></textarea>

                              </div>
                          </div>
        
               </div>

               <div class="col-12"> <hr> </div>


                 <div class="col-12"> 
                    <div class="form-group row">
                      <div class="col-sm-4">
                          <label style="font-weight: bold;" class="mb-3" id="add-contract-country"> </label>
                          <input class="form-control" name="country" type="text" id="example-text-input">
                      </div>
                      <div class="col-sm-4">
                          <label style="font-weight: bold;" class="mb-3" id="add-contract-city"></label>
                          <input class="form-control" type="text" name="city" id="example-text-input">

                       </div>

                       <div class="col-sm-4">
                        <label style="font-weight: bold;" class="mb-3" id="add-contract-state"></label>
                        <input class="form-control" type="text" name="state" id="example-text-input">

                     </div>
                     
                              
                    </div>
                  </div>
                   
                  <div class="col-12"> 
                    <div class="form-group row">
                      <div class="col-sm-4">
                          <label style="font-weight: bold;" class="mb-3" id="add-contract-address"> </label>
                          <input class="form-control" name="address" type="text" id="example-text-input">
                      </div>
                      <div class="col-sm-4">
                          <label style="font-weight: bold;" class="mb-3" id="add-contract-phone"></label>
                          <input class="form-control" type="text" name="phone" id="example-text-input">

                       </div>

                       <div class="col-sm-4">
                        <label style="font-weight: bold;" class="mb-3" id="add-contract-notes"></label>
                        <input class="form-control" type="text" name="notes" id="example-text-input">

                     </div>
                     
                              
                    </div>
                  </div>
                 


                  <div class="col-12"> 
                    
                    <button class="btn btn-sm btn-primary mr-1 font-15" id="add-contract-add-btn"> </button>
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
document.getElementById("breadcrumb-1").innerHTML = "منصتي"; 
document.getElementById("breadcrumb-2").innerHTML = " العقود و التوكلات"; 

document.getElementById("page-name").innerHTML = " العقود و التوكلات";


document.getElementById("add-contract-btn").innerHTML = '<i class="mdi mdi-plus-box ml-2"></i> إضافة  عقد'; 

document.getElementById("contract-tbl-title").innerHTML = 'جميع العقود و التوكيلات'; 

document.getElementById("tbl-1").innerHTML = "الموضوع"; 
document.getElementById("tbl-2").innerHTML = "نوع العقد"; 
document.getElementById("tbl-3").innerHTML = "المبلغ"; 
document.getElementById("tbl-4").innerHTML = "تاريخ البداية"; 
document.getElementById("tbl-5").innerHTML = "تاريخ الانتهاء"; 
document.getElementById("tbl-6").innerHTML = "المستند"; 
document.getElementById("tbl-7").innerHTML = "حذف"; 

document.getElementById("add-contract-name").innerHTML = "اسم العقد"; 
document.getElementById("add-contract-type").innerHTML = "نوع العقد"; 
document.getElementById("add-contract-doc").innerHTML = "مستند العقد"; 
document.getElementById("add-contract-amount").innerHTML = "المبلغ"; 
document.getElementById("add-contract-start").innerHTML = "تاريخ البداية"; 
document.getElementById("add-contract-end").innerHTML = "تاريخ الانتهاء"; 
document.getElementById("add-contract-subject").innerHTML = "الموضوع"; 
document.getElementById("add-contract-country").innerHTML = "البلد"; 
document.getElementById("add-contract-city").innerHTML = "المدينة"; 
document.getElementById("add-contract-state").innerHTML = "الولاية"; 
document.getElementById("add-contract-address").innerHTML = "العنوان"; 
document.getElementById("add-contract-phone").innerHTML = "رقم الهاتف"; 
document.getElementById("add-contract-notes").innerHTML = "ملاحظات"; 
document.getElementById("add-contract-add-btn").innerHTML = "اضافة"; 
       }else{

        document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "my platform";
document.getElementById("breadcrumb-1").innerHTML = "contracts";

document.getElementById("page-name").innerHTML = "CONTRACTS";

document.getElementById("add-contract-btn").innerHTML = '<i class="mdi mdi-plus-box mr-2"></i> Add contract'; 
document.getElementById("contract-tbl-title").innerHTML = 'All contracts'; 

document.getElementById("tbl-1").innerHTML = "Subject"; 
document.getElementById("tbl-2").innerHTML = "Contract type"; 
document.getElementById("tbl-3").innerHTML = "Amount"; 
document.getElementById("tbl-4").innerHTML = "Start date"; 
document.getElementById("tbl-5").innerHTML = "End date"; 
document.getElementById("tbl-6").innerHTML = "Document"; 
document.getElementById("tbl-7").innerHTML = "Delete"; 


document.getElementById("add-contract-name").innerHTML = "Contract name"; 
document.getElementById("add-contract-type").innerHTML = "Contract type"; 
document.getElementById("add-contract-doc").innerHTML = "Document"; 
document.getElementById("add-contract-amount").innerHTML = "Amount"; 
document.getElementById("add-contract-start").innerHTML = "Start date"; 
document.getElementById("add-contract-end").innerHTML = "End date"; 
document.getElementById("add-contract-subject").innerHTML = "Subject"; 
document.getElementById("add-contract-country").innerHTML = "Country"; 
document.getElementById("add-contract-city").innerHTML = "City"; 
document.getElementById("add-contract-state").innerHTML = "State"; 
document.getElementById("add-contract-address").innerHTML = "Address"; 
document.getElementById("add-contract-phone").innerHTML = "Phone number"; 
document.getElementById("add-contract-notes").innerHTML = "Notes"; 
document.getElementById("add-contract-add-btn").innerHTML = "Add "; 

       }
</script>



    
@endsection
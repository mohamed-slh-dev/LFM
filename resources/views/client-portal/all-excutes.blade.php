@extends('layouts.client-layout')

@section('path')
<li id="breadcrumb-2" class="breadcrumb-item active"><a href="javascript:void(0);"></a></li>
<li id="breadcrumb-1" class="breadcrumb-item active"></li>
@endsection

@section('page-name')
    
@endsection

@section('content')

<div class="row">

    <div class="col-lg-12">
        <div class="card" style="background-color: #fff;">
            <div class="card-body">

                <h4 class="mt-0 header-title" id="tbl-title"> التنفيذات</h4>
                <p class="text-muted mb-3" id="tbl-desc">جميع التنفيذات لكل القضايا 
                </p>

                <div class="table-responsive">
                    <table class="table table-bordered mb-0 table-centered">
                <thead>
                    <tr>
                        <th id="th-1" style="width: 140px;">رقم التنفيذ</th>
                        <th id="th-2" style="width: 130px;">نوع التنقيذ</th>
                        <th id="th-3" style="width: 130px;"> المبلغ المستحق</th>
                        <th id="th-4" style="width: 150px;"> المبلغ المتحصل</th>
                        <th id="th-5" style="width: 130px;"> تاريخ التنفيذ</th>
                        <th id="th-6"style="width: 130px;"> رسوم التنفيذ</th>
                        <th id="th-7"style="width: 130px;">رسوم المكتب</th>
                        <th id="th-8" style="width: 130px;">رسوم القضية</th>
                        <th id="th-9"style="width: 200px;"> موضوع التنفيذ</th>
                        <th id="th-10"style="width: 150px;">  عرض الاجراءات التنفيذية</th>
                </tr>
                </thead>
             
                <tbody>
                       
                @foreach($excutes as $excute )
               
                <tr>
                   
                    <td  style="width: 100px;"> {{$excute->excute_uid}}</td>
                        <td  style="width: 100px;"> {{$excute->typeName}}</td>
                        <td  style="width: 100px;"> {{$excute->cliam_amount }}</td>
                        <td  style="width: 130px;"> {{$excute->collected_amount}}</td>
                        <td  style="width: 100px;"> {{$excute->excute_date}}</td>
                        <td  style="width: 100px;"> {{$excute->excute_fee}}</td>
                        <td  style="width: 100px;"> {{$excute->case_fee}}</td>
                        <td  style="width: 100px;"> {{$excute->office_fee}}</td>
                        <td  style="width: 100px;"> {{$excute->subject}}</td>
                      
                        <td class="text-center" style="width: 180px;">
                           
                            <a href="{{url('client-excute-actions/'.$excute->excute_stage_id)}} ">
                                <button class="btn-sm btn-outline-dark waves-effect waves-light"><i class="dripicons-preview "></i></button>
                            </a>

                        </td>
                    </tr>
              
                    @endforeach
                </tbody>
                
            </table>
                </div>
            </div>
        </div>                                            
    </div>
   
</div>
<div class="float-left mt-4">
    {{ $excutes->links() }}
    
    </div> 
    
@endsection


@section('page-script')
    
<script>
           if (lang == "ar") {
document.body.style.direction = "rtl"; 
document.body.style.textAlign = "right"; 

document.getElementById("breadcrumb-float").classList.add('float-left');
document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
document.getElementById("breadcrumb-2").innerHTML = " التنفيذات"; 

document.getElementById("page-name").innerHTML = " التنفيذات";

           }else{
            document.body.style.direction = "ltr"; 
document.body.style.textAlign = "left"; 

document.getElementById("breadcrumb-float").classList.add('float-right');
document.getElementById("breadcrumb-2").innerHTML = "cases manage";
document.getElementById("breadcrumb-1").innerHTML = "executes";

document.getElementById("page-name").innerHTML = "EXECUTES";

document.getElementById("tbl-title").innerHTML = "Executes";
document.getElementById("tbl-desc").innerHTML = "All executes in all cases";

document.getElementById("th-1").innerHTML = "Execute Number";
document.getElementById("th-2").innerHTML = "Execute Type";
document.getElementById("th-3").innerHTML = "Cliam Amount";
document.getElementById("th-4").innerHTML = "Collected Amount";
document.getElementById("th-5").innerHTML = "Execute Date";
document.getElementById("th-6").innerHTML = "Execute Fees";
document.getElementById("th-7").innerHTML = "Office Fees";
document.getElementById("th-8").innerHTML = "Case Fees";
document.getElementById("th-9").innerHTML = "Execute subject";
document.getElementById("th-10").innerHTML = "View Execute Actions";


           }
</script>
    
@endsection
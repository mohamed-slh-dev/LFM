@extends('layouts.main-layout')

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
                    <h5 class="mt-0" style=" font-weight: bold; " id="title"></h5>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center">
                                <h3> {{$files->count()}} <i class="fas fa-file text-secondary ml-1"></i></h3>
                                <p class="text-muted" id="all-files"></p>
                            </div>
                        </div><!--end col-->

                        

                          <div class="col-md-2">
                            <div class="text-center">
                                <h3> {{$main_cases->count()}} <i class="fas fa-file-alt  text-secondary ml-1"></i></h3>
                                <p class="text-muted" id="all-main-cases"></p>
                            </div>
                        </div><!--end col-->

                         <div class="col-md-2">
                            <div class="text-center">
                                <h3> {{$cases->count()}} <i class="fas fa-file-alt  text-secondary ml-1"></i></h3>
                                <p class="text-muted" id="all-cases"></p>
                            </div>
                        </div><!--end col-->

                         <div class="col-md-2">
                            <div class="text-center">
                                <h3> {{$cases_not_registerd->count()}} <i class="fas fa-folder-open    text-secondary ml-1"></i></h3>
                                <p class="text-muted" id="cases-not-registered"></p>
                            </div>
                        </div><!--end col-->

                        

                        <div class="col-md-2">
                            <div class="text-center">
                                <h3> {{$cases_startup->count()}} <i class="fas fa-spinner text-success ml-1"></i></h3>
                                <p class="text-muted" id="all-excuting"></p>
                            </div>
                        </div><!--end col-->

                        <div class="col-md-2">
                            <div class="text-center">
                                <h3> {{$decisions->count()}} <i class="fas fa-hammer text-danger ml-1"></i></h3>
                                <p class="text-muted" id="all-judges"></p>
                            </div>
                        </div><!--end col-->
                        
                    </div><!--end row-->
                    <div class="apexchart-wrapper chart-demo m-0">
                        <div id="task_report" class="chart-gutters"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->
@endsection

@section('page-script')
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
    document.getElementById("breadcrumb-1").innerHTML = "ادارة القضايا"; 
    document.getElementById("breadcrumb-2").innerHTML = "لوحة تحكم القضايا"; 

    document.getElementById("page-name").innerHTML = "لوحة تحكم القضايا";

    document.getElementById("title").innerHTML = "تقارير القضايا";
    document.getElementById("all-files").innerHTML = "مجموع الملفات";
    document.getElementById("all-main-cases").innerHTML = "مجموع القضايا";
    document.getElementById("all-cases").innerHTML = "مجموع الدعاوى";
    document.getElementById("cases-not-registered").innerHTML = "الدعاوى قيد التسجيل";
    document.getElementById("all-excuting").innerHTML = "الدعاوى قيد التنفيذ";
    document.getElementById("all-judges").innerHTML = "الاحكام";

      }else{
        document.body.style.direction = "ltr"; 
    document.body.style.textAlign = "left"; 
    document.getElementById("breadcrumb-float").classList.add('float-right');
    document.getElementById("breadcrumb-2").innerHTML = "cases manage";
    document.getElementById("breadcrumb-1").innerHTML = "cases dashboard";


    document.getElementById("page-name").innerHTML = "CASES DASHBOARD";

    document.getElementById("title").innerHTML = "Cases reports";
    document.getElementById("all-files").innerHTML = "All files";
    document.getElementById("all-main-cases").innerHTML = "All main cases";
    document.getElementById("all-cases").innerHTML = "All cases";
    document.getElementById("cases-not-registered").innerHTML = "Under registration ";
    document.getElementById("all-excuting").innerHTML = "Cases underproccess";
    document.getElementById("all-judges").innerHTML = "Judges";
      }
</script>
@endsection
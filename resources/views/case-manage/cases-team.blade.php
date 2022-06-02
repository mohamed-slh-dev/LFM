@extends('layouts.main-layout')

@section('path')
<li class="breadcrumb-item active"><a href="javascript:void(0);">فريق العمل</a></li>

<li class="breadcrumb-item active">ادارة القضايا</li>
@endsection

@section('page-name')
فريق العمل
@endsection

@section('content')
<div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
    
                                  
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 table-centered">
                                            <thead>
                                            <tr>
                                            <th>رقم الملف</th>
                                                <th>رقم القضية</th>
                                                <th> موضوع القضية</th>
                                                <th>المكلف الاداري</th>
                                                <th> بواسطة</th>
                                                <th> تاريخ الانشاء</th>
                                                <th> تاريخ التسجيل</th>
                                                
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($options as $option)
                                            <tr>
                                                <td> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table><!--end /table-->
                                    </div><!--end /tableresponsive-->
                                    <div class="float-left mt-4">
                                        {{ $options->links() }}
                                        
                                    </div>
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!-- end col -->
    
@endsection
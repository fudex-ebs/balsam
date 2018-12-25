@extends('admin/master', ['title'=>'اعدادات الشحن والتوصيل','active'=>'settings'])
@section('content')
<div class="row mt">
    <div class="col-lg-6">
        <div class="form-panel">      
            <h4 class="mb"><i class="fa fa-angle-right"></i> أضف تفاصيل شحن </h4>
            <hr/>
            <form class="form-horizontal style-form" method="post" action="{{ url('admin/add_delivery_settings') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="country" class="col-sm-2 col-sm-2 control-label">البلد  </label>
                    <div class="col-sm-5">
                        <select name="country" id="country" class="form-control country">
                            <option value="0">-- اختر بلد   -- </option>
                            @if($countries)
                            @foreach($countries as $row)
                            <option value="{{ $row->id }}">{{ $row->title_ar }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city" class="col-sm-2 col-sm-2 control-label">المنطقة  </label>
                    <div class="col-sm-5">
                        <select name="region" id="region" class = "form-control" required="">
                            <option value="0"> -- اختر منطقة -- </option>                 
                        </select>
                    </div>
                    <div class="col-sm-5">
                        <a href="javascript:void(0);" class="addOption" data-toggle="modal" data-target="#addRegion" title="أضف منطقة">
                            <i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp; 
                            <a href="javascript:void(0);" class="viewOption" data-toggle="modal" data-target="#viewRegions" title="عرض المناطق">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city" class="col-sm-2 col-sm-2 control-label">المدينة  </label>
                    <div class="col-sm-5">
                        <select name="city" id="city" class = "form-control" required="">
                            <option value="0"> -- اختر مدينة -- </option>                 
                        </select>
                    </div>
                    <div class="col-sm-5">
                        <a href="javascript:void(0);" class="addOption" data-toggle="modal" data-target="#addCity" title="أضف مدينة">
                            <i class="fa fa-plus-circle"></i></a> &nbsp; &nbsp; 
                            <a href="javascript:void(0);" class="viewOption" data-toggle="modal" data-target="#viewCities" title="عرض المدن">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-2 col-sm-2 control-label">السعر</label>
                    <div class="col-sm-10">
                        <input type="text" name="price" id="price" class="form-control">
                    </div>
                </div>       
                <div class="form-group">
                    <label for="active" class="col-sm-2 col-sm-2 control-label">نشط ؟</label>
                    <div class="col-sm-10">
                        <div class="radio">                    
                            <label> <input type="radio" name="active" id="yes" value="1" checked> نعم </label>                    
                            <label> <input type="radio" name="active" id="no" value="0"> لا </label>                    
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-theme">أضف</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="col-lg-6">

        <div class="form-panel">
            {!! Form::open(array('url'=>'admin/tbl_actions','method'=>'POST')) !!}  
            {{ csrf_field() }}         
            <input type="hidden" value="Delivery_setting" name="tbl" />
            <table class="table table-striped table-advance table-hover" id="myTbl">
                <h4><i class="fa fa-angle-right"></i> عرض اعدادات الشحن </h4>
                <hr> 
                <div class="controls myctls">     
                    <button type="submit" class="btn btn-danger" title="حذف"><i class="fa fa-trash-o"></i></button>                
                </div>
                <thead>
                    <tr>
                        <th class="text-center"><input type="checkbox" name="all" id="all" /></th>                
                        <th class="text-center">المدينة </th>                
                        <th class="text-center">السعر</th>
                        <th class="text-center">نشط </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)                
                    <tr>
                        <td class="text-center"><input type="checkbox" value="{{$row->itmID}}" name="select_rows[]"/></td>                    
                        <td>{{ $row->title_ar }} </td>
                        <td>{{ $row->price }} ريال</td>
                        <td>
                            @if($row->active == 1) <span class="label label-info label-mini"> نعم</span>
                            @else <span class="label label-warning label-mini"> لا </span> @endif
                        </td>
                        <td>                
                            <a href="{{ url('admin/delivery_settings') }}/{{$row->itmID}}/edit" class="btn btn-primary btn-xs" title="تعديل"><i class="fa fa-pencil"></i></a>
                            <a href="{{ url('admin/delivery_settings/') }}/{{$row->itmID}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            </form>
            <div class="clearfix"></div>
        </div>


    </div>
</div>


<div class="modal fade" id="addRegion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أضف منطقة</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal style-form" method="post" action="{{ url('admin/addRegion') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="country_id" class="col-sm-3 col-sm-4 control-label">البلد  </label>
                        <div class="col-sm-7">
                            <select name="country_id" id="country_id" class="form-control country">
                                <option value="0">-- اختر بلد   -- </option>
                                @if($countries)
                                @foreach($countries as $row)
                                <option value="{{ $row->id }}">{{ $row->title_ar }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="region" class="col-sm-3 col-sm-4 control-label">اسم المنطقة  </label>
                        <div class="col-sm-7">
                            <input type="text" name="region" id="region" class="form-control" required=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="active" class="col-sm-3 col-sm-4 control-label">نشط؟ </label>
                        <div class="col-sm-7">
                            <input type="radio" name="active" value="1" checked=""/> نعم 
                            <input type="radio" name="active" value="0" /> لا 
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">أضــف</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button> 
                </form>
            </div>      

        </div>
    </div>
</div>


<div class="modal fade" id="addCity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أضف مدينة</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal style-form" method="post" action="{{url('admin/addCity')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="countyID" class="col-sm-3 col-sm-4 control-label">البلد  </label>
                        <div class="col-sm-7">
                            <select name="countyID" id="countyID" class="form-control">
                                <option value="0">-- اختر بلد   -- </option>
                                @if($countries)
                                @foreach($countries as $row)
                                <option value="{{ $row->id }}">{{ $row->title_ar }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="region_id" class="col-sm-3 col-sm-4 control-label">المنطقة  </label>
                        <div class="col-sm-7">
                            <select name="region_id" id="region_id" class = "form-control" required="">
                                <option value="0"> -- اختر منطقة -- </option>                 
                            </select>
                        </div>            
                    </div>
                    <div class="form-group">
                        <label for="title_ar" class="col-sm-3 col-sm-4 control-label">اسم المدينة</label>
                        <div class="col-sm-7">
                            <input type="text" name="title_ar" id="title_ar" class="form-control" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="active" class="col-sm-3 col-sm-4 control-label">نشط؟ </label>
                        <div class="col-sm-7">
                            <input type="radio" name="active" value="1" checked=""/> نعم 
                            <input type="radio" name="active" value="0" /> لا 
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">أضــف</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button> 
                </form>
            </div>


        </div>
    </div>
</div>


<div class="modal fade" id="viewRegions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">عرض   المناطق</h5>
            </div>
            <div class="modal-body">
                
                <table class="table table-striped table-advance table-hover" id="myTbl">
                
                <thead>
                    <tr>                        
                        <th class="text-center">اسم المنطقة </th>                                        
                        <th class="text-center">نشط </th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($regions as $row)                
                    <tr>                                        
                        <td>{{ $row->title_ar }} </td>                        
                        <td>
                            @if($row->active == 1) <span class="label label-info label-mini"> نعم</span>
                            @else <span class="label label-warning label-mini"> لا </span> @endif
                        </td>
                        <td>                                            
                            <a href="{{ url('admin/region/') }}/{{$row->id}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>                 
            </div>      

        </div>
    </div>
</div>


<div class="modal fade" id="viewCities" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">عرض   المدن</h5>
            </div>
            <div class="modal-body">
                
                <table class="table table-striped table-advance table-hover" id="myTbl">
                
                <thead>
                    <tr>                        
                        <th class="text-center">اسم المدينة </th>                                        
                        <th class="text-center">نشط </th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cities as $row)                
                    <tr>                                        
                        <td>{{ $row->title_ar }} </td>                        
                        <td>
                            @if($row->active == 1) <span class="label label-info label-mini"> نعم</span>
                            @else <span class="label label-warning label-mini"> لا </span> @endif
                        </td>
                        <td>                                            
                            <a href="{{ url('admin/city/') }}/{{$row->id}}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>                 
            </div>      

        </div>
    </div>
</div>

    @stop

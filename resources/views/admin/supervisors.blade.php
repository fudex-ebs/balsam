@extends('admin/master',['title'=>'عرض المشرفين والمدراء','active'=>'users'])
@section('content')
<div class="row mt">
        <div class="col-lg-12">
            
     <div class="form-panel">
         <div class="controls">                
    {!! Html::decode(link_to('admin/users/add','<i class="fa fa-plus-circle"></i> أضف',    
    ['class' => 'btn btn-round btn-theme'])) !!}
        </div>
                  
         <table class="table table-striped table-advance table-hover text-center" id="myTbl">
            <h4><i class="fa fa-angle-right "></i> عرض المستخدمين </h4>
            <hr>
        <thead>
            <tr>                
                <th class="text-center">الاسم كامل</th>
                <th class="text-center">الدور</th>
                <th class="text-center">نشط</th>                          
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if($items)
            @foreach($items as $row)                                
            <tr>                     
                <td><a href="{{ url('users') }}/{{ $row->id }}">{{ $row->first_name }} {{ $row->last_name }}</a></td>
                <td> 
                    <?php  echo Form::open(['action' => ['AdminController@updateRole', $row->id]]);  ?>        
                            {{ csrf_field() }}
                            <select name="role" id="role" class="form-control" onchange="this.form.submit();">
                    @if(@roles)
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}" @if($role->id == $row->role) selected @endif>
                                {{ $role->title_ar }}</option>
                        @endforeach
                    @endif
                    </select>
         
         {!! Form::close() !!}
                </td>
                <td>@if($row->active == 1) نعم  @else لا @endif</td>
                <td>
                <!--<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>-->
                <a href="{{ url('admin') }}/{{$row->id}}/edit_user" class="btn btn-primary btn-xs" title="تعديل"><i class="fa fa-pencil"></i></a>
                <a href="{{ url('admin/') }}/{{$row->id}}/delete_user" class="btn btn-danger btn-xs" title="حذف"><i class="fa fa-trash-o "></i></a>
                </td>
            </tr>            
            @endforeach
            @endif
        </tbody>
        </table>
          
         <div class="clearfix"></div>
     </div>
            
            
    </div>
</div>

@stop

@extends('admin/master',['title'=>'عرض  المقالات','active'=>'articles'])
@section('content')
<div class="row mt">
        <div class="col-lg-12">
            
     <div class="form-panel">
         <div class="controls">                
    {!! Html::decode(link_to('admin/new_article','<i class="fa fa-plus-circle"></i> أضف',    
    ['class' => 'btn btn-round btn-theme'])) !!}
        </div>
         <table class="table table-striped table-advance table-hover" id="myTbl">
            <h4> عرض المقالات </h4>
            <hr>
        <thead>
            <tr>
                <th class="text-center">صورة المقال</th>
                <th class="text-center">العنوان  </th>
                <th class="text-center">منشور</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)                
            <tr>
                    <td class="text-center">
                        @if($row->img != "")
                            <img src="{{ asset('uploads/') }}/{{ $row->img }}" class="img-circle tbl_img" />
                        @endif
                    </td>
                    <td><a href="{{ url('article') }}/{{ $row->id }}">{{ $row->title }}</a></td>                                        
                    <td> @if($row->publish == 1) نعم  @else لا @endif</td>     
                <td>                
                <a href="{{ url('admin') }}/{{$row->id}}/edit_article" class="btn btn-primary btn-xs" title="تعديل"><i class="fa fa-pencil"></i></a>
                <a href="{{ url('admin/') }}/{{$row->id}}/delete_article" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                </td>
            </tr>
            @endforeach
            

        </tbody>
        </table>
         <div class="clearfix"></div>
     </div>
            
            
    </div>
</div>

@stop

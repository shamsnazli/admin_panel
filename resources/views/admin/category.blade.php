@extends('layouts.main')

@section('MainContent')
<div class="card">
    <div class="card-header">
        <h4>{{$title}} </h4>
    </div>
        <div class="card-body">   
        <a href="#" class="btn btn-success" id="AddCategory" >Add New Category</a>
            {!! $dataTable->table([
                'class'=>'dataTable table table-striped table-hover table-bordered' ,
                'id'=>'CategoryTable'
            ]) !!}

        <div>
            
        </div>
        </div>
        
    
</div>

@push('js')
    {!! $dataTable->scripts() !!}




@endpush
@stop

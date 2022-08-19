@extends('layouts.main')

@section('MainContent')
<!-- contacts-5-grid -->
<div class="w3l-contact-10 py-5" id="contact">
    <div class="form-41-mian pt-lg-6 pt-md-3 pb-md-4">
        <div class="container">
            <div class="heading">
                <h3 class="category-title mb-5">Add Category </h3>
            </div>
            <div class="row">
                <div class="col-6 form-inner-cont">
                    @if (session()->has('add_status'))
                        @if (session('add_status'))
                            <div class="alert alert-success">Seccess</div>
                        @else
                            <div class="alert alert-danger">Faild</div>
                        @endif
                    @endif
                    <form action="{{URL('admin/book/store/category')}}" method="post" class="signin-form" enctype="multipart/form-data" id="Add-New-Book">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group form-input">
                            <input type="text" name="name" id="w3lName" class="form-control" placeholder="Enter category *"
                                required="" />
                        </div>
                        <div class="text-right">
                            <button class="btn btn-style btn-primary" id="save-button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
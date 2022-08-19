@extends('layouts.main')

@section('MainContent')

    <!-- contacts-5-grid -->
<div class="w3l-contact-10 py-5" id="contact">
    <div class="form-41-mian pt-lg-4 pt-md-3 pb-md-4">
        <div class="container">
            <div class="heading">
                <h3 class="category-title mb-3">Add Book </h3>
            </div>
            <div class="row">
                <div class="col-12 form-inner-cont">
                    @if (session()->has('add_status'))
                        @if (session('add_status'))
                            <div class="alert alert-success">SECCESS</div>
                        @else
                            <div class="alert alert-danger">FAILD</div>
                        @endif
                    @endif
                    <form action="{{URL('admin/book/store/book')}}" method="POST" class="signin-form" enctype="multipart/form-data" id="Add-New-Book">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group form-input">
                            <input type="text" name="title" id="w3lName" class="form-control" placeholder="Enter title book *"
                                required >
                        </div>
                        <div class="form-group form-input">
                            <input type="file" name="image" id="w3lSubject" class="form-control" placeholder="Enter book image " required />
                        </div>
                        <div class="form-group form-input">
                            <label>Publisher</label>
                            <select name="publisher_id" class="form-control">
                                <option value="-1">Choose Publisher:</option>

                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-input">
                            <label>Authors</label>
                            <select name="author_id" class="form-control">
                                <option value="-1">Choose Authors:</option>

                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-input">
                            <label>Categories</label>
                            <select name="category_id" class="form-control">
                                <option value="-1">Choose Categories:</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-input">
                            <input type="number" name="published_year" id="datepicker" class="form-control" placeholder="Enter published year " required min="1990" max="2021" />
                        </div>
                        <div class="form-group form-input">
                            <input type="number" name="published_number" id="w3lSender" class="form-control" placeholder="Enter published number" required />
                        </div>
                        <div class="form-input">
                            <textarea name="description" id="w3lMessage" placeholder="Enter description about book"
                                required="" cols="128"></textarea>
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
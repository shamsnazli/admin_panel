@extends('layouts.main')

@section('MainContent')

<div class="w3l-contact-10 py-5" id="contact">
    <div class="form-41-mian pt-lg-4 pt-md-3 pb-md-4">
        <div class="container">
            <div class="heading">
                <h3 class="category-title mb-3">Edit Book </h3>
            </div>
            <div class="row">
                <div class="col-8 form-inner-cont">
                    @if (session()->has('edit_status'))
                        @if (session('edit_status'))
                            <div class="alert alert-success">SECCESS</div>
                        @else
                            <div class="alert alert-danger">FAILD</div>
                        @endif
                    @endif
                    <form action="{{URL('admin/book/update/'. $book->id)}}" method="post" class="signin-form" enctype="multipart/form-data" id="Add-New-Book">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{-- <input type="hidden" name="_method" value="PUT"> --}}
                        <div class="form-group form-input">
                            <input type="text" name="title" id="w3lName" value=" {{ $book->title }} " class="form-control" placeholder="Enter title book *"
                                required="">
                        </div>
                        <div class="form-group form-input">
                            <input type="file" name="image" id="w3lSubject" value=" {{ $book->image }} " class="form-control" placeholder="Enter book image " >
                        </div>
                        <div class="form-group form-input">
                            <label>Publisher</label>
                            <select name="publisher_id" class="form-control">
                                <option value="">Choose Publisher:</option>

                                @foreach ($books_publishers as $publisher)
                                    <option value="{{ $publisher->id }}" @if ($publisher->id == $book->publisher['id']) selected @endif>
                                        {{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-input">
                            <label>Authors</label>
                            <select name="author_id" class="form-control" >
                                <option value="">Choose Authors:</option>

                                @foreach ($books_authors as $author)
                                    <option value="{{ $author->author['id'] }}" 
                                         @foreach ($book->books_author as $books_author)  
                                            @if ($author->author['id'] == $books_author->author['id']) selected>
                                            {{ $author->author['name'] }}</option>
                                            @else
                                            <option value="{{ $author->author['id'] }}" >{{ $author->author['name'] }}</option>
                                            @endif
                                        @endforeach
                                                                         
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group form-input">
                            <label>Categories</label>
                            <select name="category_id" class="form-control" >
                                <option value="">Choose Categories:</option>
                                
                                @foreach ($books_categories as $category)
                                    <option value="{{ $category->category['id'] }}" 
                                        @foreach ($book->books_category as $books_category)  
                                            @if ($category->category['id'] == $books_category->category['id']) selected>
                                            {{ $category->category['category'] }}
                                            </option>
                                            @else
                                            <option value="{{ $category->category['id'] }}">{{ $category->category['category'] }}</option>
                                            @endif
                                        @endforeach  
                                        
                                @endforeach
                            
                            </select>
                        </div>
                        <div class="form-group form-input">
                            <input type="number" name="published_year" value="{{ $book->published_year }}" id="w3lSubject" class="form-control" placeholder="Enter published year " min="1990" max="2021" required />
                        </div>
                        <div class="form-group form-input">
                            <input type="number" name="published_number" value="{{ $book->published_number }}" id="w3lSender" class="form-control" placeholder="Enter published number" required />
                        </div>
                        <div class="form-input">
                            <textarea name="description" value="" id="w3lMessage" placeholder="Enter description about book"
                                required="">{{ $book->description }}</textarea>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-style btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 contacts-5-grid-main section-gap mt-lg-0 mt-5">
                    <img class="card-img-bottom radius-image-full d-block" src="{{ asset($book->image) }}" alt="Card image cap">
                </div>
            </div>
        </div>
    </div>
</div>
@stop
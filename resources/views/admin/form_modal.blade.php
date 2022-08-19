<!-- Book Modal -->
<div class="modal fade" id="AddOrUpdateBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modelHeading"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
            <ul id="save_msgList"></ul>
            <form class="signin-form" enctype="multipart/form-data" id="AddOrUpdateBookForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="book-id" value="">


                <div class="form-group form-input">
                    <input type="text" name="title" id="title" class="form-control"
                            placeholder="Enter title book *">
                </div>
                <div class="form-group form-input row">
                    <div class="col-2 img"><img src="" width='40' hight='50'></div>
                    <input type="file" name="image" class="form-control col-10 image"
                            placeholder="Enter book image "/>
                </div>
                <div class="form-group form-input">
                    <label>Publisher</label>
                    <select name="publisher_id" class="form-control" id="publisher_id">
                        <option value="">Choose Publisher:</option>

                        @foreach ($publishers as $publisher)
                            <option value="{{ $publisher->id  }}"
                                    @isset($data) @if($publisher->id == $data->publisher->id) selected @endif @endisset>
                                {{ $publisher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-input">
                    <label>Authors</label>
                    <select name="author_id" class="form-control" id="author_id">
                        <option value="">Choose Authors:</option>
                        @foreach ($authors as $author)
                            <option class="author_id" value="{{ $author->id }}"
                                    @isset($book)
                                    @foreach ($book->books_author as $books_author)
                                    @if ($author->id == $books_author->author->id) selected @endif>
                                {{ $author->name }}</option>
                        @endforeach
                        @endisset
                        >{{ $author->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group form-input">
                    <label>Categories</label>
                    <select name="category_id" class="form-control" id="category_id">
                        <option value="">Choose Categories:</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                    @isset($data)
                                    @foreach ($data->books_category as $books_category)
                                    @if ($category->id == $books_category->category->id) selected @endif>
                                {{ $category->category }}
                            </option>
                        @endforeach
                        @endisset
                        >{{ $category->category }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group form-input">
                    <input type="number" name="published_year" id="published_year" class="form-control"
                            placeholder="Enter published year " min="1990" max="2021">
                </div>
                <div class="form-group form-input">
                    <input type="number" name="published_number" id="published_number" class="form-control"
                            placeholder="Enter published number">
                </div>
                <div class="form-input">
                    <textarea name="description" id="description" placeholder="Enter description about book"
                                class="form-control w-100" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-button">Save changes</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>



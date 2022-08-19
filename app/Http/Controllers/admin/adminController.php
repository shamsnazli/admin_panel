<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDatatable;
use App\DataTables\AdminAuthorDatatable;
use App\DataTables\AdminCategoryDatatable;
use App\DataTables\AdminPublisherDatatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PublisherRequest;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\BookRequest;
use App\Models\BooksAuthor;
use App\Models\BooksCategory;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;

class adminController extends Controller
{
    public function index(AdminDatatable $Book){
        $publishers = Publisher::select('id', 'name')->get();
        $categories = Category::select('id', 'category')->get();
        $authors = Author::select('id', 'name')->get();
        return $Book->render('admin.index',['title' => 'Admin Control'],compact('publishers','categories','authors'));
    }
    // public function showAllAuthor(AdminAuthorDatatable $Author){
    //     return $Author->render('admin.author',['title' => 'Admin Control']);
    // }
    // public function showAllCategory(AdminCategoryDatatable $Category){
    //     return $Category->render('admin.category',['title' => 'Admin Control']);
    // }
    // public function showAllPublisher(AdminPublisherDatatable $Publisher){
    //     return $Publisher->render('admin.publisher',['title' => 'Admin Control']);
    // }


    // edit book
    public function edit($id){
        $book = Book::where('id', $id)->with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->first();
        if(!empty($book->image) and $book->image !== null){
            $img_link = Storage::url($book->image);
            $book->image = $img_link;
        }
        return($book);
    }

    public function AddOrUpdateBook(BookRequest $request) {
        $data = $request->except('_token','image','author_id','category_id');
        $id = $request->get('id');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $path = 'uploads/images/';
            $name = time()+rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($path.$name , file_get_contents($image));
            Storage::disk('local')->exists($path.$name);
            $data['image'] = $path.$name;
        };
        
		$author_id = $request['author_id'];
		$category_id = $request['category_id'];

        $book_result = Book::updateOrCreate(['id' => $id],$data);

        $author_result = BooksAuthor::create([
            'book_id' => $book_result->id,
            'author_id' => $author_id
        ]);

        $category_result = BooksCategory::create([
            'book_id' => $book_result->id,
            'category_id' => $category_id
        ]);
        
        return response()->json(['success'=>true ,$book_result , $author_result, $category_result]);
    }

    // ------------- Start Author -------------
        // View Authors
        public function getAuthors(AdminAuthorDatatable $author){
            return $author->render('admin.author', ['title'=>'Admin Control']);
        }
        // Create new Author
        public function AddOrUpdateAuthor(AuthorRequest $request) {
            $data = $request->except('_token');
            $id = $request->get('id');
            $result = Author::updateOrCreate(['id' => $id], $data);
            return response()->json([
                'status'=> [$result],
                'success'=> true,
                $result
            ]);
        }
        public function editAuthor($id){
            $author = Author::where('id', $id)->first();
            return($author);
        }
        // Delete Author
        public function destroyAuthor($id){
            Author::where('id',$id)->delete(); // with Model
            return response()->json([
                'success'=> true,
            ]);
        }
    // ------------- End Author ---------------

    // ------------- Start Publisher -------------
        // View Publishers
        public function getPublishers(AdminPublisherDatatable $publisher){
            return $publisher->render('admin.publisher', ['title'=>'Admin Control']);
        }
        // Create new Publisher
        public function AddOrUpdatePublisher(PublisherRequest $request) {
            $data = $request->except('_token');
            $id = $request->get('id');
            $result = Publisher::updateOrCreate(['id' => $id], $data);
            return response()->json([
                'status'=> [$result],
                'success'=> true,
                $result
            ]);
        }
        public function editPublisher($id){
            $publisher = Publisher::where('id', $id)->first();
            return($publisher);
        }
        // Delete Publisher
        public function destroyPublisher($id){
            Publisher::where('id',$id)->delete(); // with Model
            return response()->json([
                'success'=> true,
            ]);
        }
    // ------------- End Publisher ---------------

    // ------------- Start Publisher -------------
        // View Categoties
        public function getCategoties(AdminCategoryDatatable $category){
            return $category->render('admin.category', ['title'=>'Admin Control']);
        }
        // Create new Publisher
        public function AddOrUpdateCategory(CategoryRequest $request) {
            $data = $request->except('_token');
            $id = $request->get('id');
            $result = Category::updateOrCreate(['id' => $id], $data);
            return response()->json([
                'status'=> [$result],
                'success'=> true,
                $result
            ]);
        }
        public function editCategory($id){
            $category = Category::where('id', $id)->first();
            return($category);
        }
        // Delete Category
        public function destroyCategory($id){
            Category::where('id',$id)->delete(); // with Model
            return response()->json([
                'success'=> true,
            ]);
        }
    // ------------- End Category ---------------

     // delete
    public function destroy($id){
        Book::where('id', $id )->delete();
        // return redirect()->back();
        return response()->json(['success'=>true]);
    }
}

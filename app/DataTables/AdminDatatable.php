<?php

namespace App\DataTables;

use App\Models\Book;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
                ->eloquent($query)
                ->addColumn('image', function($data){
                    $img_link = Storage::url($data->image);
                    $data->image = $img_link;
                    return "<img src='$data->image' width='40' height='50'>";
                })
                ->addColumn('description', function($data){
                    return Str::limit($data->description , 50 , '.....');
                })
                ->addColumn('publisher', function($data){
                    return $data->publisher->name ;
                })
                ->addColumn('author', function($data){
                    foreach ($data->books_author as $books_author){
                        return $books_author->author->name ;
                    };
                })
                ->addColumn('category', function($data){
                    foreach ($data->books_category as $books_category){
                        return $books_category->category->category ;
                    };
                })
                ->addColumn('action' , function($data){
                    // return view('admin.actionbtn' , compact('data'));
                    return '<div class="row">
                    <a href="javascript:void(0)" type="button" data-value="'.$data->id.'" class="mx-1 btn btn-info col-5 editBook">
                    <i class="fa fa-edit"></i></a>
                    <a type="button" class="btn btn-danger text-white deletebtn" data-value="'.$data->id.'"><i class="fa fa-trash"></i></a>                    
                    </div>';
                })
                ->rawColumns([
                    'image',
                    'description',
                    'author',
                    'category',
                    'action'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AdminDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Book::query()->with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category');
    }
    
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('admindatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0 , "ASC")
                    // ->lengthMenu([5,10,15,20],[5,10,15,20])
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('image'),
            Column::make('description'),
            Column::make('published_year'),
            Column::make('published_number'),
            Column::make('publisher'),
            Column::make('author'),
            Column::make('category'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin_' . date('YmdHis');
    }
}

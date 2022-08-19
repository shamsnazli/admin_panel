<?php

namespace App\DataTables;
use App\Models\Publisher;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminPublisherDatatable extends DataTable
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
            ->addColumn('action' , function($data){
                // return view('admin.actionbtn' , compact('data'));
                return '<div class="row">
                <a href="javascript:void(0)" type="button" data-value="'.$data->id.'" class="mx-1 btn btn-info col-5 editPublisher">
                <i class="fa fa-edit"></i></a>
                <a type="button" class="btn btn-danger text-white deletebtn" data-value="'.$data->id.'"><i class="fa fa-trash"></i></a>                    
                </div>';
            })
            ->rawColumns([
                'action'
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AdminPublisherDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Publisher::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('adminpublisherdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0, "ASC")
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
            Column::make('name'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
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
        return 'AdminPublisher_' . date('YmdHis');
    }
}

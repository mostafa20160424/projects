<?php
/*
to add DataTable Package to your Project follow steps
1-write command "composer require yajra/laravel-datatables-oracle:^8.0"
2-write command "composer require yajra/laravel-datatables:^1.0"
3-add to app php 'providers' => [
    // ...
    Yajra\DataTables\DataTablesServiceProvider::class,
],
4-write command "php artisan vendor:publish --tag=datatables"
5- to create write php artisan datatables:make Name
*/
namespace App\DataTables;

use App\Admin;//model that will read and insert  from him
use Yajra\DataTables\Services\DataTable;
use URL;
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
      //php artisan datatables:make name
   
        return datatables($query)
            ->addColumn('edit', 'admin.admins.action.edit')//addColumn(name,view path)
            ->addColumn('delete', 'admin.admins.action.delete')//addColumn(name,view path)
            ->addColumn('checkbox', 'admin.admins.action.checkbox')//addColumn(name,view path)
            ->rawColumns(['edit','delete','checkbox']);//rawColumns([columns name to show html note html code])

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Admin::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->parameters($this->getBuilderParameters());
                    ->parameters([
                      'dom'=>'Blfrtip',
                      'lengthMenu'=>[
                        [10,25,50,100],
                        [10,25,50,'All Record'],//[lenght to show in dropdown menu 10 or 25 or 50 or show all record]
                      ],
                      'buttons'=>[
                          [
                        			'text'      => '<i class="fa fa-plus"></i> '.trans('admin.CreateAdmin'),
                        			'className' => 'btn btn-info',
                              'action'    =>  "function(){
                                window.location.href='".URL::current()."/create';
                              }",
                        	],
                          [
                              'text'      => '<i class="fa fa-trash"></i> '.trans('admin.DeleteChecked'),
                              'className' => 'btn btn-danger btnshow '
                          ],
                        	['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"></i> '.trans('admin.pdf')],
                        	['extend' => 'csv', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-file"></i> '.trans('admin.csv')],
                        	['extend' => 'excel', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-file"></i> '.trans('admin.excel')],
                        	['extend' => 'reload', 'className' => 'btn btn-warning', 'text' => '<i class="fa fa-refresh"></i>'],

                      ],
                      /*
                      ['extend'=>'print or excel or any file typ ','className'=>'btn class','text'=>'text shwo in button'],
                      to Install It
                      1-use command "php artisan vendor:publish --tag=datatables-buttons"
                      2-add <script src="{{ url('') }}/vendor/datatables/buttons.server-side.js"></script>
                      3-use command "composer require yajra/laravel-datatables-buttons:^3.0"
                      4-download dataTables.buttons.min.js
                      5-add script for the file you download it
                      */
                      "initComplete"=>" function () {
                              this.api().columns([2,3,4]).every(function () {
                                  var column = this;
                                  var input = document.createElement(\"input\");
                                  $(input).appendTo($(column.footer()).empty())
                                  .on('keyup', function () {
                                      column.search($(this).val(), false, false, true).draw();
                                  });
                              });
                          }",
                          //this.api().columns([column index to be have filter input])
                          /*
                          .on('change or keyup,or keydown or when search you want to shwo', function () {
                              column.search($(this).val(), false, false, true).draw();
                          });

                          */
                          'language'         => [
                          					'sProcessing'     => trans('admin.sProcessing'),
                          					'sLengthMenu'     => trans('admin.sLengthMenu'),
                          					'sZeroRecords'    => trans('admin.sZeroRecords'),
                          					'sEmptyTable'     => trans('admin.sEmptyTable'),
                          					'sInfo'           => trans('admin.sInfo'),
                          					'sInfoEmpty'      => trans('admin.sInfoEmpty'),
                          					'sInfoFiltered'   => trans('admin.sInfoFiltered'),
                          					'sInfoPostFix'    => trans('admin.sInfoPostFix'),
                          					'sSearch'         => trans('admin.sSearch'),
                          					'sUrl'            => trans('admin.sUrl'),
                          					'sInfoThousands'  => trans('admin.sInfoThousands'),
                          					'sLoadingRecords' => trans('admin.sLoadingRecords'),
                          					'oPaginate'       => [
                          						'sFirst'         => trans('admin.sFirst'),
                          						'sLast'          => trans('admin.sLast'),
                          						'sNext'          => trans('admin.sNext'),
                          						'sPrevious'      => trans('admin.sPrevious'),
                          					],
                          					'oAria'            => [
                          						'sSortAscending'  => trans('admin.sSortAscending'),
                          						'sSortDescending' => trans('admin.sSortDescending'),
                          					],
                          	],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        /*return [
            'id',
            'name',
            'email',
            'created_at',
            'updated_at'
        ];*/
        return [
          [
            'name'=>'checkbox',//order by
            'data'=>'checkbox',//column name in database
            'title'=>'<input type="checkbox" id="checkall" onclick="check_all()">',
            'exportable'=>false,
            'printable'=>false,
            'orderable'=>false,
            'searchable'=>false,
          ],
          [
            'name'=>'id',//order by
            'data'=>'id',//column name in database
            'title'=>'Identifier',
          ],
          [
            'name'=>'name',//column name
            'data'=>'name',//column name in database
            'title'=>'Admin Name',
          ],
          [
            'name'=>'email',//column name
            'data'=>'email',//column name in database
            'title'=>'Email',
          ],
          [
            'name'=>'created_at',//column name
            'data'=>'created_at',//column name in database
            'title'=>'created_at',
          ],
          [
            'name'=>'updated_at',//column name
            'data'=>'updated_at',//column name in database
            'title'=>'updated_at',
          ],
          [
            'name'=>'edit',//name you write in rawColumns(['name'])
            'data'=>'edit',//name you write in rawColumns(['name'])
            'title'=>'edit',//column title
            'exportable'=>false,
            'printable'=>false,
            'orderable'=>false,
            'searchable'=>false,
          ],
          [
            'name'=>'delete',//name you write in rawColumns(['name'])
            'data'=>'delete',//name you write in rawColumns(['name'])
            'title'=>'delete',//column title
            'exportable'=>false,
            'printable'=>false,
            'orderable'=>false,
            'searchable'=>false,
          ],
          /*
          [
            'name'=>'column name you want',
            'data'=>'column name in database',
            'title'=>'column title',
          ],
          Note the selection but by first cell in array return from this function and its attr
          [
            'name'=>'order by ', must be name of the column in database
            'data'=>'database column name to take it value',
            'title'=>'column title',
          ],
          */
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

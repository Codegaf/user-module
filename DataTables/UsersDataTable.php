<?php

namespace Modules\User\DataTables;

use App\Traits\FiltersDatatable;
use Modules\User\Entities\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{

    use FiltersDatatable;

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
            ->filter(function($query) {
                $this->filterColumns($query, 'complete');
            })
            ->addColumn('action', function ($query) {
                return '<div class="btn-group dropdown mr-1 mb-1">
                <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                  data-boundary="window" aria-haspopup="true" aria-expanded="false">
                    '.__("global.menu").'
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="'.route('user.edit', ['user' => $query->id]).'">'.__("global.edit").'</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item delete-user" href="#" data-href="'.route('user.destroy', ['user' => $query->id]).'">'.__('global.delete').'</a>
                </div>
              </div>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->parameters([
                'language' => [
                    'url' => asset('/vendor/datatables/lang/'.app()->getLocale().'.json'),
                ],
            ])
            ->postAjax([
                'url' => route('user.index'),
                'data' => 'function(d) { 
                    d.email = $("#email").val();
                    d.name = $("#name").val();
                }'
            ])
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->dom('B <"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>> rt <"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>')
            ->orderBy(1, 'asc')
            ->buttons(
                Button::make('reload'),
                Button::make('export')
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
            Column::make('email')->title(__('forms.email')),
            Column::make('name')->title(__('forms.name')),
            Column::make('created_at')->title(__('forms.created-at')),
            Column::make('updated_at')->title(__('forms.updated-at')),
            Column::computed('action')
                ->title(__('global.action'))
                ->orderable(false)
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}

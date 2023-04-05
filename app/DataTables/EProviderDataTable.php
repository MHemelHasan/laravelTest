<?php
/*
 * File name: EProviderDataTable.php
 * Last modified: 2021.01.18 at 22:03:25
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2021
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class EProviderDataTable extends DataTable
{

    /**
     * @var array
     */
    public static $customFields = [];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        return $dataTable
            ->editColumn('updated_at', function ($user) {
                return getDateColumn($user, 'updated_at');
            })
            // ->editColumn('role', function ($user) {
            //     return getArrayColumn($user->roles, 'name', "badge bg-" . setting('theme_color'));
            // })
            ->editColumn('email', function ($user) {
                return getEmailColumn($user, 'email');
            })
            ->editColumn('avatar', function ($user) {
                return getMediaColumn($user, 'avatar', 'img-circle elevation-2');
            })
            ->editColumn('name', function ($user) {
                if ($user['featured']) {
                    return $user->name . "<span class='badge bg-" . setting('theme_color') . " p-1 m-2'>" . trans('lang.e_service_featured') . "</span>";
                }
                return $user->name;
            })
            ->editColumn('addresses', function ($user) {
                return getLinksColumnByRouteName($user->addresses, 'addresses.edit', 'id', 'address');
            })
            ->editColumn('taxes', function ($user) {
                return getLinksColumnByRouteName($user->taxes, 'taxes.edit', 'id', 'name');
            })
            ->editColumn('available', function ($user) {
                return getBooleanColumn($user, 'available');
            })
            ->editColumn('accepted', function ($user) {
                return getBooleanColumn($user, 'accepted');
            })
            ->addColumn('action', 'e_providers.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

            return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): \Illuminate\Database\Eloquent\Builder
    {
        // return $model->newQuery()->with('roles');
        return $model->newQuery()->with('roles')->whereHas('roles', function($query) {
            $query->where('name', 'provider');
        })->orderBy('updated_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title'=>trans('lang.actions'),'width' => '80px', 'printable' => false, 'responsivePriority' => '100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/'.app()->getLocale().'/datatable.json')
                    ),true)
                ]
            ));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        // TODO custom element generator
        $columns = [
            [
                'data' => 'avatar',
                'title' => trans('lang.user_avatar'),
                'orderable' => false, 'searchable' => false,

            ],
            [
                'data' => 'name',
                'title' => trans('lang.user_name'),

            ],
            [
                'data' => 'email',
                'title' => trans('lang.user_email'),

            ],
            [
                'data' => 'phone_number',
                'title' => trans('lang.e_provider_phone_number'),

            ],
            [
                'data' => 'mobile_number',
                'title' => trans('lang.e_provider_mobile_number'),

            ],
            [
                'data' => 'addresses',
                'title' => trans('lang.e_provider_addresses'),
                'searchable' => false,
                'orderable' => false
            ],
            [
                'data' => 'availability_range',
                'title' => trans('lang.e_provider_availability_range'),

            ],
            [
                'data' => 'taxes',
                'title' => trans('lang.e_provider_taxes'),
                'searchable' => false,
                'orderable' => false
            ],
            [
                'data' => 'available',
                'title' => trans('lang.e_provider_available'),

            ], [
                'data' => 'accepted',
                'title' => trans('lang.e_provider_accepted'),

            ],
            // [
            //     'data' => 'role',
            //     'title' => trans('lang.user_role_id'),
            //     'orderable' => false, 'searchable' => false,

            // ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.user_updated_at'),
                'searchable' => false,
            ]
        ];

        // TODO custom element generator
        $hasCustomField = in_array(User::class, setting('custom_field_models',[]));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', User::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.user_' . $field->name),
                    'orderable' => false,
                    'searchable' => false,
                ]]);
            }
        }
        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'usersdatatable_' . time();
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }
}

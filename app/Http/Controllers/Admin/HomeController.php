<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Task;

class HomeController
{
    public function index()
    {

        $taskCountsByStatus = Task::groupBy('status_id')
            ->selectRaw('status_id, count(*) as count')
            ->pluck('count', 'status_id');



        $settings1 = [
            'chart_title'           => 'Tasks',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Task',
            'group_by_field'        => 'due_date',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y',
            'column_class'          => 'w-full',
            'entries_number'        => '5',
            'translation_key'       => 'task',
        ];

        $settings1['total_number'] = 3;
        if (class_exists($settings1['model'])) {
            $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                if (isset($settings1['filter_days'])) {
                    return $query->where(
                        $settings1['filter_field'],
                        '>=',
                        now()->subDays($settings1['filter_days'])->format('Y-m-d')
                    );
                } elseif (isset($settings1['filter_period'])) {
                    switch ($settings1['filter_period']) {
                        case 'week':
                            $start = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start = date('Y') . '-01-01';
                            break;
                    }
                    if (isset($start)) {
                        return $query->where($settings1['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
        }


        $settings2 = [
            'chart_title'        => 'Task by status',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Task',
            'group_by_field'     => 'name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'w-full xl:w-6/12',
            'entries_number'     => '5',
            'relationship_name'  => 'status',
            'translation_key'    => 'task',
        ];

        $chart2 = new LaravelChart($settings2);

        $settings3 = [
            'chart_title'           => 'Latest Tasks',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Task',
            'group_by_field'        => 'due_date',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y',
            'column_class'          => 'w-full xl:w-6/12',
            'entries_number'        => '10',
            'fields'                => [
                'name'        => '',
                'description' => '',
                'status'      => 'name',
                'due_date'    => '',
                'assigned_to' => 'name',
                'created_at'  => '',
            ],
            'translation_key' => 'task',
        ];

        $settings3['data'] = [];
        if (class_exists($settings3['model'])) {
            $settings3['data'] = $settings3['model']::latest()
                ->take($settings3['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings3)) {
            $settings3['fields'] = [];
        }

        $settings4 = [
            'chart_title'           => 'Daily Task Trends',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Task',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'w-full xl:w-6/12',
            'entries_number'        => '5',
            'translation_key'       => 'task',
        ];

        $chart4 = new LaravelChart($settings4);

        $settings5 = [
            'chart_title'           => 'Task status',
            'chart_type'            => 'pie',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Task',
            'group_by_field'        => 'deleted_at',
            'group_by_period'       => 'year',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'w-full xl:w-6/12',
            'entries_number'        => '5',
            'translation_key'       => 'task',
        ];

        $chart5 = new LaravelChart($settings5);

        return view('admin.home', compact('chart2', 'chart4', 'chart5', 'settings1', 'settings3', 'taskCountsByStatus'));
    }
}

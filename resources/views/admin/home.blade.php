@extends('layouts.admin')
@section('content')
<div class="flex flex-wrap">
    {{-- Number block --}}
    <div class="{{ $settings1['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 shadow-lg">
            <div class="flex-auto p-4">
                {{-- <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                            {{ $settings1['chart_title'] }}
                        </h5>
                        <span class="font-semibold text-xl text-blueGray-700">
                            {{ number_format($settings1['total_number']) }}
                        </span>
                    </div> --}}
                       <div class="flex justify-between mt-4">
                                {{-- Iterate over task statuses --}}
                                 @foreach($taskCountsByStatus as $status_name => $count)
                                <div class="w-1/3 bg-white rounded-lg shadow-md p-4">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                        {{ $status_name }}
                                    </h5>
                                    <span class="font-semibold text-xl text-blueGray-700">
                                        {{ number_format($count) }}
                                    </span>
                                </div>
                                @endforeach
                            
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500">
                            <i class="fas fa-globe"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Latest Entries --}}
    <div class="{{ $settings2['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                            {{ $settings2['chart_title'] }}
                        </h5>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-indigo-500">
                            <i class="fas fa-table"></i>
                        </div>
                    </div>
                    <div class="w-full mt-4 overflow-x-auto">
                        <table class="table table-index">
                            <thead>
                                <tr>
                                    @foreach($settings2['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings2['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($settings2['data'] as $entry)
                                    <tr>
                                        @foreach($settings2['fields'] as $key => $value)
                                            <td>
                                                @if($value === '')
                                                    {{ $entry->{$key} }}
                                                @elseif(is_iterable($entry->{$key}))
                                                    @foreach($entry->{$key} as $subEentry)
                                                        <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                    @endforeach
                                                @else
                                                    {{ data_get($entry, $key . '.' . $value) }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings2['fields']) }}">{{ __('No entries found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pie chart --}}
    <div class="{{ $chart3->options['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                            {{ $chart3->options['chart_title'] }}
                        </h5>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                    </div>
                    <div class="w-full">
                        {{ $chart3->renderHtml() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Line chart --}}
    <div class="{{ $chart4->options['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                            {{ $chart4->options['chart_title'] }}
                        </h5>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-rose-500">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="w-full">
                        {{ $chart4->renderHtml() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bar chart --}}
    <div class="{{ $chart5->options['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                            {{ $chart5->options['chart_title'] }}
                        </h5>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                    <div class="w-full">
                        {{ $chart5->renderHtml() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    {{ $chart3->renderJs() }}
    {{ $chart4->renderJs() }}
    {{ $chart5->renderJs() }}
@endpush
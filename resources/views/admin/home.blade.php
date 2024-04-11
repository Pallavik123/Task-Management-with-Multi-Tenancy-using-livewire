@extends('layouts.admin')
@section('content')

    <div class="flex flex-wrap">

        <div class="{{ $settings1['column_class'] }} px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                Open
                            </h5>
                            <span class="font-semibold text-xl text-blueGray-700">
                                {{ number_format($taskCountsByStatus['open'] ?? 2) }}
                            </span>
                        </div>

                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                Close
                            </h5>
                            <span class="font-semibold text-xl text-blueGray-700">
                                {{ number_format($taskCountsByStatus['close'] ?? 1) }}
                            </span>


                            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                    In Progress
                                </h5>
                                <span class="font-semibold text-xl text-blueGray-700">
                                    {{ number_format($taskCountsByStatus['in progress'] ?? 1) }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>




            {{-- Bar chart --}}
            <div class="{{ $chart2->options['column_class'] }} px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 shadow-lg">
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                    {{ $chart2->options['chart_title'] }}
                                </h5>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                            <div class="w-full">
                                {{ $chart2->renderHtml() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Latest Entries --}}
            <div class="{{ $settings3['column_class'] }} px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 shadow-lg">
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                    {{ $settings3['chart_title'] }}
                                </h5>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-indigo-500">
                                    <i class="fas fa-table"></i>
                                </div>
                            </div>
                            <div class="w-full mt-4 overflow-x-auto">
                                <table class="table table-index">
                                    <thead>
                                        <tr>
                                            @foreach ($settings3['fields'] as $key => $value)
                                                <th>
                                                    {{ trans(sprintf('cruds.%s.fields.%s', $settings3['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($settings3['data'] as $entry)
                                            <tr>
                                                @foreach ($settings3['fields'] as $key => $value)
                                                    <td>
                                                        @if ($value === '')
                                                            {{ $entry->{$key} }}
                                                        @elseif(is_iterable($entry->{$key}))
                                                            @foreach ($entry->{$key} as $subEentry)
                                                                <span
                                                                    class="label label-info">{{ $subEentry->{$value} }}</span>
                                                            @endforeach
                                                        @else
                                                            {{ data_get($entry, $key . '.' . $value) }}
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ count($settings3['fields']) }}">
                                                    {{ __('No entries found') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-rose-500">
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

            {{-- Pie chart --}}
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
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                            </div>
                            <div class="w-full">
                                {{ $chart5->renderHtml() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        @endsection
        @push('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            {{ $chart2->renderJs() }}
            {{ $chart4->renderJs() }}
            {{ $chart5->renderJs() }}
        @endpush

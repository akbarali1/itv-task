@php
    $queries = Illuminate\Support\Facades\DB::getQueryLog() ;
@endphp
@if(count($queries) > 0)
    <div class="btn" data-bs-toggle="modal" data-bs-target="#sqlQueryLogModal">
        SQL: {{ count($queries) }}, {{ formatSize(memory_get_usage()) }} {{ round(microtime(true) - LARAVEL_START, 2) }} sec.
    </div>
    @if(!empty($queries))
        <div class="modal fade" id="sqlQueryLogModal" tabindex="-1" aria-labelledby="sqlQueryLogModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header align-items-center">
                        <h4 class="modal-title">SQL Query Log</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-2">
                        <table class="table table-sm table-bordered mb-0" style=" font-size: 12px; ">
                            <thead>
                            <tr class="table-light text-secondary">
                                <th scope="col" class="border-top-0">#</th>
                                <th scope="col" class="border-top-0" style=" text-align: left; ">Query</th>
                                <th scope="col" class="border-top-0 text-center">Bindings</th>
                                <th scope="col" class="border-top-0 text-center">Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($queries as $k => $query)
                                <tr>
                                    <th scope="row" class="align-middle">{{ $k + 1 }}</th>
                                    <td style=" text-align: left; ">
                                        <code>{{ $query['query'] }}</code>
                                    </td>
                                    <td class="text-center align-middle">
                                        @if(!empty($query['bindings']))
                                            @foreach($query['bindings'] as $binding)
                                                <span class="badge bg-secondary">{{ $binding }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center align-middle"><span class="badge bg-secondary">{{ $query['time'] }} ms</span></td>
                                </tr>
                            @endforeach
                            <tr class="table-light">
                                <th scope="row" colspan="3" style=" text-align: left; ">Total time</th>
                                <td class="text-center"><span class="badge bg-secondary">{{ round(microtime(true) - LARAVEL_START, 2) }} sec.</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif

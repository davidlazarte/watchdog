@if ($template)
    @extends($template)
@endif

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Log entries</h1>

            @if ($watchdogEntries)
                <p>
                    <a role="button"
                       data-toggle="collapse" href="#collapseFilters"
                       aria-expanded="false" aria-controls="collapseFilters">
                        Filters
                    </a>
                </p>

                <div class="collapse" id="collapseFilters">
                    <div class="well">
                        <form action="{{url('watchdog/filter')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <i>Select level to filter</i>
                            <br/>

                            <select name="level" id="level">
                                <option value="info">Info</option>
                                <option value="warning">Warning</option>
                                <option value="danger">Danger</option>
                                <option value="debug">Debug</option>
                            </select>
                            <br/>

                            <button class="btn btn-primary">Filter</button>

                        </form>
                    </div>
                </div>

                <p>
                    <a role="button"
                       data-toggle="collapse" href="#collapseExample"
                       aria-expanded="false" aria-controls="collapseExample">
                        Clear log messages
                    </a>
                </p>

                <div class="collapse" id="collapseExample">
                    <div class="well">
                        <form action="{{url('watchdog/clear-log')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <i>This will permanently remove the log messages from the database.</i>
                            <br/>
                            <button class="btn btn-danger">Clear log messages</button>
                        </form>
                    </div>
                </div>

                <table class="table table-bordered table-striped table-responsive">
                    <thead>
                    <tr class="info">
                        <th>Message</th>
                        <th>Level</th>
                        <th>Incident time</th>
                        <th>View</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($watchdogEntries as $entry)
                        <tr>
                            <td><a href="{{ url('watchdog/entry/' . $entry->id)  }}">{{$entry->message}}</a></td>
                            <td>{{ucfirst($entry->level)}}</td>
                            <td>{{$entry->incident_time}}</td>
                            <td><a href="{{ url('watchdog/entry/' . $entry->id)  }}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {!! $watchdogEntries->render() !!}
            @else
                <div class="info alert-info">
                    <div class="well">No log entries</div>
                </div>
            @endif
        </div>
    </div>
@endsection
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
                       data-toggle="collapse" href="#collapseExample"
                       aria-expanded="false" aria-controls="collapseExample">
                        Clear log messages
                    </a></p>

                <div class="collapse" id="collapseExample">
                    <div class="well">
                        <form action="{{url('watchdog/clear-log')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                            <td>{{$entry->level}}</td>
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
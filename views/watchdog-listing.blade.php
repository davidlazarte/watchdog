@if ($template)
    @extends($template)
@endif

@section('content')
    @if($watchdogEntries)
        <div class="row">
            <div class="col-md-12">
                <h1>Log entries</h1>
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
            </div>
        </div>
    @endif
@endsection
@if ($template)
@extends($template)
@endif

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Details of the watchdog entry</h1>

        <table class="table table-responsive table-bordered table-striped">
            <tr>
                <td><strong>Message:</strong></td>
                <td>{{$entry->message}}</td>
            </tr>

            <tr>
                <td>Level</td>
                <td>{{$entry->level}}</td>
            </tr>

            <tr>
                <td>Incident time</td>
                <td>{{$entry->incident_time}}</td>
            </tr>

            <tr>
                <td>IP Address</td>
                <td>{{$entry->ip_address}}</td>
            </tr>

            <tr>
                <td>User</td>
                <td>{{$entry->user}}</td>
            </tr>

            @if($entry->variable != '')
            <tr>
                <td>Variable</td>
                <td>{{krumo(unserialize($entry->variable))}}</td>
            </tr>
            @endif
        </table>

        <a href="{{ url('watchdog/list') }}" class="btn btn-primary">Back</a>
    </div>
</div>
@endsection

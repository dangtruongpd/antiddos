@php
// dd($all);
@endphp

<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<table>
    <tr>
        <th>IP</th>
        <th>Count</th>
        <th>First Time</th>
        <th>Last Time</th>
    </tr>
    @foreach ($all as $item)
        <tr>
            <td>{{ $item->ip }}</td>
            <td>{{ $item->count }}</td>
            <td>{{ $item->first_time }}</td>
            <td>{{ $item->last_time }}</td>
        </tr>
    @endforeach
</table>

<hr>

<h1>IP REQUESTS CONFIG</h1>

<form action="{{ route('update-config') }}" method="post">
    @csrf
    Requests: <input type="number" name="requests" value="{{ $requests }}">
    Scope: <input type="number" name="scope" value="{{ $scope }}">

    <select name="unit">
        <option {{ $unit == 'YEAR' ? 'selected' : '' }} value="YEAR">YEAR</option>
        <option {{ $unit == 'MONTH' ? 'selected' : '' }} value="MONTH">MONTH</option>
        <option {{ $unit == 'DAY' ? 'selected' : '' }} value="DAY">DAY</option>
        <option {{ $unit == 'HOUR' ? 'selected' : '' }} value="HOUR">HOUR</option>
        <option {{ $unit == 'MINUTE' ? 'selected' : '' }} value="MINUTE">MINUTE</option>
        <option {{ $unit == 'SECOND' ? 'selected' : '' }} value="SECOND">SECOND</option>
    </select>

    <input type="submit" value="Submit">
</form>

@extends('layouts.app')
@section('page-title')
    List of clients
@endsection
@section('content')
    <h2>List of Clients</h2>
    <table class="table table-bordered table-hover">
        <thead class="">
        <th>id</th>
        <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>Door Number</th>
        <th>Apartment</th>
        <th>Street</th>
        <th>City</th>
        <th>Province</th>
        <th>Country</th>
        <th>Postal Code</th>
        </thead>
        @foreach($clients as $client)
            @if($client['isAdmin'] == false)
                <tr>
                    <td>{{ $client['id'] }}</td>
                    <td>{{ $client['email'] }}</td>
                    <td>{{ $client['firstName'] }}</td>
                    <td>{{ $client['lastName'] }}</td>
                    <td>{{ $client['phoneNumber'] }}</td>
                    <td>{{ $client['doorNumber'] }}</td>
                    <td>{{ $client['appartement'] }}</td>
                    <td>{{ $client['street'] }}</td>
                    <td>{{ $client['city'] }}</td>
                    <td>{{ $client['province'] }}</td>
                    <td>{{ $client['country'] }}</td>
                    <td>{{ $client['postalCode'] }}</td>
                </tr>
            @endif
        @endforeach
    </table>
@endsection
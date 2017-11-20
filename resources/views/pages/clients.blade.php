@extends('layouts.app')
@section('page-title')
    List of clients
@endsection
@section('content')
    <h2>List of Clients</h2>
    <table class="table">
        <thead>
        <td>id</td>
        <td>Email</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Phone Number</td>
        <td>Door Number</td>
        <td>Apartment</td>
        <td>Street</td>
        <td>City</td>
        <td>Province</td>
        <td>Country</td>
        <td>Postal Code</td>
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
@extends('layouts.app')
@section('page-title')
    List of clients
@endsection
@section('content')
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
            @if($client->getIsAdmin() == false)
                <tr>
                    <td>{{ $client->getId() }}</td>
                    <td>{{ $client->getEmail() }}</td>
                    <td>{{ $client->getFirstName() }}</td>
                    <td>{{ $client->getLastName() }}</td>
                    <td>{{ $client->getPhoneNumber() }}</td>
                    <td>{{ $client->getDoorNumber() }}</td>
                    <td>{{ $client->getAppartement() }}</td>
                    <td>{{ $client->getStreet() }}</td>
                    <td>{{ $client->getCity() }}</td>
                    <td>{{ $client->getProvince() }}</td>
                    <td>{{ $client->getCountry() }}</td>
                    <td>{{ $client->getCountry() }}</td>
                </tr>
            @endif
        @endforeach
    </table>
@endsection
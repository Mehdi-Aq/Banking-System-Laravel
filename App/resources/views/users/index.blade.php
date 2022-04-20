@extends('layouts.app')

@section('content')

<div class="container">

<nav>
    <div>
        <a href="{{ URL::to('users') }}">User List</a>
    </div>
    <ul>
        <li><a href="{{ URL::to('users') }}"> View All Users</a></li>
        <li><a href="{{ URL::to('users/create') }}"> Create a User</a>
    </ul>
</nav>

<h2>All Users</h2>

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Address</td>
            <td>City</td>
            <td>Province</td>
            <td>Postal Code</td>
            <td>Phone Number</td>
            <td>Email</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->firstname }}</td>
                <td>{{ $value->lastname }}</td>
                <td>{{ $value->address }}</td>
                <td>{{ $value->city }}</td>
                <td>{{ $value->province }}</td>
                <td>{{ $value->postalcode }}</td>
                <td>{{ $value->phone }}</td>
                <td>{{ $value->email }}</td>

                <td>

                    <!-- delete the user (uses the destroy method DESTROY /users/{id} -->
                    <!-- we will add this later since its a little more complicated than the other two buttons -->

                    <!-- show the user (uses the show method found at GET /users/{id} -->
                    <a class="btn btn-small btn-success" href="{{ URL::to('users/' . $value->id) }}">Show this user</a>

                    <!-- edit this user (uses the edit method found at GET /users/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('users/' . $value->id . '/edit') }}">Edit this user</a>

                </td>
            </tr>            
        @endforeach
    </tbody>
</table>

</div>

@endsection
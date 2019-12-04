@extends('layouts.content')
@section('title', 'Edit')
@section('main-content')

<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('nerds') }}">Nerd Alert</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('teams') }}">View All Teams</a></li>
            <li><a href="{{ URL::to('teams/create') }}">Create a team</a>
        </ul>
    </nav>

    <h1>Showing {{ $team->name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $team->name }}</h2>
        <p>
            <strong>Team:</strong> {{ $team->name }}<br>

        </p>
    </div>

</div>

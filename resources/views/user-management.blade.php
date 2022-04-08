@extends('layouts.AdminNavbar')

@section('content')
<div class="container">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @can('isAdmin')
            <div class="btn btn-primary btn-lg">
                You have Admin access (User Management Page)
            </div>
            @endcan
        </div>
</div>
@endsection

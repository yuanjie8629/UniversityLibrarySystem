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
                <admin-borrows-table></admin-borrows-table>
            @endcan
        </div>
</div>
@endsection

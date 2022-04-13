@extends('layouts.Navbar')

@section('content')
<div class="container">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @can('isAdmin')
            @else
            <return-book-table :user_id={{Auth::id()}}></return-book-table>
            @endcan
        </div>
</div>
@endsection
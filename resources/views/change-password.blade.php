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
            <change-password-form :user_id={{Auth::id()}}></change-password-form>
            @endcan
        </div>
</div>
@endsection

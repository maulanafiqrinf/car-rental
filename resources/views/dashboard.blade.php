@extends('templates.dashboard.app')

@section('content')
<div class="body-wrapper">
    @include('templates.includes.headbar')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Case Pinjam</h5>
                <p class="mb-0">You're logged in! {{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>
</div>

@endsection

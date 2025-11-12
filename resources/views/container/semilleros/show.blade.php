@extends('layouts.dashboard')

@section('content')
<div class="max-w-4xl mx-auto">
    @include('container.semilleros.show-container.semilleros-info')

    @include('container.semilleros.show-container.semilleros-files')
</div>
@endsection

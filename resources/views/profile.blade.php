@extends('layouts.app')

@section('content')

    <div class="container">

        <livewire:profile-form />

        <livewire:password-change-form />

        <livewire:two-factor-form />

    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">Profile updated successfully!</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" class="form-control" type="text" value="{{ old('name', $user->name) }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" class="form-control" type="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection

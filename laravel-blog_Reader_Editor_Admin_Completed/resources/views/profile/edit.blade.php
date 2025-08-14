@extends(request()->routeIs('admin.*') ? 'admin.layouts.app' : 'layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 780px;">
  <h1 class="h4 fw-bold mb-3">Edit Profile</h1>

  @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Update Name --}}
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
      <h2 class="h6 mb-3">Basic Info</h2>
      <form method="POST" action="{{ route('profile.update-name') }}" class="row g-3">
        @csrf
        <div class="col-12">
          <label class="form-label">Name</label>
          <input name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="col-12 d-flex justify-content-end">
          <button class="btn btn-primary">Save Name</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Change Email (OTP to current email) --}}
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
      <h2 class="h6 mb-3">Change Email</h2>

      <form method="POST" action="{{ route('profile.request-otp') }}" class="row g-3">
        @csrf
        <input type="hidden" name="purpose" value="email">
        <div class="col-md-8">
          <label class="form-label">New Email</label>
          <input name="new_email" type="email" class="form-control" value="{{ old('new_email') }}" required>
          <div class="form-text">We will send an OTP to your current email: <strong>{{ $user->email }}</strong></div>
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button class="btn btn-outline-primary w-100">Send OTP</button>
        </div>
      </form>

      <form method="POST" action="{{ route('profile.confirm-otp') }}" class="row g-3 mt-2">
        @csrf
        <input type="hidden" name="purpose" value="email">
        <div class="col-md-6">
          <label class="form-label">OTP Code</label>
          <input name="otp_code" class="form-control" maxlength="6" placeholder="6-digit code">
        </div>
        <div class="col-md-6 d-flex align-items-end">
          <button class="btn btn-primary w-100">Confirm Email Change</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Change Password (OTP to current email) --}}
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
      <h2 class="h6 mb-3">Change Password</h2>

      {{-- Step 1: send OTP --}}
      <form method="POST" action="{{ route('profile.request-otp') }}" class="row g-3">
        @csrf
        <input type="hidden" name="purpose" value="password">
        <div class="col-md-6">
          <label class="form-label">Send OTP to {{ $user->email }}</label>
          <button class="btn btn-outline-primary d-block">Send OTP</button>
        </div>
      </form>

      {{-- Step 2: confirm OTP and set new password --}}
      <form method="POST" action="{{ route('profile.confirm-otp') }}" class="row g-3 mt-2">
        @csrf
        <input type="hidden" name="purpose" value="password">
        <div class="col-md-6">
          <label class="form-label">OTP Code</label>
          <input name="otp_code" class="form-control" maxlength="6" placeholder="6-digit code">
        </div>
        <div class="col-md-6">
          <label class="form-label">Current Password</label>
          <input name="current_password" type="password" class="form-control" autocomplete="current-password">
        </div>
        <div class="col-md-6">
          <label class="form-label">New Password</label>
          <input name="new_password" type="password" class="form-control" autocomplete="new-password">
        </div>
        <div class="col-md-6">
          <label class="form-label">Confirm New Password</label>
          <input name="new_password_confirmation" type="password" class="form-control" autocomplete="new-password">
        </div>
        <div class="col-12 d-flex justify-content-end">
          <button class="btn btn-primary">Update Password</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Optional: Delete --}}
  {{-- Keep only if you have profile.destroy wired and want this feature --}}
  {{-- <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Delete account?');">
    @csrf @method('DELETE')
    <button class="btn btn-outline-danger">Delete Account</button>
  </form> --}}
</div>
@endsection

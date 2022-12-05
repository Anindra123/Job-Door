@extends('layout.app')

@section('title')
Verify Email
@endsection

@section('content')
<div class="container">
    <div class="row p-5">
        @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            {{'A new verification link has been sent to the email address you provided during registration.' }}
        </div>
        @endif
        <div class="col-lg-12">
            <div class="card" style="width: 50rem;">
                <div class="card-body">
                    <h5 class="card-title">Thank you for registering to Job Door</h5>
                    <p class="card-text">Before proceeding please verify your email address sent on your email. If you haven't recive the mail,</p>
                    <form action="{{ route('verification.send') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-small">Resend Verification Link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
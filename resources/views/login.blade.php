@extends('layouts.app')
@section('title', 'Login')
@section('content')

<style>
    :root{
        --pos-dark:#182420;
        --pos-green:#1f8a5f;
        --pos-green-light:#d7f7e3;
        --pos-green-text:#188a53;
        --pos-red:#ef4463;
        --pos-red-light:#fdecef;
        --pos-gray:#6b7280;
        --pos-border:#eef1f0;
    }

    .pos-login-wrap{
        min-height:calc(100vh - 80px);
        display:flex;
        align-items:center;
        justify-content:center;
        padding:2rem 1rem;
    }

    .pos-login-card{
        width:100%;
        max-width:380px;
        background:#fff;
        border:none;
        border-radius:18px;
        box-shadow:0 4px 20px rgba(0,0,0,.06);
        overflow:hidden;
    }

    .pos-login-header{
        background:var(--pos-dark);
        padding:2.25rem 1.5rem 1.75rem;
        text-align:center;
    }
    .pos-login-logo{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        width:52px;
        height:52px;
        border-radius:15px;
        background:var(--pos-green);
        color:#fff;
        margin-bottom:.9rem;
        box-shadow:0 4px 12px rgba(31,138,95,.35);
    }
    .pos-login-logo svg{
        width:26px;
        height:26px;
    }
    .pos-login-header h5{
        color:#fff;
        font-weight:700;
        font-size:1.15rem;
        margin-bottom:.2rem;
    }
    .pos-login-header p{
        color:rgba(255,255,255,.6);
        font-size:.82rem;
        margin-bottom:0;
    }

    .pos-login-body{
        padding:2rem 1.75rem 1.75rem;
    }

    .pos-form-label{
        font-size:.82rem;
        font-weight:600;
        color:#111827;
        margin-bottom:.5rem;
        display:block;
    }

    .pos-form-input{
        width:100%;
        border:1px solid var(--pos-border);
        background:#fafbfb;
        border-radius:10px;
        padding:.7rem .9rem;
        font-size:.9rem;
        outline:none;
        transition:border-color .15s, background .15s;
        margin-bottom:1.25rem;
    }
    .pos-form-input:focus{
        border-color:var(--pos-green);
        background:#fff;
    }
    .pos-form-input.is-invalid{
        border-color:var(--pos-red);
        background:#fff;
    }

    .pos-error-msg{
        color:var(--pos-red);
        font-size:.78rem;
        margin-top:-.7rem;
        margin-bottom:1rem;
        display:block;
    }

    .btn-pos-submit{
        width:100%;
        background:var(--pos-dark);
        border:none;
        color:#fff;
        border-radius:10px;
        padding:.75rem;
        font-weight:600;
        font-size:.92rem;
        margin-top:.25rem;
        transition:background .15s;
    }
    .btn-pos-submit:hover{
        background:#0f1a16;
        color:#fff;
    }

    .pos-alert-success{
        border:none;
        border-radius:12px;
        background:var(--pos-green-light);
        color:var(--pos-green-text);
        font-size:.88rem;
        padding:.85rem 1.1rem;
        max-width:600px;
        margin:1.5rem auto 0;
    }
</style>

@if (session('status'))
    <div class="pos-alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="pos-login-wrap">
    <div class="pos-login-card">

        <div class="pos-login-header">
            <div class="pos-login-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="7" width="20" height="14" rx="2"></rect>
                    <path d="M16 7V5a4 4 0 0 0-8 0v2"></path>
                    <line x1="12" y1="12" x2="12" y2="16"></line>
                    <line x1="10" y1="14" x2="14" y2="14"></line>
                </svg>
            </div>
            <h5>Login</h5>
            <p>Masuk untuk melanjutkan ke aplikasi</p>
        </div>

        <div class="pos-login-body">
            <form action="{{ route('auth') }}" method="POST">
                @csrf

                <label for="exampleInputEmail1" class="pos-form-label">Email address</label>
                <input type="email" name="email" class="pos-form-input @error('email') is-invalid @enderror"
                    id="exampleInputEmail1" placeholder="nama@email.com">
                @error('email')
                    <span class="pos-error-msg">{{ $message }}</span>
                @enderror

                <label for="exampleInputPassword1" class="pos-form-label">Password</label>
                <input type="password" name="password" class="pos-form-input @error('password') is-invalid @enderror"
                    id="exampleInputPassword1" placeholder="••••••••">
                @error('password')
                    <span class="pos-error-msg">{{ $message }}</span>
                @enderror

                <button type="submit" class="btn-pos-submit">Submit</button>
            </form>
        </div>

    </div>
</div>

@endsection
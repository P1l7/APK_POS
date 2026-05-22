@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

@include('layouts.navbar')

<div class="container py-4">

    <h4 class="mb-4">Tambah Produk</h4>

    <form
        action="{{ route('produk.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        @include('produk._form')

    </form>

</div>

@endsection
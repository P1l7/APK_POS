@extends('layouts.app')

@section('title', 'Edit jenis')

@section('content')
    <h4>Edit Jenis</h4>

<form action="{{ route('jenis.update', $jeni) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('jenis.form')
    </form>
@endsection
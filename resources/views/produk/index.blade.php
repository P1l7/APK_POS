@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

@php
    $isAdmin = auth()->user()->role->name === 'admin';
@endphp

<div class="container py-4">

    <h1 class="mb-4">Halaman Produk</h1>

    {{-- Tombol Create --}}
    @can('create', App\Models\Produk::class)
        <a
            href="{{ $isAdmin ? route('produk.create') : route('produk.create') }}"
            class="btn btn-primary mb-3"
        >
            Create
        </a>
    @endcan

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Search --}}
    <form
        action="{{ $isAdmin ? route('produk.index') : route('produk.index') }}"
        method="GET"
        class="mb-4"
    >
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Search nama produk"
            >
            <button class="btn btn-outline-secondary" type="submit">
                Search
            </button>
        </div>
    </form>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th style="width: 180px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $products->firstItem() + $loop->index }}</td>

                        <td>{{ $product->user->name ?? '-' }}</td>

                        <td>
                            @if ($product->foto)
                                <img
                                    src="{{ asset('storage/' . $product->foto) }}"
                                    width="80"
                                    class="img-thumbnail"
                                    alt="Foto {{ $product->name }}"
                                >
                            @else
                                <span class="text-muted fst-italic">Tidak ada foto</span>
                            @endif
                        </td>

                        <td>{{ $product->name }}</td>

                        <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>

                        <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>

                        <td>{{ $product->stok }}</td>

                        <td>
                            <div class="d-flex gap-2">

                                {{-- Edit --}}
                                @can('update', $product)
                                    <a
                                        href="{{ $isAdmin
                                            ? route('produk.edit', $product)
                                            : route('produk.edit', $product) }}"
                                        class="btn btn-warning btn-sm"
                                    >
                                        Edit
                                    </a>
                                @endcan

                                {{-- Delete --}}
                                @can('delete', $product)
                                    <form
                                        action="{{ $isAdmin
                                            ? route('produk.destroy', $product)
                                            : route('produk.destroy', $product) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus produk ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                @endcan

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            Tidak ada produk
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $products->withQueryString()->links() }}
    </div>

</div>

@endsection
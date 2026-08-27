@extends('layouts.app')

@section('title', 'Jenis Produk')

@section('content')

@include('layouts.navbar')

<div class="container mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Jenis Produk</h3>
            <p class="text-muted mb-0">Kelola jenis produk yang tersedia.</p>
        </div>

        <a href="{{ route('jenis.create') }}" class="btn btn-primary">
            + Tambah Jenis
        </a>
    </div>

    {{-- Alert Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover mb-0">

                    <thead class="table-light">
                        <tr>
                            <th style="width: 70px;" class="ps-4">No</th>
                            <th>Nama Jenis</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($jenis as $item)

                            <tr>
                                <td class="ps-4 text-muted">
                                    {{ $loop->iteration + ($jenis->currentPage() - 1) * $jenis->perPage() }}
                                </td>

                                <td>
                                    {{ $item->nama_jenis }}
                                </td>

                                <td>
                                    <a href="{{ route('jenis.edit', $item->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    Belum ada data jenis.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $jenis->links() }}
    </div>

</div>

@endsection

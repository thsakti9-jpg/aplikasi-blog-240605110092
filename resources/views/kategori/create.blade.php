@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="card shadow-sm border-0">

```
<div class="card-header">
    Tambah Kategori
</div>

<div class="card-body">

    <form action="{{ route('kategori.store') }}"
          method="POST">

        @csrf

        <div class="mb-3">
            <label>Nama Kategori</label>

            <input type="text"
                   name="nama_kategori"
                   class="form-control @error('nama_kategori') is-invalid @enderror"
                   value="{{ old('nama_kategori') }}">

            @error('nama_kategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Keterangan</label>

            <textarea name="keterangan"
                      rows="4"
                      class="form-control">{{ old('keterangan') }}</textarea>
        </div>

        <button class="btn btn-success">
            Simpan
        </button>

        <a href="{{ route('kategori.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>
```

</div>

@endsection

<div class="mb-3">
    <label for="nama_jenis" class="form-label">Nama Jenis</label>
    <input type="text" name="nama_jenis"
        class="form-control @error('nama_jenis') is-invalid @enderror"
        
        placeholder="Contoh: Makanan, Minuman, dll" autofocus>
  
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('jenis.index') }}" class="btn btn-secondary">Batal</a>
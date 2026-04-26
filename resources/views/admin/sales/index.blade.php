@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0 py-2">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">Manajemen Akun Sales</h4>
            <p class="text-secondary mb-0 small">Kelola data sales, status aktif, dan akses sistem.</p>
        </div>
        <div class="d-grid gap-2 d-md-flex w-100 w-md-auto">
            <a href="{{ route('sales.download-template') }}" class="btn btn-outline-success shadow-sm" style="border-radius: 8px;">
                <i class="bi bi-file-earmark-excel me-1"></i> <span class="d-md-none d-lg-inline">Template Excel</span><span class="d-none d-md-inline d-lg-none">Template</span>
            </a>
            <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#importModal" style="border-radius: 8px;">
                <i class="bi bi-cloud-arrow-up me-1"></i> Import
            </button>
            <a href="{{ route('admin.sales.create') }}" class="btn btn-danger shadow-sm" style="border-radius: 8px;">
                <i class="bi bi-plus-lg me-1"></i> Tambah Sales
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-nowrap">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase text-secondary fw-semibold d-none d-md-table-cell" style="font-size: 0.75rem; letter-spacing: 0.5px; width: 5%;">No</th>
                            <th class="ps-4 ps-md-2 py-3 text-uppercase text-secondary fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px; width: 8%;">Foto</th>
                            <th class="py-3 text-uppercase text-secondary fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Nama Sales</th>
                            <th class="py-3 text-uppercase text-secondary fw-semibold d-none d-md-table-cell" style="font-size: 0.75rem; letter-spacing: 0.5px;">Email</th>
                            <th class="py-3 text-uppercase text-secondary fw-semibold d-none d-sm-table-cell" style="font-size: 0.75rem; letter-spacing: 0.5px;">No. Telepon</th>
                            <th class="py-3 text-uppercase text-secondary fw-semibold text-center" style="font-size: 0.75rem; letter-spacing: 0.5px; width: 12%;">Status</th>
                            <th class="pe-4 py-3 text-uppercase text-secondary fw-semibold text-center" style="font-size: 0.75rem; letter-spacing: 0.5px; width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($sales as $index => $item)
                        <tr>
                            <td class="ps-4 text-secondary d-none d-md-table-cell">{{ $index + 1 }}</td>
                            <td class="ps-4 ps-md-2">
                                <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://ui-avatars.com/api/?name='.urlencode($item->name).'&background=random' }}" class="rounded-circle shadow-sm" width="40" height="40" style="object-fit: cover;">
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $item->name }}</div>
                                <div class="d-md-none text-secondary small">{{ $item->email }}</div>
                                <div class="d-sm-none text-muted small" style="font-size: 0.7rem;">{{ $item->nomor_telepon }}</div>
                            </td>
                            <td class="text-secondary d-none d-md-table-cell">{{ $item->email }}</td>
                            <td class="text-secondary d-none d-sm-table-cell">{{ $item->nomor_telepon }}</td>
                            
                            <td class="text-center">
                                <form action="{{ route('admin.sales.toggle', $item->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm shadow-none p-0 border-0 transition-all" title="Ubah Status">
                                        @if($item->is_active)
                                            <span class="badge bg-success px-2 py-2 px-md-3 rounded-pill fw-medium" style="letter-spacing: 0.3px;">
                                                <i class="bi bi-check2-circle d-none d-md-inline me-1"></i> Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-danger px-2 py-2 px-md-3 rounded-pill fw-medium" style="letter-spacing: 0.3px;">
                                                <i class="bi bi-x-circle d-none d-md-inline me-1"></i> Nonaktif
                                            </span>
                                        @endif
                                    </button>
                                </form>
                            </td>

                            <td class="pe-4 text-center">
                                <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-2">
                                    <button type="button" class="btn btn-sm btn-light border text-dark fw-medium w-100" data-bs-toggle="modal" data-bs-target="#resetModal{{ $item->id }}" style="border-radius: 6px;">
                                        <i class="bi bi-key"></i> <span class="d-none d-md-inline">Reset</span>
                                    </button>

                                    @if(!$item->is_active)
                                        <form action="{{ route('admin.sales.destroy', $item->id) }}" method="POST" class="m-0 form-delete w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger fw-medium w-100 btn-delete" data-name="{{ $item->name }}" style="border-radius: 6px;" title="Hapus Akun">
                                                <i class="bi bi-trash3"></i> <span class="d-none d-md-inline">Hapus</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="resetModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <form action="{{ route('admin.sales.reset-password', $item->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header border-bottom-0 pb-0">
                                            <h6 class="modal-title fw-bold">Reset Password</h6>
                                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-start pb-2">
                                            <p class="small text-muted mb-3">Password baru untuk <strong>{{ $item->name }}</strong>.</p>
                                            <label class="small fw-semibold mb-1 text-dark">Password Baru</label>
                                            <input type="password" name="new_password" class="form-control" placeholder="Minimal 8 karakter" required>
                                        </div>
                                        <div class="modal-footer border-top-0 pt-1">
                                            <button type="submit" class="btn btn-danger w-100" style="border-radius: 8px;">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-people fs-1 text-light-subtle mb-2 d-block"></i>
                                <span class="fw-medium">Belum ada akun sales yang terdaftar.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('sales.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light border-bottom-0">
                    <h5 class="modal-title fw-bold text-dark">Import Akun Sales</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4 px-4">
                    <div class="mb-3">
                        <i class="bi bi-file-earmark-excel-fill text-success" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-muted mb-4 small">Unggah file Excel (.xlsx) dengan format kolom:<br><strong class="text-dark">Nama, Email, Password, No Telepon</strong></p>
                    
                    <div class="text-start">
                        <label class="small fw-semibold mb-1 text-dark">Pilih File Excel</label>
                        <input type="file" name="file_import" class="form-control" accept=".xlsx, .xls" required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light flex-column flex-md-row">
                    <button type="button" class="btn btn-light border w-100 w-md-auto mb-2 mb-md-0" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn btn-success w-100 w-md-auto" style="border-radius: 8px;">Mulai Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const form = this.closest('form');
                const name = this.getAttribute('data-name');
                
                Swal.fire({
                    title: 'Hapus Akun?',
                    text: `Apakah Anda yakin ingin menghapus akun ${name} secara permanen? Data tidak dapat dikembalikan.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
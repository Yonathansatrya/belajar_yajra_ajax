<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Belajar Ajax</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('item.index') ? 'active' : '' }}"
                        href="{{ route('item.index') }}">Barang</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a id="btn-logout" class="nav-link text-danger" href="javascript:void(0)">Log Out</a>
                </li>
            </ul>
            <script>
                $('body').on('click', '#btn-logout', function() {
                    let token = $("meta[name='csrf-token']").attr("content");
            
                    Swal.fire({
                        title: 'Apakah Kamu Yakin?',
                        text: "Ingin keluar dari akun ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'TIDAK',
                        confirmButtonText: 'YA, LOGOUT!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/logout',
                                type: 'POST',
                                cache: false,
                                data: {
                                    "_token": token
                                },
                                success: function(response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: `${response.message}`,
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(() => {
                                        window.location.href = "/";
                                    });
                                },
                                error: function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal logout',
                                        text: 'Terjadi kesalahan saat mencoba logout.',
                                        showConfirmButton: true
                                    });
                                }
                            });
                        }
                    });
                });
            </script>
            
        </div>
    </div>
</nav>

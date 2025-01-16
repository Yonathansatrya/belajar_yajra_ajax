<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="">
                <h2>Login</h2>
                <form id="login-form">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter password" required>
                    </div>
                    <button type="button" id="login-btn" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#login-btn').on('click', function() {
            const email = $('#email').val();
            const password = $('#password').val();

            $('#login-error').addClass('d-none').text('');

            $.ajax({
                url: '/login',
                type: 'POST',
                data: {
                    email: email,
                    password: password,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        title: "Login Berhasil!",
                        text: response.message || "Selamat datang di dashboard!",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/dashboard';
                    });
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON?.message ||
                        'Login gagal. Periksa email dan password Anda.';
                    Swal.fire({
                        title: "Login Gagal",
                        text: errorMessage,
                        icon: "error",
                        timer: 3000,
                        showConfirmButton: true
                    });
                }
            });
        });
    </script>
</body>

</html>

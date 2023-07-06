<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/evoting2/public/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="icon" href="/evoting2/public/image/logo-uho.png" type="image/x-icon">
    <link rel="shortcut icon" href="/evoting2/public/image/logo-uho.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Evoting | Login Admin</title>
</head>
<body class="bg-sky-600">
    <div class="container">
        <div class="wrapper">
            <div class="login-box">
                <div class="header-img">
                    <img src="/evoting2/public/image/logo-uho.png" alt="">
                </div>
                <div class="header-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                    </svg>
                    <p>Login</p>
                </div>
                <form action="login/post" method="POST">
                    <div class="input-group">
                        <input type="text" class="input-field" id="username" name="username" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="input-group">
                        <input type="password" class="input-field" id="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="forgot-pass">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ubah password</a>
                    </div>
                    <div class="input-group">
                        <button class="input-submit">Login <i class="bx bx-log-in"></i></button>
                    </div>
                </form>
            </div>
            <div class="vector">
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="edit/password" method="POST">
            <div class="modal-body">
            <div class="mb-3">
                <label for="modalUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="modalUsername" placeholder="Username" name="username">
            </div>
            <div class="mb-3">
                <label for="modalPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="modalPassword" placeholder="Password" name="password">
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="newPassword" placeholder="Password Baru" name="newPassword">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ubah Password</button>
    </div>
</form>
    </div>
  </div>
</div>

    <script>
        <?php 
            SweetAlert::Alert();
        ?>
    </script>
</body>
</html>
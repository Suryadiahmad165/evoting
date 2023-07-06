<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/form-style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="/evoting2/public/image/logo-uho.png" type="image/x-icon">
    <link rel="shortcut icon" href="/evoting2/public/image/logo-uho.png" type="image/x-icon">
    <title>Evoting | Tambah DPT</title>
</head>
<body>
<button class="block md:hidden p-2 text-gray-800 hover:text-gray-700" onclick="toggleMenu()" style="position: absolute; left: 16px; transition: left 0.1s ease-out;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
    </svg>
</button>
<div id="sidebar" class="sidebar w-64 bg-gray-800 text-white p-4 fixed left-0 h-screen hidden md:block" style="transform: translateX(0%); transition: transform 0.5s ease-out;">
    <div class="py-4 px-6 text-white">
        <h1 class="text-3xl font-bold mb-2">Dashboard</h1>
        <p class="text-gray-500">Welcome Back!! <span id="username"></span></p>
    </div>
    <ul class="list-none p-0">
        <li class="py-2 px-6">
            <a href="index" class="block text-white hover:bg-gray-700 rounded-full py-1 px-3">Dashboard</a>
        </li>
        <li class="py-2 px-6">
            <div class="relative">
                <a href="#" class="block text-white hover:bg-gray-700 rounded-full py-1 px-3" onclick="toggleAccordion(event, 'calonKetua')">Kandidat Ketua HMPS<span class="dropdown-arrow">&#9662;</span></a>
                <ul id="calonKetua" class="ml-[-50px] mt-2 bg-white text-black rounded-md p-2 hidden" style="z-index: 1;">
                    <li>
                        <a href="tambahcalon" class="block text-black hover:bg-gray-200 rounded-full py-1 px-3">Tambah Calon</a>
                    </li>
                    <li>
                        <a href="datacalon" class="block text-black hover:bg-gray-200 rounded-full py-1 px-3">Daftar Calon</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="py-2 px-6">
            <div class="relative">
                <a href="#" class="block text-white hover:bg-gray-700 rounded-full py-1 px-3" onclick="toggleAccordion(event, 'dpt')">Data DPT<span class="dropdown-arrow">&#9662;</span></a>
                <ul id="dpt" class="ml-[-50px] mt-2 bg-white text-black rounded-md p-2 hidden" style="z-index: 1;">
                    <li>
                        <a href="tambahdpt" class="block text-black hover:bg-gray-200 rounded-full py-1 px-3">Tambah DPT</a>
                    </li>
                    <li>
                        <a href="datadpt" class="block text-black hover:bg-gray-200 rounded-full py-1 px-3">Daftar DPT</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="py-2 px-6">
            <form action="/evoting2/admin/logout" method="post">
                <button class="mx-auto" onclick="logout()">Logout</button>
            </form>
        </li>
    </ul>
</div>


<div id="main-content" class="ml-64 p-4">
    <h1 class="text-3xl mb-4">Daftar Pemilih Tetap</h1>
    <hr class="border-gray-300 mb-4">
    <h4 class="text-lg font-semibold mb-2">Tambah DPT</h4>
    <form action="tambahdpt/store" method="post">
        <label for="nimdpt">
            Nomor Induk Mahasiswa
            <input type="text" placeholder="NIM" id="nimdpt" name="nim" required>
        </label>
        <label for="namadpt">
            Nama
            <input type="text" placeholder="Nama" id="namadpt" name="nama" required>
        </label>
        <button class="py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600">Submit</button>
    </form>
</div>

<script src="/evoting2/public/js/script.js"></script>
<script src="/evoting2/public/js/dptValidationMessage.js"></script>
<script>
        <?php 
            SweetAlert::Alert();
        ?>
    </script>
</body>
</html>

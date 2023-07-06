<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/evoting2/public/css/style.css">
    <link rel="stylesheet" href="/evoting2/public/css/form-style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <link rel="icon" href="/evoting2/public/image/logo-uho.png" type="image/x-icon">
    <link rel="shortcut icon" href="/evoting2/public/image/logo-uho.png" type="image/x-icon">
    <title>Evoting | Edit Data Calon</title>
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
            <a href="/evoting2/admin/index" class="block text-white hover:bg-gray-700 rounded-full py-1 px-3">Dashboard</a>
        </li>
        <li class="py-2 px-6">
            <div class="relative">
                <a href="#" class="block text-white hover:bg-gray-700 rounded-full py-1 px-3" onclick="toggleAccordion(event, 'calonKetua')">Kandidat Ketua HMPS<span class="dropdown-arrow">&#9662;</span></a>
                <ul id="calonKetua" class="ml-[-50px] mt-2 bg-white text-black rounded-md p-2 hidden" style="z-index: 1;">
                    <li>
                        <a href="/evoting2/admin/tambahcalon" class="block text-black hover:bg-gray-200 rounded-full py-1 px-3">Tambah Calon</a>
                    </li>
                    <li>
                        <a href="/evoting2/admin/datacalon" class="block text-black hover:bg-gray-200 rounded-full py-1 px-3">Daftar Calon</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="py-2 px-6">
            <div class="relative">
                <a href="#" class="block text-white hover:bg-gray-700 rounded-full py-1 px-3" onclick="toggleAccordion(event, 'dpt')">Data DPT<span class="dropdown-arrow">&#9662;</span></a>
                <ul id="dpt" class="ml-[-50px] mt-2 bg-white text-black rounded-md p-2 hidden" style="z-index: 1;">
                    <li>
                        <a href="/evoting2/admin/tambahdpt" class="block text-black hover:bg-gray-200 rounded-full py-1 px-3">Tambah DPT</a>
                    </li>
                    <li>
                        <a href="/evoting2/admin/datadpt" class="block text-black hover:bg-gray-200 rounded-full py-1 px-3">Daftar DPT</a>
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
    <h1 class="text-3xl mb-4">Kandidat Ketua Himpunan</h1>
    <hr class="border-gray-300 mb-4">
    <h4 class="text-lg font-semibold mb-2">Tambah Kandidat</h4>
    <form action="edit/update" method="post" enctype="multipart/form-data">
    <?php foreach ($rows as $row): ?>
        <input type="hidden" name="id" value="<?php echo $row['id_calon']; ?>">
        <label for="nimketua">
            Nomor Induk Mahasiswa Calon Ketua
            <input type="text" placeholder="NIM" id="nimketua" name="nimketua" required value="<?php echo $row['nim_calon_ketua'];?>">
        </label>
        <label for="nimwakil">
            Nomor Induk Mahasiswa Calon Wakil Ketua
            <input type="text" placeholder="NIM" id="nimwakil" name="nimwakil" required value="<?php echo $row['nim_calon_wakil_ketua']?>">
        </label>
        <label for="namaketua">
            Nama Calon Ketua
            <input type="text" placeholder="Nama Calon Ketua" id="namaketua" name="namaketua" required value="<?php echo $row['nama_calon_ketua']?>">
        </label>
        <label for="namawakil">
            Nama Calon Wakil Ketua
            <input type="text" placeholder="Nama Calon Wakil Ketua" id="namawakil" name="namawakil" required value="<?php echo $row['nama_calon_wakil_ketua']?>">
        </label>
        <label for="visi">
            Visi
            <input type="text" name="visi" id="visi" placeholder="Visi" required value="<?php echo $row['visi']?>">
        </label>
        <label for="misi">
            Misi
            <textarea id="misi" name="misi" required><?php echo $row['misi']?></textarea>
        </label>
        <label for="foto">
            Foto
            <input type="file" name="foto" id="foto">
            <input type="hidden" name="existingFoto" value="<?php echo $row['gambar']?>">
        </label>
        <?php endforeach; ?>
        <button class="py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600">Submit</button>
    </form>
</div>

<script src="/evoting2/public/js/script.js"></script>
<script src="/evoting2/public/js/calonValidationMessage.js"></script>
<script>
        <?php 
            SweetAlert::Alert();
        ?>
</script>
<script>
    CKEDITOR.replace('misi', {
        removePlugins: 'image,table,sourcearea,link,horizontalrule,scayt',
        removeButtons: 'Image,Table,Source,Anchor,HorizontalRule,Scayt'
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/evoting2/public/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="icon" href="/evoting2/public/image/logo-uho.png" type="image/x-icon">
    <link rel="shortcut icon" href="/evoting2/public/image/logo-uho.png" type="image/x-icon">
    <title>Evoting</title>
</head>
<body>
    <div class="mynavbar mb-10">
        <h1>E-Voting</h1>
    </div>
    <div class="candidates">
    <?php
        $counter = 1; 
        foreach ($rows as $row): ?>
            <?php $modalId = "exampleModal" . $row['id_calon']; ?>
            <div class="candidate">
                <h3><?php echo $counter++; ?></h3>
                <img src="<?php echo $row['gambar'];?>" alt="Candidate 1">
                <h2><?php echo($row['nama_calon_ketua'] . " / " . $row['nama_calon_wakil_ketua']);?></h2>
            <button class="visimisi-button" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>">Visi & Misi</button>
            <button class="vote-button" onclick="confirmation(<?php echo $row['id_calon']; ?>)">Vote</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Visi & Misi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <h3>Visi</h3>
                    <?php echo $row['visi'];?>
                </div>
                <div>
                    <h3>Misi</h3>
                    <?php echo $row['misi'];?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
    <?php endforeach; ?>
    </div>
    <script src="../public/js/script.js"></script>
    <script>
        <?php 
            SweetAlert::Alert();
        ?>
        function confirmation(id) {
            const idCandidate = id;
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Vote akan terekam dan kamu tidak akan bisa mengubah pilihan kamu!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya yakin!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with form submission
                    const form = document.createElement('form');
                    form.action = 'index/vote';
                    form.method = 'POST';
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.value = idCandidate;
                    input.name = 'id';
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
</body>
</html>

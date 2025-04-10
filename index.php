<?php

include("./controller/Controller.php");

$controller = new Controller;

$data_proyek_ti;
$nama_proyek;
$jenis_proyek;

$delete_proyek = false;

if(isset($_POST["nama_proyek"])&&isset($_POST["jenis_proyek"])){
    $nama_proyek = $_POST["nama_proyek"];
    $jenis_proyek = $_POST["jenis_proyek"];
    if(isset($_POST["id_proyek"])){
        $controller->update($_POST["id_proyek"],$nama_proyek,$jenis_proyek);
    } else if(isset($_POST["id_proyek_delete"])) {
        $controller->delete(intval($_POST["id_proyek_delete"]));
    } else {
        $controller->create($nama_proyek,$jenis_proyek);
    }
    header("Location: /crud-mvc-web-lanjut");
}

if(isset($_POST["search"])){
    $data_proyek_ti = $controller->findByNameOrType($_POST["search"]);
} else {
    $data_proyek_ti = $controller->read();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <?php include("navbar.php") ?>

    <div class="w-75 mx-auto my-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah Proyek
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Proyek</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="body-confirm d-none fs-4">Yakin ingin menghapus <span class="confirm fw-bolder"></span>?</div>
                        <div id="form-proyek">
                            <input type="hidden" id="id_proyek">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nama Proyek</label>
                                <input type="text" class="form-control nama_proyek" placeholder="Nama Proyek" name="nama_proyek" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Jenis Proyek</label>
                                <select name="jenis_proyek" class="jenis_proyek my-3 w-100 p-3">
                                    <option value="Software Engineering">Software Engineering</option>
                                    <option value="IoT">IoT</option>
                                    <option value="Sistem Cerdas">Sistem Cerdas</option>
                                </select>
                            </div>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button class="btn" type="submit">Save changes</button>
                    </div>
                </form>    
            </div>
        </div>
        </div>

        <table class="fs-5 table text-center table-secondary table-striped">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Nama Proyek</th>
                    <th>Jenis Proyek</th>
                    <td colspan="2">
                        <img width="26" height="26" src="./styles/icons/gear-fill.svg">
                    </td>
                </tr>
            </thead>
            <tbody>
            <?php if(!$data_proyek_ti) { ?>
                <tr>
                    <td colspan="4" class="bg-info p-3 fs-5 text-center fw-bolder">Tidak ada proyek. Silahkan tambahkan proyek </td>
                </tr>
            <?php } else { foreach($data_proyek_ti as $key => $value) {?>
                <tr>
                    <td class="p-4"><?= $key+1 ?></td>
                    <td class="p-4"><?= $value["nama_proyek"] ?></td>
                    <td class="p-4"><?= $value["jenis_proyek"] ?></td>
                    <td class="p-3">
                        <a data-bs-toggle="modal" onclick="setDelete(this)" class="m-3 text-decoration-none delete <?= rand(000,999).$value["id_proyek"]." ".str_replace(" ","_",$value["nama_proyek"]) ?>" data-bs-target="#exampleModal">
                            <img width="26" height="26" src="./styles/icons/trash-fill.svg">
                        </a>
                        <a data-bs-toggle="modal" onclick="setUpdate('<?= str_replace(' ','_',$value['nama_proyek']) ?>')" class="m-3 text-decoration-none" data-bs-target="#exampleModal">
                            <img width="26" height="26" src="./styles/icons/pencil-fill.svg">
                        </a>
                    </td>
                    <td class="d-none <?= str_replace(" ","_",$value["nama_proyek"])." ".rand(000,999).$value["id_proyek"] ?>"><?= json_encode(["nama_proyek"=>$value["nama_proyek"],"jenis_proyek"=>$value["jenis_proyek"]]) ?></td>
                </tr>
            <?php }} ?>
            </tbody>
        </table>
    </div>

    <script src="script.js"></script>

    <script src="./styles/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    
</body>
</html>
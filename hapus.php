<?php
    // session_start();
    require_once "./dbhelper.php";

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $data = selectquerysql("SELECT * FROM user WHERE id=$id")[0];
        if (deletedata($id) > 0) {
            $filename = end(explode("/", $data["gambar"]));
            deleteFileOnBucket($filename);
            // setMessage("Delete Berhasil", "data id $id berhasil di delete", "success");
            echo "<script>
                alert('Data berhasil dihapus');
                document.location.href = './';
            </script>";
        } else {
            // setMessage("Delete gagal", "Terjadi kesalahan query dan id", "danger");
            echo "<script>
                alert('Data gagal dihapus');
                document.location.href = './';
            </script>";
        }
    } 
    else {
        header("Location: ./");
    }

?>
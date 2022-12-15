<?php
    session_start();
    try {
        $conn = mysqli_connect("db", "root", "root", "uas_awan");
    } catch (Exception $th) {
        echo $th;
    }
    $tabledb = "user";

    function selectquerysql($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $tampungdatabase = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $tampungdatabase[] = $row;
        }
        return $tampungdatabase;
    }

    function insertdata($data){
        global $conn, $tabledb;

        $nama = htmlspecialchars($data["nama"]);
        $deskripsi = htmlspecialchars($data["deskripsi"]);

        $namafiles = $_FILES["gambar"]["name"];
        $tmpfiles = $_FILES["gambar"]["tmp_name"];

        $gambar = uploadFileOnBucket($namafiles, $tmpfiles);

        $query = "INSERT INTO $tabledb VALUES
            (NULL, '$nama', '$deskripsi', '$gambar')
        ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function deletedata($id)
    {
        global $conn, $tabledb;

        $query = "DELETE FROM $tabledb WHERE id=$id";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }


    require_once "./vendor/autoload.php";

    use Google\Cloud\Storage\StorageClient;

    $bucketName = "uts-komputasi-awan";

    function connectStorageBucket(){
        return new StorageClient([
            'keyFilePath' => 'credential.json',
        ]);
    }
    
    function createStorageBucket()
        {
            global $bucketName;
            try {
                $storage = connectStorageBucket();
            
                $bucket = $storage->bucket($bucketName);
                if (!$bucket->exists()) {
                    $storage->createBucket($bucketName);
                    echo "Your Bucket $bucketName is created successfully.";
                } 
                else {
                    echo "Your Bucket $bucketName already exist.";
                }
                
                $info = $bucket->info();
                print_r($info);  
                return $bucketName;
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
    
    function uploadFileOnBucket($namafiles, $tmpfiles){
        global $bucketName;

        $arraygambar = explode('.', $namafiles);
        $ekstensigambar = strtolower(end($arraygambar));

        $namafiles = uniqid() . "." . $ekstensigambar;

        try {
            $status = move_uploaded_file($tmpfiles, "tmp/" . $namafiles);
        } catch (Exception $e) {
            echo $e;
        }

        try {
            $storage = connectStorageBucket();
            $bucket = $storage->bucket($bucketName);
            $object = $bucket->upload(
                fopen('tmp/' . $namafiles, 'r'),
                [
                    'predefinedAcl' => 'publicRead'
                ]
            );

            unlink("tmp/" . $namafiles);
            $namafiles = "https://storage.googleapis.com/$bucketName/$namafiles";
            
            return $namafiles;
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    
    function deleteFileOnBucket($fileName){
        global $bucketName;
        try {
            $storage = connectStorageBucket();
        
            $bucket = $storage->bucket($bucketName);
            $object = $bucket->object($fileName);
        
            $object->delete();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    function setMessage($pesan, $sebab, $tipe, $untuk = null){
        $_SESSION["flash"]["pesan"] = $pesan;
        $_SESSION["flash"]["sebab"] = $sebab;
        $_SESSION["flash"]["tipe"] = $tipe;
        if ($untuk != null) {
            $_SESSION["flash"]["untuk"] = $untuk;
        }
    }
    
    function printAlertQuery(){
        if ( isset($_SESSION["flash"]) ){
            $color = "";
            if ($_SESSION["flash"]["tipe"] === "danger") {
                $color = "red";
            } else {
                $color = "green";
            }
            $alert = '<div class="p-4 mb-4 text-sm text-' . $color . '-700 bg-' . $color . '-200 rounded-lg role="alert">
                <span class="font-medium">' . $_SESSION["flash"]["pesan"] . '</span>' . $_SESSION["flash"]["sebab"] . '.
            </div>';
            unset($_SESSION["flash"]);
            echo $alert;
            return true;
        }
    }
    
    function printErrorInput(){
        if ( isset($_SESSION["flash"]) ){  
            if ($_SESSION["flash"]["untuk"] === "input") {
                $color = "";
                if ($_SESSION["flash"]["tipe"] === "danger") {
                    $color = "red";
                } else {
                    $color = "green";
                }

                $alert = '<p style="color: ' . $color . ';" class="mt-2 text-sm text-' . $color . '-500">' . $_SESSION["flash"]["pesan"] . ', ' .  $_SESSION["flash"]["sebab"] . '</p>';
                unset($_SESSION["flash"]);
                echo $alert;
                return true;
            }

        }
    }
?>
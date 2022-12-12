<?php 
    // session_start();
    require_once "./dbhelper.php";
    
    if ( isset($_POST["submit"])) {
        if( insertdata($_POST) > 0){
            // setMessage("Insert Berhasil", "data berhasil di tambahkan", "success");
            echo "<script       >
                alert('Data berhasil ditambahkan');
                document.location.href = './';
            </script>";
        } else {
            // setMessage("Insert gagal", "Terjadi kesalahan query dan id", "danger");
            echo "<script>
                alert('Data gagal ditambahkan');
                document.location.href = './';
            </script>";
        }   
    }

    $data = selectquerysql("SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Home</title>
        <link rel="stylesheet" href="dist/output.css" />
    </head>
    <body class="bg-slate-200 p-2.5">
        <div class="text-2xl text-center mb-2.5">
            <span>TI-3F Meme</p>
        </div>
        <!-- Modal toggle -->
        <button
            class="block mx-auto mb-5 text-white bg-indigo-600 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center"
            type="button"
            data-modal-toggle="defaultModal"
        >
            Add Image
        </button>

        <!-- Main modal -->
        <div
            id="defaultModal"
            tabindex="-1"
            aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center"
        >
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <form action="" method="POST" enctype="multipart/form-data" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600"
                    >
                        <h3
                            class="text-xl font-semibold text-gray-900 dark:text-white"
                        >
                            Upload Foto
                        </h3>
                        <button
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="defaultModal"
                        >
                            <svg
                                aria-hidden="true"
                                class="w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="mt-5 md:col-span-2 md:mt-0">
                            <div>
                                <div
                                    class="shadow sm:overflow-hidden sm:rounded-md"
                                >
                                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                        <div>
                                            <label for="company-website" class="block text-sm font-medium text-gray-700">Nama</label>
                                            <input type="text" name="nama" id="company-website" class="block w-full flex-1  mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Asep" required autofocus autocomplete="off">
                                        </div>
                                        <div>
                                            <label for="about" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                                <div class="mt-1">
                                                    <textarea id="about" name="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Lagi turu" required autocomplete="off"></textarea>
                                                </div>
                                        </div>
                                        <div>
                                            <div
                                                class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6"
                                            >
                                                <div
                                                    class="space-y-1 text-center"
                                                >
                                                    <svg
                                                        class="mx-auto h-12 w-12 text-gray-400"
                                                        stroke="currentColor"
                                                        fill="none"
                                                        viewBox="0 0 48 48"
                                                        aria-hidden="true"
                                                    >
                                                        <path
                                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                        />
                                                    </svg>
                                                    <div
                                                        class="flex text-sm text-gray-600"
                                                    >
                                                        <label
                                                            for="file-upload"
                                                            class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500"
                                                        >
                                                            <span
                                                                >Upload a
                                                                file</span
                                                            >
                                                            <input
                                                                id="file-upload"
                                                                name="gambar"
                                                                type="file"
                                                                class="sr-only"
                                                                accept="image/*"
                                                                required
                                                            />
                                                        </label>
                                                        <p class="pl-1">
                                                            or drag and drop
                                                        </p>
                                                    </div>
                                                    <p
                                                        class="text-xs text-gray-500"
                                                    >
                                                        PNG, JPG, GIF up to 2MB
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600"
                    >
                        <button
                            type="submit"
                            name="submit"
                            class="text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-indigo-600 dark:focus:ring-blue-800"
                        >
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php // printAlertQuery() ?>

        <?php if ($data) : ?>
            <!-- Table -->
            <div class="overflow-x-auto w-full">
                <table class="table w-full border border-solid border-b-slate-500">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomer = 1 ?>
                        <?php foreach ($data as $datasatuan) : ?>
                            <tr class="space-x-1">
                                <td class="text-center"><?= $nomer++ ?></td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-3">
                                        <a class="avatar" href="<?= $datasatuan["gambar"] ?>" target="_blank">
                                            <div
                                                class="flex overflow-hidden border h-12 w-12 md:h-16 md:w-16 lg:h-28 lg:w-28 rounded-full border-solid border-indigo-600"
                                            >
                                                <img
                                                    class="rounded-full h-full w-full object-cover"
                                                    src="<?= $datasatuan["gambar"] ?>"
                                                    alt="Avatar"
                                                />
                                            </div>
                                        </a>
                                        <div>
                                            <div
                                                class="lg:text-xl md:font-bold md:text-base text-sm font-normal"
                                            >
                                                <?= $datasatuan["nama"] ?>
                                            </div>
                                            <div class="text-xs opacity-50">TI-3F</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-xs md:text-base"><?= $datasatuan["deskripsi"] ?></td>
                                <th class="text-center">
                                    <a
                                        href="<?= $datasatuan["gambar"] ?>" target="_blank"
                                        class="btn block md:inline-block bg-blue-500 hover:bg-blue-700 btn-xs text-sm text-white px-2 py-1 rounded-md mb-2 md:mb-0"
                                    >
                                        detail
                                    </a>
                                    <a
                                        href="./hapus.php?id=<?= $datasatuan["id"] ?>"
                                        class="btn block md:inline-block bg-red-500 hover:bg-red-700 btn-xs text-sm text-white px-2 py-1 rounded-md"
                                        onclick="return confirm('Konfirmasi hapus ?');"
                                    >
                                        hapus
                                    </a>
                                </th>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center mb-2.5">
                <p class="text-xl font-bold">Tidak ada Data</p>
            </div>
        <?php endif ?>
        <script src="./node_modules/flowbite/dist/flowbite.js"></script>
    </body>
</html>

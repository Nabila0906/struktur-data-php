<?php

// Mengambil data array dari cookie
if (isset($_COOKIE['data_array'])) {
    $array = json_decode($_COOKIE['data_array'], true);

    if (!is_array($array)) {
        $array = ["Apel", "Mangga", "Jeruk"];
    }
} else {
    $array = ["Apel", "Mangga", "Jeruk"];
}

// Menambahkan data
if (isset($_POST['tambah'])) {
    $data = trim($_POST['data']);

    if ($data != "") {
        $array[] = $data;

        setcookie(
            "data_array",
            json_encode($array),
            time() + (86400 * 30),
            "/"
        );

        header("Location: array.php");
        exit;
    }
}

// Menghapus data
if (isset($_POST['hapus'])) {
    $index = $_POST['index'];

    if (isset($array[$index])) {
        array_splice($array, $index, 1);

        setcookie(
            "data_array",
            json_encode($array),
            time() + (86400 * 30),
            "/"
        );

        header("Location: array.php");
        exit;
    }
}

// Reset data
if (isset($_POST['reset'])) {
    setcookie(
        "data_array",
        "",
        time() - 3600,
        "/"
    );

    header("Location: array.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Linear Array</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
        }

        .menu {
            text-align: center;
            margin-bottom: 25px;
        }

        .menu a {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        form {
            margin: 15px 0;
        }

        input {
            padding: 10px;
            width: 60%;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .tambah {
            background-color: #28a745;
            color: white;
        }

        .reset,
        .hapus {
            background-color: #dc3545;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #e9ecef;
        }

        .array-box {
            margin-top: 20px;
            padding: 15px;
            background-color: #f1f3f5;
            border-radius: 8px;
            font-size: 18px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Linear Array</h1>

    <div class="menu">
        <a href="array.php">Linear Array</a>
        <a href="linkedlist.php">Linked List</a>
        <a href="stack.php">Stack</a>
    </div>

    <h3>Tambah Data</h3>

    <form method="POST">
        <input
            type="text"
            name="data"
            placeholder="Masukkan data"
        >

        <button
            type="submit"
            name="tambah"
            class="tambah"
        >
            Tambah
        </button>
    </form>

    <form method="POST">

        <button
            type="submit"
            name="reset"
            class="reset"
        >
            Reset Semua Data
        </button>

    </form>

    <h3>Isi Linear Array</h3>

    <div class="array-box">

        <?php
        if (empty($array)) {
            echo "Array masih kosong.";
        } else {
            echo "[ " . implode(" , ", $array) . " ]";
        }
        ?>

    </div>

    <table>

        <tr>
            <th>Index</th>
            <th>Data</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($array as $index => $data): ?>

        <tr>

            <td>
                <?= $index ?>
            </td>

            <td>
                <?= htmlspecialchars($data) ?>
            </td>

            <td>

                <form method="POST">

                    <input
                        type="hidden"
                        name="index"
                        value="<?= $index ?>"
                    >

                    <button
                        type="submit"
                        name="hapus"
                        class="hapus"
                    >
                        Hapus
                    </button>

                </form>

            </td>

        </tr>

        <?php endforeach; ?>

    </table>

</div>

</body>
</html>
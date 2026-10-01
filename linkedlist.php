<?php

// Class Node untuk Linked List
class Node
{
    public $data;
    public $next;

    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}

// Mengambil data dari cookie
if (isset($_COOKIE['linked_list'])) {
    $dataList = json_decode($_COOKIE['linked_list'], true);

    if (!is_array($dataList)) {
        $dataList = ["Node A", "Node B", "Node C"];
    }
} else {
    $dataList = ["Node A", "Node B", "Node C"];
}

// Membuat Linked List
$head = null;
$tail = null;

foreach ($dataList as $data) {

    $newNode = new Node($data);

    if ($head === null) {
        $head = $newNode;
        $tail = $newNode;
    } else {
        $tail->next = $newNode;
        $tail = $newNode;
    }
}

// Menambahkan node
if (isset($_POST['tambah'])) {

    $data = trim($_POST['data']);

    if ($data != "") {

        $dataList[] = $data;

        setcookie(
            "linked_list",
            json_encode($dataList),
            time() + (86400 * 30),
            "/"
        );

        header("Location: linkedlist.php");
        exit;
    }
}

// Menghapus node
if (isset($_POST['hapus'])) {

    $index = $_POST['index'];

    if (isset($dataList[$index])) {

        array_splice($dataList, $index, 1);

        setcookie(
            "linked_list",
            json_encode($dataList),
            time() + (86400 * 30),
            "/"
        );

        header("Location: linkedlist.php");
        exit;
    }
}

// Reset
if (isset($_POST['reset'])) {

    setcookie(
        "linked_list",
        "",
        time() - 3600,
        "/"
    );

    header("Location: linkedlist.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Linked List</title>

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

        .linked-list {
            margin-top: 25px;
            padding: 20px;
            background-color: #f1f3f5;
            border-radius: 8px;
            text-align: center;
            overflow-x: auto;
        }

        .node {
            display: inline-block;
            padding: 15px;
            margin: 5px;
            background-color: #ffffff;
            border: 2px solid #333;
            border-radius: 8px;
        }

        .arrow {
            font-size: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
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

    </style>

</head>

<body>

<div class="container">

    <h1>Linked List</h1>

    <div class="menu">

        <a href="array.php">
            Linear Array
        </a>

        <a href="linkedlist.php">
            Linked List
        </a>

        <a href="stack.php">
            Stack
        </a>

    </div>

    <h3>Tambah Node</h3>

    <form method="POST">

        <input
            type="text"
            name="data"
            placeholder="Masukkan data node"
        >

        <button
            type="submit"
            name="tambah"
            class="tambah"
        >
            Tambah Node
        </button>

    </form>

    <form method="POST">

        <button
            type="submit"
            name="reset"
            class="reset"
        >
            Reset Semua Node
        </button>

    </form>

    <h3>Visualisasi Linked List</h3>

    <div class="linked-list">

        <?php

        if ($head === null) {

            echo "Linked List masih kosong.";

        } else {

            $current = $head;

            while ($current !== null) {

                echo '<span class="node">';
                echo htmlspecialchars($current->data);
                echo '</span>';

                if ($current->next !== null) {
                    echo '<span class="arrow"> → </span>';
                }

                $current = $current->next;
            }

            echo '<span class="arrow"> → NULL</span>';
        }

        ?>

    </div>

    <h3>Data Node</h3>

    <table>

        <tr>
            <th>Posisi</th>
            <th>Data</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($dataList as $index => $data): ?>

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
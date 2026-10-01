<?php

// Mengambil data stack dari cookie
if (isset($_COOKIE['stack_data'])) {
    $stack = json_decode($_COOKIE['stack_data'], true);

    if (!is_array($stack)) {
        $stack = ["Buku", "Pensil", "Pulpen"];
    }
} else {
    $stack = ["Buku", "Pensil", "Pulpen"];
}

// PUSH - menambahkan data ke TOP
if (isset($_POST['push'])) {

    $data = trim($_POST['data']);

    if ($data != "") {

        $stack[] = $data;

        setcookie(
            "stack_data",
            json_encode($stack),
            time() + (86400 * 30),
            "/"
        );

        header("Location: stack.php");
        exit;
    }
}

// POP - mengambil data paling atas
if (isset($_POST['pop'])) {

    if (!empty($stack)) {

        array_pop($stack);

        setcookie(
            "stack_data",
            json_encode($stack),
            time() + (86400 * 30),
            "/"
        );

        header("Location: stack.php");
        exit;
    }
}

// Reset stack
if (isset($_POST['reset'])) {

    setcookie(
        "stack_data",
        "",
        time() - 3600,
        "/"
    );

    header("Location: stack.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Stack</title>

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

        .push {
            background-color: #28a745;
            color: white;
        }

        .pop {
            background-color: #ff9800;
            color: white;
        }

        .reset {
            background-color: #dc3545;
            color: white;
        }

        .stack-box {
            margin: 25px auto;
            width: 250px;
            min-height: 300px;
            border: 3px solid #333;
            border-top: none;
            display: flex;
            flex-direction: column-reverse;
            justify-content: flex-start;
        }

        .item {
            padding: 18px;
            border-top: 2px solid #333;
            background-color: #f1f3f5;
            text-align: center;
            font-weight: bold;
        }

        .top {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }

        .empty {
            text-align: center;
            padding: 30px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Stack</h1>

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

    <h3>Push Data</h3>

    <form method="POST">

        <input
            type="text"
            name="data"
            placeholder="Masukkan data"
        >

        <button
            type="submit"
            name="push"
            class="push"
        >
            PUSH
        </button>

    </form>

    <form method="POST">

        <button
            type="submit"
            name="pop"
            class="pop"
        >
            POP
        </button>

    </form>

    <form method="POST">

        <button
            type="submit"
            name="reset"
            class="reset"
        >
            Reset Stack
        </button>

    </form>

    <div class="top">

        <?php

        if (!empty($stack)) {
            echo "TOP → " . htmlspecialchars(end($stack));
        } else {
            echo "STACK KOSONG";
        }

        ?>

    </div>

    <div class="stack-box">

        <?php

        if (empty($stack)) {

            echo '<div class="empty">Stack kosong</div>';

        } else {

            foreach ($stack as $data) {

                echo '<div class="item">';
                echo htmlspecialchars($data);
                echo '</div>';

            }

        }

        ?>

    </div>

    <p style="text-align:center;">
        Stack menggunakan prinsip
        <strong>LIFO</strong>
        (<i>Last In, First Out</i>).
    </p>

</div>

</body>
</html>
<?php
class Book {
    private $code_book;
    private $name;
    private $qty;

    // Setter dalam constructor
    public function __construct($code_book, $name, $qty) {
        $this->setCodeBook($code_book);
        $this->name = $name;
        $this->setQty($qty);
    }

    private function setCodeBook($code_book) {
        if (preg_match('/^[A-Z]{2}[0-9]{2}$/', $code_book)) {
            $this->code_book = $code_book;
        } else {
            echo "<p class='error'>Error: Format code_book tidak valid. Gunakan format 'BB00'.</p>";
        }
    }

    private function setQty($qty) {
        if (is_numeric($qty) && (int)$qty > 0 && $qty == (int)$qty) {
            $this->qty = (int)$qty;
        } else {
            echo "<p class='error'>Error: qty harus berupa bilangan bulat positif lebih dari 0.</p>";
        }
    }

    // Getter
    public function getCodeBook() {
        return $this->code_book;
    }

    public function getName() {
        return $this->name;
    }

    public function getQty() {
        return $this->qty;
    }
}

// Inisialisasi variabel hasil jika form disubmit
$result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code_book = strtoupper(trim($_POST['code_book']));
    $name = trim($_POST['name']);
    $qty = $_POST['qty'];

    ob_start(); // Tampung output error dari class
    $book = new Book($code_book, $name, $qty);
    $errors = ob_get_clean();

    if (!$errors) {
        $result = "<div class='result'>
            <h3>Data Buku Berhasil Ditambahkan</h3>
            <p><strong>Kode Buku:</strong> {$book->getCodeBook()}</p>
            <p><strong>Nama Buku:</strong> {$book->getName()}</p>
            <p><strong>Jumlah:</strong> {$book->getQty()}</p>
        </div>";
    } else {
        $result = $errors;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Buku</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            padding: 30px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        label {
            display: block;
            margin-top: 15px;
            color: #444;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        input[type="submit"] {
            margin-top: 25px;
            background-color: #28a745;
            border: none;
            color: white;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .error {
            background-color: #f8d7da;
            padding: 10px;
            margin-top: 15px;
            border: 1px solid #f5c6cb;
            color: #721c24;
            border-radius: 5px;
        }
        .result {
            margin-top: 25px;
            background-color: #e2f0d9;
            border: 1px solid #c3e6cb;
            padding: 15px;
            border-radius: 8px;
            color: #155724;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Input Data Buku</h2>
    <form method="POST">
        <label for="code_book">Kode Buku (format BB00):</label>
        <input type="text" id="code_book" name="code_book" required maxlength="4">

        <label for="name">Nama Buku:</label>
        <input type="text" id="name" name="name" required>

        <label for="qty">Jumlah:</label>
        <input type="number" id="qty" name="qty" required>

        <input type="submit" value="Simpan Buku">
    </form>

    <?php echo $result; ?>
</div>

</body>
</html>

<?php
    require("db.php");
    if(!isset($_GET["id"])) {
        echo "<script>
            alert('not chosen item');
            location.href = 'index.php';
        </script>";
        exit();
    }
    $id = $_GET["id"];

    $item = $db->query("SELECT * FROM items WHERE id=$id")->fetchAll(2);

    if(count($item)>0){
        $item = $item[0];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content="width-device-width, initial scale=1.0">
    <title>Product-page</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body class = "single">
    <header>
        <a href = "index.php">Back</a>
    </header>

    <main>
        <section class = "info">
            <img src="<?php echo $item['photo']?>" alt = "item" width = "700">>
            <h1><?php echo $item['name']?></h1>
            <p><?php echo $item['description']?></p>
        </section>

        <section class = "buy">
            <div class = "amount">
                <button>+</button>
                <span>1</span>
                <button>-</button>
            </div>
            <h2>$<?php echo $item['price']?></h2>
        </section>
    </main>
</body>
</html>
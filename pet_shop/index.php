<?php
require("db.php");
$categories = $db->query("SELECT * FROM categories")->fetchAll(2);
$items = $db->query("SELECT * FROM items")->fetchAll(2);

if(isset($_GET['category'])){
    $id = $_GET['category'];
    $items = $db->query("SELECT * FROM items WHERE category=$id")->fetchAll(2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content="width-device-width, initial scale=1.0">
    <title>Shop</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
    <header><h1>Petshop</h1></header>
    <a href="admin.php">Admin panel</a>
    <br>

    <main>
        <section class = "filters">
            <?php foreach($categories as $item):?>
                <a href="?category=<?php echo $item['id']; ?>">
                    <?php echo $item["name"];?>
                </a>
            <?php endforeach; ?>

            </form>
        </section>

        <section class = "container">
            <h2>Popular items</h2>
            <?php foreach($items as $item): ?>

            <div class = "item">
                <img src = "<?php echo $item['photo']?>" alt = "photo" width = "100">
                <h3><?php echo $item['name']; ?></h3>
                <p>$<?php echo $item['price'];?></p>
                <a class = "button" href = "single.php?id=<?php echo $item['category'];?>">More</a>
            </div>
            <?php endforeach;?>
        </section>
    </main>
</body>
</html>
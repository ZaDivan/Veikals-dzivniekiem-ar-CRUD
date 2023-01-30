<?php
require("db.php");

if(!empty($_GET)) {
    if(isset($_GET["delete_cat"])){
        $id = $_GET['id'];

        if($db->query("DELETE FROM categories WHERE id=$id")){
            echo "<script>
                alert('Veiksmigi izrakstits')
                location.href = 'admin.php';
            </script>";
            exit();
        } else {
            var_dump($db-error_log());
        }

    }
    if(isset($_GET["delete_item"])){
        $id = $_GET['id'];

        if($db->query("DELETE FROM items WHERE id=$id")){
            echo "<script>
                alert('Veiksmigi izrakstits')
                location.href = 'admin.php';
            </script>";
            exit();
        } else {
            var_dump($db-error_log());
        }

    }


    if(isset($_GET["new_cat"])){
        $name = $_GET["new_cat"];
        if($db->query("INSERT INTO categories (name) VALUES ('$name') ")){
            echo "<script>
                alert('Veiksmigi pievienots')
                location.href = 'admin.php';
            </script>";
        } else {
            var_dump($db-error_log());
        }
    }

    if(isset($_GET["new_item_name"])){
        $name = $_GET["new_item_name"];
        $photo = $_GET['photo'];
        $description = $_GET['description'];
        $price = $_GET['price'];
        $category = $_GET['category'];
        if($db->query("INSERT INTO items (name, photo, description, price, category) VALUES ('$name', '$photo', '$description', $price, '$category') ")){
            echo "<script>
                alert('Veiksmigi pievienots')
                location.href = 'admin.php';
            </script>";
        } else {
            var_dump($db-error_log());
        }
    }

    if(isset($_GET["cat_name"])){
        $name = $_GET["cat_name"];
        $id = $_GET["id"];

        if($db->query("UPDATE categories SET name='$name' WHERE id=$id")){
            echo "<script>
                alert('Veiksmigi izmainits')
                location.href = 'admin.php';
            </script>";
        } else {
            var_dump($db-error_log());
        }
    }
    if(isset($_GET["item_name"])){
        $name = $_GET["item_name"];
        $photo = $_GET['photo'];
        $description = $_GET['description'];
        $price = $_GET['price'];
        $category = $_GET['category'];
        $id = $_GET['id'];
        if($db->query("UPDATE items SET name='$name', photo='$photo',
        description='$description', price='$price', category='$category' WHERE id=$id")){
            echo "<script>
                alert('Veiksmigi izmainits')
                location.href = 'admin.php';
            </script>";
        } else {
            var_dump($db-error_log());
        }
    }
}


$categories = $db->query("SELECT * FROM categories")->fetchAll(2);
$items = $db->query("SELECT * FROM items")->fetchAll(2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content="width-device-width, initial scale=1.0">
    <title>Admin</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
    <h1>Admin panel</h1>
    <header>
        <a href = "index.php">Back</a>
    </header>

    <main>
        <section class = "categories">
            <h2>Categories</h2>

            <div class = "container"
                <form action="#" class="item">
                    <label>
                        Nosaukums
                        <input type="text" required name="new_cat">
                    </label>
                    <button>Add</button>
                </form>

            <?php foreach ($categories as $item):?>
                <form action="#" class="item">
                    <label>Nosaukums
                    <input type="text" name="cat_name" value="<?php echo $item['name']?>">
                    <input type="hidden" name="id" value="<?php echo $item['id']?>">
                    </label>
                    <button>Update</button>
                    <button name="delete_cat">Delete</button>
                </form>
            <?php endforeach;?>
            </div>
        </section>

        <section class = "items">
            <h2>Products</h2>

            <div class = "container">
                <form action="#" class="item">
                    <label>
                        Nosaukums
                        <input type="text" required name="new_item_name"></label>
                    <label>
                        Foto
                        <input type="text" required name="photo" ></label>
                    <label>
                        Apraksts
                        <textarea type="text" required name="description"></textarea></label>
                    <label>
                        Cena
                        <input type="number" required min="0" name="price" ></label>

                    <label>
                        Kategorija
                        <select name="category" id="">
                            <?php foreach($categories as $cat): ?>
                                <option value="<?php echo $cat['id'];?>">
                                    <?php echo $cat['name'] ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </label>

                    <button>Add</button>
                </form>


                 <?php foreach ($items as $item):?>
                    <form action="#" class="item">
                        <img src="<?php echo $item['photo'];?>" alt="photo" width="100" height="100">
                        <label>
                            Nosaukums
                            <input type="text" name="item_name" value="<?php echo $item['name']?>"></label>
                        <label>
                            Foto
                            <input type="text" name="photo" value="<?php echo $item['photo']?>"></label>
                        <label>
                            Apraksts
                            <textarea type="text" name="description"><?php echo $item['description']?></textarea></label>
                        <label>
                            Cena
                            <input type="number" min="0" name="price" value="<?php echo $item['price']?>"></label>

                        <label>
                            Kategorija
                        <select name="category" id="">
                            <?php foreach($categories as $cat): ?>
                                <option <?php if($item['category'] == $cat['id']) echo 'selected';  ?> value="<?php echo $cat['id'];?>">
                                    <?php echo $cat['name'] ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                        </label>

                        <input type = "hidden" name="id" value="<?php echo $item['id']; ?>">

                        <button>Update</button>
                        <button name="delete_item">Delete</button>
                    </form>
                    <?php endforeach;?>
            </div>
        </section>
    </main>
</body>
</html>
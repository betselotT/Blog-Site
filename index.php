<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $blog = isset($_POST['blog']) ? $_POST['blog'] : '';

    $newBlogEntry = [
        'id' => $id,
        'name' => $name,
        'blog' => $blog,
    ];

    $jsonData = file_exists('blogs.json') ? file_get_contents('blogs.json') : '[]';

    $blogs = json_decode($jsonData, true);

    $blogs[] = $newBlogEntry;

    $jsonUpdated = json_encode($blogs, JSON_PRETTY_PRINT);

    file_put_contents('blogs.json', $jsonUpdated);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blog Website</title>
	<link rel="stylesheet" href="style.css">
    <style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    background-color: lightgrey;
}

.container{
    width: 100%;
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.mini-container{
    border: 2px solid black;
    border-radius: 15px;
    padding: 15px;
    box-shadow: 5px 5px 20px rgba(0,0,0,0.7);
}

h2, h3{
    padding-bottom: 15px;
    text-align: center;
}

.forms label{
    padding-bottom: 15px;
}

.forms input{
    padding-bottom: 20px;
    border-radius: 5px;
    margin-bottom: 10px;
}

.blog{
    width: 200px;
    height: 150px;
}

.button{
    margin-left: 150px;
    padding-bottom: 0px !important;
    margin-bottom: 0px !important;
    padding: 5px;
    background-color: yellow;
    font-weight: 500;
    cursor: pointer;
}

.blogItem{
    padding-left: 15px;
}

.blogItem h2{
    font-size: 20px;
    text-align: left;
}

.blogItem p{
    font-size: 16px;
    text-align: left;
}

h1{
    text-align: left;
    padding-left: 15px;
    padding-bottom: 15px;
}
    </style>
</head>
<body>
	<div class="container">
        <div class="mini-container">
		    <h2>Blog Website</h2>
		            <h3>Create A New Blog</h3>
                        <form class="forms" action="index.php" method="post">
                            <label for="">Enter your user ID here</label>
                            <input type="text" name="id">
                            <br>
                            <label for="">Enter your name here</label>
                            <input type="text" name="name">
                            <br>
                            <label for="">Enter your blog here</label>
                            <input class="blog" type="text" name="blog">
                            <br>
                            <input class="button" type="submit" name="submit">
                        </form>
        </div>
        <div id="blogList" ></div>
    </div>
    <h1>Recent Blogs:</h1>

<?php
$jsonData = file_get_contents('blogs.json');

$blogs = json_decode($jsonData, true);

if ($blogs !== null) {
    foreach ($blogs as $blog) {
        echo '<div class="blogItem">';
        echo '<p>' . htmlspecialchars($blog['id']) . '</p>';
        echo '<h2>' . htmlspecialchars($blog['name']) . '</h2>';
        echo '<p>' . htmlspecialchars($blog['blog']) . '</p>';
        echo '</div>';
    }
} else {
    echo 'Error decoding JSON';
}
?>
</body>
</html>

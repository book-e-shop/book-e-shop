<?php
$title = "Рецензии";
require 'db.php';
require 'libs/Parsedown.php';
require 'toc_generator.php';
include getcwd() . "/header.php";
?>


<?php
$review_id = $_SERVER['QUERY_STRING'];
$review = mysqli_query($connect, "SELECT * FROM `reviews` WHERE `id` = '$review_id'");
$review = mysqli_fetch_assoc($review);
mysqli_close($connect);
$Parsedown = new Parsedown();
$text =  $Parsedown->text($review["review"]);


$text = set_id($text);
?>

<div id="h-review" hidden><?php echo $review["review"]; ?></div>
<div class="container body-content">
    <div class="row">
        <div class="col">
            <h1>
                <?php echo $review["title"]; ?>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <i><?php echo $review["author"] . ', ' . $review["publish_date"]; ?></i>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <?php generate_toc($text)
            ?>
        </div>
    </div>


    <div class="row">
        <div id="review" class="col">
            <?php
            echo $text;
            ?>
        </div>
    </div>
</div>



<?php
include getcwd() . "/footer.php";
?>
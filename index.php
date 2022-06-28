
<?php
include("header.php");
require("cp/connect.php");
?>

<?php

$sql= "select * from products where CID=7";
$q=$con->prepare($sql);
$q->execute();
if($q->rowcount())
{
    $rows= $q->fetchall();
    foreach($rows as $row)
    {
        $id =$row["ID"];
        $namepr =$row["NameProducts"];
        $numberpr =$row["NumberProducts"];
        $pricepr =$row["PriceProducts"];
        $imgpr =$row["ImageProducts"];


        echo "
        <section>

        </section>
        
        <section>
        <article>
        <h2>$namepr</h2>
                <img src='images/".$imgpr."'>
                <p><br>$numberpr</p>
                <p><i>$pricepr</i></p>
                <button class='btn'>اضف إلى السله </button>
        </article>
        </section>

        ";


    }
}

?>


<!--
    <section>

    </section>
    <section>
        <article>
        <h2>leader and mr chic on white1</h2>
                <a href='images/leader_and_mr_chic_on_white_1_.png'><img src='images/leader_and_mr_chic_on_white_1_.png'></a>
                <p><br> عطر الزعيم والسيد</p>
                <p><i>250 ر . س</i></p>
                <button class="btn">اضف إلى السله </button>

        </article>

        <article>
        <h2>blue box closed2</h2>
                <a href='images/blue_box_closed_2_.jpg'><img src='images/blue_box_closed_2_.jpg'></a>
                <p> <br> عطر الصندوق الأزرق المغلق </p>
                <p><i>260 ر . س</i></p>
                <button class="btn">اضف إلى السله </button>
        </article>

        <article>

        <h2>Musk</h2>
                <a href='images/new_project_4__1.png'><img src='images/new_project_4__1.png'></a>
                <p> <br> عطر المسك الجديد كليا </p>
                <p><i>240 ر . س</i></p>
                <button class="btn">اضف إلى السله </button>

        </article>
    </section>
    
    <div class="bb"> 
    <a href="images/musk_collection_1600x800_-_web_banner_1__1.jpg"><img src="images/musk_collection_1600x800_-_web_banner_1__1.jpg"></a>
    </div>

    <section>
        <article>
        <h2>Oud orintel 010</h2>
                <a href='images/intense_oud_website.jpg'><img src='images/intense_oud_website.jpg'></a>
                <p> <br> عطر عود اورينتل نسائي</p>
                <p><i>119 ر . س</i></p>
                <button class="btn">اضف إلى السله </button>
        </article>

        <article>

        <h2>Oud orintel 011</h2>
                <a href='images/intense_rose.jpg'><img src='images/intense_rose.jpg'></a>
                <p> <br> عطر عود اورينتل رجالي</p>
                <p><i>119 ر . س</i></p>
                <button class="btn">اضف إلى السله </button>
            
        </article>

        <article>
        <h2>Oud orintel 012</h2>
                <a href='images/intense_rose_free_100_50.png'><img src='images/intense_rose_free_100_50.png'></a>
                <p> <br> عطرين عود اورينتل </p>
                <p><i>130 ر . س</i></p>
                <button class="btn">اضف إلى السله </button>
        </article>
    </section>-->
    
        <div class="clr"></div>
       <?php
		include("footer.php");
		?>
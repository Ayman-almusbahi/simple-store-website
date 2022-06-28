<?php
include("header.php");
require("cp/connect.php");
?>





<?php

$sql= "select * from products where CID=8";
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




    <!--<section>
        <section>
        </section>
        <section>
            <article>
            <h2>pure love</h2>
            <a href='images/pure_love.png'><img src='images/pure_love.png'></a>
            <p><br> عطر الحب النقي</p>
            <p><i>96.99 ر.س </i></p>
            
            <button class="btn">اضف إلى السله </button>
            </article>

            <article>
            <h2>pure love noir</h2>
            <a href='images/pure_love_noir.png'><img src='images/pure_love_noir.png'></a>

            <p><br> عطر نوير الحب النقي</p>
            <p><i>96.99 ر.س </i></p>
            <button class="btn">اضف إلى السله </button>

              
            </article>

            <article>
            <h2>pure love red copy</h2>
            <a href='images/pure_love_red_copy.jpg'><img src='images/pure_love_red_copy.jpg'></a>
            <p> <br> عطر الحب النقي النسخه الحمراء </p>
            <p><i>97.99 ر.س </i></p>
            <button class="btn">اضف إلى السله </button>
            </article>
        </section>

        <section>
            <article>

            <h2>Musk 006</h2>
            <a href='images/untitled-1_3.png'><img src='images/untitled-1_3.png'></a>
            <p><br> عطر مسك 40 ملي</p>
            <p><i>90 ر . س </i></p>
            <button class="btn">اضف إلى السله </button>
             

            </article>

            <article>
            <h2>Musk 005</h2>
            <a href='images/untitled-1_2.png'><img src='images/untitled-1_2.png'></a>

            <p><br> عطر مسك 40 ملي</p>
            <p><i>90 ر . س </i></p>
            <button class="btn">اضف إلى السله </button>

            </article>

            <article>

            <h2>Musk 001</h2>
            <a href='images/untitled-13_1.jpg'><img src='images/untitled-13_1.jpg'></a>

            <p> <br> عطر مسك 40 ملي </p>
            <p><i>90 ر . س </i></p>
            <button class="btn">اضف إلى السله </button>
                
            </article>
        </section>
-->

        <div class="clr"></div>
        <?php
        include("footer.php");
        ?>


<ul id="menu">
    <?php
        foreach($this->elements as $elt){
            $active = $elt->page == PAGE ? "class='active'":"";
            echo "<li><a href='?page=$elt->page' $active >$elt->text</a></li>";
        }
    ?>
</ul>
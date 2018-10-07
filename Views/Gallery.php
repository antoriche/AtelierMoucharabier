<div>
    <h2>Gallerie</h2>
    <table style="width: 100%;">
        <tr>
        <?php
        foreach($this->files as $i=>$file) {
            if($i%3 == 2)echo "<tr/><tr>";
            echo "<td class='gallery_img' ><div style='background-image: url(\"Gallery/$file\");' onClick='fullScreen(\"Gallery/$file\")'></div></td>";
        }
        ?>
        </tr>
    </table>
    <div id="fullScreen" onClick="fullScreen()">
        <div style="display: table-cell; vertical-align: middle;">
            <img/>
        </div>
    </div>
</div>
<script>
    function fullScreen(file){
        const element = document.getElementById("fullScreen");
        if(!file){
            element.style.display = 'none';
            return;
        }
        document.querySelector("#fullScreen img").setAttribute('src',file);
        element.style.display = 'table';
    }
</script>
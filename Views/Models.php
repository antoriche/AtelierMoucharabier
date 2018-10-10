<div>
    <h2>Commande</h2>
    <form>
        Modèle :
        <div class="imageSelector">
            <?php
                foreach($this->models as $i=>$model) {
                    echo "<img value='$model' src='Gallery/$model' />";
                }
            ?>
            <input type="hidden" name="model"/>
        </div>
    </form>
</div>

<script>
    let selectedImage = null;
    $(".imageSelector img").on("click",function(){
        $(".imageSelector img").removeClass("active");
        $(this).attr("class","active");
        selectedImage = $(this).attr("value");
        $('.imageSelector input').val(selectedImage);
    });

    function scrollHorizontally(e) {
        e = window.event || e;
        var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
        $('.imageSelector').each(function(){
            $(this)[0].scrollLeft -= (delta*60); // Multiplied by 40
            e.preventDefault();
        });
    }

    $('.imageSelector')[0].addEventListener("DOMMouseScroll", scrollHorizontally, false);
    $('.imageSelector')[0].addEventListener("mousewheel", scrollHorizontally, false);
    
</script>
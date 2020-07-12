<script>
    function search(param) {
        window.location.href = "?index.php&controller=product&action=readall&search=" + param;
    }
</script>
<section class="search__area">
    <div class="nav-trigger"></div>
    <form action="?index.php&controller=product&action=readall" method="post">
        <div class="nav-trigger"></div>
        <div class="search_box">
            <input type="search" name="search" id="search_field" class="search_field" placeholder="Find a product, brand or category">
            <span class="icon" onclick="search(document.getElementById('search_field').value)"><i class="fa fa-search"></i></span>
        </div>
    </form>
</section>

<section class="products">
    <div class="categorie-selection">
        <select class="cat_select" name="cat" id="cat_select" onchange="javascript:location.href = this.value;">
            <option value="?index.php&controller=product&action=readall&theme=all">Category : All</option>
            <?php
            if (isset($_REQUEST['theme'])) {
            }
            foreach ($tab_t as $key => $t) {
                if (isset($_REQUEST['theme']) && $_REQUEST['theme'] == $t[0]) {
                    echo "<option selected value=\"?index.php&controller=product&action=readall&theme={$t[0]}\">Category : {$t[1]}</option>";
                } else {
                    echo "<option value=\"?index.php&controller=product&action=readall&theme={$t[0]}\">Category : {$t[1]}</option>";
                }
            }
            ?>
        </select>
    </div>
    <aside class="category_side">
        <a href="?index.php&controller=product&action=readall" class="categ__itemLink">All</a>
        <?php
        foreach ($tab_t as $key => $t) {
            echo "<a href=\"?index.php&controller=product&action=readall&theme={$t[0]}\" class=\"categ__itemLink\">{$t[1]}</a>";
        }
        ?>
    </aside>
    <main class="products__list">
        <?php
        if (count($tab_p) == 0) {
            echo "<p>Vide</p>";
            return;
        }
        foreach ($tab_p as $key => $p) {
            if ($p->getStock() > 0) {
                echo "
                <a href=\"?index.php&controller=product&action=read&id={$p->getIdProduct()}\" style=\"text-decoration: none; color: black;\">
                <article class=\"card_product\">
                    <img src=\"{$p->getImgSRC()}\" alt=\"\" class=\"card_img\">
                    <div class=\"card_info\">
                        <h5 class=\"card_title\">{$p->getTitle()}</h5>
                        <h4 class=\"card_price\">{$p->getPrice()}D.T</h4>
                    </div>
                </article>
            </a>
                    ";
            }
        }
        ?>

    </main>
</section>
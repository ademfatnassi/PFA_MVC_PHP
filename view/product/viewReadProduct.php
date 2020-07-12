    <a href="./products.html" class="back_arrow"><i class="fas fa-chevron-circle-left"></i></a>

    <div class="product_item_wrap">
        <img src="<?= $p->getImgSRC() ?>" alt="hoody, donation" class="product_item_img">
        <div class="product_item_info">
            <div class="pr_item_bar"></div>
            <h2 class="product_item_title"><?= $p->getTitle() ?></h2>
            <h3 class="product_item_price"><?= $p->getPrice() ?> DT</h3>
            <h6 class="product_item_discrep"><?= $p->getDescription() ?></h6>
            <a href="?index.php&controller=product&action=addtocart&idproduct=<?= $p->getIdProduct() ?>" class="command_product_link"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to
                cart</a>
        </div>
    </div>
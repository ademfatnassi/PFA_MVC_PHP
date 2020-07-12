<?php
session_start();
// $_SESSION['panier'] = array();
?>
<div class="cart_wrap">
    <div class="cart_info">
        <div class="cart_header_wrap">
            <h2 class="cart_title">My Cart</h2>
            <?php
            // print_r($_SESSION['panier']);
            $total = 0;
            foreach ($cartList as $item) {
                $total += $item->getPrice() * array_count_values($_SESSION['panier'])[$item->getIdProduct()];
            }

            ?>
            <div class="cart_total">Total:<span class="total_value"><?= $total ?> DT</span></div>
        </div>
        <?php
        if ($total > 0) {
            echo '<button onclick="" id="buyAll_cart" class="buyAll_cart w3-hover-shadow">Buy all</button>';
            echo '
            <div id="paymentModal" class="w3-modal">
            <div class="w3-modal-content w3-card-4">
              <header class="w3-container w3-teal"> 
                <span onclick="document.getElementById(\'paymentModal\').style.display=\'none\'" 
                class="w3-button w3-display-topright">&times;</span>
                <h2>Paiement Methode</h2>
              </header>
              <div class="w3-container"style=" display: flex; height: 300px; align-items: center; justify-content: space-between;">
                <a href="?controller=command&action=add&paymentMethode=2" style="display: flex; flex-direction: column; align-items: center;text-decoration: none;"><img src="assets/images/credit_card.png"/><p>Payment by card</p></a>
                <a href="?controller=command&action=add&paymentMethode=1" style="display: flex; flex-direction: column; align-items: center;text-decoration: none;"><img src="assets/images/delivery.png"/><p>Cash on delivery</p></a>
              </div>
              <footer class="w3-container w3-teal">
                <p></p>
              </footer>
            </div>
          </div>
        </div>
            ';
        }
        ?>

    </div>
    <div class="commands_list">

        <?php
        // session_start();
        // print_r(array_count_values($_SESSION['panier']));
        // echo "<br>";
        // print_r($cartList);
        foreach ($cartList as $item) {
            echo "
                <article class=\"cart_item\">
                <img src=\"{$item->getImgSRC()}\" alt=\"\" class=\"cart_item_img\">
                <div class=\"cart_item_info\">
                    <div class=\"cart_item_details\">
                        <h5 class=\"cart_item_title\">{$item->getTitle()}</h5>
                        <h4 class=\"cart_item_price\">{$item->getPrice()}DT</h4>
                    </div>
                    <h6 class=\"cart_item_descrip\" >" . $item->getDescription() . "</h6>
                    <div class=\"cart_item_footer\">
                    <h5 class='cart_item_qte'> Qte:" . array_count_values($_SESSION['panier'])[$item->getIdProduct()] . " </h5>
                       
                        <a href=\"?index.php&controller=client&action=removecartitem&idproduct={$item->getIdProduct()}\" class=\"cart_delete_item_link\"><i class=\"fas fa-trash\"></i></a>
                    </div>
                </div>
            </article>
                ";
        }
        // foreach (array_count_values($_SESSION['panier']) as $idProduct => $qte) {
        //     $p = ModelProduct::select($idProduct);
        // }

        ?>
    </div>
    <?php
    if ($total == 0) {
        echo '<p style="text-align:center;">No Item in the cart</p>';
    }
    ?>
</div>
<script>
    // Get the modal
    var modal = document.getElementById('paymentModal');
    var buyAll_cart = document.getElementById('buyAll_cart');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    var id = <?php if (isset($_SESSION['userId'])) {
                    echo $_SESSION['userId'];
                } else {
                    echo "'((p))'";
                }
                ?>

    buyAll_cart.addEventListener('click', () => {
        console.log(id);
        if (isNaN(id)) {
            // alert('not number');
            window.location.href = "?index.php&controller=client&action=login";
        } else {
            document.getElementById('paymentModal').style.display = 'block';
        }
    })
</script>
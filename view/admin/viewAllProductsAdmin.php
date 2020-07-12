<div class="aUserMang_right">
    <!-- <button id="btnAdd"><i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button> -->
    <a href="?index.php&controller=admin&action=products&task=add" class="w3-text-lime"><i class="fa fa-plus-square" aria-hidden="true"></i> ADD PRODUCT</a>
    <table class="w3-table w3-bordered table_users" id="Users">
        <thead>
            <tr>
                <th></th>
                <th>Id</th>
                <th>Image</th>
                <th>Title</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Provider</th>
                <th>Manu. Date</th>
                <th>Exp. Date</th>
                <th class="w3-center">Theme</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tab_p as $key => $p) {
                echo "
                <tr>
                <td>
                    <div class=\"user__action\">
                        <a href=\"?index.php&controller=admin&action=products&task=detail&id={$p->getIdProduct()}\" class=\"w3-text-green\"><i class=\"fa fa-list\" aria-hidden=\"true\"></i></a>
                        <a href=\"?index.php&controller=admin&action=products&task=edit&id={$p->getIdProduct()}\" class=\"w3-text-amber\"><i class=\"fas fa-edit \"></i></a>
                        <a href=\"#\" class=\"w3-text-red\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>
                    </div>
                </td>
                <td>{$p->getIdProduct()}</td>
                <td><img src=\"{$p->getImgSRC()}\" alt=\"contain image product\" class=\"command_item_img\" width=\"40px\"> </td>
                <td>{$p->getTitle()}</td>
                <td>{$p->getStock()}</td>
                <td>{$p->getPrice()} DT</td>
                <td>{$p->getProvider()}</td>
                <td>{$p->getManufDate()}</td>
                <td>{$p->getExpDate()}</td>
                <td>{$p->getIdTheme()}</td>
            </tr>
                ";
            }

            ?>
        </tbody>

    </table>
</div>

<!--JavaScript files 😄-->
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js">
</script>

<script>
    $(document).ready(function() {
        $('#Users').DataTable({
            order: [
                [1, 'asc']
            ],
        });
    });
</script>
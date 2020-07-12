<div class="aUserMang_right">
    <a href="?index.php&controller=admin&action=themes&task=add" class="w3-text-lime"><i class="fa fa-plus-square" aria-hidden="true"></i> ADD THEME</a>
    <table class="w3-table w3-bordered table_users" id="Themes">
        <thead>
            <tr>
                <th></th>
                <th>Id</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($tab_t as $key => $t) {
                echo "
                <tr>
                <td>
                    <div class=\"user__action\">
                        <a href=\"?index.php&controller=admin&action=themes&task=edit&id=$t[0]\" class=\"w3-text-amber\"><i class=\"fas fa-edit \"></i></a>
                        <a href=\"?index.php&controller=admin&action=themes&task=delete&id=$t[0]\" class=\"w3-text-red\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>
                    </div>
                </td>
                <td>" . $t[0] . "</td>
                <td>" . $t[1] . "</td>
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
        $('#Themes').DataTable({
            // scrollY: '50vh',
            // scrollCollapse: true,
            // paging: false,
            order: [
                [1, 'asc']
            ],
            columns: [{
                    "width": "4em"
                },
                null,
                null
            ]
        });
    });
</script>
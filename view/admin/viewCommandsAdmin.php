<style>
    .table_users th,
    .table_users td {
        text-align: center;
    }
</style>
<div class="aUserMang_right">

    <table class="w3-table w3-bordered table_users" id="Users">
        <thead>
            <tr>
                <th></th>
                <th>IdCommand</th>
                <th>IdUser</th>
                <th>CommandDate</th>
                <th>LivredDate</th>
                <th>Status</th>
                <th>State</th>
                <th>PayMethode</th>

            </tr>
        </thead>
        <tbody>
            <?php
            // echo "<pre>";
            // print_r($tab_com);
            // echo "</pre>";

            foreach ($tab_com as $command) {
                if (empty($command->getLiveredDate())) {
                    $livredDateValue = '-';
                } else {
                    $livredDateValue = $command->getLiveredDate();
                }


                if ($command->getStatus() == 2) {
                    $statusValue = "<i class=\"fa fa-check-circle w3-text-green fa-lg w3-tooltip\" aria-hidden=\"true\"><span class=\"w3-text w3-tag w3-small\">Accepted</span></i>";
                } elseif ($command->getStatus() == 3) {
                    $statusValue = "<i class=\"fa fa-times-circle w3-text-red fa-lg w3-tooltip\" aria-hidden=\"true\"><span class=\"w3-text w3-tag w3-small\">Rejected</span></i>";
                } else {
                    $statusValue = "<a href=\"?index.php&controller=command&action=update&status=2&idcommand={$command->getIdCommand()}\" style=\"text-decoration:none;\"><i class=\"fa fa-check-circle w3-text-green fa-lg\" aria-hidden=\"true\"></i></a>";
                    $statusValue .= "<a href=\"?index.php&controller=command&action=update&status=3&idcommand={$command->getIdCommand()}\" style=\"text-decoration:none;\"><i class=\"fa fa-times-circle w3-text-red fa-lg	\" aria-hidden=\"true\"></i></a>";
                }

                if ($command->getPayMethode() == 1) {
                    $payMethodeValue = "<i class=\"fas fa-money-bill-alt fa-lg w3-text-green w3-tooltip\"><span class=\"w3-text w3-tag\">Cash</span></i>";
                }
                if ($command->getPayMethode() == 2) {
                    $payMethodeValue = "<i class=\"fas fas fa-credit-card fa-lg w3-indigo w3-tooltip\"><span class=\"w3-text w3-tag\">Card</span></i>";
                }
                if ($command->getState() == 1) {
                    $stateValue = "Command";
                } else {
                    $stateValue = "Bill";
                }


                echo "<tr>
                <td></td>
                <td>{$command->getIdCommand()}</td>
                <td>{$command->getIdUSer()}</td>
                <td>{$command->getCommandDate()}</td>
                <td>" . $livredDateValue . "</td>
                <td style=\"display: flex;justify-content: space-evenly;\">" . $statusValue . "</td>
                <td>" . $stateValue . "</td>
                <td>" . $payMethodeValue . "</td>
                </tr>
                ";
            }
            ?>


        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>IdCommand</td>
                <td>IdUser</td>
                <td>CommandDate</td>
                <td>LivredDate</td>
                <td>Status</td>
                <td>State</td>
                <td>PayMethode</td>
            </tr>
        </tfoot>

    </table>
    <!-- <?= "<p onclick=\"alert(idcommd.idUser)\">p</p>"; ?> -->

</div>

<!--JavaScript files 😄-->
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js">
</script>

<script>
    /* Formatting function for row details - modify as you need */
    // var idcommd = 1;

    // function format(d) {
    //     // `d` is the original data object for the row
    //     <?php
            //     // $product = ModelProduct::select();
            //     // echo "<script>document.writeln(String(idcommd));</script>";
            //     // echo "<p onload="console.log(idcommd.idUser)"></p>";

            //     
            ?>
    //     return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
    //         '<tr>' +
    //         '<td>idCommand:</td>' +
    //         '<td>' + d.idCommand + '</td>' +
    //         '</tr>' +
    //         '<tr>' +
    //         '<td>Command Date:</td>' +
    //         '<td>' + d.CommandDate + '</td>' +
    //         '</tr>' +
    //         '<tr>' +
    //         '<td>Extra info:</td>' +
    //         '<td>And any further details here (images etc)...</td>' +
    //         '</tr>' +
    //         '</table>';
    // }
    $(document).ready(function() {
        var table = $('#Users').DataTable({
            scrollY: '50vh',
            scrollCollapse: true,
            paging: false,
            // columns: [{
            //         "className": 'details-control',
            //         "orderable": false,
            //         "data": null,
            //         "defaultContent": '',
            //         "render": function() {
            //             return '<i class="fa fa-plus-square" aria-hidden="true"></i>';
            //         },
            //         width: "15px",
            //     },
            //     {
            //         data: "idCommand"
            //     },
            //     {
            //         data: "idUser"
            //     },
            //     {
            //         data: "CommandDate"
            //     },
            //     {
            //         data: "LivredDate"
            //     },
            //     {
            //         data: "Status"
            //     },
            //     {
            //         data: "state"
            //     },
            //     {
            //         data: "payMethode"
            //     }
            // ],
            order: [
                [1, 'asc']
            ]
        });
        // Add event listener for opening and closing details
        // $('#Users tbody').on('click', 'td.details-control', function() {
        //     var tr = $(this).closest('tr');
        //     var tdi = tr.find("i.fa");
        //     var row = table.row(tr);

        //     if (row.child.isShown()) {
        //         // This row is already open - close it
        //         row.child.hide();
        //         tr.removeClass('shown');
        //         tdi.first().removeClass('fa-minus-square');
        //         tdi.first().addClass('fa-plus-square');
        //     } else {
        //         // Open this row
        //         row.child(format(row.data())).show();
        //         window.idcommd = row.data();

        //         tr.addClass('shown');
        //         tdi.first().removeClass('fa-plus-square');
        //         tdi.first().addClass('fa-minus-square');
        //     }
        // });

        // table.on("user-select", function(e, dt, type, cell, originalEvent) {
        //     if ($(cell.node()).hasClass("details-control")) {
        //         e.preventDefault();
        //     }
        // });
    });
</script>
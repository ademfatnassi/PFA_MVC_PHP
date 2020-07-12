<div class="aUserMang_right adUserDet">
    <main>
        <section class="adUserDetailsBox">
            <div>
                <h4 class="AdAccountInfotitle">First Name: <span class="accountInfoData"><?= $user->Prenom ?></span></h4>
                <h4 class="AdAccountInfotitle">Last Name: <span class="accountInfoData"><?= $user->Nom ?></span></h4>
                <h4 class="AdAccountInfotitle">Email: <span class="accountInfoData"><?= $user->Email ?></span></h4>
                <h4 class="AdAccountInfotitle">Phone: <span class="accountInfoData"><?= $user->Phone ?></span></h4>
                <h4 class="AdAccountInfotitle">Birth Date: <span class="accountInfoData"><?= $user->BirthDate ?></span></h4>
                <h4 class="AdAccountInfotitle">Gender: <span class="accountInfoData"><?= $user->Gender ?></span></h4>
            </div>
            <div>
                <h4 class="AdAccountInfotitle">Address: <span class="accountInfoData"><?= $user->Adresse ?></span></h4>
                <h4 class="AdAccountInfotitle">ZIP: <span class="accountInfoData"><?= $user->ZIP ?></span></h4>
                <h4 class="AdAccountInfotitle">City: <span class="accountInfoData"><?= $city->getNameCity()  ?></span></h4>
                <h4 class="AdAccountInfotitle">Status:
                    <?= $user->getUStatus() == 1 ? "<span class=\"accountInfoData w3-text-green\"> Active</span>" : "<span class=\"accountInfoData w3-text-red\"> Desactive</span>" ?>

                </h4>
                <h4 class="AdAccountInfotitle">Role: <span class="accountInfoData"><?= $user->Role == 1 ? "Admin" : "Client" ?></span></h4>
                <h4 class="AdAccountInfotitle">Date of Regestration: <span class="accountInfoData"><?= $user->getInscritDate() ?></span></h4>
            </div>
        </section>

        <section class="Ucommand_wrap">
            <h2 class="Ucommand_header_title">Commands</h2>

            <table class="w3-table w3-bordered table_commands" id="commands">
                <thead>
                    <tr>
                        <th>Img</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Command Date</th>
                        <th>Livered Date</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // echo "<pre>";
                    // print_r($tab_com);
                    // echo "</pre>";
                    if (empty($tab_com)) {
                        echo "videe";
                    } else
                        foreach ($tab_com as $command) {
                            if ($command->getStatus() == 1) {
                                $statusTData = "<td class=\"w3-text-amber\"><i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> In Progress</td>";
                            }
                            if ($command->getStatus() == 2) {
                                $statusTData = "<td class=\"w3-text-green\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> Livred</td>";
                            }
                            if ($command->getStatus() == 3) {
                                $statusTData = "<td class=\"w3-text-red\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> Canceled</td>";
                            }
                            if (empty($command->getLiveredDate())) {
                                $livredDateValue = '-';
                            } else {
                                $livredDateValue = $command->getLiveredDate();
                            }
                            // echo $command->getIdCommand() . "<br>";
                            // echo $command->getCommandDate() . "<br>";
                            // echo $command->getStatus() . "<br>";
                            $detailCommand = ModelDetailCommand::getAllByColumn("idCommand ", $command->getIdCommand());
                            // echo "<pre>";
                            // print_r($detailCommand);
                            // echo "</pre>";
                            if (empty($detailCommand)) {
                                echo "videe";
                            } else
                                foreach ($detailCommand as $detail) {
                                    $product = ModelProduct::select($detail->getIdProduct());
                                    // echo "<pre>";
                                    // print_r($product);
                                    // echo "</pre>";
                                    echo "
                                <tr>
                                    <td><img src=\"{$product->getImgSRC()}\" alt=\"contain image product\" class=\"command_item_img\" width=\"40px\"> </td>
                                    <td>{$product->getTitle()}</td>
                                    <td>{$product->getPrice()} D.T</td>
                                    <td>{$detail->getQuantity()}</td>
                                    <td>{$command->getCommandDate()}</td>
                                    <td>" . $livredDateValue . "</td>
                                    " . $statusTData . "
                                </tr>
                            ";
                                }
                        }

                    ?>

                </tbody>

            </table>


        </section>
    </main>

</div>

<!--JavaScript files 😄-->
<script src="../JS/observers.js"></script>
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js">
</script>

<script>
    $(document).ready(function() {
        $('#commands').DataTable({
            scrollY: '25vh',
            scrollCollapse: true,
            "language": {
                "lengthMenu": "Display _MENU_ records per page",
                "zeroRecords": "Nothing found - sorry",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)"
            }
        });
    });
</script>
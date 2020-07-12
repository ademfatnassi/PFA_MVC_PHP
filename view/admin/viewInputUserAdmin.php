<div class="aUserMang_right" style="background-color: #f1f1f1;">
    <form action="<?= $actionForm ?>" method="post" name="FormPerInfo" class="">
        <div class="FormPerInfo">
            <div class="inputField adminUserMang__inputs">
                <label for="firstname" class="name-field-label">First Name</label>
                <?php
                ($task == 'edit') ? $fnameValue = "value=\"" . $user->Prenom . "\"" : $fnameValue = "";
                ?>
                <input type="text" <?= $fnameValue ?> name="fname" id="firstname" class="firstname field-input" placeholder="e.g Flen">

            </div>
            <span style="width: 10px;"></span>
            <div class="inputField adminUserMang__inputs">
                <?php
                ($task == 'edit') ? $lnameValue = "value=\"" . $user->Nom . "\"" : $lnameValue = "";
                ?>
                <label for="lastname" class="name-field-label">Last Name</label>
                <input type="text" <?= $lnameValue ?> name="lname" id="lastname" class="lastname field-input" placeholder="e.g Smith">
            </div>
        </div>
        <div class="Bdate_Field adminUserMang__inputs">
            <?php
            ($task == 'edit') ? $BdateValue = "value=\"" . $user->BirthDate . "\"" : $BdateValue = "";
            ?>
            <input type="date" <?= $BdateValue ?> name="BDate" id="BDate" class="BDate field-input">
        </div>
        <div class="gender adminUserMang__inputs" style="margin: 1rem">
            <input type="radio" name="gender" value="M" id="Gmale" <?php if ($task == 'edit') echo ($user->Gender == 'M') ? "checked" : ""; ?> />
            <label for="Gmale">Male</label>
            <input type="radio" name="gender" value="F" id="Gfemale" class="adminUserMang__inputs" <?php if ($task == 'edit') echo ($user->Gender == 'F') ? "checked" : ""; ?> />
            <label for="Gfemale">Female</label>
        </div>
        <div class="inputField adminUserMang__inputs">
            <?php
            ($task == 'edit') ? $emailValue = "value=\"" . $user->Email . "\"" : $emailValue = "";
            ?>
            <label for="email" class="name-field-label">Email</label>
            <input type="email" <?= $emailValue ?> name="email" id="email" class="email_field field-input" placeholder="e.g flen@topnet.tn">
        </div>
        <div class="FormPriInfo">
            <div class="inputField adminUserMang__inputs">
                <label for="pwd" class="name-field-label">Password</label>
                <input type="password" name="pwd" id="pwd" class="pwd field-input" placeholder="e.g ●●●●●●●●●">
            </div>
            <span style="width: 10px;"></span>
            <div class="inputField adminUserMang__inputs">
                <label for="repwd" class="name-field-label">Repeat Password</label>
                <input type="password" name="repwd" id="repwd" class="repwd field-input" placeholder="e.g ●●●●●●●●●">
                <span id='message'></span>
            </div>
        </div>
        <!-- 
            region_Field class: I've been used many time in code,
            It's for design css proposes, that repeat multiple time
        -->
        <div class="region_Field adminUserMang__inputs">
            <select class="region_Field" name="region" id="join__region">
                <option>---Choose your city---</option>
                <?php
                foreach ($tab_c as $c) {
                    if ($task == 'edit') {
                        if ($user->getIdCity() == $c->getIdCity()) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                    }

                    echo "<option {$selected} value=" . $c->getIdCity() . ">" . $c->getNameCity() . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="FormPerAddress">
            <div class="inputField adminUserMang__inputs">
                <?php
                ($task == 'edit') ? $addresseValue = "value=\"" . $user->Adresse . "\"" : $addresseValue = "";
                ?>
                <label for="address" class="name-field-label">Address</label>
                <input type="text" <?= $addresseValue ?> name="addresse" id="address" class="address field-input" placeholder="e.g XX Rue de ZZZZ">
            </div>
            <span style="width: 10px;"></span>
            <div class="inputField adminUserMang__inputs">
                <?php
                ($task == 'edit') ? $ZIPValue = "value=\"" . $user->ZIP . "\"" : $ZIPValue = "";
                ?>
                <label for="zipcode" class="name-field-label">ZIP</label>
                <input type="number" <?= $ZIPValue ?> name="zip" id="zipcode" class="zipcode field-input" placeholder="e.g 111">
            </div>
        </div>
        <div class="inputField adminUserMang__inputs">
            <?php
            ($task == 'edit') ? $PhoneValue = "value=\"" . $user->Phone . "\"" : $PhoneValue = "";
            ?>
            <label for="phone" class="name-field-label">Phone</label>
            <input type="number" <?= $PhoneValue ?> name="phone" id="phone" class="phone_field field-input" placeholder="e.g 99 999 999">
        </div>
        <div class="region_Field adminUserMang__inputs">
            <select class="region_Field" name="status" id="">
                <option>---Choose Status---</option>
                <option value="1" <?php if ($task == 'edit') echo ($user->getUStatus() == 1) ? "selected" : ""; ?>>Active</option>
                <option value="2" <?php if ($task == 'edit') echo ($user->getUStatus() == 2) ? "selected" : ""; ?>>Desactive</option>
            </select>
        </div>
        <div class="region_Field adminUserMang__inputs">
            <select class="region_Field" name="role" id="">
                <option>---Choose Role---</option>
                <option value="1" <?php if ($task == 'edit') echo ($user->Role == 1) ? "selected" : ""; ?>>Admin</option>
                <option value="2" <?php if ($task == 'edit') echo ($user->Role == 2) ? "selected" : ""; ?>>Client</option>
            </select>
        </div>
        <div>
            <input type="submit" value="<?= $btnSendValue ?>">
            <input type="reset" value="Cancel">
        </div>
    </form>
    <?php
    // print_r($tab_c);

    ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js"></script>
<script>
    $('input').on('focusin', function() {
        $(this).parent().find('label').addClass('Iactive');
    });

    $('input').on('focusout', function() {
        if (!this.value) {
            $(this).parent().find('label').removeClass('Iactive');
        }
    });

    $('input').ready(function() {
        $(":input").map(function() {
            if ($(this).val()) {
                $(this).parent().find('label').addClass('Iactive');

            } else if ($(this).val()) {
                $(this).parent().find('label').removeClass('Iactive');

            }
        });
    }); //If input value is not empty on loading data from database for updating
    $('#pwd, #repwd').on('keyup', function() {
        if ($('#pwd').val() == $('#repwd').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });
</script>
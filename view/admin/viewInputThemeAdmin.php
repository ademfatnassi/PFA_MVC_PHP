<div class="aUserMang_right" style="background-color: #f1f1f1;">
    <form action="<?= $actionForm ?>" method="post" name="FormPerInfo" class="">
        <div class="FormPerInfo">
            <div class="inputField adminUserMang__inputs">
                <label for="themeTitle" class="name-field-label">Theme Title</label>
                <?php
                ($task == 'edit') ? $themeTitleValue = "value=\"" . $theme[1] . "\"" : $themeTitleValue = "";
                ?>
                <input type="text" <?= $themeTitleValue ?> name="themeTitle" id="themeTitle" class="themetittle field-input" placeholder="e.g assocation name">

            </div>

        </div>

        <!-- 
            region_Field class: I've been used many time in code,
            It's for design css proposes, that repeat multiple time
        -->

        <div>
            <input type="submit" value="<?= $btnSendValue ?>">
            <input type="reset" value="Cancel">
        </div>
    </form>
    <?php

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
</script>
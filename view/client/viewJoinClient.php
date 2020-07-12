<a href="/pfa/" class="logo__link"><img src="./assets/Images/WhiteLogo.png" alt="" class="white_logo"></a>
<div class="joinLeft_side">

    <div class="join-left-side-wrap">
        <h2 class="greet-title">Hello There !</h2>
        <span class="greet-bar"></span>
        <h3 class="greet-descrip">To keep connected with us please login with your personal info.</h3>
        <a href="index/client/login/" class="greet-signup">Log IN</a>
    </div>
</div>
<div class="join__container">
    <div class="join_wrap">
        <h2 class="join__title">Create new Account</h2>

        <form action="?index.php&controller=client&action=created" id="regForm" method="post" class="join__form">
            <div class="tab partOne_wrap">
                <h4 class="join__subtitle">Fill these info.</h4>
                <div class="name-section">
                    <label for="join__fname" class="firstName-field-label">First name</label>
                    <input type="text" name="fname" id="join__fname" class="join__fname">
                </div>
                <div class="name-section">
                    <label for="join__lname" class="lastName-field-label">Last name</label>
                    <input type="text" name="lname" id="join__lname" class="join__lname">
                </div>

                <div class="phone-section">
                    <label for="join__phone" class="phone-field-label">Phone</label>
                    <input type="text" name="phone" id="join__phone" class="join__phone">
                </div>
                <div class="gender">
                    <input type="radio" name="gender" value="M" id="Gmale" />
                    <label for="Gmale">Male</label>
                    <input type="radio" name="gender" value="F" id="Gfemale" />
                    <label for="Gfemale">Female</label>
                </div>

            </div>

            <div class="tab partTwo_wrap">
                <h4 class="join__subtitle">we need more info.</h4>
                <div class="bdate-section">
                    <label for="join__BDate" class="BDate-field-label">Birth Date</label>
                    <input type="date" name="BDate" id="join__BDate" class="join__BDate">
                </div>
                <div class="coordinates">
                    <div class="region-section">
                        <label for="join__region" class="region-field-label">Region</label>
                        <select class="join__region" name="region" id="join__region">
                            <option>---Choose your city---</option>
                            <?php
                            foreach ($tab_c as $c) {
                                echo "<option value=" . $c->getIdCity() . ">" . $c->getNameCity() . "</option>";
                            }
                            ?>
                        </select>
                        <span id="ErrorCity"></span>
                    </div>
                    <div class="addresse-section">
                        <label for="join__addresse" class="addresse-field-label">Addresse</label>
                        <input type="text" name="addresse" id="join__addresse" class="join__addresse">
                    </div>
                    <div class="zip-section">
                        <label for="join__zip" class="zip-field-label">ZIP Code</label>
                        <input type="number" name="zip" id="join__zip" class="join__zip">
                    </div>
                </div>
            </div>
            <div class="tab partThree_wrap">
                <h4 class="join__subtitle">just these thing and you ready to go</h4>
                <div class="email-section">
                    <label for="join__email" class="email-field-label">Email</label>
                    <input type="email" name="email" id="join__email" class="join__email" onblur="CheckEmail()">
                    <span id="ErrorSpan"></span>
                </div>
                <div class="pwd-section">
                    <label for="join__name" class="pwd-field-label">Password</label>
                    <input type="password" name="pwd" id="join__pwd" class="join__pwd">
                </div>
                <div class="repwd-section">
                    <label for="join__name" class="repwd-field-label">Repeat your Password</label>
                    <input type="password" name="repwd" id="join__repwd" class="join__repwd">
                    <span id='message'></span>
                </div>
            </div>
            <!-- <div class="guide_btn">
                    <button>Back</button>
                    <button>Next</button>
                </div> -->
            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
            </div>

            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>

        </form>

    </div>
</div>
<script src="./JS/w3schoolCheat.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('#join__pwd, #join__repwd').on('keyup', function() {
        if ($('#join__pwd').val() == $('#join__repwd').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });

    function CheckEmail() {
        var Email = document.getElementById('join__email');
        if (Email.value != "") {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var value = xmlhttp.responseText;
                    if (value.length > 1) {
                        document.getElementById('ErrorSpan').innerHTML = "Email Already exist please choose Other Email";
                        Email.style.color = "#FF0000";
                        Email.style.backgroundColor = "#ffdddd";
                        // Email.focus();
                    } else {
                        document.getElementById('ErrorSpan').innerHTML = "";
                        Email.style.color = "";
                        Email.style.backgroundColor = "";
                    }
                }
            }
            xmlhttp.open("GET", "?index.php&controller=client&action=check&q=" + Email.value, true);
            xmlhttp.send();
        }
    }
</script>
<!-- <script src="./JS/cleave.min.js"></script>
<script src="./JS/cleave-phone.tn.js"></script>

<script>
    var cleave = new Cleave('#join__phone', {
        phone: true,
        phoneRegionCode: 'TN'
    });
</script> -->
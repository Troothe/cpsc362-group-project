<div class="plain-header">
    <img src="images/logo.png" />
</div>
<div style="height: 150px;"></div>
<?php

if(count($_SESSION['ErrorsToShow']) > 0) {
    echo '
        <div class="important_error" id="ImportantError">
            ' . $_SESSION['ErrorsToShow'][0] . '<br>
            <button class="SubmitButtonLogin" style="margin-top: 50px; width: 100px;"onclick="document.getElementById(\'ImportantError\').style.display = \'none\'; stopModal(\'ImportantError\');">Okay</button>
        </div>
    ';
}

?>


<?php if (isset($messages) && (isset($messages['error']) || isset($messages['success']) || isset($messages['info']))) {
    foreach ($messages as $key => $values) {
        if (is_array($values) && sizeof($values) > 0) {
            ?>
            <div class="<?= $key; ?>-container">
                <ul>
                <?php foreach ($values as $value) {   ?>
                    <li><?= $value; ?></li>
                <?php } ?>
                </ul>
            </div>
            <?php
        }
    }
    ?>
<?php } ?>
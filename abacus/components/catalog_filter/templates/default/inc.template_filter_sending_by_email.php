<?php
$hide_sending_by_email = false;
if (isset($_GET['series']) && $_GET['series'] == 'iP') {
    $hide_sending_by_email = true;
}
?>

<?php if (!$hide_sending_by_email): ?>
<div class="filter_field_block borderless pb-1 pt-1">
    <div class="columns is-gapless is-multiline">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input type="checkbox" 
                   id="checkbox_sending_by_email" 
                   value="sending_by_email"
                   @change="filterChanged" 
                   v-model="filterSelectedInterfaces"
                   class="sending_by_email"/>&nbsp;
            <label for="checkbox_sending_by_email">Отправка сообщений на почту</label>
        </div>
    </div>
</div>
<?php endif; ?>
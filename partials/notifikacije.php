<?php if (empty($poruke) == false) : ?>
    <fieldset class="blue-border">
        <legend>Poruke</legend>

        <?php foreach ($poruke as $poruka) : ?>
            <p class="margin-0"><?= $poruka ?></p>
        <?php endforeach ?>
    </fieldset>
<?php endif ?>

<?php if (empty($greske) == false) : ?>
    <fieldset class="red-border">
        <legend>Greške</legend>

        <?php foreach ($greske as $greska) : ?>
            <p class="margin-0"><?= $greska ?></p>
        <?php endforeach ?>
    </fieldset>
<?php endif ?>
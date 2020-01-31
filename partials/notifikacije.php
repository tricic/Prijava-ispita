<?php if (empty($poruke) == false) : ?>
    <ul class="alert alert-primary">
        <?php foreach ($poruke as $poruka) : ?>
            <li class="ml-3"><?= $poruka ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>

<?php if (empty($greske) == false) : ?>
    <ul class="alert alert-danger">
        <?php foreach ($greske as $greska) : ?>
            <li class="ml-3"><?= $greska ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>

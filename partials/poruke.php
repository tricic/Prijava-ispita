<?php
if (isset($_GET['uspjeh']))
{
    echo "Operacija uspješna!" . '<hr>';
}

if (empty($greske) == false)
{
    foreach ($greske as $greska)
    {
        echo $greska . '<hr>';
    }
}
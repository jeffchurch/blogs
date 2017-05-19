<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
              <?php foreach (($blogs?:[]) as $row): ?>
             <?php foreach (($row?:[]) as $key=>$value): ?>
             <?php foreach (($value?:[]) as $key2=>$value2): ?>
                <p><?= $key2 ?> - <?= $value2 ?></p>
              <?php endforeach; ?>
              <?php endforeach; ?>
              <?php endforeach; ?>

    </body> 
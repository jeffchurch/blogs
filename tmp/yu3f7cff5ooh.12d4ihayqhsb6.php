<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
              <?php foreach (($blogs?:[]) as $key2=>$value2): ?>
             <?= $value2 ?> <?= $key2.PHP_EOL ?>

              <?php foreach (($value2?:[]) as $key=>$value): ?>
                <p><?= $key ?> - <?= $value ?></p>
              <?php endforeach; ?>
              <?php endforeach; ?>
                      
    </body> 
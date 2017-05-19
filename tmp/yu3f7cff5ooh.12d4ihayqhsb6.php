<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
              <?php foreach (($blogs?:[]) as $value2): ?>
             <?= $value2['blog_title'] ?> ---- <?= $key2.PHP_EOL ?>

              <?php foreach (($value2?:[]) as $key=>$value): ?>
                <p><?= $key ?> - <?= $value ?></p>
              <?php endforeach; ?>
              <?php endforeach; ?>

    </body> 
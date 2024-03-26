<?php require APPROOT . '/views/inc/header.php'; ?>

<h1><?= $data['title']; ?></h1>
<p><?= $data['content']; ?></p>
<a href="<?= URLROOT; ?>/pages/about" class='btn btn-primary'>Voir plus</a>

<?php foreach($data['posts'] as $post){ ?>
    <h2><?= $post->title; ?></h2>
    <p><?= $post->content; ?></p>
<?php } ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
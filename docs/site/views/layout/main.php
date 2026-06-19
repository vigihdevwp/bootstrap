<?php
// layout/main.php

$title = isset($title) ? $title : '';
$content = isset($content) ? $content : '';
$js = isset($js) ? PHP_EOL . $js : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo htmlspecialchars($title); ?></title>
    <?php include LAYOUT_PATH . '/header.php'; ?>
</head>

<body>
    <div class="app-wrapper">
        <div class="app-sidebar shadow-3" id="sidebar">
            <?php include LAYOUT_PATH . '/sidebar.php'; ?>
        </div>
        <main class="app-main" role="main" id="main">
            <?php include LAYOUT_PATH . '/navbar.php'; ?>

            <div class="content" id="content">
                <?php echo $content; ?>
            </div>

            <?php include LAYOUT_PATH . '/footer.php'; ?>
            <?php echo $js; ?>
        </main>
    </div>
</body>

</html>
<?php
$content = get_sub_field('content');
$container_class = get_sub_field('container');

?>

<section>
    <div class="container <?php echo $container_class; ?>"> 
        <div class="rich-text"> 
            <?php echo $content; ?>
        </div>
    </div>
</section>

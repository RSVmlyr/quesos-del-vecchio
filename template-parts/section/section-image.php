
<?php
$image = get_sub_field('image');
?>

<section class="py-6 lg:py-12">
    <div class="container">
        <figure class="rounded-2xl overflow-hidden lg:rounded-[3rem]">
            <img class="w-full" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
        </figure>
    </div>
</section>  

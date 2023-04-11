<?php if(have_posts()): while(have_posts()): the_post(); ?>
    <?php echo get_the_date('D/m/Y h:i:s'); ?>
    <?php the_content(); ?>
    <?php
    $fname = get_the_author_meta('first_name');
    $lname = get_the_author_meta('last_name');
    ?>
    <p> Posted on <?php echo $fname; ?> <?php echo $lname; ?></p>

    <?php 
    $tags = get_the_tags();
    foreach($tags as $tag): ?>
        <a href="<?php echo get_tag_link($tag->term_id); ?>" ><?php echo $tag->name;?></a>
    <?php endforeach; ?>

    <?php 
    $category = get_the_category();
    foreach($category as $category):
    ?>
    <a href="<?php echo get_category_link($category->term_id) ?>"><?php echo $category->name ?></a>
    <?php endforeach; ?>
<?php endwhile; else: endif; ?>
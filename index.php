<?php get_header(); ?>
    <?php if(have_posts()): ?>
        <div class="container">
            <?php while(have_posts()): the_post();?>
                <?php get_template_part('content', get_post_format()); ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <?php if(is_home()): ?>
        <?php
            $total = wp_count_posts()->publish;
            $canShow = get_option('posts_per_page');
         ?>
         <?php if($total > $canShow): ?>
             <div class="row pb-2">
                 <div class="col">
                     <hr>
                     <?php
                        $paginate_args = array(
                            'type' => 'array'
                        );
                        $all_pages = paginate_links($paginate_args);
                     ?>
                     <nav class="postPagination">
                        <ul class="pagination justify-content-center">
                            <?php foreach($all_pages as $page): ?>
                                <li class="page-item">
                                    <?php echo str_replace('page-numbers', 'page-link', $page); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                 </div>
             </div>
         <?php endif; ?>
    <?php endif; ?>

<?php get_footer(); ?>

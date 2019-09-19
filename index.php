<?php get_header(); ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col">
                <h2 class="display-4"><?= single_post_title(); ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card p-4">
                    <img src="https://secure.meetupstatic.com/photos/event/7/4/c/5/global_467909893.jpeg" alt="" class="img-fluid mb-2">
                    <p>
                    <!-- Wellington's home to some great health tech startups and established bioscience based industries. Connectivity between people and the various disciplines is crucial to growing the success of the health technology and life-sciences industry in Wellington and in NZ. This is why we're creating the opportunity for networking and sharing ideas. All welcome, including scientists, clinicians, policy, funding, and startup people. -->
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <?php if(have_posts()): ?>
                    <?php while(have_posts()): the_post();?>
                        <div class="card shadow-sm rounded-0 mb-4 p-3">
                            <div class="row">
                                <?php if(has_post_thumbnail()): ?>
                                    <div class="col-12 col-md-3 d-flex justify-content-center align-items-center">
                                        <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid' ) ); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="col">
                                    <div class="card-body">
                                      <h5 class="card-title"><?php the_title(); ?></h5>
                                      <p class="card-text"><?php the_excerpt(); ?></p>
                                      <a href="<?php the_permalink(); ?>" class="btn btn-whtn">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile ?>
                    <?php
                        $total = wp_count_posts()->publish;
                        $canShow = get_option('posts_per_page');
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                     ?>
                    <?php if($total > $canShow): ?>
                        <div class="row">
                            <div class="col-12">
                                <?php
                                    $paginate_args = array(
                                        'type' => 'array'
                                    );
                                    $all_pages = paginate_links($paginate_args);
                                 ?>
                                 <nav>
                                     <ul class="pagination justify-content-end">
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
            </div>
        </div>
    </div>

<?php get_footer(); ?>

<?php
/**
 * Template Name: Landing Page
 */
get_header();?>

    <div class="wrapper">
        <section id="header">
            <div class="container">
                <div class="row wow slideInDown">
                    <h1><?php _e('Welcome To Here..') ?></h1>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div id="frontend-frm" class="col-md-5 wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">
                    <?php gravity_form( 2, false, false, true, '', false ); ?>
                </div>
                <div class="col-md-7">
                    <div class="preview-pan">
                        <?php
                        $arg = array(
                            'post_type'             => 'post',
                            'posts_per_page'        => 1,
                            'order'   => 'DESC',
                        );
                        $loop = new WP_Query($arg);
                        while($loop->have_posts()): $loop->the_post();?>

                            <h1 class="post-title wow fadeInUp" data-wow-delay="500ms">
                                <?php
                                the_title();
                                ?>
                            </h1>
                            <div class="post-content wow fadeInUp" data-wow-delay="500sm">
                                <?php
                                the_content();
                                ?>
                            </div>
                            <div class="post-img wow fadeInUp">
                                <?php
                                the_post_thumbnail('preview_img', array( 'class' => 'img-responsive' ));
                                ?>
                            </div>
                            <div class="post-tags wow fadeInUp">
                                <?php
                                echo get_the_tag_list('<p>Tags: ',', ','</p>');
                                ?>
                            </div>
                            <div class="post-address wow fadeInUp">
                                <span><?php _e('Address ','text-domain');?></span><span class="address-txt"><?php echo $address = get_field("address");?></span>
                            </div>
                            <div class="post-gallery wow fadeInUp">
                                <p>
                                    <?php _e('Gallery ','text-domain')?>
                                </p>
                                <?php
                                $images = get_field('gallery');

                                if( $images ): ?>
                                    <ul>
                                        <?php foreach( $images as $image ):?>
                                            <li>
                                                <a href="<?php echo $image['url']; ?>">
                                                    <img class="img-responsive" src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
                                                </a>
                                            </li>

                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>


                            </div>
                            <div class="post-url">
                                <p>
                                    <?php _e('URL ','text-domain')?>
                                </p>
                                <?php
                                $url_list = get_field('url_list');
                                echo $a = get_post_meta('url_list');
                                if ($url_list): ?>
                                    <ul>
                                        <?php
                                        while(has_sub_field('url_list')):
                                            $url = get_sub_field('url');
                                            ?>
                                            <li class="wow fadeInUp">
                                            <a target="_blank" href="<?php echo $url; ?>"><?php echo $url; ?></a>
                                            </li><?php
                                        endwhile;
                                        ?>
                                    </ul>
                                <?php endif;

                                ?>
                            </div>


                        <?php
                        endwhile;
                        wp_reset_query();
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <section id="footer">
            <div class="container">
                <div class="row">
                    <h3>
                        @copyright2015-Test Project
                    </h3>
                </div>
            </div>
        </section>

    </div>


<?php
    get_footer();
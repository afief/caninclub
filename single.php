<?php get_header(); ?>

<!-- Site Body -->
<main class="site-body single" id="site-content" role="main">

  <!-- Blog Posts -->
  <article class="blog-body">
    <?php if (have_posts()):
      the_post(); ?>

      <article <?php post_class('post'); ?>>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        <?php if (has_post_thumbnail() && !post_password_required()): ?>

          <a href="<?php the_permalink(); ?>" class="featured-image">
            <?php the_post_thumbnail(); ?>
          </a>

        <?php endif; ?>

        <div class="content">

          <?php
          if (is_search()) {
            the_excerpt();
          } else {
            the_content();
            edit_post_link();
          }
          ?>

        </div><!-- .content -->

        <?php

        if (is_singular())
          wp_link_pages();

        if (get_post_type() == 'post'): ?>

          <div class="meta">
            <a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format')); ?></a>

            <?php if (is_sticky()): ?>
              <span class="sep"></span>
              <?php _e('Sticky', 'caninclub'); ?>
            <?php endif ?>


            <p>
              <?php _e('In', 'caninclub'); ?>
              <?php the_category(', '); ?>
            </p>
            <p>
              <?php the_tags(' #', ' #', ' '); ?>
            </p>


          </div><!-- .meta -->

        <?php endif;

        if ((comments_open() || get_comments_number()) && !post_password_required()) {
          ?>
          <hr class="simple-divider" />
          <?php
          comments_template();
        }

        ?>

      </article><!-- .post -->

      <hr class="simple-divider" />

      <?php

    elseif (is_404()): ?>

      <div class="post not-found">
        <p>
          Looks like we lost our way. Let's get <a href="/" title="Home Page">back on track</a>!
        </p>
      </div><!-- .post -->

    <?php endif; ?>

    </div>

</main><!-- .wrapper -->

<?php get_footer(); ?>
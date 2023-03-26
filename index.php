<?php get_header(); ?>

<!-- Site Body -->
<main class="site-body" id="site-content" role="main">

	<?php if (is_archive() || is_search()):

		if (is_search()) {
			global $wp_query;
			// Translators: %s = The search query
			$archive_title = sprintf(_x('Search Results: &ldquo;%s&rdquo;', '%s = The search query', 'caninclub'), get_search_query());
			$archive_description = sprintf(_nx('%s result was found.', '%s results were found.', $wp_query->found_posts, '%s = The search query', 'caninclub'), $wp_query->found_posts);
		} else {
			$archive_title = get_the_archive_title();
			$archive_description = get_the_archive_description();
		}
		?>

		<header class="archive-header">
			<?php if ($archive_title): ?>
				<h1 class="archive-title">
					<?php echo $archive_title; ?>
				</h1>
			<?php endif; ?>
			<?php if ($archive_description): ?>
				<div class="archive-description">
					<?php echo $archive_description; ?>
				</div>
			<?php endif; ?>
		</header>

	<?php endif; ?>

	<!-- Blog Posts -->
	<article class="blog-body">
		<?php if (have_posts()):

			while (have_posts()):
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

							<?php if (comments_open() && !post_password_required()): ?>
								<span class="sep"></span>
								<?php comments_popup_link(__('Comment', 'caninclub'), __('Comment', 'caninclub'), __('Comments', 'caninclub'), '', __('Comments off', 'caninclub')); ?>
							<?php endif; ?>

						</div><!-- .meta -->

					<?php endif;

					if ((comments_open() || get_comments_number()) && !post_password_required()) {
						comments_template();
					}

					?>

				</article><!-- .post -->

				<hr class="simple-divider" />

				<?php

			endwhile;

		elseif (is_404()): ?>

			<div class="post not-found">
				<p>
					Looks like we lost our way. Let's get <a href="/" title="Home Page">back on track</a>!
				</p>
			</div><!-- .post -->

		<?php endif;

		if (!is_singular() && (get_previous_posts_link() || get_next_posts_link())): ?>

			<div class="pagination">
				<?php next_posts_link(__('Older posts', 'caninclub')); ?>
				<?php previous_posts_link(__('Newer posts', 'caninclub')); ?>
			</div><!-- .pagination -->

		<?php endif; ?>

		</div>

</main><!-- .wrapper -->

<?php get_footer(); ?>
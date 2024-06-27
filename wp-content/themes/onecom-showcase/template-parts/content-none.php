<div class="oct-post-content">
    <header class="page-header">
        <div class="row mt-4">
            <div class="col-md-12">
                <h1 class="oct-underlined-heading">
                    <?php echo __('No entries found!', 'oct-express'); ?>
                </h1>
                <?php if (is_search()): ?>
                    <div class="oct-main-content"><?php echo __('Try searching with a different keyword.', 'oct-express'); ?></div>
                <?php else: ?>
                    <div class="oct-main-content"><?php echo __('Try a search instead', 'oct-express'); ?>:</div>
                <?php endif; ?>

                <?php get_search_form(); ?>
            </div>
        </div>
    </header><!-- .page-header -->
</div>
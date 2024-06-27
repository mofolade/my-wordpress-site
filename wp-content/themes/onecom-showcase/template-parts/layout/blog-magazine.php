<div class="col-md-12">
    <?php
    // Show container if magazine has some page content
    // Display content box if have content, else not blank space/box
    if (!empty(trim(get_the_content()))) {
        echo '<div class="oct-main-content">';
    }

    the_content();
    edit_post_link('edit', '<p>', '</p>');

    if (!empty(trim(get_the_content()))) {
        echo '</div>';
    }
    ?>

    <?php
    /* Magazine section-1 switch */
    if (get_post_meta(get_the_ID(), 'section_1_switch', true) != 'off') {
        ?>
        <section class="oct-magazine-section oct-magazine-section-1 oct-main-content">
            <div class="row">
                <!-- Magazine Section 3 Subsection -->
                <?php
                get_template_part('template-parts/layout/magazine', 'section-1');
                ?>
            </div>
        </section>
    <?php } ?>

    <?php
    /* Magazine section-2 switch */
    if (get_post_meta(get_the_ID(), 'section_2_switch', true) != 'off') {
        ?>
    <section class="oct-magazine-section oct-magazine-section-2 oct-main-content">
        <div class="row">
            <!-- Magazine Section 2 Subsection -->
            <?php
            get_template_part('template-parts/layout/magazine', 'section-2');
            ?>
        </div>
    </section>
    <?php } ?>
    
    <?php
    /* Magazine section-3 switch */
    if (get_post_meta(get_the_ID(), 'section_3_switch', true) != 'off') {
        ?>
    <section class="oct-magazine-section oct-magazine-section-3 oct-main-content">
        <div class="row">
            <div class="col-md-4">
                <!-- Magazine Section 1 Subsection 1 -->
                <?php
                get_template_part('template-parts/layout/magazine', 'section-3-category-1');
                ?>
            </div>
            <div class="col-md-4">
                <!-- Magazine Section 1 Subsection 2 -->
                <?php
                get_template_part('template-parts/layout/magazine', 'section-3-category-2');
                ?>
            </div>

            <div class="col-md-4">
                <!-- Magazine Section 1 Subsection 3 -->
                <?php
                get_template_part('template-parts/layout/magazine', 'section-3-category-3');
                ?>
            </div>

        </div>
    </section>
    <?php } ?>
</div>
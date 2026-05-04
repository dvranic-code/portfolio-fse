<?php
/**
 * Title: Archive Work List
 * Slug: portfolio-fse/archive-work-list
 * Categories: portfolio-fse
 * Description: Query Loop for the Portfolio CPT archive. Uses inherit:true so it respects WP main query, Settings → Reading, and works automatically for taxonomy archives.
 * Keywords: archive, portfolio, query
 */
?>
<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|foreground-muted","width":"1px"},"bottom":{"color":"var:preset|color|foreground-muted","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"surface-light-alt","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-surface-light-alt-background-color has-background" style="border-top-color:var(--wp--preset--color--foreground-muted);border-top-width:1px;border-bottom-color:var(--wp--preset--color--foreground-muted);border-bottom-width:1px;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">

    <!-- Eyebrow -->
    <!-- wp:group {"align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}},"typography":{"letterSpacing":"1px"},"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"textColor":"foreground-muted","fontSize":"small","fontFamily":"mono","layout":{"type":"constrained","justifyContent":"left"}} -->
    <div class="wp-block-group alignfull has-foreground-muted-color has-text-color has-link-color has-mono-font-family has-small-font-size" style="padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);letter-spacing:1px">
        <!-- wp:paragraph -->
        <p><mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-accent-secondary-color">/</mark> ALL PROJECTS</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- Query wrapper -->
    <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">

        <!-- wp:query {"queryId":17,"query":{"perPage":10,"pages":0,"offset":0,"postType":"portfolio","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"align":"wide","layout":{"type":"constrained","contentSize":""}} -->
        <div class="wp-block-query alignwide">

            <!-- Heading row -->
            <!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
            <div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--70)">

                <!-- wp:heading {"level":1,"align":"wide"} -->
                <h1 class="wp-block-heading alignwide">Projects<mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-accent-secondary-color">.</mark></h1>
                <!-- /wp:heading -->

                <!-- wp:query-total {"displayType":"range-display","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}},"typography":{"textTransform":"lowercase"}},"textColor":"foreground-muted","fontSize":"small","fontFamily":"mono"} /-->

            </div>
            <!-- /wp:group -->

            <!-- Posts -->
            <!-- wp:post-template {"align":"wide","layout":{"type":"default"}} -->
                <!-- wp:pattern {"slug":"portfolio-fse/project-card"} /-->
            <!-- /wp:post-template -->

            <!-- No results -->
            <!-- wp:query-no-results -->
                <!-- wp:paragraph -->
                <p>No projects found.</p>
                <!-- /wp:paragraph -->
            <!-- /wp:query-no-results -->

            <!-- Pagination -->
            <!-- wp:query-pagination {"paginationArrow":"arrow","style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}},"fontFamily":"mono","layout":{"type":"flex","justifyContent":"space-between"}} -->
                <!-- wp:query-pagination-previous /-->
                <!-- wp:query-pagination-numbers /-->
                <!-- wp:query-pagination-next /-->
            <!-- /wp:query-pagination -->

        </div>
        <!-- /wp:query -->

    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->
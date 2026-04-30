<?php
/**
 * Title: Blog List
 * Slug: portfolio-fse/blog-list
 * Categories: portfolio-fse
 * Description: Blog List Loop Template.
 * Keywords: blog list, query
 */
?>
<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|foreground-muted","width":"1px"},"bottom":{"color":"var:preset|color|foreground-muted","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"surface-light-alt","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-surface-light-alt-background-color has-background" style="border-top-color:var(--wp--preset--color--foreground-muted);border-top-width:1px;border-bottom-color:var(--wp--preset--color--foreground-muted);border-bottom-width:1px;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}},"typography":{"letterSpacing":"1px"},"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"textColor":"foreground-muted","fontSize":"small","fontFamily":"mono","layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group alignfull has-foreground-muted-color has-text-color has-link-color has-mono-font-family has-small-font-size" style="padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);letter-spacing:1px"><!-- wp:paragraph -->
<p><mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-accent-secondary-color">— 04</mark> NOTES</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:query {"queryId":19,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false,"parents":[],"format":[]},"align":"wide","layout":{"type":"constrained","contentSize":""}} -->
<div class="wp-block-query alignwide"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"align":"wide"} -->
<h2 class="wp-block-heading alignwide">Writing<mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-accent-secondary-color">.</mark></h2>
<!-- /wp:heading -->

<!-- wp:group {"fontSize":"small","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
<div class="wp-block-group has-small-font-size"><!-- wp:query-total {"displayType":"range-display","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}},"typography":{"textTransform":"lowercase"}},"textColor":"foreground-muted","fontFamily":"mono"} /-->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}}},"textColor":"foreground-muted"} -->
<p class="has-foreground-muted-color has-text-color has-link-color">|</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-primary"}}}},"textColor":"accent-primary","fontFamily":"mono"} -->
<p class="has-accent-primary-color has-text-color has-link-color has-mono-font-family">→ /<a href="/blog">blog</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:post-template {"align":"wide","layout":{"type":"grid","minimumColumnWidth":"25rem"}} -->
    <!-- wp:pattern {"slug":"portfolio-fse/blog-card"} /-->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p>No Projects found...</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
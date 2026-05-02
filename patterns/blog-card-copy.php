<?php
/**
 * Title: Blog Card (Copy)
 * Slug: portfolio-fse/blog-card-copy
 * Categories: 
 */
?>
<!-- wp:group {"style":{"border":{"radius":{"topLeft":"0px","topRight":"0px","bottomLeft":"0px","bottomRight":"0px"},"width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"surface-light","borderColor":"border-light","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-border-light-border-color has-surface-light-background-color has-background" style="border-width:1px;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-left-radius:0px;border-bottom-right-radius:0px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}},"typography":{"textTransform":"lowercase"}},"textColor":"foreground-muted","fontSize":"small","fontFamily":"mono","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group has-foreground-muted-color has-text-color has-link-color has-mono-font-family has-small-font-size" style="text-transform:lowercase"><!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /-->

<!-- wp:post-terms {"term":"post_tag","prefix":"#","style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-primary"},":hover":{"color":{"text":"var:preset|color|accent-primary"}}}}},"textColor":"accent-primary"} /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background","fontSize":"x-large","fontFamily":"sans"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50"}},"border":{"top":{"color":"var:preset|color|border-light","width":"1px"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}},"typography":{"letterSpacing":"0.5px"}},"textColor":"foreground-muted","fontSize":"small","fontFamily":"mono","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group has-foreground-muted-color has-text-color has-link-color has-mono-font-family has-small-font-size" style="border-top-color:var(--wp--preset--color--border-light);border-top-width:1px;padding-top:var(--wp--preset--spacing--50);letter-spacing:0.5px"><!-- wp:post-time-to-read {"displayAsRange":false} /-->

<!-- wp:read-more {"content":"read →","style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-secondary"}}}},"textColor":"accent-secondary"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
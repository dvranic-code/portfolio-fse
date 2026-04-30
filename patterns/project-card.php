<?php
/**
 * Title: Project Card
 * Slug: portfolio-fse/project-card
 * Categories: portfolio-fse
 * Description: Single project row used inside the work-list Query Loop.
 * Keywords: project, card, portfolio, query
 * Block Types: core/post-template, core/query
 */
?>
<!-- wp:group {"className":"project-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group project-card"><!-- wp:group {"align":"wide","className":"project-row","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|60","right":"var:preset|spacing|60"}},"border":{"width":"1px"}},"backgroundColor":"surface-light","borderColor":"border-light","layout":{"type":"flex","flexWrap":"wrap","orientation":"horizontal","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide project-row has-border-color has-border-light-border-color has-surface-light-background-color has-background" style="border-width:1px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--60)"><!-- wp:group {"style":{"layout":{"selfStretch":"fill","flexSize":null},"dimensions":{"minHeight":"0%"}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="min-height:0%"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"x-large","fontFamily":"sans"} /-->

<!-- wp:post-date {"format":"Y","textAlign":"right","metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}},"border":{"width":"1px"}},"textColor":"foreground-muted","fontFamily":"mono","borderColor":"border-light"} /--></div>
<!-- /wp:group -->

<!-- wp:post-terms {"term":"project_type","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}}},"textColor":"foreground-muted","fontSize":"small"} /-->

<!-- wp:post-excerpt {"fontSize":"medium"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"layout":{"selfStretch":"fit","flexSize":null}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"technology","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}},"border":{"width":"0px","style":"none"}},"textColor":"foreground-muted","fontSize":"small","fontFamily":"mono"} /--></div>
<!-- /wp:group -->

<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"21/9","width":"","height":"","style":{"layout":{"selfStretch":"fill","flexSize":null}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
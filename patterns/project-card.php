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
<!-- wp:group {"templateLock":"contentOnly","className":"project-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group project-card"><!-- wp:group {"align":"wide","className":"project-row","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|60","right":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|50"},"border":{"width":"1px"}},"backgroundColor":"surface-light","borderColor":"border-light","layout":{"type":"flex","flexWrap":"wrap","orientation":"horizontal","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group alignwide project-row has-border-color has-border-light-border-color has-surface-light-background-color has-background" style="border-width:1px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--60)"><!-- wp:group {"className":"project-card__main","style":{"layout":{"selfStretch":"fill","flexSize":null},"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
<div class="wp-block-group project-card__main"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground"},":hover":{"color":{"text":"var:preset|color|accent-secondary"}}}}},"fontSize":"x-large","fontFamily":"sans"} /-->

<!-- wp:post-date {"format":"Y","textAlign":"right","metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}},"border":{"width":"1px"}},"textColor":"foreground-muted","fontFamily":"mono","borderColor":"border-light"} /--></div>
<!-- /wp:group -->

<!-- wp:post-terms {"term":"project_type","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}}},"textColor":"foreground-muted","fontSize":"small"} /-->

<!-- wp:post-excerpt {"fontSize":"medium"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"className":"project-card__tags","style":{"layout":{"selfStretch":"fixed","flexSize":"180px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group project-card__tags"><!-- wp:post-terms {"term":"technology","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-muted"}}},"border":{"width":"0px","style":"none"},"spacing":{"margin":{"top":"0"}}},"textColor":"foreground-muted","fontSize":"small","fontFamily":"mono"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"className":"project-card__cover","style":{"layout":{"selfStretch":"fixed","flexSize":"281px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group project-card__cover"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"21/9"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
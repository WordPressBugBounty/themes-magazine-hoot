<?php
// Get Content
global $maghoot_theme;
$maghoot_theme->topbar_left = is_active_sidebar( 'hoot-topbar-left' );
$maghoot_theme->topbar_right = is_active_sidebar( 'hoot-topbar-right' );

// Template modification Hook
do_action( 'maghoot_template_before_topbar' );

// Display Topbar
$maghoot_topbar_left = $maghoot_theme->topbar_left;
$maghoot_topbar_right = $maghoot_theme->topbar_right;
if ( !empty( $maghoot_topbar_left ) || !empty( $maghoot_topbar_right ) ) :

	?>
	<div <?php hybridextend_attr( 'topbar', '', 'inline-nav social-icons-invert hgrid-stretch' ); ?>>
		<div class="hgrid">
			<div class="hgrid-span-12">

				<div class="topbar-inner table">
					<?php if ( $maghoot_topbar_left ): ?>
						<div id="topbar-left" class="table-cell-mid">
							<?php dynamic_sidebar( 'hoot-topbar-left' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $maghoot_topbar_right ): ?>
						<div id="topbar-right" class="table-cell-mid">
							<div class="topbar-right-inner">
								<?php
								dynamic_sidebar( 'hoot-topbar-right' );
								?>
							</div>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</div>
	<?php

endif;

// Template modification Hook
do_action( 'maghoot_template_after_topbar' );
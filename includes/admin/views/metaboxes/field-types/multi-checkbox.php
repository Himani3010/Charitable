<?php
/**
 * Display radio field.
 *
 * @author      Eric Daams
 * @package     Charitable/Admin Views/Metaboxes
 * @copyright   Copyright (c) 2018, Studio 164a
 * @since       1.6.7
 * @version     1.6.7
 */

if ( ! array_key_exists( 'form_view', $view_args ) || ! $view_args['form_view']->field_has_required_args( $view_args ) ) {
	return;
}

?>
<div id="<?php echo esc_attr( $view_args['wrapper_id'] ); ?>" class="<?php echo esc_attr( $view_args['wrapper_class'] ); ?>">
	<?php if ( isset( $view_args['label'] ) ) : ?>
		<label for="<?php echo esc_attr( $view_args['id'] ); ?>" id="charitable_field_<?php echo esc_attr( $view_args['key'] ); ?>_label">
			<?php echo esc_html( $view_args['label'] ); ?>
		</label>
	<?php endif ?>
	<ul class="charitable-checkbox-list options">
	<?php foreach ( $view_args['options'] as $key => $option ) : ?>
		<li><input type="checkbox"
				id="<?php echo esc_attr( $view_args['key'] . '-' . $key ); ?>"
				name="<?php echo esc_attr( $view_args['key'] ); ?>[]"
				value="<?php echo esc_attr( $key ); ?>"
				aria-describedby="charitable_field_<?php echo esc_attr( $view_args['key'] ); ?>_label"
				<?php checked( in_array( $key, $view_args['value'] ) ); ?>
			/>
			<label for="<?php echo esc_attr( $view_args['key'] . '-' . $key ); ?>"><?php echo $option; ?></label>
		</li>
	<?php endforeach ?>
	</ul>
	<?php if ( isset( $view_args['description'] ) ) : ?>
		<span class="charitable-helper"><?php echo esc_html( $view_args['description'] ); ?></span>
	<?php endif ?>
</div><!-- #<?php echo $view_args['wrapper_id']; ?> -->

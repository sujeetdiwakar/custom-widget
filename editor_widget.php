<?php
class Contributor_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'contributor_widget',
			esc_html__( 'Contributor Widget', 'contributor_widget' ),
			[ 'description' => esc_html__( 'Contributor Widget', 'contributor_widget' ), ]
		);
	}

	public function widget( $args, $instance ) {
		$widget_id = 'widget_' . $args['widget_id'];
		require( locate_template( 'template-parts/widget-' . 'contributor.php' ) );
	}

	public function form( $instance ) {
		$title_field_name = 'title';
		
		$er_id=$instance["er_id"];
		
		$editor_id=$this->get_field_name("er_id");
		
		$argss = [
				'role' => 'Editor',
				'orderby' => 'post_count',
				'order'   => 'DESC',
				'number'  => 3

			];

		$wp_user_q = new WP_User_Query( $argss );
		//print_r($wp_user_q->results);
		?>

		<select id="<?php echo $this->get_field_id( 'er_id' ); ?>" name="<?php echo $this->get_field_name( 'er_id' ); ?>">
			<?php 
			if($wp_user_q->results):
			echo "<option value=''>Select Editor</option>";
			foreach ( $wp_user_q->results as $u ): ?>
            <option value='<?php echo $u->ID; ?>' <?php echo( $u->ID ==  $er_id )?'selected':''; ?>>
				<?php echo $u->display_name; ?>
			</option>
			<?php endforeach; endif; ?>
            </select>
			<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance["er_id"]=$new_instance["er_id"];
		
		
		//Return back to the environment
		return $instance;
	}
}
?>



<?php
//template file
extract($args);
		extract($instance);
		echo $er_id;
?>

		<secction class="row profile-list">

			<secction class="col-xs-3">
				<img src="<?php echo get_avatar_url( $er_id ); ?>" alt="<?php  ?>">
				<?php 
				$user_info = get_userdata($er_id);
			
				echo $user_info->display_name; ?>
			</secction>

			

		</secction>


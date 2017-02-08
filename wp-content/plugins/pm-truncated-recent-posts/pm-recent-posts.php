<?php
/*
Plugin Name: PM Truncated Recent Posts
Plugin URI: https://pmclain.com/truncated-recent-posts-widget-for-wordpress.html 
Description: Recent posts widget with ability to truncate post titles.
Author: Patrick McLain
Version: 1.0
Author URI: http://www.pmclain.com
License: GLP3

PM Truncated Recent Posts is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.
 
PM Truncated Recent Posts is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with PM Truncated Recent Posts. If not, see http://www.gnu.org/licenses/gpl-3.0.en.html.
*/

// Block direct requests
if ( !defined('ABSPATH'))
	die('-1');
	
	
add_action( 'widgets_init', function(){
     register_widget( 'PM_Recent_Posts' );
});	
/**
 * Adds My_Widget widget.
 */
class PM_Recent_Posts extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'PM_Recent_Posts', // Base ID
			'Recent Posts, Truncated', // Name
			array( 'description' => 'Truncate recent post titles.', ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	
    echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		
    $number = $instance['number'];
    $limit = $instance['limit'];
    $pad = $instance['pad'];
    $query = array('showposts' => $number,
                    'nopaging' => 0,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => 1);
    
    $r = new WP_Query($query); ?>
    
    <ul>
    
    <?php    
    while ($r->have_posts()) : $r->the_post(); ?>
    <li>
      <a href="<?php the_permalink() ?>" title="<?php esc_attr(get_the_title() ? get_the_title() : get_the_ID()) ?>">
      <?php
      $title = get_the_title();
      
      if (strlen($title) <= $limit) {
        echo $title;
      } else {
        echo substr($title, 0, $limit) . $pad;
      }
      ?>
      </a>
    </li>
    <?php endwhile; ?>
    
  </ul>
    
	<?php	echo $args['after_widget']; 
    
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('Recent Posts','text_domain');
		}
    
    if (isset($instance['number'])) {
      $number = $instance['number'];
    } else {
      $number = 5;
    }
    
    if (isset($instance['limit'])) {
      $limit = $instance['limit'];
    } else {
      $limit = 20;
    }
    
    if (isset($instance['pad'])) {
      $pad = $instance['pad'];
    } else {
      $pad = '...';
    }
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Title max characters:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>">
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'pad' ); ?>"><?php _e( 'Truncate padding:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'pad' ); ?>" name="<?php echo $this->get_field_name( 'pad' ); ?>" type="text" value="<?php echo esc_attr( $pad ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : 'Recent Posts';
    $instance['number'] = (!empty($new_instance['number'])) ? strip_tags($new_instance['number']) : $old_instance['number'];
    $instance['limit'] = (!empty($new_instance['limit'])) ? strip_tags($new_instance['limit']) : $old_instance['limit'];
    $instance['pad'] = (!empty($new_instance['pad'])) ? strip_tags($new_instance['pad']) : $old_instance['pad'];
		return $instance;
	}
} // class My_Widget

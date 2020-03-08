<div class="pinglun" id="weilaiComments">

	<ol class="comment-list">
          <?php 

		$current_id = get_queried_object_id(); //这里是文章的ID

		$comments = get_comments(array(
			'post_id' => $current_id,
			'status' => 'approve' //Change this to the type of comments to be displayed
		));

		 wp_list_comments('type=comment&callback=mytheme_comment',$comments) ?>
	</ol>
</div>



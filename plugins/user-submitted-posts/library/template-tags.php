<?php // User Submitted Posts - Template Tags

if (!defined('ABSPATH')) die();



/* 
	Returns a boolean value indicating whether the specified post is a public submission
	Usage: <?php if (function_exists('usp_is_public_submission')) usp_is_public_submission(); ?>
*/
function usp_is_public_submission($postId = false) {
	
	global $post;
	
	if (false === $postId) {
		
		if ($post) $postId = $post->ID;
		
	}
	
	if (get_post_meta($postId, 'is_submission', true) == true) {
		
		return true;
		
	}
	
	return false;
	
}



/* 
	Returns an array of URLs for the specified post image
	Usage: <?php $images = usp_get_post_images(); foreach ($images as $image) { echo $image; } ?>
*/
function usp_get_post_images($postId = false) {
	
	global $post;
	
	if (false === $postId) {
		
		if ($post) $postId = $post->ID;
		
	}
	
	if (usp_is_public_submission($postId)) {
		
		return get_post_meta($postId, 'user_submit_image');
		
	}
	
	return array();
	
}



/*
	Prints the URLs for all post attachments.
	Usage:  <?php if (function_exists('usp_post_attachments')) usp_post_attachments(); ?>
	Syntax: <?php if (function_exists('usp_post_attachments')) usp_post_attachments($size, $beforeUrl, $afterUrl, $numberImages, $postId); ?>
	Parameters:
		$size         = image size as thumbnail, medium, large or full -> default = full
		$beforeUrl    = text/markup displayed before the image URL     -> default = <img src="
		$afterUrl     = text/markup displayed after the image URL      -> default = " />
		$numberImages = the number of images to display for each post  -> default = false (display all)
		$postId       = an optional post ID to use                     -> default = uses global post
*/
function usp_post_attachments($size = 'full', $beforeUrl = '<img src="', $afterUrl = '" />', $numberImages = false, $postId = false) {
	
	global $post;
	
	if (false === $postId) {
		
		if ($post) $postId = $post->ID;
		
	}
	
	if (false === $numberImages || !is_numeric($numberImages)) {
		
		$numberImages = 99;
		
	}
	
	$args = array(
		'post_type'   => 'attachment', 
		'post_parent' => $postId, 
		'post_status' => 'inherit', 
		'numberposts' => $numberImages
	);
	
	$attachments = get_posts($args);
	
	foreach ($attachments as $attachment) {
		
		$info = wp_get_attachment_image_src($attachment->ID, $size);

		echo $beforeUrl . $info[0] . $afterUrl;
		
	}
	
}



/*
	For public-submitted posts, this tag displays the author's name as a link (if URL provided) or plain text (if URL not provided)
	For normal posts, this tag displays the author's name as a link to their author's post page
	Usage: <?php if (function_exists('usp_author_link')) usp_author_link(); ?>
*/
function usp_author_link() {
	
	global $post;

	$isSubmission     = get_post_meta($post->ID, 'is_submission', true);
	$submissionAuthor = get_post_meta($post->ID, 'user_submit_name', true);
	$submissionLink   = get_post_meta($post->ID, 'user_submit_url', true);

	if ($isSubmission && !empty($submissionAuthor)) {
		
		if (empty($submissionLink)) {
			
			echo '<span class="usp-author-link">' . $submissionAuthor . '</span>';
			
		} else {
			
			echo '<span class="usp-author-link"><a href="' . $submissionLink . '">' . $submissionAuthor . '</a></span>';
			
		}
		
	} else {
		
		the_author_posts_link();
		
	}
	
}

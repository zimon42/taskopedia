<?php

include_once("LoginHandler.php");

class TopicRenderer {
	
	public static function render($topic) {
		
		$html = "";
		$html .= "<h3>Forum Topic: ".$topic["title"]."</h3>";
		
		$html .= self::renderNewReplyButton($topic);
		
		$html .= "<table id=topic_table cellspacing=0><tbody>";
		
		$posts = self::getPosts($topic);
		
		// Render posts
		for ($i=0; $i<count($posts); $i++) {
			$post = $posts[$i];
			$html .= self::renderPost($topic, $post, $i);
		}
		
		$html .= "</tbody></table><br>";
		
		$html .= self::renderNewReplyButton($topic);		
		
		return $html;
		
	}
	
	// Need postIndex argment to separate edit_topic from
	// edit_reply edit button handler
	
	// Need topic argment when calling edit_reply. Note that
	// topic and post argument can refer to the same post
	
	public static function renderPost($topic, $post, $postIndex) {
		$html = "";
		$html .= <<<HTML
<tr>
	<td rowspan="2" valign="top" class="td_left">
		<img src="forum_avatar.png">
		<br>
		{$post["user"]}
	</td>
	<td class="td_top_right" valign="top">
		<span class=date>{$post["date"]}</span>
		<br>
		{$post["content"]}
	</td>
</tr>
<tr>
	<td class="td_bottom_right" valign=bottom align=right>
HTML;
		if (LoginHandler::userIsLoggedIn() && LoginHandler::loggedInUserName()==$post["user"]) {
			$html .= self::renderEditButton($topic, $post, $postIndex);
		}
		
		$html .= <<<HTML
	</td>
</tr>		
HTML;
		return $html;
	}
	
	// Concatenates topic with reply list
	
	public static function getPosts($topic) {
		$post = $topic;
		$posts = $topic["replies"];
		array_unshift($posts,$post);
		return $posts;
	}
	
	// Note that data-topic-id and data-post-id can be the same
	// if post is topic
	
	public static function renderEditButton($topic, $post, $postIndex) {
		$postId = $postIndex == 0 ? $post["topic_id"] : $post["reply_id"];
		$html = "<button class=edit_post_button ";
		$html .= "data-topic-id={$topic["topic_id"]} ";
		$html .= "data-post-id={$postId} ";
		$html .= "data-post-index={$postIndex} ";
		$html .= ">Edit</button>";
		return $html;
	}
	
	public static function renderNewReplyButton($topic) {
		return "<button class=new_reply_button data-topic-id={$topic["topic_id"]}>New reply</button><br><br>";
	}
	
}

?>
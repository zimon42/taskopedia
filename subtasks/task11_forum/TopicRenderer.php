<?php

class TopicRenderer {
	
	public static function render($topic) {
		
		$html = "";
		$html .= "<h3>Forum Topic: ".$topic["title"]."</h3>";
		
		$html .= "<table id=topic_table cellspacing=0><tbody>";
		
		$posts = self::getPosts($topic);
		
		// Render posts
		for ($i=0; $i<count($posts); $i++) {
			$post = $posts[$i];
			$html .= self::renderPost($post);
		}
		
		$html .= "</tbody></table>";
		
		return $html;
		
	}
	
	public static function renderPost($post) {
		return <<<HTML
<tr>
	<td rowspan="2" valign="top" class="td_left">
		<img src="forum_avatar.png">
		<br>
		{$post["user"]}
	</td>
	<td class="td_top_right">
		{$post["date"]}
	</td>
</tr>
<tr>
	<td class="td_bottom_right">
		<button>Edit</button>
	</td>
</tr>		
HTML;
	}
	
	// Concatenates topic with reply list
	public static function getPosts($topic) {
		$post = $topic;
		$posts = $topic["replies"];
		array_unshift($posts,$post);
		return $posts;
	}
	
}

?>
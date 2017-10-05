<?php
if ($style == 'table'):

    if ($show_header):
        $html .= '<div class="wps_forum_posts_header">';

            // Any more column headers? (apply float:right)
            $html = apply_filters( 'wps_forum_post_columns_header_filter', $html, $term->term_id, $atts );

            $html .= '<div class="wps_forum_title_header">'.$header_title.'</div>';
            if ($show_freshness) $html .= '<div class="wps_forum_categories_freshness_header">'.$header_freshness.'</div>';    
            if ($show_last_activity) $html .= '<div class="wps_forum_last_poster_header">'.$header_last_activity.'</div>';
            if ($show_count) $html .= '<div class="wps_forum_count_header">'.$header_count.'</div>';
        $html .= '</div>';
    endif;

    // Get previous login
    $last_logged_in = wps_get_previous_login($current_user->ID);

    $html .= '<div class="'.$slug.' wps_forum_posts">';

        // ... carry on
		$c = 0;
		foreach ($forum_posts as $forum_post):

			if ($forum_post['post_status'] == 'publish' || current_user_can('edit_posts') || $forum_post['post_author'] = $current_user->ID):
// echo '<span style="color:red">'.$forum_post['post_title'].'</span><br />';
// var_dump($forum_post['read']);

				// read it?
                $read = get_post_meta( $forum_post['ID'], 'wps_forum_read', true );
                if (!$read || (!in_array($current_user->user_login, $read) && !in_array($current_user->ID, $read))):
                    $forum_post['read'] = false;
// echo 'NOT READ<br />';
// var_dump($read);
                endif;
                // new?
                if ($forum_post['post_author'] != $current_user->ID && wps_since_last_logged_in($forum_post[$base_date], $new_seconds)):
// var_dump($forum_post['read']);
                    if (!$new_item_read || ($new_item_read && !$forum_post['read'])):
// echo ($forum_post['read'] ? 'y' : 'n').'<br />';
                        $forum_post['new'] = true;
// echo 'new since previous login, so mark as new<br />';
                    endif;
                endif;

				$c++;
				$args = array(
					'status' => 1,
					'orderby' => 'comment_ID',
					'order' => 'DESC',
					'post_id' => $forum_post['ID'],
                    'parent' => 0 // set to 0 to exlude comments to replies
				);
				$comments = get_comments($args);

				// set to following as default (ie. original post creator)
				$author = wps_display_name(array('user_id'=>$forum_post['post_author'], 'link'=>1));
                $author_id = $forum_post['post_author'];
				$created = sprintf($date_format, human_time_diff(strtotime($forum_post[$base_date]), current_time('timestamp', 1)), WPS2_TEXT_DOMAIN);
				$comment_date = false;  // set in case nothing to show

				// now we need to check for new replies and comments and update the above if need be
                $reply_count = 0;
                $checked_date = 0; // keep track if already checked a later date

				if ($comments):
                    $comments_ptr = 0;
                    foreach($comments as $comment): // loop through replies
// echo '<strong>'.$comment->comment_content.'</strong><br />';
                        // check to see if involved in all the comments to this reply
                        $args = array(
                            'status' => 1,
                            'orderby' => 'comment_ID',
                            'order' => 'DESC',
                            'post_id' => $forum_post['ID'],
                            'offset' => 0,
                            'number' => 100,
                            'parent' => $comment->comment_ID
                        );
                        $subcomments = get_comments($args); 
                        $involved_in_replies = false;
                        if ($subcomments):
// echo 'comment authors...<br />';
                            foreach ($subcomments as $subcomment):
// echo $current_user->ID.'-'.$subcomment->user_id.'<br />';
                                if ($subcomment->user_id == $current_user->ID) $involved_in_replies = true;
                            endforeach;
                        endif;
                        reset($subcomments);
// echo 'involved? '.($involved_in_replies ? 'YES' : 'NO').'<br />';
// echo 'original poster? '.($current_user->ID == $forum_post['post_author'] ? 'YES' : 'NO').'<br />';
// echo 'reply author? '.($comment->user_id == $current_user->ID ? 'YES' : 'NO').'<br />';
                        $private = get_comment_meta( $comment->comment_ID, 'wps_private_post', true );
// echo 'private? '.($private ? 'YES' : 'NO').'<br />';
                    	if ($comment->user_id): // not an auto-close comment
                            // .. reply is applicable if current user is post author, or the reply author or involved in comments (or not a private reply)
	                        $private = get_comment_meta( $comment->comment_ID, 'wps_private_post', true );
	                        if ($involved_in_replies || !$private || $current_user->ID == $forum_post['post_author'] || $comment->user_id == $current_user->ID):
// echo 'reply is applicable (or post author, etc)<br />';
                                if (!$comments_ptr):
// echo 'tracking first reply<br />';
                                    // .. track the first reply found (as ordered to first is latest)
                                    $comment_author = $comment->user_id;
                                    $author = wps_display_name(array('user_id'=>$comment_author, 'link'=>1));
// echo 'first reply author set to '.$author.'<br>';                                    
                                    $author_id = $comment_author;
                                    $comment_date = $base_date == 'post_date_gmt' ? $comment->comment_date_gmt : $comment->comment_date;
                                    $created = sprintf($date_format, human_time_diff(strtotime($comment_date), current_time('timestamp', 1)), WPS2_TEXT_DOMAIN);
                                    $checked_date = $comment_date;
									$read = get_comment_meta( $comment->comment_ID, 'wps_forum_reply_read', true );
									$new_topic_reply = ( !$read || (!in_array($current_user->user_login, $read) && !in_array($current_user->ID, $read)) );
                                    if ($comment_author != $current_user->ID && $new_topic_reply):
                                    	$forum_post['read'] = false;
// echo 'not read the reply, so mark as new<br />';
									endif;
                                    if ($comment_author != $current_user->ID && wps_since_last_logged_in($comment_date, $new_seconds)):
                                        if (!$new_item_read || ($new_item_read && !$forum_post['read'])) $forum_post['new'] = true;
// echo 'new reply since previous login, so mark as new<br />';
                                    endif;

                                endif;
                                // Now check if any comments on replies are more recent than the stored reply
                                if ($subcomments):
// echo 'checking comments on this reply...<br />';
                                    foreach ($subcomments as $subcomment):
                                        $subcomment_date = $base_date == 'post_date_gmt' ? $subcomment->comment_date_gmt : $subcomment->comment_date;
// echo '<span style="color:orange">'.$subcomment->comment_content.' ('.$subcomment_date.':'.$checked_date.')</span><br />';
                                        if ($subcomment_date > $checked_date):
// echo '<span style="color:green">newer comment... '.$subcomment->comment_content.'</span> '.$subcomment_date.' '.$checked_date.'<br />';
                                            $subcomment_author = $subcomment->user_id;
                                            $comment_author = $subcomment_author;
                                            $author = wps_display_name(array('user_id'=>$subcomment_author, 'link'=>1));
                                            $author_id = $subcomment_author;
// echo 'set to '.$author.'<br />';
                                            $comment_date = $subcomment_date;
                                            $created = sprintf($date_format, human_time_diff(strtotime($subcomment_date), current_time('timestamp', 1)), WPS2_TEXT_DOMAIN);
                                            $checked_date = $subcomment_date; // to check against next loop
                                        	$read = get_comment_meta( $subcomment->comment_ID, 'wps_forum_comment_read', true );
                                            $new_reply_comment = ( !$read || (!in_array($current_user->user_login, $read) && !in_array($current_user->ID, $read)) );
                                        	if ($subcomment_author != $current_user->ID && $new_reply_comment):
                                        		$forum_post['read'] = false;
// echo 'not read the comment, so mark as unread<br />';
											endif;      
                                            if ($subcomment_author != $current_user->ID && wps_since_last_logged_in($subcomment_date, $new_seconds)):
                                                if (!$new_item_read || ($new_item_read && !$forum_post['read'])) $forum_post['new'] = true;
// echo 'new since previous login, so mark as new<br />';
                                            endif;
                                        endif;
                                    endforeach;
                                else:
// echo 'no comments on this reply<br />';
                                endif;
                                $reply_count++; // increase count of replies
                                $comments_ptr++;
	                        endif;
	                    endif;
                    endforeach;
				else:
					$author = wps_display_name(array('user_id'=>$forum_post['post_author'], 'link'=>1));
                    $author_id = $forum_post['post_author'];
					$created = sprintf($date_format, human_time_diff(strtotime($forum_post[$base_date]), current_time('timestamp', 1)), WPS2_TEXT_DOMAIN);
				endif;

                // if last activity is current user, can't be new
                if ($author_id == $current_user->ID || !is_user_logged_in()) $forum_post['read'] = true;
// echo 'reply count:'.$reply_count.'<br />';
// echo 'show as new? '.(!$forum_post['read'] ? 'NEW' : 'read').'<br />';


				$forum_html = '';

				$forum_html .= '<div class="wps_forum_post';
                        if ($forum_post['new']) $forum_html .= ' wps_forum_post_new_table';
						if ($forum_post['comment_status'] == 'closed') $forum_html .= ' wps_forum_post_closed';
						if ($forum_post['is_sticky']) $forum_html .= ' wps_forum_post_sticky';
					$forum_html .= '"'; // end of class

					// Hide if closed and chosen not to show
					if ($closed_switch && $forum_post['comment_status'] == 'closed' && $closed_switch_state == 'off' && !$forum_post['is_sticky']) $forum_html .= ' style="display:none"';

					$forum_html .= '>'; // end of opening div
    
					// Any more columns? (apply float:right)
					$forum_html = apply_filters( 'wps_forum_post_columns_filter', $forum_html, $forum_post['ID'], $atts );

					$forum_html .= '<div class="wps_forum_title';
						if (!$forum_post['read']) $forum_html .= ' wps_forum_post_unread';
						if ($reply_icon && $forum_post['commented']) $forum_html .= ' wps_forum_post_commented';
						$forum_html .= '">';
						if ($forum_post['comment_status'] == 'closed' && $closed_prefix) $forum_html .= '['.$closed_prefix.'] ';
						if ($forum_post['post_status'] == 'publish'):

                            global $blog;
							if ( wps_using_permalinks() ):
								if (!is_multisite()):
									$url = get_bloginfo('url').'/'.$slug.'/'.$forum_post['post_name'];
								else:
									$blog_details = get_blog_details(get_current_blog_id());
									$url = $blog_details->path.$slug.'/'.$forum_post['post_name'];
								endif;
							else:
								if (!is_multisite()):
									$forum_page_id = wps_get_term_meta($term->term_id, 'wps_forum_cat_page', true);
									$url = get_bloginfo('url')."/?page_id=".$forum_page_id."&topic=".$forum_post['post_name'];
								else:
									$forum_page_id = wps_get_term_meta($term->term_id, 'wps_forum_cat_page', true);
									$blog_details = get_blog_details(get_current_blog_id());
									$url = $blog_details->path."?page_id=".$forum_page_id."&topic=".$forum_post['post_name'];
								endif;
							endif;
							
                            $forum_title = esc_attr($forum_post['post_title']);
                            $forum_title = str_replace(array_keys(array('[' => '&#91;',']' => '&#93;','<' => '&lt;','>' => '&gt;',)), array_values(array('[' => '&#91;',']' => '&#93;','<' => '&lt;','>' => '&gt;',)), $forum_title);  
                            if (strlen($forum_title) > $title_length) $forum_title = substr($forum_title, 0, $title_length).'...';
                            $multiline = (strpos($forum_title, chr(10)) !== false) ? true : false;
                            if ($multiline) $forum_title = str_replace(chr(10), '<br />', $forum_title);
							$forum_html .= '<a href="'.$url.'">'.$forum_title.'</a>';
							if ($show_originator):
                                $the_user = get_user_by('id', $forum_post['post_author']);
                                if ($the_user)
								    $forum_html .= sprintf($originator, wps_display_name(array('user_id'=>$forum_post['post_author'], 'link'=>1)));
							endif;
						else:
                            $forum_title = esc_attr($forum_post['post_title']);
                            $forum_title = str_replace(array_keys(array('[' => '&#91;',']' => '&#93;','<' => '&lt;','>' => '&gt;',)), array_values(array('[' => '&#91;',']' => '&#93;','<' => '&lt;','>' => '&gt;',)), $forum_title);  
							$forum_html .= $forum_title.$pending;						
						endif;

                        // New label?
                        if ($forum_post['new']) $forum_html .= ' <span class="wps_forum_new_label">'.convert_smilies($new_item_label).'</span>';

                        // Filter for suffix after name
                        $forum_html = apply_filters( 'wps_forum_post_name_filter', $forum_html, $forum_post['ID'] );

					$forum_html .= '</div>';
					if ($show_freshness):
						$forum_html .= '<div class="wps_forum_freshness">';
						$forum_html .= $created ? $created : '&nbsp;';
						$forum_html .= '</div>';
					endif;
					if ($show_last_activity):
						$forum_html .= '<div class="wps_forum_last_poster">';
						$forum_html .= $author ? $author : '&nbsp;';
						$forum_html .= '</div>';
					endif;
					if ($show_count):
						$forum_html .= '<div class="wps_forum_count">';
						$forum_html .= $reply_count;
						$forum_html .= '</div>';
					endif;

				$forum_html .= '</div>';

				$forum_html = apply_filters( 'wps_forum_post_item', $forum_html );
				$html .= $forum_html;

			endif;

			if ($c == $count) break;

		endforeach;

	$html .= '</div>';
    
endif;
?>
<?php

function highlight_result_text($text, $query, $size = 200, $highlighter = '<strong class="highlight">%s</strong>')
{
  return highlight_lucene_results($text, $query, $highlighter);
}

function highlight_keywords($text, $keywords, $highlighter = '<strong class="highlight">%s</strong>')
{

  return highlight_lucene_results($text, $keywords, $highlighter);
}

function highlight_lucene_results($content, $term, $highlighter){
  $content_length = mb_strlen($content);
  $term_length = mb_strlen($term);
  $next_chars_blacklist = array_merge(range('a', 'z'), array('ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'œ', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'þ', 'ÿ'));
  for ($position = stripos($content, $term); $position !== false; $position = stripos($content, $term, $position)){
      $lowerContent = mb_strtolower($content);

      if (
        !in_array(mb_strtolower(mb_substr($content, $position + $term_length, 1)), $next_chars_blacklist) &&
        ($position == 0 || !in_array(mb_strtolower(mb_substr($content, $position - 1, 1)), $next_chars_blacklist)) &&
        substr_count($lowerContent, '<textarea', $position + $term_length) == substr_count($lowerContent, '</textarea>', $position + $term_length) &&
        substr_count($content, '>', $position + $term_length) == substr_count($content, '<', $position + $term_length) // in well formed x/html, the carat count must be the same after the string to indicate that we're outside of an tag
      )
      {
        // we have to do our replacement manually... hold on

        $prefix = mb_substr($content, 0, $position);
        $suffix = mb_substr($content, $position + $term_length);

        $term_hit = mb_substr($content, $position, $term_length);
        $new_term = sprintf($highlighter, $term_hit);
        $new_term_length = mb_strlen($new_term);

        $content = $prefix .  $new_term . $suffix;

        $content_length = $content_length + $new_term_length - $term_length;

        $position += $new_term_length;
      }
      else
      {
        $position += $term_length;
      }
    }
  
  return $content;
}

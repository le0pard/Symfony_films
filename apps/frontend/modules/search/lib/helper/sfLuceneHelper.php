<?php

function highlight_result_text($text, $query, $size = 200, $highlighter = '<strong class="highlight">%s</strong>')
{
  $h = new sfLuceneHighlighter($text);
  $h->addKeywordSlug($query);
  $h->addHighlighter($highlighter);
  $h->hasBody(false);
  $h->densityCrop($size);
  return $h->highlight();
}

function highlight_keywords($text, $keywords, $highlighter = '<strong class="highlight">%s</strong>')
{
  $h = new sfLuceneHighlighter($text);
  $h->addKeywordSlug($keywords);
  $h->addHighlighter($highlighter);
  $h->hasBody(false);

  return $h->highlight();
}

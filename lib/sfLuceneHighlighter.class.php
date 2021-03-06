<?php
/*
 * This file is part of the sfLucenePlugin package
 * (c) 2007 Carl Vondrick <carlv@carlsoft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Provides a universal highligher for the plugin that can automatically work
 * around HTML code.  This highlighter will only highlight text in the body,
 * not inside an HTML tag, and not inside a text area.
 *
 * @package    sfLucenePlugin
 * @subpackage Utilities
 * @author     Carl Vondrick <carlv@carlsoft.net>
 */

class sfLuceneHighlighter
{
  protected $content;

  protected $keywords = array();

  protected $highlighters = array();

  protected $hasBody = true;

  protected $blacklist = array();

  /**
   * Constructor.
   * @param string $content The content to higlight
   */
  public function __construct($content, $blacklist = null)
  {
    $this->content = $content;

    if ($blacklist == null)
    {
      $this->blacklist = array_merge(range('a', 'z'), array('ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'œ', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'þ', 'ÿ'));
    }

    elseif (!is_array($blacklist))
    {
      throw new sfLuceneHighterException('Word characters must be null or an array');
    }
    else
    {
      $this->blacklist = $blacklist;
    }
  }

  /**
   * Prepares and validates the content for highlighting based off configuration
   */
  protected function prepare()
  {
    $response = mb_substr_count($this->content, '>') == mb_substr_count($this->content, '<');

    if ($this->hasBody)
    {
      $response = $response && mb_substr_count($this->content, '<body') == 1 && mb_substr_count($this->content, '</body>') == 1;
    }

    if (!$response)
    {
      throw new sfLuceneHighlighterException('Highlighting failed because content is malformed X/HTML');
    }

    $this->keywords = array_unique($this->keywords);

    if (count($this->highlighters) == 0)
    {
      $this->addHighlighter('<strong>%s</strong>');
    }
  }

  public function getContent()
  {
    return $this->content;
  }

  /**
   * Adds a keyword
   */
  public function addKeyword($keyword)
  {
    $this->keywords[] = $keyword;

    return $this;
  }

  /**
   * Adds an array of keywords
   */
  public function addKeywords($keywords)
  {
    foreach ($keywords as $keyword)
    {
      $this->addKeyword($keyword);
    }

    return $this;
  }

  /**
   * Adds keywords from slug
   */
  public function addKeywordSlug($slug)
  {
    //$this->addKeywords(str_word_count($slug, 2, implode($this->blacklist, '')));
	$this->addKeywords(str_word_count_utf8($slug, 2));
    return $this;
  }

  /**
   * Adds a possible highlight string
   */
  public function addHighlighter($highlighter)
  {
    $this->highlighters[] = $highlighter;

    return $this;
  }

  /**
   * Adds an array of highlighters
   */
  public function addHighlighters($highlighters)
  {
    foreach ($highlighters as $highlighter)
    {
      $this->addHighlighter($highlighter);
    }

    return $this;
  }

  /**
   * Enables/disables whether if a the content contains a body element
   * @param bool $has If true, content should have body tags
   */
  public function hasBody($has)
  {
    $this->hasBody = (bool) $has;

    return $this;
  }

  /**
   * Strips all the tags from the content
   */
  public function stripTags()
  {
    $this->content = strip_tags($this->content);

    return $this;
  }

  /**
   * Crops the content by finding the section with the highest keyword density
   * within the specified $length.
   */
  public function densityCrop($size, $dots = '...')
  {
    // handling HTML will horribly slow this down, so we strip it out.
    // maybe add HTML support later??
    $this->stripTags();

    // first we build an index of all the keywords
    $index = array();
    $length = mb_strlen($this->content);
    $radius = floor($size / 2);

    $blacklist = $this->blacklist;

    foreach ($this->keywords as $keyword)
    {
      $keywordLength = mb_strlen($keyword);

      for ($position = mb_stripos($this->content, $keyword); $position !== false; $position += $keywordLength, $position = mb_stripos($this->content, $keyword, $position))
      {
        if (!in_array(mb_strtolower(mb_substr($this->content, $position + $keywordLength, 1)), $blacklist) &&
        !in_array(mb_strtolower(mb_substr($this->content, $position - 1, 1)), $blacklist) &&
        substr_count($this->content, '>', $position + $keywordLength) == substr_count($this->content, '<', $position + $keywordLength) // in well formed x/html, the carat count must be the same after the string to indicate that we're outside of an tag
        )
        {
          $index[] = array('position' => $position, 'word' => $keyword);
        }
      }
    }

    $bestDensity = 0;
    $bestLeft = 0;

    // then we search for the best density across $size

    foreach ($index as $indexItem)
    {
      $position = $indexItem['position'];

      if ($position < $radius)
      {
        $left = 0;
      }
      elseif ($position - $length > $radius)
      {
        $left = $position - $size;
      }
      else
      {
        $left = $position - $radius + floor(mb_strlen($indexItem['word']) / 2);
      }

      $currentDensityCount = 0;

      for ($x = 0, $c = count($index); $x < $c; $x++)
      {
        if ($index[$x]['position'] >= $left && $index[$x]['position'] <= $left + $size)
        {
          $currentDensityCount++;
        }
      }

      if ($currentDensityCount > $bestDensity)
      {
        $bestDensity = $currentDensityCount;
        $bestLeft = $left;
      }
    }

    $oldLeft = $bestLeft;

    // recalculate best left
    for ($offset = 1; true; $offset++)
    {
      if ($bestLeft - $offset >= 0 && in_array(mb_strtolower(mb_substr($this->content, $bestLeft - $offset, 1)), $this->blacklist))
      {
        continue;
      }
      else
      {
        $bestLeft = $bestLeft - $offset + 1;
        break;
      }
    }

    // recalculate size
    for ($offset = 1; true; $offset++)
    {
      if ($oldLeft + $size + $offset < $length && in_array(mb_strtolower(mb_substr($this->content, $oldLeft + $size + $offset, 1)), $this->blacklist))
      {
        continue;
      }
      else
      {
        $size = $size + $offset - 2;
        break;
      }
    }

    $newContent = trim(mb_substr($this->content, $bestLeft, $size));

    if ($bestLeft + $size < $length)
    {
      $newContent .= $dots;
    }

    if ($bestLeft > 0)
    {
      $newContent = $dots . $newContent;
    }

    $this->content = $newContent;

    return $this;
  }

  /**
   * Does the actual highlighting and returns the string.
   * This is based off the configuration settings so far.
   */
  public function highlight()
  {
    $this->prepare();

    $prefix = '';
    $suffix = '';

    if ($this->hasBody)
    {
      $body_start = mb_stripos($this->content, '<body');
      $body_end = mb_stripos($this->content, '</body>') + mb_strlen('</body>');

      $prefix = mb_substr($this->content, 0, $body_start);
      $suffix = mb_substr($this->content, $body_end);
      $this->content = mb_substr($this->content, $body_start, $body_end - $body_start);
    }

    for ($x = 0, $c = count($this->keywords); $x < $c; $x++)
    {
      $this->highlightTerm($this->keywords[$x], $x);
    }

    $this->content = $prefix . $this->content . $suffix;

    return $this->content;
  }

  /**
   * Highlights an individual term.
   * @param string $term The term to highlight
   * @param int $term_count The term number (used for diff colors, etc)
   */
  protected function highlightTerm($term, $term_count = 0)
  {
    $content = $this->content;

    $content_length = mb_strlen($content);
    $term_length = mb_strlen($term);

    $next_chars_blacklist = $this->blacklist;

    for ($position = mb_stripos($content, $term); $position !== false; $position = mb_stripos($content, $term, $position))
    {
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
        $new_term = sprintf($this->getHighlighter($term_count), $term_hit);
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

    $this->content = $content;
  }

  /**
   * Gets a highlighter based off the term count
   */
  protected function getHighlighter($term_count)
  {
    return $this->highlighters[$term_count % count($this->highlighters)];
  }
}


function str_word_count_utf8($string, $format = 0){
        switch ($format) {
        case 1:
            preg_match_all("/\p{L}[\p{L}\p{Mn}\p{Pd}'\x{2019}]*/u", $string, $matches);
            return $matches[0];
        case 2:
            preg_match_all("/\p{L}[\p{L}\p{Mn}\p{Pd}'\x{2019}]*/u", $string, $matches, PREG_OFFSET_CAPTURE);
            $result = array();
            foreach ($matches[0] as $match) {
                $result[$match[1]] = $match[0];
            }
            return $result;
        }
        return preg_match_all("/\p{L}[\p{L}\p{Mn}\p{Pd}'\x{2019}]*/u", $string, $matches);
}

if (!function_exists('mb_internal_encoding')){
   function mb_strlen($str)
   {
      for ($i = strlen($str), $j = 0; $i--; )
         if ((ord($str[$i]) & 0xc0) != 0x80)
            $j++;
         return $j;
   }

function mb_substr($str, $from, $len = false)
   {
      if ($from >= 0)
      {
         for ($c_byte = 0; $from--; )
            if (ord($str[$c_byte]) <= 0x7F)
               $c_byte++;
            else
               while ((ord($str[++$c_byte]) & 0xc0) == 0x80);

         $byte_beg = $c_byte;

         if ($len === false)
            return substr($str, $byte_beg);
         elseif ($len < 0)
         {
            for ($c_byte = strlen($str) - 1; $len++; $c_byte--)
               if (ord($str[$c_byte]) > 0x7F)
                  while ((ord($str[--$c_byte]) & 0xc0) == 0x80);

            return substr($str, $byte_beg, -strlen($str) + 1 + $c_byte);
         }
         else
         {
            for ( ; $len--; )
               if (ord($str[$c_byte]) <= 0x7F)
                  $c_byte++;
               else
                  while ((ord($str[++$c_byte]) & 0xc0) == 0x80);

            return substr($str, $byte_beg, $c_byte - $byte_beg);
         }
      }
      else
      {
         $last_byte = strlen($str) - 1;
         for ($c_byte = $last_byte; $from++; $c_byte--)
            if (ord($str[$c_byte]) > 0x7F)
               while ((ord($str[--$c_byte]) & 0xc0) == 0x80);

         $byte_beg = $c_byte;

         if ($len === false)
            return substr($str, $byte_beg - $last_byte);
         elseif ($len < 0)
         {
            for ($c_byte = $last_byte; $len++; $c_byte--)
               if (ord($str[$c_byte]) > 0x7F)
                  while ((ord($str[--$c_byte]) & 0xc0) == 0x80);

            return substr($str, $byte_beg - $last_byte, $c_byte - $last_byte);
         }
         else
         {
            for ( ; $len--; )
               if (ord($str[$c_byte]) <= 0x7F)
                  $c_byte++;
               else
                  while ((ord($str[++$c_byte]) & 0xc0) == 0x80);

            return substr($str, $byte_beg - $last_byte, $c_byte - $byte_beg);
         }
      }
   }
}
else
   mb_internal_encoding('UTF-8');
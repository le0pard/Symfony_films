<?php

/**
 * Captacha generation based on the Cryptographp script (www.captcha.fr)
 * 
 * Usage: $captcha = new sfCryptoCaptcha();
 *        $captcha->getCaptchaImage();
 * 
 * @package    sfCryptoCaptchaPlugin
 * @subpackage lib
 * @author     HeNeArKrXeRn <henearkrxern [at] hotmail.fr>
 * @version    1.0
 */
class sfCryptoCaptcha
{
  //config holder
  private $config = array();
  
  //image resource
  private $image;
  //image resource used when adding stuff or deleting stuff (used as a temporary image resource container)
  private $temp_image;
  
  //captcha array (word, fonts, colors etc.)
  private $captcha = array();
  
  //the sfUser local object
  private $sf_user;
  
  
  public function __construct($test_queries_flood=true)
  {
    $this->getConfiguration();
    
    //get sfUser
    $user = sfContext::getInstance()->getUser();
    //test if sfUser ok
    $test_value = 'done';
    $user->setAttribute('test',$test_value);
    
    if($user->getAttribute('test') == $test_value)
    {
      //remove the test and add the user object into the class
      $user->getAttributeHolder()->remove('test');
      $this->sf_user = $user;
      
      if($test_queries_flood == true)
      {
        //test the number of queries and other stuff
        if($this->testQueries() && $this->testLastRequest())
        {
          //all good to go :)
          $this->config['constructor_test'] = true;
          return true;
        }
        else
        {
          $this->config['constructor_test'] = false;
          if(!$this->testQueries()) { 
            $this->config['constructor_error_reason'] = 'Error - too many queries';
            $this->config['constructor_error_message'] = 'too_many';
          }
          elseif(!$this->testLastRequest())
          {
            $this->config['constructor_error_reason'] = 'Error - refreshing too fast';
            $this->config['constructor_error_message'] = 'refresh';
          }
          else
          {
            $this->config['constructor_error_reason'] = 'Error - unknown reason';
            $this->config['constructor_error_message'] = 'unknown';
          }
          return false;
        }
      }
      else
      {
        //no testing (for captcha test - tests manually disabled because no need to double check)
        $this->config['constructor_test']= true;
        return true;
      }
    }
  }
  
  /**
   * Tests the number of queries done
   *
   * Tests the number of queries done by the user
   * to block flood attempts
   * 
   * @return bool Ok if the number of queries is under the limit per session
   */
  private function testQueries()
  {
    if($this->sf_user->getAttribute('queries', null, 'captcha') == '' || $this->sf_user->getAttribute('queries', null, 'captcha') == 0)
    {
      $this->sf_user->setAttribute('queries',1, 'captcha');
      return true;
    }
    elseif($this->sf_user->getAttribute('queries', null, 'captcha') >= $this->config['max_refresh'])
    {
      return false;
    }
    else
    {
      $this->sf_user->setAttribute('queries',$this->sf_user->getAttribute('queries', null, 'captcha')+1, 'captcha');
      return true;
    }   
  }
  
  /**
   * Tests the last request time
   * 
   * Tests the last request time done by the user to block
   * too fast refreshes
   *
   * @return bool Ok if the last request was not too soon from now
   */
  private function testLastRequest()
  {
    if($this->sf_user->getAttribute('last_request', null, 'captcha') == '' || $this->sf_user->getAttribute('last_request', null, 'captcha') == 0)
    {
      $this->sf_user->setAttribute('last_request',time(), 'captcha');
      return true;
    }
    else
    {
      $delay = time() - $this->sf_user->getAttribute('last_request', null, 'captcha');
      if($this->config['flood_timer'] != 0 && $this->config['flood_timer'] > $delay)
      {
        //this user is flooding.
        return false;
      }
      else
      {
        $this->sf_user->setAttribute('last_request',time(), 'captcha');
        return true;
      }
    }
  }
  
  /**
   * Generates the captcha image
   *
   * This function generates the captcha variables and 
   * creates the image.
   * 
   * @return resource Returns the image to the browser of the user
   */
  public function getCaptchaImage()
  {
    if($this->config['constructor_test']===false) {
      //generate error image
      if(!$this->sendErrorImage($this->config['constructor_error_message']))
      {
        if (sfConfig::get('sf_logging_enabled'))
        {
          $message = '{sfCaptcha}';
          $message .= ' - Critical Image Error - ';
          $message .= 'The ERROR message(['.$this->config['constructor_error_reason'].']) image could not be sent to the user.';
          $message .= ' Possible problem with file access/path.';
          sfContext::getInstance()->getLogger()->crit($message);
        } 
      }
      elseif(!$this->generateErrorImage($this->config['constructor_error_reason']))
      {
        if (sfConfig::get('sf_logging_enabled'))
        {
          $message = '{sfCaptcha}';
          $message .= ' - Critical Image Error - ';
          $message .= 'The ERROR message(['.$this->config['constructor_error_reason'].']) image encoutered an error when sending to user.';
          $message .= ' Possible problem with GD2 library.';
          sfContext::getInstance()->getLogger()->crit($message);
        } 
      }
      //finish the operation: delete the error image
      imagedestroy($this->image);
      //clear attributes
      $config = array();
      $captcha = array();
      $image = ''; //clear image
      $temp_image = ''; //clear temporary image
      return true;
    }
    //generate the captcha attributes
    $this->generateCaptcha();
    
    //align and adjust captcha
    $this->adjustCaptcha();
    
    //destroy the temporary image
    imagedestroy ($this->temp_image); 
    
    //select a background image (from the file) or set background color
    $this->selectBackground();
    
    //create the image (starting by the background)
    $this->createCaptchaImageAndBackground();
    
    //select if noise or chars first and add them
    $this->setNoiseParameters();
    if($this->config['noise_on_top'])
    {
      $this->addLettersToImage();
      $this->addNoiseToImage();
    }
    else
    {
      $this->addNoiseToImage();
      $this->addLettersToImage();
    }
    $this->clearBrush(); //destroys the brush (EXTREMELY IMPORTANT FOR THE NOISE BRUSH TO FUNCTION PROPERLY)
    
    $this->addBorder();
    $this->addEffect(); //blur, grayscale
    
    //set user attributes (word into session etc.)
    $this->setUserAttributes();
    
    if(!$this->sendImageToBrowser())
    {
      if (sfConfig::get('sf_logging_enabled'))
      {
        $message = '{seCaptcha}';
        $message .= ' - Critical Image Error - ';
        $message .= 'The NORMAL image encoutered an error when sending to user.';
        $message .= ' Possbile problem with GD2 library.';
        sfContext::getInstance()->getLogger()->crit($message);
      } 
    }
    
    
    //finish the operation: delete image and user unused attributes
    imagedestroy($this->image);
    //clear attributes
    $config = array();
    $captcha = array();
    $image = ''; //clear image
    $temp_image = ''; //clear temporary image
    
    return true;
  }
  
  /**
   * Tests the user's captcha
   *
   * Tests if the captcha given by the user is correct.
   * 
   * @return bool Ok if the captcha is correct
   */
  public function testCaptcha($input)
  {
    if(!$this->config['case_sensitive'])
    {
      $input = strtoupper($input);
    }
    
    //hash the input
    if(empty($this->config['hash_algo']))
    {
      $input_hash = hash('sha1',$input);
    }
    else
    {
      $input_hash = hash($this->config['hash_algo'],$input);
    }
    
    //compare the two hashes (the one in memory and the one with the captcha)
    $saved_captcha = $this->sf_user->getAttribute('captcha_code', null, 'captcha');
    if($input_hash == $saved_captcha)
    {
      //clear all and return good :)
      $this->clearUserCaptchaAttributes();
      return true;
    }
    else
    {
      //no good! return bad!
      return false;
    }
  }
  
  /**
   * Clears all the user captcha attributes (last_request, queries, ...)
   * 
   * @return bool Always true
   */
  public function clearUserCaptchaAttributes()
  {
    $this->sf_user->getAttributeHolder()->removeNamespace('captcha');
    return true;
  }
  
  /**
   * Generates the captcha
   *
   * It generates the captcha atributes and other stuff
   * and saves it in the class $captcha attribute
   * 
   * @return bool Ok if the captcha has been correctly generated.
   */
  private function generateCaptcha()
  {
    $this->captcha['word'] = '';
    $this->captcha['chars'] = rand($this->config['min_chars'],$this->config['max_chars']);
    
    $x_coord = 10; //starting position of the captcha on the X axis.
    //generate the captcha
    for($i=1; $i<= $this->captcha['chars']; $i++)
    {
      //font
      $this->captcha['letters'][$i]['font'] = $this->getRandomFont();
      $this->captcha['letters'][$i]['font_path'] = $this->config['char_fonts_dir'].$this->captcha['letters'][$i]['font'];
      
      //ink color
      $this->captcha['letters'][$i]['ink_type'] = $this->getInkType();
      $this->captcha['letters'][$i]['ink_colors'] = $this->getInkColors();
      
      //rotation
      $this->captcha['letters'][$i]['rotation'] = $this->getRandomLetterRotation();

      //character
      $this->captcha['letters'][$i]['char'] = $this->getRandomCharacter();
      
      //size
      $this->captcha['letters'][$i]['size'] = $this->getRandomCharacterSize();
      
      //vertical offset of the letter
      $this->captcha['letters'][$i]['y_coord'] = $this->getRandomVerticalOffset();
      
      //Add the letter to the complete word
      $this->captcha['word'] .= $this->captcha['letters'][$i]['char'];
      
      //save the letter coordinate and increase the counter
      $this->captcha['letters'][$i]['x_coord'] = $x_coord;
      $x_coord += $this->config['char_px_spacing'];
    }
    
    return true;
  }
  
  /**
   * Adjusts the captcha to the image
   *
   * It adapts the characters to the image so none is out of bounds
   * and saved the x offset coordinate
   * 
   * @return bool Ok if the captcha has been correctly aligned.
   */
  private function adjustCaptcha()
  {
    //generate temporary image
    $this->generateRawTempImage();
    
    //add chars into the image
    $this->addCaptchaOnTempImage();
    
    //adjust the temp captcha and get the offset
    $x_coord_adjust = $this->getAdjustmentOffset();
    if(!empty($x_coord_adjust))
    {
      $this->captcha['x_coord_adjust'] = $x_coord_adjust;
      
      //update characters x coord with the new $xadjustment
      $this->updateCaptchaXCoord();
      
      return true;
    }
    else
    {
      return false;
    }
  }
  
  
  /**
   * Randomly selects a font in the available fonts
   * 
   * @return string The randomly selected font
   */
  private function getRandomFont()
  {
    return $this->config['char_fonts'][array_rand($this->config['char_fonts'],1)];
  }
  
  /**
   * Randomly generates an angle
   * 
   * @return string The randomly generated angle
   */
  private function getRandomLetterRotation()
  {
    if(rand(0,1))
    {
      return rand(0, $this->config['char_max_rot_angle']);
    }
    else
    {
      return rand(360-$this->config['char_max_rot_angle'],360);
    }
  }
  
  /**
   * Randomly selects a character
   *
   * The function randomly selects characters to make the captcha
   * word. If the easy captcha is activated, it alternates
   * between vowels and consonants.
   * 
   * @return string The randomly selected letter
   */
  private function getRandomCharacter()
  {
    //test if easy captcha activated    
    if($this->config['easy_captcha'])
    {
      //select if vowel or consonant
      if($this->config['easy_captcha_bool'] == 1)
      {
        //invert for next letter (vowel/consonant)
        $this->config['easy_captcha_bool'] = 0;
        return $this->config['easy_captcha_consonants']{rand(0,strlen($this->config['easy_captcha_consonants'])-1)};
      }
      else
      {
        //invert for next letter (vowel/consonant)
        $this->config['easy_captcha_bool'] = 1;
        return $this->config['easy_captcha_vowels']{rand(0,strlen($this->config['easy_captcha_vowels'])-1)};
      }
    }
    else
    {
      //random character in the authorized characters
      return $this->config['chars_used']{rand(0,strlen($this->config['chars_used'])-1)};
    }
  }
  
  /**
   * Randomly selects a character size
   * 
   * @return string The randomly selected size
   */
  private function getRandomCharacterSize()
  {
    return rand($this->config['char_min_size'],$this->config['char_max_size']);
  }
  
  /**
   * Randomly generates a vertical offset
   * 
   * @return string The randomly generated offset
   */
  private function getRandomVerticalOffset()
  {
    if($this->config['char_vertical_offset'])
    {
      $vertical_offset = $this->config['height']/2;
      $vertical_offset += rand(0,round($this->config['height']/5));
    }
    else
    {
      $vertical_offset = round($this->config['height']/1.5);
    }
    return $vertical_offset;
  }
  
  /**
   * Generates an image with a white background in the $temp_image class attribute
   * 
   * @return bool True if the generation is successfull.
   */
  private function generateRawTempImage()
  {
    $this->temp_image = imagecreatetruecolor($this->config['width'],$this->config['height']);
    $white = imagecolorallocate($this->temp_image,255,255,255);
    
    if(!imagefill($this->temp_image,0,0,$white))
    {
      return false;
    }
    else
    {
      return true;
    }
  }
  
  /**
   * Adds the captcha letters on the temporary image
   * 
   * @return bool True if the adding is successfull
   */
  private function addCaptchaOnTempImage()
  {
    //add each character
    for($i=1; $i<= $this->captcha['chars']; $i++)
    {
      $black_ink = imagecolorallocate($this->temp_image,0,0,0);
      //add letter to image
      if(!imagettftext($this->temp_image,
                       $this->captcha['letters'][$i]['size'],
                       $this->captcha['letters'][$i]['rotation'],
                       $this->captcha['letters'][$i]['x_coord'],
                       $this->captcha['letters'][$i]['y_coord'],
                       $black_ink,
                       $this->captcha['letters'][$i]['font_path'],
                       $this->captcha['letters'][$i]['char']))
      {
        return false;
      }
    }
    return true;
  }
  
  /**
   * Computes the x coordinate offset
   * 
   * @return int The x coordiante offset
   */
  private function getAdjustmentOffset()
  {
    $white = imagecolorallocate($this->temp_image,255,255,255);
    
    //Adjust the X begin coordinate
    $xbegin = 0;
    $x = 0;
    while ($x < $this->config['width'] && !$xbegin )
    {
      $y = 0;
      while ($y < $this->config['height'] && !$xbegin )
      {
        if(imagecolorat($this->temp_image, $x, $y) != $white )
        {
          $xbegin = $x;
        }
        $y++;
      }
      $x++;
    }
    $xend = 0;
    
    //Adjust the X end coordinate
    $x = $this->config['width'] - 1;
    while($x > 0 && !$xend)
    {
      $y = 0;
      while ($y < $this->config['height'] && !$xend)
      {
        if(imagecolorat($this->temp_image, $x, $y) != $white)
        {
          $xend = $x;
        }
        $y++;
      }
      $x--;
    }
    
    //Compute the adjustment
    $xadjustment = round(($this->config['width']/2)-($xend-$xbegin)/2);
    
    return $xadjustment;
  }
  
  /**
   * Selects the final captcha background. Random image if file in configuration
   *
   * In all cases, it defines also the background color.
   * 
   * @return bool True if image correctly selected and set
   */
  private function selectBackground()
  {
    if($this->config['bg_img'] && is_dir($this->config['bg_img']))
    {
      $pointer = opendir($this->config['bg_img']);
      while(false !== ($filename = readdir($pointer)))
      {
        if(eregi('.[gif|jpg|jpeg|png]$', $filename))
        {
          $files[] = $filename;
        }
      }
      closedir($pointer);
      $this->captcha['bg_img'] = $this->config['bg_img'].'/'.$files[array_rand($files, 1)];
    }
    elseif($this->config['bg_img'] && file_exists($this->config['bg_img']))
    {
      //use the file specified
      $this->captcha['bg_img'] = $this->config['bg_img'];
    }
    else
    {
      $this->captcha['bg_img'] = '';
    }
    $this->captcha['bg_colors'] = array('red'=>$this->config['bg_red'], 'green'=>$this->config['bg_green'], 'blue'=>$this->config['bg_blue']);
    
    if(!empty($this->captcha['bg_colors']))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  
  /**
   * Selects the ink type (transparent or normal)
   * 
   * @return bool The ink type (true=alpha, false=opaque)
   */
  private function getInkType()
  {
    //select if transparent or "normal"
    if(function_exists('imagecolorallocatealpha') && $this->config['char_transparent'] != 0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  
  /**
   * Selects the ink colors
   * 
   * @return array The ink colors
   */
  private function getInkColors()
  {
    //random color or configured colors
    if($this->config['char_random_color'])
    {
      $ok = false;
      do {
        $rand_red = rand(0,255);
        $rand_green = rand(0,255);
        $rand_blue = rand(0,255);
        $random_color_sum = $rand_red + $rand_green + $rand_blue;
        switch ($this->config['char_random_color_lvl'])
        {
          case 1  : if ($random_color_sum<200) $ok=true; break; // very dark
          case 2  : if ($random_color_sum<400) $ok=true; break; // dark
          case 3  : if ($random_color_sum>500) $ok=true; break; // bright
          case 4  : if ($random_color_sum>650) $ok=true; break; // very bright
          default : $ok=true;               
        }
      }while($ok == false);
      
      $ink['red']=$rand_red;
      $ink['green']=$rand_green;
      $ink['blue']=$rand_blue;
    }
    else
    {
      $ink['red']=$this->config['char_red'];
      $ink['green']=$this->config['char_green'];
      $ink['blue']=$this->config['char_blue'];
    }
    
    return $ink;
  }
  
  /**
   * Defines the captcha noise parameters
   * 
   * @return bool Always true
   */
  private function setNoiseParameters()
  {
    switch($this->config['noise_color'])
    {
      case 1  : $rand_letter = rand(1,$this->captcha['chars']); 
                $this->captcha['noise_color'] = $this->captcha['letters'][$rand_letter]['ink_colors']; break; //color of the writing
      case 2  : $this->captcha['noise_color'] = $this->captcha['bg_colors']; break; //color of the background
      case 3  : 
      default : $this->captcha['noise_color'] = array('red'=>rand(0,255),'green'=>rand(0,255),'blue'=>rand(0,255)); break; //random color
    }
    
    $this->captcha['noise_px'] = rand($this->config['noise_min_px'],$this->config['noise_max_px']);
    $this->captcha['noise_lines'] = rand($this->config['noise_min_lines'],$this->config['noise_max_lines']);
    $this->captcha['noise_circles'] = rand($this->config['noise_min_circles'],$this->config['noise_max_circles']);
    
    return true;
  }
  
  /**
   * Generates the final captcha image with the background
   * 
   * @return bool Always true
   */
  private function createCaptchaImageAndBackground()
  {
    $this->image = imagecreatetruecolor($this->config['width'],$this->config['height']);
    //add background
    if(!empty($this->config['bg_img']))
    {
      $this->addImageBackgroundImage();
    }
    else
    {
      $this->addImageBackgroundColor();
    }
    
    return true;
  }
  
  /**
   * Adds the background image to the $image attribute
   * 
   * @return bool Always true
   */
  private function addImageBackgroundImage()
  {
    list($bg_width, $bg_height, $bg_type, $bg_attributes) = getimagesize($this->captcha['bg_img']);
    if($bg_type == '1')
    {
      $img_read = imagecreatefromgif($this->captcha['bg_img']);
    }
    elseif($bg_type == '2')
    {
      $img_read = imagecreatefromjpeg($this->captcha['bg_img']);
    }
    elseif($bg_type == '3')
    {
      $img_read = imagecreatefrompng($this->captcha['bg_img']);
    }
    else
    {
      return false;
    }
    imagecopyresized($this->image, $img_read, 0, 0, 0, 0, $this->config['width'], $this->config['height'], $bg_width, $bg_height );
    imagedestroy($img_read);
    
    return true;
  }
  
  /**
   * Adds the background color to the $image attribute
   * 
   * @return bool Always true
   */
  private function addImageBackgroundColor()
  {
    $bg = imagecolorallocate($this->image, $this->captcha['bg_colors']['red'], $this->captcha['bg_colors']['green'], $this->captcha['bg_colors']['blue']);
    imagefill($this->image, 0, 0, $bg);
    
    if($this->config['bg_transparent'] && strtoupper($this->config['format'])== 'PNG')
    {
      imagecolortransparent($this->image, $bg);
    }
    
    return true;
  }
  
  /**
   * Adds the noise to the $image attribute
   * 
   * @return bool Always true
   */
  private function addNoiseToImage()
  { 
    //add pixels
    for($i = 1; $i < $this->captcha['noise_px']; $i++)
    {
      imagesetpixel($this->image, rand(0, $this->config['width']-1), rand(0, $this->config['height']-1), $this->getNoiseBrush() );
    }
    
    for($j = 1; $j < $this->captcha['noise_lines']; $j++)
    {
      imageline($this->image, rand(0, $this->config['width']-1), rand(0, $this->config['height']-1), rand(0, $this->config['width']-1), rand(0, $this->config['height']-1), $this->getNoiseBrush());
    }
    
    for($k = 1; $k < $this->captcha['noise_circles']; $k++)
    {
      $radius = rand(5,$this->config['width']/3);
      imagearc($this->image, rand(0, $this->config['width']-1), rand(0, $this->config['height']-1), $radius, $radius, 0, 360, $this->getNoiseBrush());
    }
    
    return true;
  }
  
  /**
   * Updates the captcha letters x_coord value
   * 
   * @return bool Always true
   */
  private function updateCaptchaXCoord()
  {
    //for each letter, redefine the x_coord
    $x_coord = $this->captcha['x_coord_adjust']; //starting position of the captcha on the X axis - adapted with the x offset.
    
    for($i=1; $i<= $this->captcha['chars']; $i++)
    { 
      //update the letter coordinate and increase the counter
      $this->captcha['letters'][$i]['x_coord'] = $x_coord;
      $x_coord += $this->config['char_px_spacing'];
    }
    
    return true;
  }
  
  /**
   * Adds the actual captcha letters to the $image attribute
   * 
   * @return bool Always true
   */
  private function addLettersToImage()
  {
    //add each character to the image :D
    for($i=1; $i<= $this->captcha['chars']; $i++)
    { 
      //create ink
      if($this->captcha['letters'][$i]['ink_type'])
      {
        //alpha active
        $ink = imagecolorallocatealpha($this->image, $this->captcha['letters'][$i]['ink_colors']['red'],
                                              $this->captcha['letters'][$i]['ink_colors']['green'],
                                              $this->captcha['letters'][$i]['ink_colors']['blue'],
                                              $this->config['char_transparent']);
      }
      else
      {
        //normal/opaque ink
        $ink = imagecolorallocatealpha($this->image, $this->captcha['letters'][$i]['ink_colors']['red'],
                                              $this->captcha['letters'][$i]['ink_colors']['green'],
                                              $this->captcha['letters'][$i]['ink_colors']['blue']);
      }
      
      //add character
      imagettftext($this->image,
                   $this->captcha['letters'][$i]['size'],
                   $this->captcha['letters'][$i]['rotation'],
                   $this->captcha['letters'][$i]['x_coord'],
                   $this->captcha['letters'][$i]['y_coord'],
                   $ink,
                   $this->captcha['letters'][$i]['font_path'],
                   $this->captcha['letters'][$i]['char']);
      //char added :)
    }
    
    return true;
  }
  
  /**
   * Defines the brush used on the $image attribute
   * 
   * @return bool Always true
   */
  private function setBrush()
  {
    $noise_color = imagecolorallocate ($this->image, $this->captcha['noise_color']['red'], $this->captcha['noise_color']['green'], $this->captcha['noise_color']['blue']);
    if($this->config['brush_size'] && $this->config['brush_size']>1 && function_exists('imagesetbrush'))
    {
      $brush = imagecreatetruecolor($this->config['brush_size'], $this->config['brush_size']);
      imagefill($brush, 0, 0, $noise_color);
      imagesetbrush($this->image, $brush);
      $this->captcha['noise_brush'] = IMG_COLOR_BRUSHED;
      $this->captcha['brush'] = $brush;
    }
    else
    {
      $this->captcha['noise_brush'] = $noise_color;
    }
    
    return true;
  }
  
  /**
   * Deletes the brush image so it can be reused!
   *
   * @return bool Always returns true
   */
  private function clearBrush()
  {
    if(isset($this->captcha['brush']) && !empty($this->captcha['brush']))
    {
      imagedestroy($this->captcha['brush']);
      return true;
    }
    else
    {
      return false;
    }
  }
  
  /**
   * Refreshes the captcha noise parameters if the random option is selected
   * 
   * @return bool If changed, returns true
   */
  private function refreshNoiseColor()
  {
    if($this->config['noise_color'] != 1 && $this->config['noise_color'] != 2)
    {
      $this->captcha['noise_color'] = array('red'=>rand(0,255),'green'=>rand(0,255),'blue'=>rand(0,255));
      return true;
    }
    return false;
  }
  
  /**
   * Refreshes the noise and makes it into a brush for direct use
   * 
   * @return bool Always true
   */
  private function getNoiseBrush()
  {
    //refresh the color if random type selected
    if($this->refreshNoiseColor())
    {
      //brush updated, regenerate brush
      $this->setBrush();
    }
    else
    {
      if(empty($this->captcha['noise_brush']) || !isset($this->captcha['noise_brush']))
      {
        $this->setBrush();
      }
      else
      {
        //no need to do anything (color not updated and brush set)
      }
    }
    return $this->captcha['noise_brush'];
  }
  
  /**
   * Adds a border around the image
   * 
   * @return bool Always true
   */
  private function addBorder()
  {
    if($this->config['bg_border'])
    {
      $border_color = imagecolorallocate($this->image, ($this->config['bg_red']*3+$this->config['char_red'])/4,
                                                 ($this->config['bg_green']*3+$this->config['char_green'])/4,
                                                 ($this->config['bg_blue']*3+$this->config['char_blue'])/4);
      imagerectangle($this->image, 0, 0, $this->config['width']-1, $this->config['height']-1, $border_color);
    }
    return true;
  }
  
  /**
   * Aplies effects to the image
   * 
   * @return bool Always true
   */
  private function addEffect()
  {
    if(function_exists('imagefilter'))
    {
      if($this->config['effect_greyscale'])
      {
        imagefilter($this->image, IMG_FILTER_GRAYSCALE);
      }
      if($this->config['effect_blur'])
      {
        imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);
      }
    }
    return true;
  }
  
  /**
   * Saves the captcha word into the user session
   * 
   * @return bool Always true
   */
  private function setUserAttributes()
  {
    if(!$this->config['case_sensitive'])
    {
      $this->captcha['word'] = strtoupper($this->captcha['word']);
    }
    
    //save the captcha into the session in hashed form
    if(empty($this->config['hash_algo']))
    {
      $this->sf_user->setAttribute('captcha_code', hash('sha1',$this->captcha['word']), 'captcha');
    }
    else
    {
      $this->sf_user->setAttribute('captcha_code', hash($this->config['hash_algo'],$this->captcha['word']), 'captcha');
    }
    
    return true;
  }
  
  /**
   * Sends the final image to the browser!
   *
   * @return bool Returns false if the format specified does not exist.
   */
  private function sendImageToBrowser()
  {
    //disable cache for captchas
    header("Cache-Control: no-cache");
    
    //send the finished image in JPG, GIF or PNG format
    if(strtoupper($this->config['format']) == 'JPG' || strtoupper($this->config['format']) == 'JPEG')
    {
      if(imagetypes() & IMG_JPG)
      {
        header("Content-type: image/jpeg");
        imagejpeg($this->image, '', 80);
      }
      else
      {
        return false;
      }
    }
    
    if(strtoupper($this->config['format']) == 'GIF')
    {
      if(imagetypes() & IMG_GIF)
      {
        header("Content-type: image/gif");
        imagegif($this->image);
      }
      else
      {
        return false;
      }
    }
    
    if(strtoupper($this->config['format']) == 'PNG')
    {
      if(imagetypes() & IMG_PNG)
      {
        header("Content-type: image/png");
        imagepng($this->image);
      }
      else
      {
        return false;
      }
    }
    
    return true;
  }
  /*
  private function generateErrorImage($error_text)
  {
    $this->captcha['bg_img'] = false;
    $this->config['bg_red']=255;
    $this->config['bg_green']=255;
    $this->config['bg_blue']=255;
    $this->selectBackground();
    
    //create the image (starting by the background)
    $this->createCaptchaImageAndBackground();
    
    //generate error letters and add them
    $this->captcha['word'] = $error_text;
    $this->captcha['chars'] = strlen($this->captcha['word']);
    
    $x_coord = 5; //starting position of the captcha on the X axis.
    $new_line = false;
    //generate the letters
    for($i=1; $i<= $this->captcha['chars']; $i++)
    {
      //font
      $this->captcha['letters'][$i]['font'] = 'arial.ttf'//$this->config['error_font'];
      $this->captcha['letters'][$i]['font_path'] = $this->config['char_fonts_dir'].$this->captcha['letters'][$i]['font'];
      
      //ink color
      $this->captcha['letters'][$i]['ink_type'] = $this->getInkType();
      $this->captcha['letters'][$i]['ink_colors'] = array('red'=>255,'green'=>0, 'blue'=>0);
      
      //rotation
      $this->captcha['letters'][$i]['rotation'] = 0;

      //character
      $this->captcha['letters'][$i]['char'] = $this->captcha['word']{$i-1};
      
      //size
      $this->captcha['letters'][$i]['size'] = '8';
      
      //X spacing:
      $this->config['char_px_spacing'] = 7;
      //make message on two lines - test if $i above half the message
      if($i >= round($this->captcha['chars'])/2)
      {
        if($this->captcha['letters'][$i]['char'] == ' ' && !$new_line)
        {
          //reset X coordinates
          $x_coord = 10;
          $new_line = true;
        }
        if($new_line == true)
        {
          //vertical offset of the letter
          $this->captcha['letters'][$i]['y_coord'] = $this->config['height']/1.3;
        }
        else
        {
          //vertical offset of the letter
          $this->captcha['letters'][$i]['y_coord'] = $this->config['height']/2.5;
        }
      }
      else
      {
        if(($i >= (round($this->captcha['chars'])/2 - 1) || $i >= (round($this->captcha['chars'])/2 - 2)) && $this->captcha['letters'][$i]['char'] == ' ' && !$new_line)
        {
          //reset X coordinates
          $x_coord = 5;
          $new_line = true;
        }
        if($new_line == true)
        {
          //vertical offset of the letter
          $this->captcha['letters'][$i]['y_coord'] = $this->config['height']/1.3;
        }
        else
        {
          //vertical offset of the letter
          $this->captcha['letters'][$i]['y_coord'] = $this->config['height']/2.5;
        }
      }
           
      //save the letter coordinate and increase the counter
      $this->captcha['letters'][$i]['x_coord'] = $x_coord;
      $x_coord += $this->config['char_px_spacing'];
    }
    $this->addLettersToImage();
    
    $this->addBorder();
    
    
    return $this->sendImageToBrowser();
  }
  */
  
  private function sendErrorImage($error_message)
  {
    // 1) read the image depending on the sf_user culture
    // 2) send it to the browser
    
    //get culture
    $culture = $this->sf_user->getCulture();
       
    //set image path
    if($this->config['use_i18n'] == true)
    {
      $image_path = $this->config['error_images_dir'].DIRECTORY_SEPARATOR.$culture.DIRECTORY_SEPARATOR.$error_message.'.'.$this->config['format'];
    }
    else
    {
      $image_path = $this->config['error_images_dir'].DIRECTORY_SEPARATOR.$error_message.'.'.$this->config['format'];
    }
    //send the finished image in JPG, GIF or PNG format
    if(strtoupper($this->config['format']) == 'JPG' || strtoupper($this->config['format']) == 'JPEG')
    {
      header("Content-type: image/jpeg");
      readfile($image_path); 
      exit;
    }
    
    if(strtoupper($this->config['format']) == 'GIF')
    {
      header("Content-type: image/gif");
      readfile($image_path);
      exit;
    }
    
    if(strtoupper($this->config['format']) == 'PNG')
    {
      header("Content-type: image/png");
      readfile($image_path);
      exit;
    }
    
    return true;
  }
  
  
  /**
   * Captcha configuration getter from the app.yml
   *
   * This function gets the configuration values
   * from the configuration file.
   * 
   * @return bool Always true
   */
  private function getConfiguration()
  {
    $root_dir = sfConfig::get('sf_root_dir');
    $web_dir = sfConfig::get('sf_web_dir');
    //Setting image size
    $this->config['width'] =  sfConfig::get('app_sf_crypto_captcha_width', 130); // width of generated image
    $this->config['height'] = sfConfig::get('app_sf_crypto_captcha_height', 40); // height of generated image
    
    //Setting background
    $this->config['bg_red'] = sfConfig::get('app_sf_crypto_captcha_bg_red', 238); // quantity of ref (0->255)
    $this->config['bg_green'] = sfConfig::get('app_sf_crypto_captcha_bg_green', 255); // quantity of green (0->255)
    $this->config['bg_blue'] = sfConfig::get('app_sf_crypto_captcha_bg_blue', 255); // quantity of blue (0->255)
    $this->config['bg_transparent'] = sfConfig::get('app_sf_crypto_captcha_bg_transparent', false); // transparent backround, only for PNG
    $this->config['bg_img'] = sfConfig::get('app_sf_crypto_captcha_bg_img', false); // boolean(false) or image(path) or file (random image from file path)
    if($this->config['bg_img'] != false) { $this->config['bg_img'] = $root_dir.$this->config['bg_img']; } //The background image file must be a path from the symfony root dir
    
    $this->config['bg_border'] = sfConfig::get('app_sf_crypto_captcha_bg_border', true); //border or not
    
    //Setting characters
    $this->config['char_red'] = sfConfig::get('app_sf_crypto_captcha_char_red', 0); // quantity of ref (0->255)
    $this->config['char_green'] = sfConfig::get('app_sf_crypto_captcha_char_green', 0); // quantity of green (0->255)
    $this->config['char_blue'] = sfConfig::get('app_sf_crypto_captcha_char_blue', 0); // quantity of blue (0->255)
    $this->config['char_random_color'] = sfConfig::get('app_sf_crypto_captcha_char_random_color', true); // random color choice
    $this->config['char_random_color_lvl'] = sfConfig::get('app_sf_crypto_captcha_char_random_color_lvl', 1); // if the color is random, test it's "brightness"
    $this->config['char_transparent'] = sfConfig::get('app_sf_crypto_captcha_char_transparent', 10); // intensity of transparency (0->127)
    $this->config['char_px_spacing'] = sfConfig::get('app_sf_crypto_captcha_char_px_spacing', 20); // number of pixels between each letter
    $this->config['char_min_size'] = sfConfig::get('app_sf_crypto_captcha_char_min_size', 16); // minimum character size
    $this->config['char_max_size'] = sfConfig::get('app_sf_crypto_captcha_char_max_size', 20); // maximum character size
    $this->config['char_max_rot_angle'] = sfConfig::get('app_sf_crypto_captcha_char_max_rot_angle', 30); // maximum rotation angle of the characters (0->360)
    $this->config['char_vertical_offset'] = sfConfig::get('app_sf_crypto_captcha_char_vertical_offset', true); // random vertical offset of letters
    
    //Setting fonts
    $this->config['char_fonts'] = sfConfig::get('app_sf_crypto_captcha_char_fonts', array('luggerbu.ttf')); // the fonts used randomly to generate the characters
    $this->config['char_fonts_dir'] = sfConfig::get('app_sf_crypto_captcha_char_fonts_dir', '/plugins/sfCryptoCaptchaPlugin/media/fonts/'); // directory with the fonts
    $this->config['char_fonts_dir'] = $root_dir.$this->config['char_fonts_dir'];
    
    //Setting authorized characters
    $this->config['chars_used'] = sfConfig::get('app_sf_crypto_captcha_chars_used', 'ABCDEFGHKLMNPRTWXYZ234569'); // characters used for the captchas
    
    //Setting easy captchas
    $this->config['easy_captcha'] = sfConfig::get('app_sf_crypto_captcha_easy_captcha', true); // make easy readable captachas (alternate vowels/consonant)
    $this->config['easy_captcha_vowels'] = sfConfig::get('app_sf_crypto_captcha_easy_captcha_vowels', 'AEIOUY'); // vowels used in the easy captchas
    $this->config['easy_captcha_consonants'] = sfConfig::get('app_sf_crypto_captcha_easy_captcha_consonants', 'BCDFGHKLMNPRTVWXZ'); // consonant used in the easy captchas
    $this->config['easy_captcha_bool'] = rand(0,1);    //create random bool for easy captcha (first letter vowel or consonant)
    
    //Setting parameters
    $this->config['case_sensitive'] = sfConfig::get('app_sf_crypto_captcha_case_sensitive', false); // differentiate between letters (M and m)
    $this->config['min_chars'] = sfConfig::get('app_sf_crypto_captcha_min_chars', 4); // minimum characters in the captcha
    $this->config['max_chars'] = sfConfig::get('app_sf_crypto_captcha_max_chars', 6); // maximum characters in the captcha
    $this->config['brush_size'] = sfConfig::get('app_sf_crypto_captcha_brush_size', 1); // noise brush size (1->25)
    $this->config['format'] = sfConfig::get('app_sf_crypto_captcha_format', 'png'); // image format (png, gif, jpg)
    $this->config['hash_algo'] = sfConfig::get('app_sf_crypto_captcha_hash_algo', 'sha1'); // hashing used
    $this->config['flood_timer'] = sfConfig::get('app_sf_crypto_captcha_flood_timer', 0); // time (seconds) between each refresh of image
    //$this->config['flood_error'] = sfConfig::get('app_sf_crypto_captcha_flood_error', 3); // what happens if flood (1=no image, 2=error image, 3=pause)
    $this->config['max_refresh'] = sfConfig::get('app_sf_crypto_captcha_max_refresh',1000); // maximum refreshes the user can do for one session
    
    //Setting effects
    $this->config['effect_blur'] = sfConfig::get('app_sf_crypto_captcha_effect_blur', false); // adds gaussian blur to the image
    $this->config['effect_greyscale'] = sfConfig::get('app_sf_crypto_captcha_effect_greyscale', false); // makes the captacha in grayscale (only if PHP >= 5.0.0)
    
    //Setting noise
    $this->config['noise_min_px'] = sfConfig::get('app_sf_crypto_captcha_noise_min_px', 200); // minimum noise pixels
    $this->config['noise_max_px'] = sfConfig::get('app_sf_crypto_captcha_noise_max_px', 400); // maximum noise pixels
    $this->config['noise_min_lines'] = sfConfig::get('app_sf_crypto_captcha_noise_min_lines', 2); // minimum noise lines
    $this->config['noise_max_lines'] = sfConfig::get('app_sf_crypto_captcha_noise_max_lines', 3); // maximum noise lines
    $this->config['noise_min_circles'] = sfConfig::get('app_sf_crypto_captcha_noise_min_circles', 2); // minimum noise circles
    $this->config['noise_max_circles'] = sfConfig::get('app_sf_crypto_captcha_noise_max_circles', 3); // maximum noise circles
    $this->config['noise_color'] = sfConfig::get('app_sf_crypto_captcha_noise_color', 3); // noise color (1= character color, 2= background, 3= random)
    $this->config['noise_on_top'] = sfConfig::get('app_sf_crypto_captcha_noise_on_top', false); // the noise is on the top layer
    
    //error config
    $this->config['use_i18n'] = sfConfig::get('sf_i18n', false);
    $this->config['error_images_dir'] = sfConfig::get('app_sf_crypto_captcha_error_images_dir', '/plugins/sfCryptoCaptchaPlugin/media/error/'); //the dir where the images are - from symfony root dir
    $this->config['error_images_dir'] = $root_dir.$this->config['error_images_dir'];
    
    return true;
  }
  
}


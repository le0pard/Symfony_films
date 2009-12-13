<?php

/**
 * SymfonyTwitter class
 *
 * This source file can be used to communicate with Twitter (http://twitter.com)
 * This class provide a symfony-oriented code
 *
 * Changelog since 0.1.0
 *
 * License
 * Copyright (c) 2009, Eugene Smirnov. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 * 3. The name of the author may not be used to endorse or promote products derived from this software without specific prior written permission.
 *
 * This software is provided by the author "as is" and any express or implied warranties, including, but not limited to, the implied warranties of merchantability and fitness for a particular purpose are disclaimed. In no event shall the author be liable for any direct, indirect, incidental, special, exemplary, or consequential damages (including, but not limited to, procurement of substitute goods or services; loss of use, data, or profits; or business interruption) however caused and on any theory of liability, whether in contract, strict liability, or tort (including negligence or otherwise) arising in any way out of the use of this software, even if advised of the possibility of such damage.
 *
 * @author      Eugene Smirnov <smirik@gmail.com>
 * @version     0.1.1
 *
 * @copyright   Copyright (c) 2009, Eugene Smirnov. All rights reserved.
 * @license     MIT License, BSD License
 */

class SymfonyTwitter extends Twitter
{
  
  /**
   * Return SymfonyTwitter object with all properties or generate new TwitterException
   *
   * @param int $user_id
   */
  public function __construct($user_id)
  {
    $c = new Criteria();
    $c->add(TwitterUserPeer::USER_ID, $user_id);
    $tu = TwitterUserPeer::doSelect($c);
    var_dump($tu);
    exit();
    if (isset($tu[0]))
    {
      parent::__construct($tu[0]->getEmail(), $tu[0]->getPassword());
    } else
    {
      throw new TwitterException(sfConfig::get('app_twitter_not_found'));
    }
  }

}

?>
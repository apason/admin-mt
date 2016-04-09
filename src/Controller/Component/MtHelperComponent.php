<?php namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;

/**
  * This component provides general helper methods for controllers.
**/
class MtHelperComponent extends Component {

  /* This method helps in determining the content type of task / answer media. */
  public getContentTypeFromUri($uri) {
    $ending = /* Regular expression to find out content type. */
    if (mb_substr($uri, -4) == '.mp4' || mb_substr($uri, -5 == '.webm'))
      return "video";
    }
    if (mb_substr($uri, -4) == '.jpg' || mb_substr($uri, -5 == '.jpeg') || mb_substr($uri, -4 == '.png'))
      return "image";
    }
  }
}

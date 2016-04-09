<?php namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Aws\S3\S3Client;
use Aws\Credentials\Credentials;

/**
  * This component provides helper methods for communication with Amazon AWS S3.
  *
**/
class MtS3ServiceComponent extends Component {

  private $S3 = null;

  public function initialize(array $config) {

    // Create a credentials object and populate it.
    $credentials = new Credentials(
      Configure::readOrFail('AwsS3Settings.accessKey'),
      Configure::readOrFail('AwsS3Settings.secretAccessKey'));
    // Create a S3Client instance.
    $this->S3 = new S3Client([
        'version' => 'latest',
        'region'  => 'eu-central-1'
    ]);
  }

  // Sets video metadata to allow streaming.
  public function setTaskMetadata($id = null) {

  }
}

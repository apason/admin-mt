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
      $key = Configure::readOrFail('AwsS3Settings.accessKey'),
      $secret = Configure::readOrFail('AwsS3Settings.secretAccessKey'));
    // Create a S3Client instance.
    $this->S3 = new S3Client([
        'version' => 'latest',
        'region'  => 'eu-central-1',
        'credentials' => array(
          'key' => $key,
          'secret' => $secret)
    ]);
  }

  public function getSignedAnswerDownloadUrl($object_name) {
    $answer_bucket_name = Configure::readOrFail('AwsS3Settings.answerBucketName');
    return $this->getSignedDownloadUrl($answer_bucket_name, $object_name);
  }

  public function getSignedDownloadUrl($bucket_name, $object_name) {
    $cmd = $this->S3->getCommand('GetObject', [
      'Bucket' => $bucket_name,
      'Key'    => $object_name
    ]);

    return $this->S3->createPresignedRequest($cmd, '+15 minutes')->getUri();
  }

  public function getSignedUploadUrl($bucket_name, $object_name, $content_type) {
    $cmd = $this->S3->getCommand('PutObject', [
      'Bucket' => $bucket_name,
      'Key'    => $object_name
    ]);

    return $this->S3->createPresignedRequest($cmd, '+15 minutes')->getUri();
  }
}

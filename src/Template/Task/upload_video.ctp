<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $task->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Task'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Category'), ['controller' => 'Category', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Category', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Answer'), ['controller' => 'Answer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answer', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="task form large-9 medium-8 columns content">
  <legend>Lähetä tai päivitä tehtävävideo</legend>
  <ul>
    <li>ID: <?php print $task->id; ?></li>
    <li>Kuvaus: <?php print $task->info; ?></li>
  </ul>
  <?php if ($task->uploaded == false): ?>
    Tehtävävideota ei ole vielä lähetetty.
  <?php else: ?>
    Tehtävävideo on jo lähetetty.
  <?php endif; ?>

  <input type="file" id="file-chooser" />
  <button id="upload-button">Lähetä video</button>
  <div id="results"></div>
  <script src="https://sdk.amazonaws.com/js/aws-sdk-2.2.47.min.js"></script>
  <script type="text/javascript">
    var taskId = <?php print $task->id; ?>;
    var taskBucketName = '<?php print $taskBucketName; ?>';
    var awsAccessKey = '<?php print $awsAccessKey; ?>';
    var awsSecretAccessKey = '<?php print $awsSecretAccessKey; ?>';
  </script>
  <script type="text/javascript">
    function taskVideoUploadComplete(taskId) {
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET", "/task/video_upload_complete/" + taskId, true);
      xhttp.send();
    }

    // See the Configuring section to configure credentials in the SDK
    AWS.config.update({
      accessKeyId: awsAccessKey,
      secretAccessKey: awsSecretAccessKey
    });
    AWS.config.sslEnabled = true;
    // Configure your region
    AWS.config.region = 'eu-central-1';

    var bucket = new AWS.S3({params: {Bucket: taskBucketName}});
    var fileChooser = document.getElementById('file-chooser');
    var button = document.getElementById('upload-button');
    var results = document.getElementById('results');
    button.addEventListener('click', function() {
      var file = fileChooser.files[0];
      if (file) {
        results.innerHTML = '';

        var params = {Key: file.name, ContentType: file.type, Body: file};
        bucket.upload(params, function (err, data) {
          if (err) {
              results.innerHTML = 'Videon lähettämisessä tapahtui virhe: ' + err;
          } else {
            results.innerHTML = 'Video lähetettiin onnistuneesti.';
            // Make an AJAX call to video_upload_completed/id.
            taskVideoUploadComplete(taskId);
          }
        });
      } else {
        results.innerHTML = 'Valitse ensin lähetettävä video.';
      }
    }, false);
  </script>

</div>

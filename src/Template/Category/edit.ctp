<script type="text/javascript" src="/js/mtadmin-common.js"></script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $category->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Category'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Task'), ['controller' => 'Task', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Task', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="category form large-9 medium-8 columns content">
    <?= $this->Form->create($category) ?>
    <fieldset>
        <legend><?= __('Edit Category') ?></legend>
        <?php
            // echo $this->Form->input('uploaded');
            echo $this->Form->input('enabled');
            echo $this->Form->input('name');
            echo $this->Form->input('coordinate_x');
            echo $this->Form->input('coordinate_y');
            // echo $this->Form->input('bg_uri');
            // echo $this->Form->input('icon_uri');
        ?>
    </fieldset>

    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.2.47.min.js"></script>
    <script type="text/javascript">
      var categoryId = <?php print $category->id; ?>;
      var graphicsBucketName = '<?php print $graphicsBucketName; ?>';
      var awsAccessKey = '<?php print $awsAccessKey; ?>';
      var awsSecretAccessKey = '<?php print $awsSecretAccessKey; ?>';
      // See the Configuring section to configure credentials in the SDK
      AWS.config.update({
        accessKeyId: awsAccessKey,
        secretAccessKey: awsSecretAccessKey
      });
      AWS.config.sslEnabled = true;
      // Configure your region
      AWS.config.region = 'eu-central-1';
    </script>

    <div id="category-background-upload">
      <div id="category-background-upload-results">
        <?php if ($category->bg_uri == null || $category->bg_uri == ''): ?>
         Kategorian taustakuvaa ei vielä ole lähetetty.
        <?php else: ?>
          Kategorian taustakuva on jo lähetetty. Taustakuvan URI on: <?php print $category->bg_uri; ?>
        <?php endif; ?>
      </div>
      <input type="file" id="category-background-file-chooser" />
      <button type="button" id="category-background-upload-button">Lähetä taustakuva</button>
      <script type="text/javascript">
        var categoryBackgroundBucket = new AWS.S3({params: {Bucket: graphicsBucketName}});
        var categoryBackgroundFileChooser = document.getElementById('category-background-file-chooser');
        var categoryBackgroundUploadButton = document.getElementById('category-background-upload-button');
        var categoryBackgroundUploadResults = document.getElementById('category-background-upload-results');
        categoryBackgroundUploadButton.addEventListener('click', function() {
          var backgroundFile = categoryBackgroundFileChooser.files[0];

          if (backgroundFile) {
            // Is the file of the right type?
            if (!checkFileType(backgroundFile, new Array('image/png'))) {
                categoryBackgroundUploadResults.innerHTML = "Virhe: Kuvatiedosto on väärää tyyppiä.";
                return;
            }

            var backgroundUploadFilename = generateCategoryBackgroundFilename(categoryId, backgroundFile);
            var backgroundParams = {Key: backgroundUploadFilename, ContentType: backgroundFile.type, Body: backgroundFile};
            categoryBackgroundUploadResults.innerHTML = 'Taustakuvaa lähetetään. Odota hetki...';
            categoryBackgroundBucket.upload(backgroundParams, function (err, data) {
              if (err) {
                  categoryBackgroundUploadResults.innerHTML = 'Taustakuvan lähettämisessä tapahtui virhe: ' + err;
              } else {
                categoryBackgroundUploadResults.innerHTML = 'Taustakuva lähetettiin onnistuneesti.';
                // Make an AJAX call to background_upload_completed/id.
                categoryBackgroundUploadCompleted(categoryId, backgroundUploadFilename);
              }
            });
          } else {
            categoryBackgroundUploadResults.innerHTML = 'Valitse ensin lähetettävä taustakuva.';
          }
        }, false);
      </script>
    </div>

    <div id="category-icon">
      <div id="category-icon-upload-results">
        <?php if ($category->icon_uri == null || $category->icon_uri == ''): ?>
          Kategorian kuvaketta ei vielä ole lähetetty.
        <?php else: ?>
          Kategorian kuvake on jo lähetetty. Kuvakkeen URI on: <?php print $category->icon_uri; ?>
        <?php endif; ?>
      </div>
    <div id="category-icon-upload">
      <input type="file" id="category-icon-file-chooser" />
      <button type="button" id="category-icon-upload-button">Lähetä kuvake</button>
      <script type="text/javascript">
        var categoryIconBucket = new AWS.S3({params: {Bucket: graphicsBucketName}});
        var categoryIconFileChooser = document.getElementById('category-icon-file-chooser');
        var categoryIconUploadButton = document.getElementById('category-icon-upload-button');
        var categoryIconUploadResults = document.getElementById('category-icon-upload-results');
        categoryIconUploadButton.addEventListener('click', function() {
          var iconFile = categoryIconFileChooser.files[0];

          if (iconFile) {
            // Is the file of the right type?
            if (!checkFileType(iconFile, new Array('image/png'))) {
                categoryIconUploadResults.innerHTML = "Virhe: Kuvatiedosto on väärää tyyppiä.";
                return;
            }

            var iconUploadFilename = generateCategoryIconFilename(categoryId, iconFile);
            var iconParams = {Key: iconUploadFilename, ContentType: iconFile.type, Body: iconFile};
            categoryIconUploadResults.innerHTML = 'Kuvaketta lähetetään. Odota hetki...';
            categoryIconBucket.upload(iconParams, function (err, data) {
              if (err) {
                  categoryIconUploadResults.innerHTML = 'Kuvakkeen lähettämisessä tapahtui virhe: ' + err;
              } else {
                categoryIconUploadResults.innerHTML = 'Kuvake lähetettiin onnistuneesti.';
                // Make an AJAX call to icon_upload_completed/id.
                categoryIconUploadCompleted(categoryId, iconUploadFilename);
              }
            });
          } else {
            categoryIconUploadResults.innerHTML = 'Valitse ensin lähetettävä kuvake.';
          }
        }, false);
      </script>
    </div>
    </div>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

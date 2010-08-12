<h1><?php echo __('Edit Page'); ?></h2>

<?php if (isset($statusHtml)) echo $statusHtml; ?>
<?php echo Form::open($formUrl, array('method' => 'post', 'class' => 'editForm')); ?>

<h2><?php echo __('Generic Page Properties'); ?></h2>
<label class="line"><?php echo Form::checkbox('publish_flag', $pageData['publish_flag'], $pageData['publish_flag_checked']); ?> <?php echo __('Publish'); ?></label>
<br />
<?php echo Form::label('page_section', __('Section')); ?>
<?php // eventually we will want someting like this: echo Form::select('page_section_id', $sectionData, '', array('id' => 'page_section_id')); ?>
<?php echo Form::input('page_section', $section, array('readonly' => 'readonly')); ?>
<?php echo Form::hidden('page_section_id', $pageData['section']); ?>
<br />
<?php echo Form::label('page_short_name', __('Short Name')); ?>
<?php echo Form::input('page_short_name', $pageData['short_name'], array('readonly' => 'readonly')); ?>
<br />
<?php echo Form::label('start_date', __('Start Publishing Date')); ?>
<?php echo Form::input('start_date', $pageData['publish_start_time'], array('id' => 'start_date')); ?>
<br />
<?php echo Form::label('end_date', __('End Publishing Date')); ?>
<?php echo Form::input('end_date', $pageData['publish_end_time'], array('id' => 'end_date')); ?>

<h2><?php echo __('Canadian English (en-ca)'); ?></h2>
<br />
<label class="line"><?php echo Form::checkbox('en_publish_flag', $enContentData['publish_flag'], $enContentData['publish_flag_checked']);?> <?php echo __('Publish'); ?></label>
<br />
<?php echo Form::label('en_title', __('Title'), array('maxlength' => '255')); ?>
<?php echo Form::input('en_title', $enContentData['title']); ?>
<br />
<?php echo Form::label('en_html', __('HTML Content')); ?>
<?php echo Form::textarea('en_html', $enContentData['html'], array('id' => 'en_html', 'rows' => '10', 'cols' => '50')); ?>
<br />
<?php echo Form::label('en_meta_description', __('META Description')); ?>
<?php echo Form::input('en_meta_description', $enContentData['meta_description'], array('class' => 'metaField', 'maxlength' => '255')); ?>
<br />
<?php echo Form::label('en_meta_keywords', __('META Keywords')); ?>
<?php echo Form::input('en_meta_keywords', $enContentData['meta_keywords'], array('class' => 'metaField', 'maxlength' => '255')); ?>

<aside class="controlRow">
    <?php echo Form::submit('Save', __('Save')); ?>
</aside>

<h2><?php echo __('Canadian French (fr-ca)'); ?></h2>
<br />
<label class="line"><?php echo Form::checkbox('fr_publish_flag', $frContentData['publish_flag'], $frContentData['publish_flag_checked']);?> <?php echo __('Publish'); ?></label>
<br />
<?php echo Form::label('fr_title', __('Title'), array('maxlength' => '255')); ?>
<?php echo Form::input('fr_title', $frContentData['title']); ?>
<br />
<?php echo Form::label('fr_html', __('HTML Content')); ?>
<?php echo Form::textarea('fr_html', $frContentData['html'], array('id' => 'fr_html', 'rows' => '10', 'cols' => '50')); ?>
<br />
<?php echo Form::label('fr_meta_description', __('META Description')); ?>
<?php echo Form::input('fr_meta_description', $frContentData['meta_description'], array('class' => 'metaField', 'maxlength' => '255')); ?>
<br />
<?php echo Form::label('fr_meta_keywords', __('META Keywords')); ?>
<?php echo Form::input('fr_meta_keywords', $frContentData['meta_keywords'], array('class' => 'metaField', 'maxlength' => '255')); ?>

<aside class="controlRow">
    <?php echo Form::submit('Save', __('Save')); ?>
</aside>
<script id="editFormJs"></script>
<?php echo Form::close(); ?>
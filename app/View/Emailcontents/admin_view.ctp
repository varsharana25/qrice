<div class="emailcontents view">
<h2><?php echo __('Emailcontent'); ?></h2>
	<dl>
		<dt><?php echo __('Emailcontent Id'); ?></dt>
		<dd>
			<?php echo h($emailcontent['Emailcontent']['emailcontent_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($emailcontent['Emailcontent']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Label'); ?></dt>
		<dd>
			<?php echo h($emailcontent['Emailcontent']['label']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fromname'); ?></dt>
		<dd>
			<?php echo h($emailcontent['Emailcontent']['fromname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fromemail'); ?></dt>
		<dd>
			<?php echo h($emailcontent['Emailcontent']['fromemail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Toemail'); ?></dt>
		<dd>
			<?php echo h($emailcontent['Emailcontent']['toemail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ccemail'); ?></dt>
		<dd>
			<?php echo h($emailcontent['Emailcontent']['ccemail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($emailcontent['Emailcontent']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Emailcontent'); ?></dt>
		<dd>
			<?php echo h($emailcontent['Emailcontent']['emailcontent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Date'); ?></dt>
		<dd>
			<?php echo h($emailcontent['Emailcontent']['created_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified Date'); ?></dt>
		<dd>
			<?php echo h($emailcontent['Emailcontent']['modified_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Emailcontent'), array('action' => 'edit', $emailcontent['Emailcontent']['emailcontent_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Emailcontent'), array('action' => 'delete', $emailcontent['Emailcontent']['emailcontent_id']), array(), __('Are you sure you want to delete # %s?', $emailcontent['Emailcontent']['emailcontent_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Emailcontents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emailcontent'), array('action' => 'add')); ?> </li>
	</ul>
</div>

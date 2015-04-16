<?php $this->load->helper('render'); ?>
<?php $this->load->helper('form'); ?>
<?php $this->load->view('admin_header'); ?>
<?php $this->load->view('admin_menu', array('tables' => $tables, 'current' => null)); ?>

<?php if (isset($error_no)) { ?>
    <?php if ($error_no === 0) { ?>
<p><?php echo $info; ?></p>
    <?php } else { ?>
<p>错误 <?php echo $error_no; ?>: <?php echo $info; ?></p>
    <?php } ?>
<?php } ?>

<?php echo form_open('admin/modify/' . (string)$current . '/'  . (string)$wid); ?>
<?php foreach ($tables[$current] as $entry => $format) { ?>
    <label for="<?php echo $entry; ?>"><?php echo $entry; ?></label>
    <?php echo render_input($entry, $row, $format, $foreign_keys); echo '<br>'; ?>
<?php } ?>
<input type='submit' value='提交'>
<?php echo form_close(); ?>
<a href="<?php echo site_url('admin/ls/' . $current . '/'); ?>">返回</a>

<?php $this->load->view('admin_footer', $tables);

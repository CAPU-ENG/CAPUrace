<ul>
<?php $this->load->helper('url'); ?>
<?php foreach ($tables as $name => $format) { ?>
    <li>
    <?php if ($name !== $current) { ?>
        <a href="<?php echo site_url('/admin/ls/' . $name); ?>">
    <?php } ?>
    <?php echo $name; ?>
    <?php if ($name !== $current) { ?>
        </a>
    <?php } ?>
    </li>
<?php } ?>
</ul>

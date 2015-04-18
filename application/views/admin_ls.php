<?php $this->load->helper('render'); ?>
<?php $this->load->view('admin_header'); ?>
<?php $this->load->view('admin_menu', array('tables' => $tables, 'current' => isset($current) ? $current : NULL)); ?>

<?php if (isset($current)) { ?>
<table>
    <thead>
        <tr>
    <?php foreach ($tables[$current] as $name => $content) { ?>
            <td><?php echo $name; ?></td>
    <?php }?>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($records as $row) { ?>
        <tr>
        <?php $current_table = $tables[$current]; ?>
        <?php foreach ($current_table as $name => $format) { ?>
            <td><?php echo render_value($name, $row, $format); ?></td>
        <?php }?>
            <td>
                <a href="<?php echo site_url('admin/modify/' . $current . '/' . (string)$row['id']); ?>">修改</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<a href="<?php echo site_url('admin/csv/' . $current . '/'); ?>">csv</a>
<a href="<?php echo site_url('admin/modify/' . $current . '/new/'); ?>">添加</a>
<?php } ?>

<?php $this->load->view('admin_footer', $tables);

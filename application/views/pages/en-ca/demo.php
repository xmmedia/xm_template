<?php try { ?>

Select Array: <?php echo ClaeroForm::select('select_array[]', array(
    'value1' => 'Name 1',
    'value2' => 'Name 2'), 'value2', array(
        'multiple' => TRUE,
        'class' => 'test_field'
    ), array(
        'add_values' => array(
            'value0' => 'New Value',
        ),
        'select_one' => TRUE,
        'select_none' => TRUE,
    )) . HEOL . HEOL; ?>

Select SQL: <?php echo ClaeroForm::select('select_sql', "SELECT id, name FROM auth_type ORDER BY display_order, name", NULL, array(
        'class' => 'test_field'
    ), array('select_one' => TRUE,)) . HEOL . HEOL; ?>

Select SQL Parent: <?php echo ClaeroForm::select('select_sql_parent', "SELECT p.name AS parent, c.id, c.name
        FROM select_parent AS p
            LEFT JOIN select_child AS c ON (c.select_parent_id = p.id)
        ORDER BY p.display_order, p.name, c.display_order, c.name", NULL, array(
        'class' => 'test_field'
    ), array('select_one' => TRUE,)) . HEOL . HEOL; ?>

Radio SQL: <?php echo HEOL . ClaeroForm::radios('radios', "SELECT id, name FROM auth_type ORDER BY display_order, name", NULL, array(
        'class' => 'test_field'
    ), array('orientation' => 'table_vertical')) . HEOL . HEOL; ?>

Checkbox SQL: <?php echo ClaeroForm::checkboxes('checkboxes', "SELECT id, name FROM auth_type ORDER BY display_order, name", NULL, array(
        'class' => 'test_field'
    ), array('orientation' => 'vertical')) . HEOL . HEOL; ?>

Checkbox SQL Table: <?php echo ClaeroForm::checkboxes('checkboxes_table', "SELECT id, name FROM auth_type ORDER BY display_order, name", NULL, array(
        'class' => 'test_field'
    ), array('orientation' => 'table')) . HEOL . HEOL; ?>

Date: <?php echo ClaeroForm::date('date', date('Y-m-d', strtotime('-2 weeks')), array(
        'class' => 'test_field')) . HEOL . HEOL; ?>
<span id="additional_date_fields"></span>
<a href="" id="newDate">Add Date Field</a><br /><br />

Datetime: <?php echo ClaeroForm::datetime('datetime', date('Y-m-d H:i:s', strtotime('-2 weeks')), array(
        'class' => 'test_field')) . HEOL . HEOL; ?>


Date Drop: <?php echo ClaeroForm::date_drop('date_drop', date('Y-m-d H:i:s', strtotime('-2 weeks')), array(
        'class' => 'test_field')) . HEOL . HEOL; ?>

Date Drop: <?php echo ClaeroForm::checkbox_search('checkbox_search', 1, array(
        'class' => 'test_field')) . HEOL . HEOL; ?>

Password Confirm: <?php echo HEOL . ClaeroForm::password_confirm('password', 'balh', array(
        'class' => 'test_field')) . HEOL . HEOL; ?>

Yes/No: <?php echo HEOL . ClaeroForm::yes_no('yes_no', 2, array(
        'class' => 'test_field')) . HEOL . HEOL; ?>

Gender: <?php echo HEOL . ClaeroForm::gender('gender', 2, array(
        'class' => 'test_field')) . HEOL . HEOL; ?>

Range Select: <?php echo HEOL . ClaeroForm::range_select('range_select', 2, 8, 5, array(
        'class' => 'test_field'), array(
        'select_one' => TRUE,
        )) . HEOL . HEOL; ?>

Text: <?php echo HEOL . ClaeroForm::input('text', 'this is a test', array(
        'class' => 'test_field')) . HEOL . HEOL; ?>

Height: <?php echo HEOL . ClaeroForm::height('height', 72, array(
        'class' => 'test_field')) . HEOL . HEOL; ?>

<?php } catch (Exception $e) {
    if (DEVELOPMENT_FLAG) {
        Kohana::exception_handler($e);
    }

    echo 'There was a problem generating the form. Please try again later.';
}
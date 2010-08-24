<?php try { ?>

Select Array: <?php echo ClaeroForm::select('select_array[]', array(
    'value1' => 'Name 1',
    'value2' => 'Name 2'), 'value2', array(
        'multiple' => TRUE,
        'class' => 'testField'
    ), array(
        'add_values' => array(
            'value0' => 'New Value',
        ),
        'select_one' => TRUE,
        'select_none' => TRUE,
    )) . HEOL . HEOL; ?>

Select SQL: <?php echo ClaeroForm::select('select_sql', "SELECT id, name FROM auth_type ORDER BY display_order, name", NULL, array(
        'class' => 'testField'
    ), array('select_one' => TRUE,)) . HEOL . HEOL; ?>

Select SQL Parent: <?php echo ClaeroForm::select('select_sql_parent', "SELECT p.name AS parent, c.id, c.name
        FROM select_parent AS p
            LEFT JOIN select_child AS c ON (c.select_parent_id = p.id)
        ORDER BY p.display_order, p.name, c.display_order, c.name", NULL, array(
        'class' => 'testField'
    ), array('select_one' => TRUE,)) . HEOL . HEOL; ?>

Radio SQL: <?php echo HEOL . ClaeroForm::radios('radios', "SELECT id, name FROM auth_type ORDER BY display_order, name", NULL, array(
        'class' => 'testField'
    ), array('orientation' => 'table_vertical')) . HEOL . HEOL; ?>

Checkbox SQL: <?php echo ClaeroForm::checkboxes('checkboxes', "SELECT id, name FROM auth_type ORDER BY display_order, name", NULL, array(
        'class' => 'testField'
    ), array('orientation' => 'vertical')) . HEOL . HEOL; ?>

Checkbox SQL Table: <?php echo ClaeroForm::checkboxes('checkboxes_table', "SELECT id, name FROM auth_type ORDER BY display_order, name", NULL, array(
        'class' => 'testField'
    ), array('orientation' => 'table')) . HEOL . HEOL; ?>

<span id="dateFieldToCopy">Date: <?php echo ClaeroForm::date('date', date('Y-m-d', strtotime('-2 weeks')), array(
        'class' => 'testField')) . HEOL . HEOL; ?></span>

<a href="" id="newDate">Add Date Field</a>

<?php } catch (Exception $e) {
    if (DEVELOPMENT_FLAG) {
        Kohana::exception_handler($e);
    }

    echo 'There was a problem generating the form. Please try again later.';
}
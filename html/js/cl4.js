$.datepicker.setDefaults({
    dateFormat: 'yy-mm-dd',
    showOn: 'both',
    buttonImage: '/lib/claerolib_3/images/calendar.gif',
    buttonImageOnly: true,
    buttonText: 'Click view calendar to pick date',
    showButtonPanel: true,
    changeMonth: true,
    changeYear: true,
    constrainInput: false,
    duration: 'fast',
    yearRange: 'c-5:c+5',
    appendText: '(YYYY-MM-DD)'
});

var MULTIPLE_EDIT = 0;

$(function() {
    // enable the numeric only functionaltiy for fields with class numeric
    $('.numeric').numeric();
});

// invoked when a user clicks the checkbox to either expire or delete a record
function SetExpireFlag(b) {
  var confirmDeleteForm = document.forms['confirm_delete'];
  if (b) {
      confirmDeleteForm.expiryFlag.value = 1;
  } else {
      confirmDeleteForm.expiryFlag.value = 0;
  }
//    f.submit();
}

function clickContentBox(box, trueValue, falseValue) {
    var pattern = box.id.replace(/checkbox_/, "");
    var checkbox = get(pattern);
    if (! checkbox) {
        alert('System error - this field may not be updated in the database');
    }
    if (box.checked) {
        checkbox.value = trueValue;
    } else {
        checkbox.value = falseValue;
    }
}

function ClickMultipleEdit(checked) {
    if (checked) {
        MULTIPLE_EDIT++;
    } else {
        MULTIPLE_EDIT--;
    }
    var button = document.getElementById('submit_multiple_edit');
    if (button) {
        if (MULTIPLE_EDIT) {
            button.removeAttribute('disabled');
        } else {
            button.setAttribute('disabled', 'disabled');
        }
    }

    if (!checked) {
        // if a checkbox has been unchecked, then uncheck the check all checkbox
        c = document.getElementById('c_check_all');
        if (c) {
            c.checked = false;
        }
    }
}

function SubmitSearch() {
    var i = document.forms['claero_form'];
    eval('i.' + CLAERO_REQUEST_USER_ACTION + '.value = "search";');
    i.target = '_self';
    i.submit();
}

function CancelSearch() {
    var h = document.forms['claero_form'];
    eval('h.' + CLAERO_REQUEST_USER_ACTION + '.value = "cancel_search";');
    h.target = '_self';
    h.submit();
}

function SubmitAdd() {
    var g = document.forms['claero_form'];
    eval('g.' + CLAERO_REQUEST_USER_ACTION + '.value = "add";');
    g.target = '_self';
    g.submit();
}

function RecordCustom(id,action,target) {
    if (confirmDelete(id)) {
      var claeroForm = document.forms['claero_form'];
        eval('claeroForm.' + CLAERO_REQUEST_USER_ACTION + '.value = "' + action + '";');
        claeroForm.id.value = id;
        //if (target != 'null'){
            claeroForm.target = target;
        //}
        claeroForm.submit();
    }
}

function confirmDelete(name) {
//    input_box=confirm("Are you sure you want to remove '" + name + "' ?");
//    if (input_box==true) {
        return true;
//    }
}

function EditRecords() {
    var claeroForm2 = document.forms['claero_form'];
    if (CountCheckboxes(claeroForm2, 'ids[]') > 0) {
        eval('claeroForm2.' + CLAERO_REQUEST_USER_ACTION + '.value = "edit_multiple";');
        claeroForm2.submit();
    } else {
        alert('Please select atleast one record to edit.');
    }
}

function CountCheckboxes(theForm, name) {
    count = 0;
    for (i=0,n=theForm.elements.length-1;i<n;i++) {
        if (theForm.elements[i].name.indexOf(name) !=-1 && theForm.elements[i].checked == true) count ++;
    }
    return count;
}

function ExportRecords() {
    var claeroForm3 = document.forms['claero_form'];
    if (claeroForm3) {
        eval('claeroForm3.' + CLAERO_REQUEST_USER_ACTION + '.value = "create_csv";');
        claeroForm3.submit();
    }
}
/* not used ??
function RecordAdd(theRecord) {
    var f = document.forms['claero_form'];
    eval('f.' + CLAERO_REQUEST_USER_ACTION + '.value = "add";');
    f.id.value = theRecord;
    f.submit();
}
*/
function CancelForm(theForm, url) {
    // no url was passed, so submit the form
    if (arguments.length == 1) {
        theForm.user_action.value = "cancel";
        theForm.submit();
    // a url was passed, so use that to redirect the browser
    } else {
        document.location = url;
    }
}

function CheckAllCheckBoxes(f, name, checked) {
    if (arguments.length == 2) { checked = true; }
    count = 0;
    var form = GetById(f);
    var children = GetByTagName(f, "input");
    for (i = 0; i < children.length; i++) {
        if (children[i].type == "checkbox") {
            if (!name || children[i].name == name) {
                children[i].checked = checked;
                if (children[i].checked) count++;
            }
        }
    }

    if (checked) {
        return count-1;
    } else {
        return 0;
    }
}

/******************    helper functions    ******************/

// returns the number of checkboxes that are child elements of f and that are checked
/* long and complicated
function CountCheckedBoxes(f, name) {
    var count = 0;
    var children = GetByTagName(f, "input");
    for (var i = 0; i < children.length; i++) {
    alert(children[i].type);continue;
        if (children[i].type == "checkbox" && children[i].checked) {
            if (name) {
                if (children[i].name == name) {
                    count++;
                }
            } else {
                count++;
            }
        }
    }
    return count;
}
*/

// get a reference to an element by id
function GetById(id) {
    if (typeof id == "string") {
        return document.getElementById(id);
    } else {
        return id;
    }
}

// retrieves a list of all child tags with the appropriate name
function GetByTagName(tag, name) {
    if (arguments.length == 1) {
        return document.getElementsByTagName(tag);
    } else {
        var t = GetById(tag);
        if (! t) { return false; }
        return t.getElementsByTagName(name);
    }
}

/** the next 2 functions are for dealing with 1 to multiple edits **/
function AddMultipleRow(formId, table) {
    f = document.getElementById(formId);
    a = document.getElementById('c_add_row');
    if (f && a) {
        a.value = table;
        f.submit();
    } else {
        alert('There was an error while adding a new row.');
    }
}

function RemoveMultipleRow(rowId, deleteFlag) {
    r = document.getElementById(rowId);
    f = document.getElementById(deleteFlag);
    if (r && f) {
        r.style.display = 'none';
        f.value = 1;
    }
}

// jQuery Extension: any fields it is added to will not allow most non numeric values
if (jQuery) {
    jQuery.fn.numeric = function() {
        this.keypress(function(e) {
            var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
            if (e.ctrlKey || e.altKey // ctrl or alt key has been pressed
                || (key >= 48 && key <= 57) // numbers
                || key == 9 // tab
                || key == 39 // right, also single quote
                || key == 37 // left, also percent "%"
                || key == 35 // end, also hash "#"
                || key == 36 // home, also dollar symbol "$"
                || key == 8 // backspace
                || key == 46 // delete, also period "."
                || key == 13 // enter
                || key == 45 // dash "-"
                || key == 43) { // plus "+"
                    return true;
            }

            return false;
        });

        return this;
    }
}
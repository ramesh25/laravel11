let checked = false;

function toggleSelect() {
  const frm = document.getElementById('frmListing');
  checked = !checked;
  Array.from(frm.elements).forEach(el => {
    if (el.name === 'ids[]') {
      el.checked = checked;
    }
  });
}

function count_checked() {
  return Array.from(document.querySelectorAll("[name='ids[]']")).filter(e => e.checked).length;
}

function actionSubmit(action) {
  if (count_checked() === 0) {
    alert('Please select item(s) first.');
    return false;
  }
  const form = document.getElementById('frmListing');
  form.action = action;
  form.submit();
}

function actionConfirm(action, task) {
  if (count_checked() === 0) {
    alert('Please select item(s) first.');
    return false;
  }
  if (confirm("Are you sure to " + task + "?")) {
    const form = document.getElementById('frmListing');
    form.action = action;
    form.submit();
  } else {
    return false;
  }
}
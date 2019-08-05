//Function to prompt the user for delete programme confirmation
function deleteProgramme(progID) {
    alertify.confirm("Confirm to delete programme \"" + progID + "\"?", function (e) {
        if (e) {
            $('#delete' + progID).submit();
        }
    }).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': {
            ok: 'Delete',
            cancel: "Cancel"
        }
    }).setHeader("Delete Confirmation").show();
}

//Function to prompt the user for delete certificate confirmation
function deleteCertificate(certID, certName) {
    alertify.confirm(`Confirm to delete certificate "${certName}"?`, function (e) {
        if (e) {
            $('#delete' + certID).submit();
        }
    }).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': {
            ok: 'Delete',
            cancel: "Cancel"
        }
    }).setHeader("Delete Confirmation").show();
}

//Function to prompt the user for delete course confirmation
function deleteCourse(courseID, courseName) {
    const delForm = document.querySelector('.del_form');

    alertify.confirm(`Confirm to delete course "${courseID}-${courseName}?`, function (e) {
        if (e) {
            delForm.action = `/faculty_staff/courses/${courseID}/delete`;
            delForm.submit();
        }
    }).setting({
        'transition': 'zoom',
        'movable': false,
        'modal': true,
        'labels': {
            ok: 'Delete',
            cancel: "Cancel"
        }
    }).setHeader("Delete Confirmation").show();
}
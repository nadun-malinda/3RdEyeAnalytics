function checkFieldEmpty(str, id, form) {
    var errBox = '#' + id + ' + span'; //#id + span
    if (str == '') {
        document.getElementById(id).className = 'form-control input-danger';
        document.querySelector(errBox).innerHTML = 'You can\'t leave this empty.';

    }else {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if(this.readyState == 4 && this.status == 200) {
            document.querySelector(errBox).innerHTML = this.responseText;
          }
        };

        xhttp.open("POST", "ajax_form_validate.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("field="+id+"&value="+str+"&form="+form);
    }
}
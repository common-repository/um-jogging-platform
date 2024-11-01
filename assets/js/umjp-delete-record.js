function umjpDeleteRecord(index) {

    console.log(123);

    const tableRows =  document.querySelectorAll('.umjp-dataRow');
    const date =      tableRows[index].cells[0].innerText;
    const distance =  tableRows[index].cells[1].innerText;
    const time =      tableRows[index].cells[2].innerText;

    const xhttp = new XMLHttpRequest();

    xhttp.open("POST", umjp_AJAX.ajax_url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`action=deleteData&umjp_date=${date}&umjp_time=${time}`);

    xhttp.onreadystatechange = () => {
        if(xhttp.readyState == 4 && xhttp.status == 200) {
            tableRows[index].remove();
        }
    }

}


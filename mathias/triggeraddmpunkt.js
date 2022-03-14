function addMpunkt(filename, value)
{
    let sendString = "file=" + filename + "&value=" + value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();
        }
    };
    xmlhttp.open("GET", "addmpunkt.php?" + sendString, true);
    xmlhttp.send();
}
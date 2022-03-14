function addMpunkt(filename, value)
{
    let sendString = "file=" + filename + "&value=" + value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Add the value locally, so that we won't have to reload the page every single time
            let id = filename;
            document.getElementById(id).textContent = parseInt(document.getElementById(id).textContent) + value;
        }
    };
    xmlhttp.open("GET", "addmpunkt.php?" + sendString, true);
    xmlhttp.send();
}
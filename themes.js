const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

if (getCookie("darkMode") == "true") {
    switchDarkMode();
}

function switchTheme(e) {
    if (e.target.checked) {
        switchDarkMode();
    }
    else {
        switchLightMode();
    }    

    document.cookie = "darkMode=" + e.target.checked + "; SameSite=None; Secure";
}

toggleSwitch.addEventListener('change', switchTheme, false);

function switchDarkMode() {
    document.documentElement.setAttribute('data-theme', 'dark');
    document.getElementById('theme-switch-image').setAttribute("src", "/img/moon.svg");
    document.getElementById('theme-switch-image').setAttribute("style", "filter: invert(100%);");
}

function switchLightMode() {
    document.documentElement.setAttribute('data-theme', 'light');
    document.getElementById('theme-switch-image').setAttribute("src", "/img/sun.svg");
    document.getElementById('theme-switch-image').setAttribute("style", "filter: invert(0%);");
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
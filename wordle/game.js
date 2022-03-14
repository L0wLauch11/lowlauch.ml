let allowedKeys = "ABCDEFGHIJKLMNOPQRSTUVWXYZÖÄÜ";

let position = 0;
let row = 0;

let canType = true;
let won = false;

let wordCount = parseInt(document.getElementById("wordcount").textContent);
let wordArray = new Array();
for (let i = 0; i < wordCount; i++) {
    wordArray.push(document.getElementById("word" + i.toString()).textContent.toUpperCase());
}
let wordId = getRandomInt(wordCount);
let word = wordArray[wordId];

let selectedLetter = document.getElementById(position);
selectedLetter.setAttribute("class", "selected");

document.addEventListener("keydown", keyDown);

function keyDown(e) {
    let key = `${e.key}`.toUpperCase();

    // Removing a letter
    if (`${e.key}` == "Backspace" || `${e.key}` == "<")
    if (position != 0 && position - row * 5 > 0 || !canType) {

        canType = true;

        selectedLetter = document.getElementById(position);
        selectedLetter.setAttribute("class", "deselected");
        selectedLetter.textContent = "";

        position--;
        selectedLetter = document.getElementById(position);
        selectedLetter.setAttribute("class", "selected");
        selectedLetter.textContent = "";

        return;
    }

    if (!allowedKeys.includes(key) || !canType || `${e.key}` == "Enter")
        return;

    selectedLetter.textContent = key;
    selectedLetter.setAttribute("class", "deselected");

    // Update game every new row
    position++;
    if (position % 5 == 0 && position != 0) {
        gameUpdate();
    }

    // Select next letter
    selectedLetter = document.getElementById(position);
    while (selectedLetter == null) {
        position--;
        selectedLetter = document.getElementById(position);
    }

    selectedLetter.setAttribute("class", "selected");
}

// Virtual keyboard
let allowedKeysArray = Array.from(allowedKeys + "<");
for (let i = 0; i < allowedKeysArray.length; i++) {
    let keyboardKey = document.getElementById(allowedKeysArray[i]);
    keyboardKey.onclick = () => {
        let key = allowedKeysArray[i].toLowerCase();
        document.dispatchEvent(new KeyboardEvent('keydown', { 'key': key }));
    }

}

function gameUpdate() {
    let wordCharArray = Array.from(word);
    let userWord = "";
    let correctCount = 0;

    let wordLetter, id, element, letter, key;
    for (let i = 4; i >= 0; i--) {
        id = position + i - 5;
        wordLetter = wordCharArray[id - row * 5];
        element = document.getElementById(id);

        letter = element.textContent;
        userWord += letter;

        element.setAttribute("class", "wrong");

        if (word.includes(letter) && element.getAttribute("class") != "correct") {
            element.setAttribute("class", "included");
        }

        if (wordLetter == letter) {
            element.setAttribute("class", "correct");
            correctCount++;
        }

        // Mark word red if the word doesn't exist in the list
        if (i == 0) {
            userWord = reverseString(userWord);

            if (!wordArray.includes(userWord)) {
                for (let j = 0; j < 5; j++) {
                    let doesntExistElement = document.getElementById(id + j);
                    doesntExistElement.setAttribute("class", "doesntexist");
                }

                canType = false;
                row--;
            }
        }
    }

    // Update keyboard key color
    for (let i = 4; i >= 0; i--) {
        id = position + i - 5;
        element = document.getElementById(id);

        letter = element.textContent;
        key = document.getElementById(letter);
        if (element.getAttribute("class") != "doesntexist" && element.getAttribute("class") != "deselected" && key.getAttribute("class") != "correct") {
            key.setAttribute("class", element.getAttribute("class"));
        }

    }

    row++;

    // Winning condition
    if (correctCount >= 5) {
        won = true;
        popupGameCondition("winPopup", 0, word);
    }

    // Losing condition
    if (row >= 6 && !won) {
        popupGameCondition("losePopup", 1, word);
    }
}

function removeBadWord() {
    let sendString = "wordLine=" + wordId.toString();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Das Wort wurde entfernt.");
            location.reload();
        }
    };
    xmlhttp.open("GET", "removeword.php?" + sendString, true);
    xmlhttp.send();
}

function popupGameCondition(popupName, popupId, appendText = "") {
    let modal = document.getElementById(popupName);
    let span = document.getElementsByClassName("close")[popupId];
    let closeButton = document.getElementsByClassName("closeButton")[popupId];
    let badWordButton = document.getElementsByClassName("badWordButton")[popupId];
    let text = document.getElementsByClassName("text")[popupId];
    text.textContent += appendText;

    modal.style.display = "block";

    span.onclick = () => {
        location.reload();
    }

    closeButton.onclick = () => {
        location.reload();
    }

    badWordButton.onclick = () => {
        removeBadWord();
    }
}

// Helper functions
function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}

function reverseString(str) {
    return str.split("").reverse().join("");
}
let position = 0;
let row = 0;
let won = false;
let canType = true;
let allowedKeys = "ABCDEFGHIJKLMNOPQRSTUVWXYZÖÄÜ";
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

    if (position != 0 && position - row * 5 > 0 && `${e.keyCode}` == 8 /*backspace*/ ||
        !canType && `${e.keyCode}` == 8) {

        canType = true;

        selectedLetter = document.getElementById(position);
        selectedLetter.setAttribute("class", "deselected");
        selectedLetter.textContent = "";

        position--;
        selectedLetter = document.getElementById(position);
        selectedLetter.setAttribute("class", "selected");
        selectedLetter.textContent = "";
    }

    if (!allowedKeys.includes(key) || !canType)
        return;

    selectedLetter.textContent = key;
    selectedLetter.setAttribute("class", "deselected");

    // Gameplay
    position++;
    if (position % 5 == 0 && position != 0) {
        let wordCharArray = Array.from(word);
        let correctCount = 0;

        let wordLetter, id, element, letter, key, userWord = "";
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

        for (let i = 4; i >= 0; i--) {
            id = position + i - 5;
            element = document.getElementById(id);

            letter = element.textContent;
            key = document.getElementById(letter);
            if (element.getAttribute("class") != "doesntexist" && element.getAttribute("class") != "deselected") {
                key.setAttribute("class", element.getAttribute("class"));
            }

        }

        row++;

        // Winning condition
        if (correctCount >= 5) {
            won = true;

            let modal = document.getElementById("winPopup");
            let span = document.getElementsByClassName("close")[0];
            let closeButton = document.getElementsByClassName("closeButton")[0];
            let badWordButton = document.getElementsByClassName("badWordButton")[0];

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

        // Losing condition
        if (row >= 6 && !won) {
            let modal = document.getElementById("losePopup");
            let span = document.getElementsByClassName("close")[1];
            let closeButton = document.getElementsByClassName("closeButton")[1];
            let badWordButton = document.getElementsByClassName("badWordButton")[1];
            let loseText = document.getElementById("loseText");
            loseText.textContent += word;

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
    }

    // Select next letter
    selectedLetter = document.getElementById(position);
    while (selectedLetter == null) {
        position--;
        selectedLetter = document.getElementById(position);
    }

    selectedLetter.setAttribute("class", "selected");
}

function removeBadWord() {
    let sendString = "wordLine=" + wordId.toString();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Das Wort wurde entfernt.");
        }
    };
    xmlhttp.open("GET", "removeword.php?" + sendString, true);
    xmlhttp.send();
}

// Helper functions
function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}

function reverseString(str) {
    return str.split("").reverse().join("");
}
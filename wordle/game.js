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
let word = wordArray[getRandomInt(wordCount)];

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
            key = document.getElementById(letter);

            element.setAttribute("class", "wrong");
            key.setAttribute("class", "wrong");

            if (i == 0) {
                userWord = reverseString(userWord);

                if (wordArray.includes(userWord))
                    continue;

                for (let j = 0; j < 5; j++) {
                    let doesntExist = document.getElementById(id + j);
                    doesntExist.setAttribute("class", "doesntexist");
                }

                canType = false;
                row--;
            } else {
                if (word.includes(letter)) {
                    element.setAttribute("class", "included");
                    key.setAttribute("class", "included");
                }

                if (wordLetter == letter) {
                    element.setAttribute("class", "correct");
                    key.setAttribute("class", "correct");
                    correctCount++;
                }
            }
        }

        // Winning condition
        if (correctCount >= 5) {
            won = true;

            let modal = document.getElementById("winPopup");
            let span = document.getElementsByClassName("close")[0];
            let closeButton = document.getElementsByClassName("closeButton")[0];

            modal.style.display = "block";

            span.onclick = () => {
                location.reload();
            }

            closeButton.onclick = () => {
                location.reload();
            }

            window.onclick = (event) => {
                if (event.target == modal) {
                    location.reload();
                }
            }
        }

        row++;

        // Losing condition
        if (row >= 6 && !won) {
            let modal = document.getElementById("losePopup");
            let span = document.getElementsByClassName("close")[1];
            let closeButton = document.getElementsByClassName("closeButton")[1];
            let loseText = document.getElementById("loseText");
            loseText.textContent += word;

            modal.style.display = "block";

            span.onclick = () => {
                location.reload();
            }

            closeButton.onclick = () => {
                location.reload();
            }

            window.onclick = (event) => {
                if (event.target == modal) {
                    location.reload();
                }
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

// Helper functions
function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}

function reverseString(str) {
    return str.split("").reverse().join("");
}
const puzzSel = document.getElementById('puzzle-selection');
const grid = document.getElementById('puzzle-grid');
const startBtn = document.getElementById('start-btn');
const stopBtn = document.getElementById('stop-btn');
const puzzle = document.getElementsByName('puzzle');
const diff = document.getElementsByName('diff');
const countDown = document.getElementById('count-down-timer');
const intervals = [];
let timer = 0;
let puzzleArray = [];
let first = second = 0;
let prevIndex;
let correctFound = 0;
let disableClick = false;

startBtn.addEventListener('click', () => {
    let difficulty = 0;
    for (i = 0; i < diff.length; i++) {
        if (diff[i].checked) difficulty = diff[i].value;
    }
    for (i = 0; i < puzzle.length; i++) {
        if (puzzle[i].checked) setUpPuzzle(puzzle[i].value, difficulty);
    }
});
stopBtn.addEventListener('click', () => {
    stopGame();
})

function setUpPuzzle(puzzleSize, difficulty) {
    puzzSel.hidden = true;
    stopBtn.hidden = false;
    puzzleArray = [];
    timer = puzzleSize == 8 ? 120 : puzzle == 10 ? 150 : 180;
    countDown.style.color = 'unset';
    countDown.innerHTML = '';
    const cardSize = 120;
    grid.className = '';
    grid.classList.add(
        puzzleSize == 8
            ? 'grid-4x4'
            : puzzleSize == 10
            ? 'grid-5x4'
            : 'grid-6x4'
    );

    // Remove child nodes if exists
    if (grid.childNodes.length > 0) grid.innerHTML = '';

    for (i = 1; i <= puzzleSize; i++) {
        puzzleArray.push(i);
    }
    puzzleArray = puzzleArray.flatMap((i) => [i, i]);
    shuffle(puzzleArray);

    puzzleArray.forEach((puz) => {
        const item = document.createElement('div');
        item.classList.add('grid');
        const img = new Image(cardSize);
        img.src = 'images/selection/' + puz + '.jpg';
        item.appendChild(img);
        grid.appendChild(item);
    });

    flipTimer(difficulty, puzzleSize, cardSize)
}

function flipTimer(difficulty, puzzleSize, cardSize) {
    let difficultyCount = difficulty
    let flipTimerInterval = setInterval(() => {
        if(difficultyCount <= 0) {
            countDown.innerHTML = '';
            flipOver(puzzleSize, cardSize);
            startTimer();
            clearInterval(flipTimerInterval);
        } else {
            countDown.innerHTML = difficultyCount;
        }
        difficultyCount--;
    }, 1000);
    intervals.push(flipTimerInterval);
}
function startTimer() {
    let countDownInterval = setInterval(()=> {
        if(timer < 0) {
            countDown.innerHTML = "Time's up!";
            countDown.style.color = 'red';
            puzzSel.hidden = false;
            clearInterval(countDownInterval);
        } else {
            countDown.innerHTML = timer;
        }
        timer--;
    }, 1000);
    intervals.push(countDownInterval);
}
function flipOver(puzzleSize, cardSize) {
    grid.innerHTML = '';
    for (i = 1; i <= puzzleSize * 2; i++) {
        const item = document.createElement('div');
        item.classList.add('grid');
        item.id = i;
        const img = new Image(cardSize);
        img.src = 'images/cover/' + i + '.jpg';
        img.id = i;
        img.loading = 'lazy';
        item.appendChild(img);
        grid.appendChild(item);
    }
    addEvent();
}

function addEvent() {
    document.querySelectorAll('.grid').forEach((item) => {
        item.addEventListener('click', cardSelection);
    });
}

function cardSelection(event) {
    if(disableClick) {
        return;
    }
    if(timer <= 0) {
        return;
    }
    let index = event.target.id-1;
    event.target.src = 'images/selection/' + puzzleArray[index] + '.jpg';
    document.getElementById(index+1).style.borderColor = 'lightgreen';
    if(first == 0) {
        first = puzzleArray[index];
        prevIndex = index+1;
    }
    else if(first > 0 && second == 0) {
        second = puzzleArray[index];
        disableClick = true;
    }
    if(first > 0 && second > 0 ) {
        if(first == second){
            document.getElementById(prevIndex).removeEventListener('click', cardSelection)
            document.getElementById(index+1).removeEventListener('click', cardSelection)
            puzzleArray[prevIndex-1] = -1;
            puzzleArray[index] = -1;
            correctFound++;
            disableClick = false;
        } else {
            document.getElementById(prevIndex).style.borderColor = 'red';
            document.getElementById(index+1).style.borderColor = 'red';
            setTimeout(()=> {
                document.getElementById(prevIndex).style.borderColor = 'unset';
                document.getElementById(index+1).style.borderColor = 'unset';
                document.getElementById(prevIndex).getElementsByTagName('img')[0].src = 'images/cover/' + prevIndex + '.jpg';
                document.getElementById(index+1).getElementsByTagName('img')[0].src = 'images/cover/' + (index+1) + '.jpg';
                disableClick = false;
            },300)
        }
        first = 0;
        second = 0;
        winCheck(puzzleArray.length/2);
    }
}

function winCheck(puzzleSize) {
    if(correctFound == puzzleSize) {
        startConfetti();
        puzzSel.hidden = false;
        clearInterval(countDownInterval);
        correctFound = 0;
        countDown.style.color = 'green';
        countDown.innerHTML = 'YOU WON!';
        setTimeout(()=>{
            stopConfetti();
        },3000);
    }
}

function stopGame() {
    intervals.forEach(inv => {
        clearInterval(inv);
    })
    puzzSel.hidden = false;
    correctFound = 0;
    countDown.innerHTML = '';
    grid.innerHTML = '';
    stopBtn.hidden = true;
}

function shuffle(arr) {
    let currIndex = arr.length;
    let randIndex;

    while (currIndex != 0) {
        randIndex = Math.floor(Math.random() * currIndex);
        currIndex--;

        [arr[currIndex], arr[randIndex]] = [arr[randIndex], arr[currIndex]];
    }
    return arr;
}
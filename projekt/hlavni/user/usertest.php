<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="stylesheet.css?rnd=23" media="screen" />
</head>
<?php
include '../utils/navbar.php';
?>

<body>
    <div id="quiz"></div>
    <button id="submit">kontrola</button>
    <div id="results"></div>
</body>
<script>
    var myQuestions = [{
            question: "1. Právo nabývat, držet a nosit zbraň vymezené v §1 odst. 1 zákona o zbraních, jehož přesná formulace zní:„Právo nabývat, držet a nosit zbraň je zaričeno za podmínek stanovených tímto zákonem.“ má následujiící význam:",
            answers: {
                A: 'Umožňuje s jakoukoli zbraní a střelivem nakládat kterémukoli občanovi České republiky, a to bez ohledu na to, je-li držitelem zbrojního průkazu. Požadavky zákona o zbraních musí plnit pouze fyzické osoby, které mají sie místo pobytu na území České republiky, ale nejsou jejímy občany.<br>',
                B: 'Jedná ustanovení deklarující hodnotové ukotvení zákona o zbraních poskytující určitou oporu pro jeho prání intepretaci. Náklad se zbraněmi a střelivem lze věak pouze v souladu se zákonem.<br>',
                C: 'jedná se o ustanovení, které brání trestnímu postihu za nakládání se zbraněmi a střelivem v rozporu se zákonem.'
            },
            correctAnswer: 'B'
        },
        {
            question: "2. Zákon o zbraních a zákon o nakládání se zbaněmi v některých případech ovlivňujicích vnitří pořádek a bezpečnost",
            answers: {
                A: 'Jsou synonyma téhož právního předpisu, konkrétně zákna č. 119/2002 Sb.<br>',
                B: 'Jsou dva odlišné právní předpisy, které na sebe navzájem navazují.<br>',
                C: 'Jsou dva odlišné právní předpisy, přičemž zákon o zbraních se týká nakládání se zbraněmi v civilní sféře, zatímco zákon o nakládání se zbraněmi v některých případech bezpečnost upravuje nakládání se zbraněmi pouze u příslušníků ozbrojených sil.'
            },
            correctAnswer: 'B'
        },
        {
            question: "3. Na zaměstnance poskytovatele bezpečnostních služeb pověřené zajišťováním fyzické ostrahy státních jaderných zařízení se zákon o zbraních.",
            answers: {
                A: 'Vztahuje<br>',
                B: 'Vztahuje pouze tehdy, pokud tak rozhodne Státní úřad pro jadernou bezpečnost.<br>',
                C: 'Nevztahuje.'
            },
            correctAnswer: 'A'
        },
        {
            question: "4. Umožní-li mimo jiné stát disponovat se zbraní, střelivem nebo municí, které jsou v držení a nevztahuje se na ně zákon o zbraních,komukliv jinému, který j oprávněn zbraně, střelivo nebo munici drže podle zákona o zbraních ",
            answers: {
                A: 'Vztahuje se na tuto věc zákon o zbraních, a to počínaje dnem bezprostředně následujícím po dni, kdy bylo provedenoo komisionální převzetí příjemcem či jeho pověřeným zástupcem.<br>',
                B: 'Vztahuje se na tuto věc zákon o zbraních, pokud tak rozhodne přislušný útvar policie nebo Ministerstvo vnitra.<br>',
                C: 'Vztahuje se na tuto věc od okamžiku převzetí zákon o zbraních.'
            },
            correctAnswer: 'C'
        },
        {
            question: "5. Přenecháním zbraně nebo střeliva se pro účely zákona o zbraních rozumí",
            answers: {
                A: 'Poskytnutí možnosti příslušnému útvaru policie se zbraní a střelivem fakticky nakládat, a to nejdéle na dobu 10 pracovních dnů.<br>',
                B: 'Předložení zbraně na výzvu příslušného útvaru policie ke kontrole Českému úřadu pro zkoušení zbraní a střeliva v případě důvodného podezření na špatný technický stav.<br>',
                C: 'Poskytnutí možnosti jiné osobě zbraní nebo střelivem fakticky nakládat.'
            },
            correctAnswer: 'C'
        },
        {
            question: "6. Nošením zbraně nebo střeliva se pro účely zákona o zbraních mimo jiné rozumí",
            answers: {
                A: 'mít zbraň nebo střelivo u sebe, s výjimkou případů, kdy se jedná o držení.<br>',
                B: 'mít zbraň nebo střelivo umístěné v prostoru vymezeném poloměrem 10 metrů kolem dotčené osoby.<br>',
                C: 'mít zbraň nebo střelivo uvnitř bytových nebo provozních prostor nebo uvnitř zřetelné ohraničených nemovitostí se souhlasem vlastníka nebo nájemce uvedených prostor nebo nemovistosti.'
            },
            correctAnswer: 'A'
        },
        {
            question: "7. Podle zákona o zbraních zbraněmi zařazenými do kategorií A až D se rozumí též.",
            answers: {
                A: 'podstatné části zbraní, které svým rozhodnutím určí Ministerstvo vnitra ve spolupráci s Českým úřadem pro zkoušení zbraní a střeliva.<br>',
                B: 'Hlavní části zbraní, kterých jsou nebo mají být jejich součástí.<br>',
                C: 'všechny význmné části zbraně, které svým rozhodnutím určí Ministerstvo vnitra ve spolupráci s Ministerstvem orůmyslu a obchodu.'
            },
            correctAnswer: 'B'
        },
        {
            question: "8. V pochybnostech o zařazeí  tzpu zbraně nebo střeliva do kategorie podle zákona o zbraních rozhodujee.",
            answers: {
                A: 'Český úřad pro zkoušení zbraní a střeliva.<br>',
                B: 'příslušný útvar policie.<br>',
                C: 'Ministerstvo vnitra.'
            },
            correctAnswer: 'A'
        },
        {
            question: "9. Zbraně zvláštně účinné jsou podle zákona o zbraních",
            answers: {
                A: 'zbraně s úsťovou energií střely vyšší než 650 J.<br>',
                B: 'samočinné zbraně, zákeřné zbraně a střelná nástrahová zařízení.<br>',
                C: 'střelné zbraně ráže 20 mm nebo vyšší určené pro střelbu munice.'
            },
            correctAnswer: 'C'
        },
        {
            question: "10. Samočinné zbraně, nejde-li o expanzní zbraně, jsou podle zákona o zbraních zbraně zařazené mezi",
            answers: {
                A: 'zbraně kategorie B.<br>',
                B: 'zbraně kategorie C.<br>',
                C: 'zbraně kategorie A.'
            },
            correctAnswer: 'C'
        },
        {
            question: "11. Tlumiče hluku výstřelu jsou podle zákona o zbraních",
            answers: {
                A: 'kategorie B.<br>',
                B: 'kategorie C.<br>',
                C: 'kategorie C-I.'
            },
            correctAnswer: 'B'
        },
    ];

    var quizContainer = document.getElementById('quiz');
    var resultsContainer = document.getElementById('results');
    var submitButton = document.getElementById('submit');

    generateQuiz(myQuestions, quizContainer, resultsContainer, submitButton);

    function generateQuiz(questions, quizContainer, resultsContainer, submitButton) {

        function showQuestions(questions, quizContainer) {

            var output = [];
            var answers;


            for (var i = 0; i < questions.length; i++) {


                answers = [];


                for (letter in questions[i].answers) {


                    answers.push(
                        '<label>' +
                        '<input type="radio" name="question' + i + '" value="' + letter + '">' +
                        letter + ': ' +
                        questions[i].answers[letter] +
                        '</label>'
                    );
                }


                output.push(
                    '<div class="question">' + questions[i].question + '</div>' +
                    '<div class="answers">' + answers.join('') + '</div>'
                );
            }


            quizContainer.innerHTML = output.join('');
        }


        function showResults(questions, quizContainer, resultsContainer) {


            var answerContainers = quizContainer.querySelectorAll('.answers');


            var userAnswer = '';
            var numCorrect = 0;


            for (var i = 0; i < questions.length; i++) {


                userAnswer = (answerContainers[i].querySelector('input[name=question' + i + ']:checked') || {}).value;


                if (userAnswer === questions[i].correctAnswer) {

                    numCorrect++;


                    answerContainers[i].style.color = 'lightgreen';
                } else {

                    answerContainers[i].style.color = 'red';
                }
            }


            resultsContainer.innerHTML = numCorrect + ' z ' + questions.length;
        }


        showQuestions(questions, quizContainer);

        submitButton.onclick = function() {
            showResults(questions, quizContainer, resultsContainer);
        }

    }
</script>

</html>
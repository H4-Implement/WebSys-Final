<link rel="stylesheet" href="<?= base_url('assets/css/about.css') ?>">
</head>
<body>

<div class="carousel">

<div class="list">

    <div class="item" style="background-image: url('<?= base_url('assets/img/JC.jpg') ?>');">
        <div class="content">
            <div class="title">JC</div>
            <div class="name">ABLANIDA</div>
            <div class="des">The Front-End Developer, he is responsible for the design and aesthetically pleasing  User Interface. He collaborates
                with the Back-End Developer to ensure that there is connectibity among web pages.

            </div>
        </div>
    </div>

    <div class="item" style="background-image: url('<?= base_url('assets/img/CLAYTON.png') ?>');">
        <div class="content">
            <div class="title">CLAYTON</div>
            <div class="name">TAMBIS</div>
            <div class="des">The Project Manager and Software Engineer, he ensures that the project runs smoothly and oversee the possible risks of the project.
                His leadership translated to making sure that we are on time and can collaborate ideas.
            </div>
        </div>
    </div>

    <div class="item" style="background-image: url('<?= base_url('assets/img/LUIS.png') ?>');">
        <div class="content">
            <div class="title">LUIS</div>
            <div class="name">CORTEZ</div>
            <div class="des">The Full-stack Developer, he is behind all the functions and developing the application to its full form. 
                His rolle is crucial to build highest performance of our aoplication because he maintains the server-side logic and database integration.
            </div>
    </div>

    </div>

    <div class="item" style="background-image: url('<?= base_url('assets/img/VEN.jpg') ?>');">
        <div class="content">
            <div class="title">JAVE</div>
            <div class="name">CATALAN</div>
            <div class="des">The Back-End Developer, she is responsible for putting in functions and logic inside the code. She also integrated the 
                responsiveness and interactiveness of the design, making it user-centered and focused on their experience.
            </div>
        </div>
    </div>

    </div>

</div>

<div class="arrows">
    <button class="prev"><</button>
    <button class="next">></button>
</div>

<div class="timeRunning"></div>

</div>
<script>
    var nextBtn = document.querySelector('.next'),
    prevBtn = document.querySelector('.prev'),
    carousel = document.querySelector('.carousel'),
    list = document.querySelector('.list'), 
    item = document.querySelectorAll('.item'),
    runningTime = document.querySelector('.carousel .timeRunning') 

let timeRunning = 3000 
let timeAutoNext = 7000

nextBtn.onclick = function(){
    showSlider('next')
}

prevBtn.onclick = function(){
    showSlider('prev')
}

let runTimeOut 

let runNextAuto = setTimeout(() => {
    nextBtn.click()
}, timeAutoNext)


function resetTimeAnimation() {
    runningTime.style.animation = 'none'
    runningTime.offsetHeight 
    runningTime.style.animation = null 
    runningTime.style.animation = 'runningTime 7s linear 1 forwards'
}


function showSlider(type) {
    let sliderItemsDom = list.querySelectorAll('.carousel .list .item')
    if(type === 'next'){
        list.appendChild(sliderItemsDom[0])
        carousel.classList.add('next')
    } else{
        list.prepend(sliderItemsDom[sliderItemsDom.length - 1])
        carousel.classList.add('prev')
    }

    clearTimeout(runTimeOut)

    runTimeOut = setTimeout( () => {
        carousel.classList.remove('next')
        carousel.classList.remove('prev')
    }, timeRunning)


    clearTimeout(runNextAuto)
    runNextAuto = setTimeout(() => {
        nextBtn.click()
    }, timeAutoNext)

    resetTimeAnimation()
}

resetTimeAnimation()
</script>
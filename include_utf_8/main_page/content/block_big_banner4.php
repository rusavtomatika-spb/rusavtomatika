	<script>
/* Устанавливаем стартовый индекс слайда по умолчанию: */
let slideIndex = 1;
/* Вызываем функцию, которая реализована ниже: */
showSlides(slideIndex);

/* Увеличиваем индекс на 1 — показываем следующий слайд: */
function nextSlide() {
    showSlides(slideIndex += 1);
}

/* Уменьшаем индекс на 1 — показываем предыдущий слайд: */
function previousSlide() {
    showSlides(slideIndex -= 1);  
}

/* Устанавливаем текущий слайд: */
function currentSlide(n) {
    showSlides(slideIndex = n);
}

/* Функция перелистывания: */
function showSlides(n) {
    let slides = document.getElementsByClassName("item");

    // Обеспечиваем защиту от выхода за границы массива
    n = Math.max(Math.min(n, slides.length), 1);

    for (let slide of slides) {
        slide.style.display = "none";
    }

    // Безопасное присвоение стиля только если слайд существует
    if (slides[n - 1]) {
        slides[n - 1].style.display = "block";
    }
}
	</script>
	<style>
/* Слайдер: */
.slider{
/*    max-width: 1340px;
    position: relative;
    max-height: 360px;*/
    width: 100%;
    max-width: 1340px; /* Максимальная ширина */
	margin: auto;
    overflow: hidden;
    max-height: 360px;
    position: relative;
}

/* Картинка масштабируется по отношению к родительскому элементу: */
/*.slider .item img {
    object-fit: cover;
    width: 100%;
    height: 360px;
}*/

/* Кнопки назад и вперёд: */
.slider .previous, .slider .next {
    /* Добавляет курсору иконку, когда тот оказывается над кнопкой: */
    cursor: pointer;
    /* Положение элемента задаётся относительно границ браузера: */
    position: absolute;
    top: 50%;
    width: auto;
    margin-top: -22px;
    padding: 16px;
    /* Оформление самих кнопок: */
    color: white;
    font-weight: bold;
    font-size: 26px;
	text-decoration: none;
    /* Плавное появление фона при наведении курсора: */
    transition: 0.6s ease;
    /* Скругление границ: */
    border-radius: 0 3px 3px 0;
}
.slider .next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

/* При наведении курсора на кнопки добавляем фон кнопок: */
.slider .previous:hover,
.slider .next:hover {
    background-color: rgba(0, 0, 0, 0.2);
}

/* Анимация слайдов: */
.slider .item {
    animation-name: fade;
    animation-duration: 1.5s;
	height:inherit;
}
@keyframes fade {
    /* Устанавливаем и изменяем степень прозрачности: */
    from {
        opacity: 0.4
    }
    to {
        opacity: 1
    }
}
	#sld iframe,.slider iframe {
/*			max-width: 1340px;
			max-height: 360px;*/
    width: 100%;
    max-height: 360px; /* Начальная высота */
    transition: height 0.3s ease-in-out; /* Добавляем анимацию для плавного перехода */
    border: none;
	height:inherit;
		scrolling:no;
		}
	</style>
</head>

<body style="margin:0;">

<!-- Основной блок слайдера -->
<div class="slider mt-5">

  <!-- Первый слайд -->
  <div class="item">
        <iframe id="sld" src="/include_utf_8/main_page/content/slider-ra/v1.2/spiktek_v.1.2/index.html" align="middle"></iframe>
  </div>

  <!-- Второй слайд -->
  <div class="item" id="sld" style="display: none;">
        <iframe id="sld" src="/include_utf_8/main_page/content/block_big_banner3__content.php" align="middle"></iframe>
  </div>

  <!-- Кнопки-стрелочки -->
  <a class="previous" onclick="previousSlide()">&#10094;</a>
  <a class="next" onclick="nextSlide()">&#10095;</a>
</div>

<div id="main_page__block_big_slider" class="mt66-2"></div>
<script defer>
		function updateIframeSize() {
    const wrapper = document.querySelector('.slider');
    const frame = document.getElementById('sld');
    
    // Получаем реальную ширину блока-обёртки
    let currentWidth = wrapper.clientWidth || window.innerWidth;
    //alert(currentWidth);
    // Рассчитываем новую высоту с сохранением пропорций
    let newHeight = Math.round(currentWidth * (360 / 1340)+1);
    
    // Обновляем высоту фрейма
    wrapper.style.height = `${newHeight}px`;
    frame.style.height = `${newHeight}px`;
}

// Обновляем размер при загрузке страницы и при каждом изменении её размеров
window.addEventListener("load", updateIframeSize);
window.addEventListener("resize", updateIframeSize);
    window.addEventListener("DOMContentLoaded", () => {
        updateIframeSize();
        window.addEventListener("resize", updateIframeSize);
    });
	</script>
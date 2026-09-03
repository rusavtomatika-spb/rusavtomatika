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
	margin: auto;
    overflow: hidden;
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
/*	height:inherit;
	height: 360px;
*/}
@keyframes fade {
    /* Устанавливаем и изменяем степень прозрачности: */
    from {
        opacity: 0.4
    }
    to {
        opacity: 1
    }
}
	.desktop-only {
/*			max-width: 1340px;
			max-height: 360px;*/
    width: 100%;
    min-height:  360px; /* Начальная высота */
		min-width: 1340px;
    transition: height 0.3s ease-in-out; /* Добавляем анимацию для плавного перехода */
    border: none;
	height:inherit;
		scrolling:no;
		}
	.mobile-only {
/*			max-width: 1340px;
			max-height: 360px;*/
    width: 100%;
    min-height:  250px; /* Начальная высота */
		min-width: 970px;
    transition: height 0.3s ease-in-out; /* Добавляем анимацию для плавного перехода */
    border: none;
	height:inherit;
		scrolling:no;
		}
/* Скрываем все по умолчанию */
.banner-container .banner {
    display: none;
}

/* Полностью прячем контейнер для мобайла (<970px). 
Здесь можно использовать либо твой класс ".slider", либо "item" или даже сам ".banner-container". Главное - выбрать тот элемент, который оборачивает оба iframe. */
@media screen and (max-width: 969px) {
    /* Пример: */
    .item, .slider {
        display: none !important;
    }
}

/* Показываем Мобильную версию при ширине >= 970px И <= 1339px */
@media screen and (min-width: 970px) and (max-width: 1339px) {
    .banner-container .mobile-only {
        display: block !important;
    }
	.item, .slider {
        display: block !important;
		max-height: 250px;
		width: 970px;
	}
}

/* Показываем Десктопную версию при ширине > 1339px */
@media screen and (min-width: 1340px) {
    .banner-container .desktop-only {
        display: block !important;
    }
	.item, .slider {
        display: block !important;
		height: 360px;
		width: 1340px;
	}
}
	</style>
</head>

<body style="margin:0;">

<div class="slider mt-5">

<div class="item banner-container">
    <!-- Мобильный -->
    <iframe src="/include_utf_8/main_page/content/slider-ra/action-ra-mes.1.0/action-ra-mes.1.0_970x250/index.html" class="banner mobile-only"></iframe>
    <!-- Десктоп -->
    <iframe src="/include_utf_8/main_page/content/slider-ra/action-ra-mes.1.0/action-ra-mes.1.0_1340x360/index.html" class="banner desktop-only"></iframe>
</div>
</div>

<div id="main_page__block_big_slider" class="mt66-2"></div>

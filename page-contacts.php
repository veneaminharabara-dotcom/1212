<?php
/* Template: Контакты (contacts.html) — slug: contacts */
get_header();
?>
<main class="page">
	<section class="contacts">
		<div class="contacts__container">
			<div class="contacts__body">
				<div class="contacts__content">
					<h1 class="contacts__title title title--white">контакты</h1>
					<p class="contacts__text">Мы всегда рады вашим вопросам и предложениям! Свяжитесь с нами любым удобным способом:</p>
					<ul class="contacts__list">
						<li class="contacts__item">
							<div class="contacts__icon"><img src="/wp-content/themes/pravda3/img/icons/phone.svg" alt="Иконка телефона"></div>
							<a href="tel:88008888888" class="contacts__link">+7 (727) 310-99-69</a>
						</li>
						<li class="contacts__item">
							<div class="contacts__icon"><img src="/wp-content/themes/pravda3/img/icons/location.svg" alt="Иконка местоположения"></div>
							<span class="contacts__info">Адрес: г. Алматы, ул. Толе би, 83</span>
						</li>
					</ul>
					<div class="contacts__social social-contacts">
						<h5 class="social-contacts__title">Наши соц. сети: </h5>
						<ul class="social-contacts__list">
							<li class="social-contacts__item"><a href="#" class="social-contacts__link"><img src="/wp-content/themes/pravda3/img/icons/ytb.svg" alt="иконка ютуб"></a></li>
							<li class="social-contacts__item"><a href="#" class="social-contacts__link"><img src="/wp-content/themes/pravda3/img/icons/fb.svg" alt="иконка facebook"></a></li>
							<li class="social-contacts__item"><a href="#" class="social-contacts__link"><img src="/wp-content/themes/pravda3/img/icons/inst.svg" alt="иконка instagram"></a></li>
						</ul>
					</div>
				</div>

				<form action="#" class="contacts__form form-contacts">
					<div class="form-contacts__block">
						<div class="form-contacts__item">
							<label for="name" class="form-contacts__label">Имя</label>
							<input id="name" autocomplete="off" type="text" name="form[]" data-error="Ошибка" placeholder="Введите имя" class="form-contacts__input">
						</div>
						<div class="form-contacts__item">
							<label for="phone" class="form-contacts__label">Телефон</label>
							<input id="phone" autocomplete="off" type="text" name="form[]" data-error="Ошибка" placeholder="+7 (000) 000-00-00" class="form-contacts__input">
						</div>
						<div class="form-contacts__item">
							<label for="email" class="form-contacts__label">Email</label>
							<input id="email" autocomplete="off" type="text" name="form[]" data-error="Ошибка" placeholder="Ваш email" class="form-contacts__input">
						</div>
					</div>
					<button type="submit" class="form-contacts__button btn">Отправить</button>
				</form>
			</div>

			<div class="contacts__map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1280.2290655348183!2d76.93096180461403!3d43.25424575049249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38836962c0431f65%3A0x3c20ea1f1cd6e9f2!2z0YPQu9C40YbQsCDQotC-0LvQtSDQkdC4IDgzLCDQkNC70LzQsNGC0YsgMDUwMDAwLCDQmtCw0LfQsNGF0YHRgtCw0L0!5e0!3m2!1sru!2s!4v1771499331490!5m2!1sru!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>